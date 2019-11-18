<?php 
class category extends database{
	function __construct(){
		database::__construct();
		$this->table('categories');
	}
	public function addCategory($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallCategory($args=array(),$is_die=false){
		$args = array(
			'fields'  => array(
					'id','title','summary','show_in_menu','is_parent','status','image','(SELECT title FROM categories as c WHERE c.id = categories.parent_id) as parent_cat'
			)
		);
		return $this->selectdata($args,$is_die);
	}
	public function getCategoryById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getparentcategory($is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'is_parent' => 1,
						'parent_id' => 0
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getchildcategorybyparentid($parent_id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'is_parent' => 0,
						'parent_id' => $parent_id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteCategorybyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatecategory($data,$id,$is_die=false){
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