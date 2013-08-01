<?php

class UsuarioController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	/*
    	$SessionNamespace = new Zend_Session_Namespace('Usuario');
    	$SessionNamespace->usuario_id = '5';
    	if(!empty($SessionNamespace->usuario_id)){
    		$this->_helper->redirector('usuario','editar');
    	}*/
    	
    	$model_usuario = new Application_Model_Usuario();
    	$this->view->usuarios = $model_usuario->getUsuarios();
    }

    public function loginAction()
    {
    	$request = $this->getRequest();
    	$model_usuario = new Application_Model_Usuario();
    	 
    	if ($request->isPost()) {
    		$formDados = $request->getPost();
    		if ($formDados) {
    			$resultado = false;
    			try {
    				$usuario_dados = $model_usuario->login($formDados);
			    	$SessionNamespace = new Zend_Session_Namespace('Usuario');
			    	$SessionNamespace->usuario_id = $usuario_dados['usuario_id'];
			    	$SessionNamespace->usuario_nome = $usuario_dados['usuario_nome'];
			    	$SessionNamespace->usuario_sexo = $usuario_dados['usuario_sexo'];
			    	$SessionNamespace->usuario_login = $usuario_dados['usuario_login'];			
    				
    			} catch (Exception $ex) {
    				$this->view->erro = $ex->getMessage();
    			}
    			 
    			$this->_helper->redirector('index','index');
    		}
    	}
    }

    public function logoutAction()
    {		
		if (Zend_Session:: namespaceIsset('Usuario')) {
	        $SessionAluno = new Zend_Session_Namespace('Usuario');
	        $SessionAluno->unsetAll('');
        }

        $this->_helper->redirector('index', 'index');
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
    	
    	$SessionNamespace = new Zend_Session_Namespace('Usuario');
    	$usuario_id = $SessionNamespace->usuario_id;
    	
    	$dados_usuario = $model_usuario->getDadosUsuario($usuario_id);
    	$this->view->usuario_id = $usuario_id;
    	$this->view->usuario_nome = $dados_usuario['usuario_nome'];
    	$this->view->usuario_sexo = $dados_usuario['usuario_sexo'];
    	$this->view->usuario_login = $dados_usuario['usuario_login'];
    	$this->view->usuario_senha = $dados_usuario['usuario_senha'];
    	    	
    	if($request->isPost()) {
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









