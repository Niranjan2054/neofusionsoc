<?php 
class contact extends database{
	function __construct(){
		database::__construct();
		$this->table('contact');
	}
	public function addContact($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallContact($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getContactById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteContactbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatecontact($data,$id,$is_die=false){
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