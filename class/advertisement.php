<?php 
class advertisement extends database{
	function __construct(){
		database::__construct();
		$this->table('advertisement');
	}
	public function addAdvertisement($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallAdvertisement($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getlatestadvertisement($args=array(),$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => 0,
					'noofdata' => 1
					)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getAdvertisementById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteAdvertisementbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updateadvertisement($data,$id,$is_die=false){
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