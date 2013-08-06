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
        $this->view->cliente = $model_cliente->getCliente();
    }
    
    public function cadastroAction()
    {		
        $request = $this->getRequest();
        $model_cliente = new Application_Model_Cliente();
        if ($request->isPost()) {
                $formCliente = $request->getPost();
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
    public function editarAction()
    {
		$request = $this->getRequest();
		$model_cliente = new Application_Model_Cliente();
                if($request->isPost()) {
			$formDados = $request->getPost();
                        if ($formDados) {
				$resultado = false;
				try {
					$cliente_id = $model_cliente->updateCliente($formDados);
					$this->_helper->redirector('index','cliente');
				} catch (Exception $ex) {
					$this->view->erro = $ex->getMessage();
				}
				 
				// $this->_helper->redirector('index','index');
			}
		}
                else{                
                    $Cliente_id = $request->getParam('id');
                    if ($Cliente_id){
                        $dados_cliente = $model_cliente->getDadosCliente($Cliente_id);
                        $this->view->cliente_id       = $Cliente_id;
                        $this->view->cliente_nome     = $dados_cliente['Cliente_nome'];
                        $this->view->cliente_Email    = $dados_cliente['Cliente_Email'];
                        $this->view->cliente_sexo     = $dados_cliente['Cliente_Sexo'];
                        $this->view->cliente_cep      = $dados_cliente['Cliente_CEP'];
                        $this->view->cliente_estado   = $dados_cliente['Cliente_Estado'];
                        $this->view->cliente_endereco = $dados_cliente['Cliente_Endereco'];
                        $this->view->cliente_cidade   = $dados_cliente['Cliente_Cidade'];
                        $this->view->cliente_cpf      = $dados_cliente['Cliente_CPF'];                    
                    }
                }
    }
    
    public function removerAction()
    {
		$request = $this->getRequest();
		$model_cliente = new Application_Model_Cliente();
		 
		$cliente_id = $request->getParam('id');

		try {
			$model_cliente->excluirCliente($cliente_id);
			$this->_helper->redirector('index','cliente');
		} catch (Exception $ex) {
			$this->view->erro = $ex->getMessage();
		}
    }
    
}

