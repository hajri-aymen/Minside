<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use UserBundle\Entity\User;
use AppBundle\Extractor\ExtractionEngine;

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
            )
            ->addArgument(
                'dataType',
                InputArgument::REQUIRED,
                'xml/json'
            );

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');
        $dataType = $input->getArgument('dataType');
        $serializer = $this->getContainer()->get('jms_serializer');
        $guzzleService = $this->getContainer()->get('guzzle.client');
        $guzzleService->get($url);
        $extractionEngine = new ExtractionEngine($url, $dataType, $guzzleService, $serializer);
        $response = $extractionEngine->exploit();
        $userManager = $this->getContainer()->get('fos_user.user_manager');
        if (count($response) > 0) {
            foreach ($response as $user) {

                $exists = $userManager->findUserBy(array('email' => $user->getEmail()));

                // Modifier l'utilisateur s'il existe deja
                if ($exists instanceof User) {
                    $userAdmin = $exists;
                } else {
                    $user->__construct();
                    $userAdmin = $user;
                }
                $userAdmin->setUsername($user->getEmail());
                $userAdmin->setUsernameCanonical($user->getEmail());
                $userAdmin->setEmailCanonical($user->getEmail());
                $userAdmin->setEnabled(true);
                $userAdmin->addRole('ROLE_ADMIN');

                $userManager->updateUser($userAdmin, true);
            }
            if ($url) {
                $text = 'Success ... users were added to database';
            } else {
                $text = 'Error ... an error occured when parsing json response';
            }
        } else {
            $text = 'Une erreur est survenue, veuillez vérifier votre saisie';
        }

        $output->writeln($text);
    }
}