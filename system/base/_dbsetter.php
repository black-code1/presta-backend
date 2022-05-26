<?php
trait dbsetter
{
	private $db;
	
	public function setDb($db){
			$this->db=$db;
		}
		public function getDb(){
			 return $this->db;
		}
		public function set_id($id){
			$this->table_id = $id;
	   }
	   public function getId(){
		return $this->table_id;
   }
}

?>