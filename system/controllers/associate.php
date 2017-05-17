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
		//teste
	}

	public function adicionarAssociado($data=""){
		if(is_null($data)){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Data eh nula";
			return;
		}

		$status = $this->model['associate_model']->insert(ASSOCIATES_NAME, $data);
		
		if(!$status){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "O Associado nao foi adicionado";
			return;
		}
	}
	public function alterarAssociado($data=""){
		if(is_null($data)){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Data eh nula";
			return;
		}

		$status = $this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE id = ' " . $data['id']. " ' ");
		
		if(!$status){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "O Associado nao existe";
			return;
		}

		$status = $this->model['associate_model']->update(ASSOCIATES_NAME, $data, "WHERE id = '" . $data['id'] . " ' ");

		if(!$status){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "O Associado nao foi alterado";
			return;
		}
	}
	public function removerAssociado($data=""){
		if(is_null($data)){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Data eh nula";
			return;
		}

		$status = $this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE id = ' " . $data['id']. " ' ");
		
		if(!$status){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "O Associado nao existe";
			return;
		}

		$status = $this->model['associate_model']->delete(ASSOCIATES_NAME,"WHERE id= ' " . $data['id'] . " ' ");

		if(!$status){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Nao foi possivel remover o Associado";
			return;
		}
	}
	public function exibirAssociado($data){
		if(is_null($data)){
			$this->return['success'] = FALSE;
			$this->return['error'] .= "Data eh nula";
			return;
		}

		$status = $this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE id = ' " . $data['id']. " ' ");
		
		if($status){
		$associado = $this->model['associate_model']->get_result();
		var_dump($associado);
		}
		else{
			$this->return['success'] = TRUE;
			$this->return['error'] = "Associado nao existe ou houve um erro";

		}
	}

	public function listarTodosAssociados(){
		$this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE 1");
		$this->return['associates'] = $this->model['associate_model']->get_result();
	}

	public function listarAssociadosParticular($data=""){
		$this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE username = '" . $data[username] . "'");
		$this->return['associates'] = $this->model['associate_model']->get_result();
	}

	public function listarAssociadosPorSetor($data=""){
		$this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE sector = '" . $data[sector] . "'");
		$this->return = $this->model['associate_model']->get_result();
	}

	public function listarAssociadosPorCargo($data=""){
		$this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE position = '" . $data[position] . "'");
		$this->return = $this->model['associate_model']->get_result();
	}

	public function listarAssociadosPorEngenharia($data=""){
		$this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE engineering = '" . $data[engineering] . "'");
		$this->return = $this->model['associate_model']->get_result();
	}

	public function listarAssociadosPorStatus($data=""){
		$this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE status = '" . $data[status] . "'");
		$this->return = $this->model['associate_model']->get_result();
	}
}	
?>