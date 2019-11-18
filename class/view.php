<?php 
class view extends database{
	function __construct(){
		database::__construct();
		$this->table('view');
	}
	public function addView($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallView($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getlatestview($args=array(),$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => 0,
					'noofdata' => 1
					)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getViewById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteViewbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updateview($data,$id,$is_die=false){
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