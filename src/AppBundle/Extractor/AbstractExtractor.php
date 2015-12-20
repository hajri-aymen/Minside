<?php


namespace AppBundle\Extractor;


abstract class AbstractExtractor
{
    const USER_CLASS = 'UserBundle\Entity\User';

    abstract function validate($request, $dataType);

    abstract function extract($data, $serializer);
}