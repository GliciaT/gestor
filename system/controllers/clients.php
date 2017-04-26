<?php
defined('BASE_PATH') OR exit('No direct script access allowed');
class Clients extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load_model('clients_model');
	}
	public function test(){
		$cliente = array('id' => '10', 'name' => 'Vitória', 'ddd_1' => '81', 'tel_primary' => '111111111', 'ddd_2' => '81', 'tel_optional' => '222222222', 'email' => 'email@teste');
		//$this->adicionarCliente($cliente);
		$this->exibirCliente($cliente);
	}

	public function adicionarCliente($data=""){
		$this->model['clients_model']->insert(CLIENTS_NAME, $data);
  }

	public function alterarCliente(){
		$this->model['clients_model']->update(CLIENTS_NAME,$data,"WHERE id = '" .$data['id']. "'");
  }

	public function removerCliente(){
		$this->model['clients_model']->delete(CLIENTS_NAME,$data,"WHERE id = '" .$data['id']. "'");
  }

	public function exibirCliente($data=""){
    $this->model['clients_model']->select(CLIENTS_NAME,"WHERE id='" . $data['id']. "'");
      $cliente = $this->model['clients_model']->get_result();
      var_dump($cliente);
    }
}
?>
