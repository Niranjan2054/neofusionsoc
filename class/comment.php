<?php 
class comment extends database{
	function __construct(){
		database::__construct();
		$this->table('comment');
	}
	public function addComment($data,$is_die=false){
		return $this->adddata($data,$is_die);
	}
	public function getallComment($args=array(),$is_die=false){
		return $this->selectdata($args,$is_die);
	}
	public function getCommentById($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getCommentByPostId($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'postid' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getActiveCommentByPostId($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'postid' => $id,
						'status' => 'Active'
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getInactiveCommentByPostId($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'postid' => $id,
						'status' => 'Inactive'
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getInactiveComments($is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'status' => 'Inactive'
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getCommentByCommentId($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'commentid' => $id
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function getInactiveCommentByCommentId($id,$is_die=false){
		$args = array(
			'where' =>array(
					'and' => array(
						'commentid' => $id,
						'status' => 'Inactive'
					)
				)
			);
		return $this->selectdata($args,$is_die);
	}
	public function deleteCommentbyId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'id' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function deleteCommentbyCommentId($id,$is_die =false){
		$args = array(
			'where' =>array(
					'and' => array(
						'commentid' => $id
					)
				)
			);
		return $this->deletedata($args,$is_die);
	}
	public function updatecomment($data,$id,$is_die=false){
		$args = array(
					'where'	=> array(
						'and' => array(
							'id' => $id
						)
					)
				);
		return $this->updatedata($data,$args,$is_die);
	}
	public function PublishCommentByCommentById($id,$is_die=false){
		$args = array(
					'where'	=> array(
						'and' => array(
							'id' => $id
						)
					)
				);
		$data = array(
			'status' => 'Active'
		);
		return $this->updatedata($data,$args,$is_die);
	}

}