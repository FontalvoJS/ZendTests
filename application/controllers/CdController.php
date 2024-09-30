<?php
class CdController extends Zend_Controller_Action
{

    // HICE 2 METODOS PERSONALIZADOS: UNO PARA OBTENER LOS DATOS CRUDOS DESDE AJAX (getObjectRequest) 
    // Y OTRO PARA RESPONDER EL JSON (responseJson)
    protected $cdModel = null;


    public function init()
    {
        $this->cdModel = new Application_Model_Cd();
    }
    public function indexAction()
    {
        $this->view->cds = $this->cdModel->fetchAllCds()->toArray();
    }


    public function createAction()
    {
        try {
            $data = $this->getObjectRequest();
            $res = $this->cdModel->createCd($data);
            if ($res == 'exists') {
                $this->responseJson(400, $data, 'error', 'CD already exists');
            }else{
                $this->responseJson(200, $data, 'success', 'CD created');
            }
        } catch (Exception $e) {
            $this->responseJson(400, $data, 'error', $e->getMessage());
        }
    }
}
