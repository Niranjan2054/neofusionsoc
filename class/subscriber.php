<?php 
class subscriber extends database{
	function __construct(){
		database::__construct();
		$this->table('subscriber');
	}
	public function addSubscriber($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallSubscriber($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getSubscriberById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getSubscriberByEmail($email,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'email' => $email
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteSubscriberbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatesubscriber($data,$id,$is_die=false){
		$args = array(
					'where'	=> array(
						'and' => array(
							'id' => $id
						)
					)
				);
	return $this->updatedata($data,$args,$is_die);
	}
	public function getSubscriberUsingLimit($id,$noofdata,$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => 0,
					'noofdata' => $noofdata
					),
			'order' => 'ASC',
			'where' => 'id > '.$id
			);
		return $this->selectdata($args,$is_die);
	}

}