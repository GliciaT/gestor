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
		$cliente = array('name' => 'Vitória', 'associate_id'=> 10, 'email' => 'email@teste');
		//$this->adicionarCliente($cliente);
		//$this->exibirCliente($cliente);
		$var = array();
		$this->adicionarCliente($cliente);
		//$this->removerCliente($cliente);
		//$this->exibirCliente($cliente);
	}

	public function adicionarCliente($data=""){
		if (is_null($data)) {
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Null.";
			return;
		}
		$status = $this->model['clients_model']->insert(CLIENTS_NAME, $data);
			if(!$status){
				$this->return['success'] = FALSE;
				$this->return['error'] .= "Não foi possível inserir o Cliente.";
				return;
			}
		}
	}

	public function alterarCliente(){
		if (is_null($data)) {
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Null.";
			return;
		}
		$status = $this->model['clients_model']->select(CLIENTS_NAME,"WHERE id='" . $data['id']. "'");
		if(!$status){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Não foi possível selecionar o Cliente.";
			return;
		}else{
			$status = $this->model['clients_model']->update(CLIENTS_NAME,$data,"WHERE id = '" .$data['id']. "'");
			if (!$status) {
				$this->return['success'] = FALSE;
				$this->return['error'] .= "Não foi possível alterar o Cliente.";
				return;
			}
		}
	}

	public function removerCliente(){
		if (is_null($data)) {
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Null.";
			return;
		}
		$status = $this->model['clients_model']->select(CLIENTS_NAME,"WHERE id='" . $data['id']. "'");
		if(!$status){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Não foi possível selecionar o Cliente.";
			return;
		}else{
			$status = $this->model['clients_model']->delete(CLIENTS_NAME,$data,"WHERE id = '" .$data['id']. "'");
			if (!$status) {
				$this->return['success'] = FALSE;
				$this->return['error'] .= "Não foi possível remover o Cliente.";
				return;
			}
		}
	}

	public function exibirCliente($data=""){
		if (is_null($data)) {
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Null.";
		}else{
			$status = $this->model['clients_model']->select(CLIENTS_NAME,"WHERE id='" . $data['id']. "'");
			$client = $this->model['clients_model']->get_result();
			var_dump($client);
			if(!$status){
				$this->return['success'] = FALSE;
				$this->return['error'] .= "Não foi possível exibir o Cliente.";
				return;
			}
		}
	}

	//Depois de testar,  tentar evitar repetição de código com função para ver se é nulo e outra para ver se existe.
}
?>
