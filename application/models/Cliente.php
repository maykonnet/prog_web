<?php

class Application_Model_Cliente
{
	public function inserirCliente($dados)
	{

                $_db_cliente = new Application_Model_DbTable_Cliente();
                $dados_banco = array('Cliente_nome'     => $dados['cli_nome'],
                                     'Cliente_CPF'      => $dados['cli_cpf'],
                                     'Cliente_Sexo'     => $dados['cli_sexo'],
                                     'Cliente_Email'    => $dados['cli_email'],
                                     'Cliente_CEP'      => $dados['cli_cep'],
                                     'Cliente_Estado'   => $dados['cli_estado'],
                                     'Cliente_Cidade'   => $dados['cli_cidade'],
                                     'Cliente_Endereco' => $dados['cli_endereco']);
                //echo '<pre>'; print_r($dados_banco);
                //exit; 
                $_db_cliente->insert($dados_banco); 
	}
	public function getCliente()
	{	
		$_db_cliente = new Application_Model_DbTable_Cliente();
		$dados_banco = $_db_cliente->fetchAll();
		echo '<pre>'; print_r($dados_banco);
               exit;  
                $dados_cliente = array();
		foreach($dados_banco as $cliente){
			$dados_cliente[] = array('Cliente_id'       => $cliente['Cliente_id'],
					         'Cliente_nome'     => $cliente['Cliente_nome'],
                                                 'Cliente_sexo'     => $cliente['Cliente_sexo'],
                                                 'Cliente_email'    => $cliente['Cliente_email'],
                                                 'Cliente_CEP'      => $cliente['Cliente_CEP'],
                                                 'Cliente_Estado'   => $cliente['Cliente_Estado'],
                                                 'Cliente_Endereco' => $cliente['Cliente_Endereco'],
                                                 'Cliente_Cidade'   => $cliente['Cliente_Cidade']);
		}
		return $dados_cliente;	
	}
}
