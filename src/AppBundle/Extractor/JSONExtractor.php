<?php

namespace AppBundle\Extractor;

use AppBundle\Extractor\AbstractExtractor;
use AppBundle\Extractor\ExtractorEnum;

class JSONExtractor extends AbstractExtractor
{

    public function validate($request, $dataType)
    {

        if ($dataType == ExtractorEnum::EXTRACTOR_JSON) {
            $contentType = $request->send()->getHeaders()->get('content-type');
            if ($contentType == ExtractorEnum::CONTENT_TYPE_JSON) {

                return true;
            }
        }
        return false;

    }

    public function extract($data, $serializer)
    {
        $content = array();
        foreach ($data->json() as $element) {
            $element['name'] = $element['name']['first'] .' '. $element['name']['last'];
            unset($element['friends']);
            unset($element['range']);
            unset($element['tags']);
            $content[] = $element;


//            $user = $serializer->deserialize(json_encode($element), parent::USER_CLASS, ExtractorEnum::EXTRACTOR_JSON);

        }

        return $content;

    }

}