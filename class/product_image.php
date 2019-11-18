<?php 
class product_image extends database
{
	function __construct()
	{
		database::__construct();
		$this->table('products_image');
	}
	public function addProduct_image($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallProduct_image($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getProduct_imageById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteProduct_imagebyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updateproduct_image($data,$id,$is_die=false){
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