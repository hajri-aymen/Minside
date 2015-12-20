<?php

namespace AppBundle\Extractor;

use AppBundle\Extractor\AbstractExtractor;
use AppBundle\Extractor\ExtractorEnum;

class XMLExtractor extends AbstractExtractor
{

    public function validate($request, $dataType)
    {

        if ($dataType == ExtractorEnum::EXTRACTOR_XML) {
            $contentType = $request->send()->getHeaders()->get('content-type');
            if ($contentType == ExtractorEnum::CONTENT_TYPE_XML) {

                return true;
            }
        }
        return false;
    }

    public function extract($data, $serializer)
    {
        $content = array();
        foreach($data->xml() as $element) {

            unset($element->{'tags'});
            unset($element->{'friends'});
            $content[] = (array)$element;

//            $user = $serializer->deserialize($element->asXML(), parent::USER_CLASS, ExtractorEnum::EXTRACTOR_XML);
//            dump($user);die;
        }

        return$content;

    }

}