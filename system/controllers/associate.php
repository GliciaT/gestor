<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Associate extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load_model('associate_model');
	}

	public function test(){
		//testes
	}

	public function xd(){
		echo "entrou";
	}
	public function adicionarAssociado($data=""){
		$this->model['associate_model']->insert(ASSOCIATES_NAME, $data);
	}
	public function alterarAssociado($data=""){
		$this->model['associate_model']->update(ASSOCIATES_NAME, $data, "WHERE id = '" . $data['id'] . " ' ");
	}
	public function removerAssociado($data=""){
		$this->model['associate_model']->delete(ASSOCIATES_NAME,"WHERE id= ' " . $data['id'] . " ' ");
	}
	public function exibirAssociado($id){
		$this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE id = ' " . $id['id']. " ' ");
		$this->model['associate_model']->get_result();
		var_dump($id);
	}
}	
?>