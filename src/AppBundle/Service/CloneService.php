<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class CloneService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function cloneObject($object,$count)
    {
        var_dump($count);
        for($i=0; $i < $count; $i++)
        {
            $this->em->persist(clone($object));
            var_dump($i);
        }
        $this->em->flush();
    }
}