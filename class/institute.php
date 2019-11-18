<?php 
class institute extends database{
	function __construct(){
		database::__construct();
		$this->table('institute');
	}
	public function addInstitute($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallInstitute($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getInstituteById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteInstitutebyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updateinstitute($data,$id,$is_die=false){
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