<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\CloneService;
use PHPUnit_Framework_MockObject_MockObject;

class DefaultServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $cloneFactoryMock = $this
            ->getMockBuilder('admin.perform.clone')
            ->getMock();

        $emMock = $this
            ->getMockBuilder('\Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();

        $emMock->expects($this->once())
            ->method('persist')
            ->with('AppBundle:JamJar');

        $cloneFactoryMock->expects($this->once())
            ->method('cloneObject');

        $service = new CloneService($emMock, $cloneFactoryMock);

        $service->cloneObject(1,1);

        $emMock->expects($this->exactly(2))
            ->method('persist')
            ->with('AppBundle:JamJar');

        $cloneFactoryMock->expects($this->exactly(2))
            ->method('cloneObject');

        $service = new CloneService($emMock, $cloneFactoryMock);

        $service->cloneObject(1,2);
    }
}
