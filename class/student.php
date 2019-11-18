<?php 
class student extends database
{
	function __construct()
	{
		database::__construct();
		$this->table('student');
	}
	public function addStudent($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallStudent($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getStudentById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getStudentByCertificateNo($certificateno,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'certificateno' => $certificateno
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getStudentBygmail($gmail,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'gmail' => $gmail
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteStudentbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}

	public function updatestudent($data,$id,$is_die=false){
		$args = array(
					'where'	=> array(
						'and' => array(
							'id' => $id
						)
					)
				);
	return $this->updatedata($data,$args,$is_die);
	}
	// public function getallStudentswithvendorandcategory($args=array(),$is_die=false){
	// 	$args = array(
	// 		'fields'  => array(
	// 				'id','name','summary','brand','price','status','image','discount','(SELECT title FROM categories as c WHERE c.id = students.category) as category','(SELECT username FROM users as u WHERE u.id = students.vendor) as vendor'
	// 		)
	// 	);
	// 	return $this->selectdata($args,$is_die);
	// }
	public function getallStudentwithTestimonials($args=array(),$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'istestimonials' => "yes"
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getallStudentwithTestimonialsUsingLimit($offset,$noofdata,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'istestimonials' => "yes"
					)
				),
			'limit' =>array(
					'offset' => $offset,
					'noofdata' => $noofdata
					)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getallStudentwithSuccess($args=array(),$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'issuccess' => "yes"
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getSuccessStudentUsingLimit($offset,$noofdata,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'issuccess' => "yes"
					)
				),
			'limit' =>array(
					'offset' => $offset,
					'noofdata' => $noofdata
					)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getallStudentwithCertified($args=array(),$is_die=false){
		$args = array(
			'where' => 'certificateno IS NOT NULL'
			);
		return $this->selectdata($args,$is_die);
	}
}
