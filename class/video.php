<?php 
class video extends database{
	function __construct(){
		database::__construct();
		$this->table('video');
	}
	public function addVideo($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallVideo($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getlatestvideo($args=array(),$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => 0,
					'noofdata' => 1
					)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getVideoById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteVideobyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatevideo($data,$id,$is_die=false){
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