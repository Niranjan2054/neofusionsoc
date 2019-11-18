<?php 
class image extends database{
	function __construct(){
		database::__construct();
		$this->table('image');
	}
	public function addImage($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallImage($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getImageById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getImageByForeign_key($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'foreign_key' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteImagebyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function deleteImagebyForeign_key($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'foreign_key' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updateimage($data,$id,$is_die=false){
		$args = array(
					'where'	=> array(
						'and' => array(
							'id' => $id
						)
					)
				);
		return $this->updatedata($data,$args,$is_die);
	}
	public function getImageUsingLimit($offset,$noofdata,$id,$is_die=false){
		$args = array(
			'where'	=> array(
						'and' => array(
							'foreign_key' => $id
						)
					),
			'limit' =>array(
					'offset' => $offset,
					'noofdata' => $noofdata
					)
			);
		return $this->selectdata($args,$is_die);
	}

}