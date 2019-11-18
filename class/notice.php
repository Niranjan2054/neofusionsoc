<?php 
class notice extends database{
	function __construct(){
		database::__construct();
		$this->table('notice');
	}
	public function addNotice($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallNotice($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getNoticeById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getlatestnotice($args=array(),$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => 0,
					'noofdata' => 1
					)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getNoticeUsingLimit($offset,$noofdata,$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => $offset,
					'noofdata' => $noofdata
					)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteNoticebyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatenotice($data,$id,$is_die=false){
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