<?php
defined('BASE_PATH') OR exit('No direct script access allowed');
class Projects extends Controller
{
	function __construct(){
		parent::__construct();
		$this->load_model('projects_model');
		//$this->load_lib('test_lib');
	}
	public function test(){
		$projeto = array(
      'id'=>16,
      'name'=>'projeto 3',
      'associate_id'=>10,
      'client_id'=>1,
      'status'=>'desenvolvimento',
      'permission_level'=>1,
      'price'=>0,
      'engineering'=>'Automação'
    );
    //$this->adicionar_projeto($projeto);
    # já testado
    //$this->alterar_projeto($projeto);
    # já testado
    //$this->exibir_projeto($projeto);
    # já testado
    // $this->remover_projeto($projeto);
    # já testado
	}
  // funcoes de projetos
  public function adicionar_projeto($data=""){
    $this->model['projects_model']->insert(PROJECTS_NAME,$data);
  }
  public function alterar_projeto($data=""){
    $this->model['projects_model']->update(PROJECTS_NAME,$data,"WHERE id = '" .$data['id']. "'");
  }
  public function remover_projeto($data=""){
    $this->model['projects_model']->delete(PROJECTS_NAME,"WHERE id = '" . $data['id']. "'");
  }
 public function exibir_projeto($data=""){
   $this->model['projects_model']->select(PROJECTS_NAME,"WHERE id='" . $data['id']. "'");
     $projeto = $this->model['projects_model']->get_result();
     print_r($projeto);
   }
 }
?>
