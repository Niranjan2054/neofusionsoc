<?php 
class banner extends database{
	function __construct(){
		database::__construct();
		$this->table('banners');
	}
	public function addBanner($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallBanner($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getlatestbanner($args=array(),$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => 0,
					'noofdata' => 1
					)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getBannerById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteBannerbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatebanner($data,$id,$is_die=false){
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