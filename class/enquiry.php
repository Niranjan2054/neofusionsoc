<?php 
class enquiry extends database{
	function __construct(){
		database::__construct();
		$this->table('enquiry');
	}
	public function addEnquiry($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallEnquiry($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getEnquiryById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteEnquirybyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updateenquiry($data,$id,$is_die=false){
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