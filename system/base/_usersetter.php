<?php
trait usersetter
{
		public function setIduser($iduser){
			$this->iduser=$iduser;
		}
		public function getIduser(){
			 return $this->iduser;
		}
		public function lastInsertId(){
        	return $this->db->lastInsertId();
    	}
}

?>