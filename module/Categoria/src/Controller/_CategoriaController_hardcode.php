<?php
namespace Categoria\Controller;

//use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Json\Json as Json;


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
    }

    public function searchAction()
    {
        $q = $this->params()->fromRoute('q');
        $jsondata = file_get_contents($this->categorias);
        $arr_data = json_decode($jsondata, true);

        $result = array_search($q, array_column($arr_data, 'name'));

        return new JsonModel(array('query' => $q ,'result' => $result));
    }
    
}