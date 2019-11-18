<?php 
class busfair extends database{
	function __construct(){
		database::__construct();
		$this->table('busfair');
	}
	public function addBusFair($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallBusFair($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getBusFairById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteBusFairbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatebusfair($data,$id,$is_die=false){
		$args = array(
					'where'	=> array(
						'and' => array(
							'id' => $id
						)
					)
				);
		return $this->updatedata($data,$args,$is_die);
	}
	public function getBusFairUsingLimit($offset,$noofdata,$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => $offset,
					'noofdata' => $noofdata
					)
			);
		return $this->selectdata($args,$is_die);
	}

}