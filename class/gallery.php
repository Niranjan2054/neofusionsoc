<?php 
class gallery extends database{
	function __construct(){
		database::__construct();
		$this->table('gallery');
	}
	public function addGallery($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallGallery($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getGalleryById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteGallerybyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updategallery($data,$id,$is_die=false){
		$args = array(
					'where'	=> array(
						'and' => array(
							'id' => $id
						)
					)
				);
		return $this->updatedata($data,$args,$is_die);
	}
	public function getGalleryUsingLimit($offset,$noofdata,$is_die=false){
		$args = array(
			'limit' =>array(
					'offset' => $offset,
					'noofdata' => $noofdata
					)
			);
		return $this->selectdata($args,$is_die);
	}

}