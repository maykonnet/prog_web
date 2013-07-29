<?php

class UsuarioController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$SessionNamespace = new Zend_Session_Namespace('Usuario');
    	$SessionNamespace->usuario_id = '2';
    	if(empty($SessionNamespace->usuario_id)){
    		$this->_helper->redirector('usuario','editar');
    	}
    }

    public function loginAction()
    {
        // action body
    }

    public function logoutAction()
    {
        // action body
    }

    public function cadastroAction()
    {
    	$request = $this->getRequest();
    	$model_usuario = new Application_Model_Usuario();
    	
    	if ($request->isPost()) {
    		$formDados = $request->getPost();
    		echo '<pre>';
    		print_r($formDados);
    		if ($formDados) {
    			$resultado = false;
    			try {
    				$usuario_id = $model_usuario->inserirUsuario($formDados);
    			} catch (Exception $ex) {
    				$this->view->erro = $ex->getMessage();
    			}
    	
    			 $this->_helper->redirector('index','index');
    		}
    	}
    }

    public function editarAction()
    {
    	$request = $this->getRequest();
    	$model_usuario = new Application_Model_Usuario();
    	
    	if ($request->isPost()) {
    		$formDados = $request->getPost();
    		echo '<pre>';
    		print_r($formDados);
    		if ($formDados) {
    			$resultado = false;
    			try {
    				$usuario_id = $model_usuario->inserirUsuario($formDados);
    			} catch (Exception $ex) {
    				$this->view->erro = $ex->getMessage();
    			}
    	
    			 $this->_helper->redirector('index','index');
    		}
    	}
    }


}









