<?php

namespace ISECH\IndicadoresBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;

class DiccionarioAdmin extends Admin
{
    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'descripcion' // name of the ordered field (default = the model id field, if any)
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('codigo', null, array('label'=> $this->getTranslator()->trans('codigo')))
            ->add('descripcion', null, array('label'=> $this->getTranslator()->trans('descripcion')))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('descripcion', null, array('label'=> $this->getTranslator()->trans('descripcion')))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('codigo', null, array('label'=> $this->getTranslator()->trans('codigo')))
            ->add('descripcion', null, array('required'=>false, 'label'=> $this->getTranslator()->trans('descripcion')))
        ;
    }
    
    public function validate(ErrorElement $errorElement, $object)
    {
    	$piecesURL = explode("/", $_SERVER['REQUEST_URI']);
    	$pieceAction = $piecesURL[count($piecesURL) - 1]; // create or update
    	$pieceId = $piecesURL[count($piecesURL) - 2]; // id/edit
    
    	$obj = new \ISECH\IndicadoresBundle\Entity\Diccionario;
    
    	$rowsRD = $this->getModelManager()->findBy('IndicadoresBundle:Diccionario',
    			array('codigo' => $object->getCodigo()));
    
    	if (strpos($pieceAction,'create') !== false) // entra cuando es ALTA
    	{
    		if (count($rowsRD) > 0){
    			$errorElement
    			->with('codigo')
    			->addViolation($this->getTranslator()->trans('registro existente, no se puede duplicar'))
    			->end();
    		}
    	}
    	else // entra cuando es EDICION
    	{
    		if (count($rowsRD) > 0){
    			$obj = $rowsRD[0];
    			if ($obj->getId() != $pieceId)
    			{
    				$errorElement
    				->with('codigo')
    				->addViolation($this->getTranslator()->trans('registro existente, no se puede duplicar'))
    				->end();
    			}
    		}
    	}
    }

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        $actions['delete'] = null;
    }
}
