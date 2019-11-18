<?php 
class studentproject extends database
{
	function __construct()
	{
		database::__construct();
		$this->table('studentproject');
	}
	public function addStudentProject($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallStudentProject($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getStudentProjectById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteStudentProjectbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatestudentproject($data,$id,$is_die=false){
		$args = array(
					'where'	=> array(
						'and' => array(
							'id' => $id
						)
					)
				);
		return $this->updatedata($data,$args,$is_die);
	}
	public function getStudentProjectUsingLimit($offset,$noofdata,$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => $offset,
					'noofdata' => $noofdata
					)
			);
		return $this->selectdata($args,$is_die);
	}
	
}
