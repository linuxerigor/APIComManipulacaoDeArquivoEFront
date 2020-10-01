<?php
namespace Categoria\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class CategoriaController extends AbstractRestfulController
{
    private $categorias  = "./data/categorias.json";

    public function indexAction()
    {
        $jsondata = file_get_contents($this->categorias);
        $arr_data = json_decode($jsondata, true);

        return new JsonModel(array('data' => $arr_data));
    }

    public function addAction()
    {
        // $request = $this->getRequest();
        // if ($request->isPost()) {
        // }
        try {

            /** Get max id */
            // $jsondata = file_get_contents($this->categorias);
            // $arr_data = json_decode($jsondata, true);

            $item = [
                'id' => '1',
                'name' => 'teste 1'
            ];
            $jsondata = file_get_contents($this->categorias);
            $arrdata = json_decode($jsondata, true);

            if(!is_array($arrdata))
                $arrdata = [];

            array_push($arrdata,$item);
            $jsondata = json_encode($arrdata, JSON_PRETTY_PRINT);

            if(file_put_contents($this->categorias, $jsondata)) {
                return new JsonModel(array('success' => "Categoria salva com sucesso"));
            }else{
                return new JsonModel(array('error' => 'Erro ao salvar categoria'));    
            }

        } catch (\InvalidArgumentException $e) {
            return new JsonModel(array('error' => "Ocorreu um erro"));
        }


    }

    public function editAction()
    {
        $request = $this->getRequest();
        $id = $this->params()->fromRoute('id');
        try {
            
        } catch (\InvalidArgumentException $ex) {
            // Logger $e->getMessage()
            return new JsonModel(array('error' => "Ocorreu um erro"));
        }
        
        return new JsonModel(array('data' => "Edit ".$id));
    }

    public function deleteAction()
    {
        $jsondata = file_get_contents($this->categorias);
        $arrdata = json_decode($jsondata, true);

        $arrdata = array_filter($arrdata,function($a){
            $id = $this->params()->fromRoute('id');
            return ($id != $a['id'])? $id : false;
        });

        try {

            $jsondata = json_encode($arrdata, JSON_PRETTY_PRINT);

            if(file_put_contents($this->categorias, $jsondata)) {
                return new JsonModel(array('success' => "Categoria deletada com sucesso"));
            }else{
                return new JsonModel(array('error' => 'Erro ao deletar categoria'));    
            }

        } catch (\InvalidArgumentException $e) {
            return new JsonModel(array('error' => "Ocorreu um erro"));
        }


    }

    public function searchAction()
    {

        $jsondata = file_get_contents($this->categorias);
        $arr_data = json_decode($jsondata, true);

        $arr_data = array_filter($arr_data,function($a){
            $q = $this->params()->fromRoute('q');
            return preg_match("/.*$q.*/",$a['name']);
        });

        return new JsonModel(array('query' => $this->params()->fromRoute('q') ,'result' => $arr_data));
    }

}