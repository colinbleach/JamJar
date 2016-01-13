<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;

class CloneService
{
    protected $em;

    /** @var CloneFactory $cloneFactory */
    protected $cloneFactory;

    public function __construct(EntityManager $em, $cloneFactory)
    {
        $this->em = $em;
        $this->cloneFactory = $cloneFactory;
    }

    public function cloneObject($object,$count)
    {
        for($i=0; $i < $count; $i++)
        {
            $this->em->persist($this->cloneFactory->cloneObject($object));;
        }
    }

}