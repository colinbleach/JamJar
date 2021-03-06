<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\CloneService;
use PHPUnit_Framework_MockObject_MockObject;

class DefaultServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $cloneFactoryMock;

    protected $emMock;

    protected $object;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->cloneFactoryMock = $this
            ->getMockBuilder('admin.perform.clone')
            ->getMock();

        $this->emMock = $this
            ->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = $this->getMockBuilder('AppBundle:JamJar')->getMock();
    }

    public function testIndex()
    {
        $this->runTest(1);
        $this->runTest(2);
    }

    public function runTest($value)
    {
        $this->emMock->expects($this->exactly($value))
            ->method('persist')
            ->with('AppBundle:JamJar');

        $this->cloneFactoryMock->expects($this->exactly($value))
            ->method('cloneObject');

        $service = new CloneService($this->emMock, $this->cloneFactoryMock);

        $service->cloneObject($this->object,$value);
    }
}
