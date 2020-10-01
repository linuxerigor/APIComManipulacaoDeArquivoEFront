<?php
namespace Categoria\Controller;

//use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class CategoriaController extends AbstractRestfulController
{

    public function indexAction()
    {
        return new JsonModel(array('data' => "Welcome to the Zend Framework Album API example"));
    }

    public function addAction()
    {
    }

    public function editAction($id)
    {
        return new JsonModel(array('data' => "Edit ".$id));
    }

    public function deleteAction()
    {
    }
}