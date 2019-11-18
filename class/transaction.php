<?php 
class Transaction extends database{
	function __construct(){
		database::__construct();
		$this->table('Transaction');
	}
	public function addTransaction($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallTransaction($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getTransactionById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteTransactionbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updateTransaction($data,$id,$is_die=false){
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