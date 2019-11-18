<?php 
class page extends database{
	function __construct(){
		database::__construct();
		$this->table('pages');
	}
	public function addPage($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallPage($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getPageById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deletePagebyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatepage($data,$id,$is_die=false){
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