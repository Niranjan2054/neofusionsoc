<?php 
class courses extends database{
	function __construct(){
		database::__construct();
		$this->table('courses');
	}
	public function addCourses($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallCourses($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getCoursesById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteCoursesbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatecourses($data,$id,$is_die=false){
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