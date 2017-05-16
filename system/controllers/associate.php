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
		$associado1 = array('name_id'=>'Fulo', 'id' => '1','username'=> 'Fulano', 'password'=>'123', 'engineering'=>'Computação', 'position'=>'Diretor', 'sector'=>'Projetos', 'email'=>'a@gmail.com');
		$associado2 = array('name_id'=>'Cicla', 'id' => '2','username'=> 'Ciclano', 'password'=>'123', 'engineering'=>'Civil', 'position'=>'Gerente', 'sector'=>'Comercial', 'email'=>'b@gmail.com');
		$associado3 = array('name_id'=>'Beltranora', 'id' => '3','username'=> 'Beltrano', 'password'=>'123', 'engineering'=>'Computação', 'position'=>'Analista', 'sector'=>'Comercial', 'email'=>'c@gmail.com');
		$this->listarAssociadosParticular($associado2);
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

	public function listarAssociadosParticular($data){
		$this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE username = '" . $data['username'] . "'");
		$this->return['associates'] = $this->model['associate_model']->get_result();
	}

	public function listarAssociadosPor($campo){
		$data=$this->get_post();
		$this->model['associate_model']->select(ASSOCIATES_NAME, "WHERE " . $campo . " = '" . $data[$campo] . "'");
		$this->return = $this->model['associate_model']->get_result();
	}
}	
?>