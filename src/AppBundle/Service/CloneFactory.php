<?php
namespace AppBundle\Service;

class CloneFactory
{
    public function cloneObject($object)
    {
        return clone($object);
    }
}