<?php


namespace AppBundle\Extractor;

use AppBundle\Extractor\JSONExtractor;
use AppBundle\Extractor\XMLExtractor;

class ExtractorFactory
{

    public static function create($extractor)
    {
        $class_name = "AppBundle\\Extractor\\" . strtoupper($extractor) . 'Extractor';
        return new $class_name();
    }
}