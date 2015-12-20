<?php


namespace AppBundle\Extractor;

use AppBundle\Extractor\AbstractExtractor;
use AppBundle\Extractor\ExtractionEngineInterface;
use AppBundle\Extractor\ExtractorEnum;
use AppBundle\Extractor\ExtractorFactory;

class ExtractionEngine implements ExtractionEngineInterface
{
    protected $extractor;
    protected $dataType;
    protected $url;
    protected $reader;
    protected $serializer;


    public function __construct($url, $dataType, $reader, $serializer)
    {
        $this->reader = $reader;
        $this->serializer = $serializer;
        $this->dataType = $dataType;
        $this->url = $url;
        if ($dataType == ExtractorEnum::EXTRACTOR_JSON) {
            $this->extractor = ExtractorFactory::create(ExtractorEnum::EXTRACTOR_JSON);
        } elseif ($dataType == ExtractorEnum::EXTRACTOR_XML) {
            $this->extractor = ExtractorFactory::create(ExtractorEnum::EXTRACTOR_XML);
        } else {
            $this->extractor = null;
        }
    }

    public function exploit()
    {
        $content = array();
        $extractor = $this->extractor;
        $dataType = $this->dataType;
        $url = $this->url;
        $reader = $this->reader;
        $serializer = $this->serializer;
        $reader->get($url);
        $request = $reader->get($url);
        $data = $request->send();

        if(is_object($extractor)){
            if($extractor->validate($request, $dataType)){
                $content =$extractor->extract($data, $serializer);
                return $content;
            }
        } else {
            //TODO::erreur
            die('erreur');
        }
        return $content;

    }

//    public function executeCommand($url)
//    {
//        $kernel = $this->get('kernel');
//        $application = new Application($kernel);
//        $application->setAutoExit(false);
//
//        $input = new ArrayInput(array(
//            'command' => 'ws:exploit',
//            'url' => $url,
//        ));
//        // You can use NullOutput() if you don't need the output
//        $output = new BufferedOutput();
//        $application->run($input, $output);
//
//        // return the output, don't use if you used NullOutput()
//        $content = $output->fetch();
//
//        // return new Response(""), if you used NullOutput()
//        return $content;
//    }
}
