<?php 
class mail extends database{
	function __construct(){
		database::__construct();
		$this->table('mail');
	}
	public function addMail($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallMail($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getMailById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getlatestmail($args=array(),$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => 0,
					'noofdata' => 1
					)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getMailUsingLimit($offset,$noofdata,$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => $offset,
					'noofdata' => $noofdata
					)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteMailbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatemail($data,$id,$is_die=false){
		$args = array(
					'where'	=> array(
						'and' => array(
							'id' => $id
						)
					)
				);
	return $this->updatedata($data,$args,$is_die);
	}
}