<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadExerciseData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $objects = \Nelmio\Alice\Fixtures::load(__DIR__.'/fixtures.yml', $manager, ['providers' => [$this]]);
    }

    public function randomType()
    {
        $type = ['strawberry', 'blackcurrant', 'raspberry'];

        return $type[array_rand($type)];
    }
}