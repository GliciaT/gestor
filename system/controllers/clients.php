<?php
defined('BASE_PATH') OR exit('No direct script access allowed');
class Clients extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load_model('clients_model');
    //$this->load_lib('test_lib'); aqui você só declara se for usar msm a biblioteca, agora não será necessário
	}
	public function test(){
		$cliente = array('name' => 'Vitória', 'ddd_1' => '81', 'tel_primary' => '111111111', 'ddd_2' => '81', 'tel_optional' => '222222222', 'email' => 'email@teste');
		$this->adicionarCliente($cliente);
	}
  public function adicionarCliente($data=""){
		$this->model['cliente_model']->insert(CLIENTS_NAME, $data);
  }
	public function alterarCliente(){
  }
	public function removerCliente(){
  }
}
?>
