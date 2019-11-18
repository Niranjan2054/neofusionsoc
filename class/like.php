<?php 
class like extends database{
	function __construct(){
		database::__construct();
		$this->table('likes');
	}
	public function addLike($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallLike($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getLikeById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getLikeByCommentId($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'commentid' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getLikeByLikeId($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'likeid' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteLikebyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function deleteLikebyLikeId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'likeid' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatelike($data,$id,$is_die=false){
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