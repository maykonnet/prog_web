<?php

class ClienteController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {	
        $model_cliente = new Application_Model_Cliente();
        $model_cliente->getCliente();
    }
    
    public function cadastroAction()
    {		
        $request = $this->getRequest();
        $model_cliente = new Application_Model_Cliente();
        if ($request->isPost()) {
                $formCliente = $request->getPost();
                echo $request->getPost();
 //               echo '<pre>'; print_r($formCliente);
//                exit;                
                if ($formCliente) {
                        try {
                            $cliente_id = $model_cliente->inserirCliente($formCliente);
                        } catch (Exception $ex) {
                                $this->view->erro = $ex->getMessage();
                        }
                       $this->_helper->redirector('index','index');
                }
        }
    }    
}

