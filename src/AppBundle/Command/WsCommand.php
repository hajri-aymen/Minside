<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use UserBundle\Entity\User;

class WsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ws:exploit')
            ->setDescription('command to parse ws xml/json response and set it dynamicly to database')
            ->addArgument(
                'url',
                InputArgument::REQUIRED,
                'Entrez l\'url de votre api'
            );

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $guzzleService =  $this->getContainer()->get('guzzle.client');
        $url = $input->getArgument('url');
        $guzzleService->get($url);
        $request = $guzzleService->get($url);
        $response = $request->send()->json();
        $userManager = $this->getContainer()->get('fos_user.user_manager');
        foreach($response as $userArray) {

            $exists = $userManager->findUserBy(array('email' => $userArray['email']));

            // Modifier l'utilisateur s'il existe deja
            if ($exists instanceof User) {
                $userAdmin = $exists;
            } else {
                $userAdmin = $userManager->createUser();
            }
            $userAdmin->setUsername($userArray['email']);
            $userAdmin->setEmail($userArray['email']);
            $userAdmin->setPlainPassword($userArray['guid']);
            $userAdmin->setEnabled(true);
            $userAdmin->addRole('ROLE_ADMIN');

            $userManager->updateUser($userAdmin, true);
        }
        if ($url) {
            $text = 'Success ... users were added to database';
        } else {
            $text = 'Error ... an error occured when parsing json response';
        }

        $output->writeln($text);
    }
}