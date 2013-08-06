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
                $_db_cliente->insert($dados_banco); 
	}
	public function updateCliente($dados)
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
  
                $_db_cliente->update($dados_banco,'Cliente_id='.$dados['cli_id']); 
	}        
        
	public function getCliente()
	{	
		$_db_cliente = new Application_Model_DbTable_Cliente();
		$dados_banco = $_db_cliente->fetchAll();
                $dados_cliente = array();
		foreach($dados_banco as $cliente){
			$dados_cliente[] = array('Cliente_id'       => $cliente['Cliente_id'],
					         'Cliente_nome'     => $cliente['Cliente_nome'],
                                                 'Cliente_Sexo'     => $cliente['Cliente_Sexo'],
                                                 'Cliente_Email'    => $cliente['Cliente_Email'],
                                                 'Cliente_CEP'      => $cliente['Cliente_CEP'],
                                                 'Cliente_Estado'   => $cliente['Cliente_Estado'],
                                                 'Cliente_Endereco' => $cliente['Cliente_Endereco'],
                                                 'Cliente_CPF'      => $cliente['Cliente_CPF'],                            
                                                 'Cliente_Cidade'   => $cliente['Cliente_Cidade']);
		}
		return $dados_cliente;	
	}
        public function getDadosCliente($Cliente_id)
	{
		$_db_cliente = new Application_Model_DbTable_Cliente();
		$dados_banco = $_db_cliente->fetchRow('Cliente_id ='.$Cliente_id);
                $dados = array('Cliente_id'        => $dados_banco['Cliente_id'],
			       'Cliente_nome'     => $dados_banco['Cliente_nome'],
			       'Cliente_Sexo'     => $dados_banco['Cliente_Sexo'],
                               'Cliente_Email'    => $dados_banco['Cliente_Email'],
                               'Cliente_CEP'      => $dados_banco['Cliente_CEP'],
                               'Cliente_Estado'   => $dados_banco['Cliente_Estado'],
                               'Cliente_Endereco' => $dados_banco['Cliente_Endereco'],
                               'Cliente_CPF'      => $dados_banco['Cliente_CPF'],                 
                               'Cliente_Cidade'   => $dados_banco['Cliente_Cidade']);
		return $dados;			
	}                
        
	public function excluirCliente($cliente_id)
	{
		$_db_cliente = new Application_Model_DbTable_Cliente();
		$_db_cliente->delete('Cliente_id ='.$cliente_id);		
	}
}
