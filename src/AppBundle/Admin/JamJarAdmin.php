<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\AppBundle;
use AppBundle\Service\CloneService;

class JamJarAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('type', 'entity', array(
            'class' => 'AppBundle\Entity\JamType',
            'property' => 'name',));
        $formMapper->add('year', 'entity', array(
            'class' => 'AppBundle\Entity\JamYear',
            'property' => 'year',));
        $formMapper->add('comment', 'text', array('required' => false));
        $formMapper->add('amount', 'number', array('mapped'=> false, 'data' => 1));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->add('type.name');
        $listMapper->add('year.year');
        $listMapper->add('comment');
    }

    public function prePersist($object)
    {
        $count = (int)$this->getForm()->get('amount')->getData();

        $cloneService = $this->getConfigurationPool()->getContainer()->get('admin.clone');

        $cloneService->cloneObject($object,$count);
    }
}