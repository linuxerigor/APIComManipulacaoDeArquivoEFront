<?php
namespace Categoria\Controller;

use DateTime;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class CategoriaController extends AbstractRestfulController
{
    private $categoriaspath  = "./data/categorias.json";

    /**
     * Função para exibir todas as categorias
     */
    public function indexAction()
    {
        $arrdata = $this->readCategorias();
        return new JsonModel(array('data' => $arrdata));
    }

    /**
     * Função para adicionar uma nova categoria
     * @Input
     *     name: String
     */
    public function addAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost())
           return new JsonModel(array('error' => 'method not allowed'));   

        $arrdata = $this->readCategorias();

        $ids = array_column($arrdata, 'id');
        $next = (max($ids) + 1) ?? 1 ;

        $datetime = new DateTime('NOW');

        $item = [
            'id' => $next,
            'name' => $request['name'],
            'created' => $datetime->format('Y-m-d H:i:s'),
            'modified' => $datetime->format('Y-m-d H:i:s')
        ];
        array_push($arrdata,$item);

        if($this->storeCategorias($arrdata)){
            return new JsonModel(array('success' => "Categoria salva com sucesso"));
        }else{
            return new JsonModel(array('error' => 'Erro ao salvar categoria'));    
        }

    }

    /**
     * Função para alterar uma categoria
     * @Input
     *     id: Int
     * @Post
     *     name: String
     */
    public function editAction()
    {
        $id = $this->params()->fromRoute('id');
        $request = $this->getRequest();
        if (!$request->isPost())
            return new JsonModel(array('error' => 'method not allowed'));    
        
        $arrdata = $this->readCategorias();

        $datetime = new DateTime('NOW');

        $arrdata = array_map(function($k) use ($request, $id, $datetime){
            if($id == $k['id']){
                $k['name'] = $request['name'];
                $k['modified'] = $datetime->format('Y-m-d H:i:s');
            }
            return $k;
        },$arrdata);

        if($this->storeCategorias($arrdata)){
            return new JsonModel(array('success' => "Categoria alterada com sucesso"));
        }else{
            return new JsonModel(array('error' => 'Erro ao deletar categoria'));    
        }
    }

    /**
     * Função para excluir uma categoria
     * @Input
     *     id: Int
     */
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        $arrdata = $this->readCategorias();

        $arrdata = array_filter($arrdata,function($a) use($id){
            return ($id != $a['id'])? $id : false;
        });

        if($this->storeCategorias($arrdata)){
            return new JsonModel(array('success' => "Categoria deletada com sucesso"));
        }else{
            return new JsonModel(array('error' => 'Erro ao deletar categoria'));    
        }

    }

    /**
     * Função para procurar uma categoria
     * @Post
     *     q: String (LIKE AS)
     */
    public function searchAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost())
           return new JsonModel(array('error' => 'method not allowed'));    
        
        $arrdata = $this->readCategorias();

        $arrdata = array_filter($arrdata,function($a) use($request){
            return preg_match("/.*{$request['q']}.*/",$a['name']);
        });

        return new JsonModel(array('query' => $this->params()->fromRoute('q') ,'result' => $arrdata));
    }

    /**
     * Função para ler do arquivo json
     */
    private function readCategorias(){
        try {
            $jsondata = file_get_contents($this->categoriaspath);
            $data = json_decode($jsondata, true);

            if(!is_array($data))
                    $data = [];

            return $data;
        } catch (\InvalidArgumentException $e) {
            return array([]);
        }
        return array([]);
    }

    /**
     * Função para escrever no arquivo json
     */
    private function storeCategorias($data){
        try {
            $jsondata = json_encode($data, JSON_PRETTY_PRINT);
            if(file_put_contents($this->categoriaspath, $jsondata)) {
                return true;
            }

        } catch (\InvalidArgumentException $e) {
            return false;
        }
        return false;
    }

}