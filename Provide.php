<?php
	class Provide_model {
		use Crud;
		use dbsetter;
		private $user_id;
		private $serv_id;
		public function hydrater(array $data) {
			foreach ($data as $key => $value) {
				# code...
				$method = "set" . ucfirst($key);
				if (method_exists($this, $method)) {
					# code...
					$this->$method($value);
				}
			}
		}
		function __construct() {
			# code...
			$this->tablename = "provide";
			$this->table_id = "user_id";
		}
		public function setUser_id($user_id) {
			$this->user_id = $user_id;
		}

		public function getUser_id() {
 			return $this->user_id;
		}
		public function setServ_id($serv_id) {
			$this->serv_id = $serv_id;
		}

		public function getServ_id() {
 			return $this->serv_id;
		}

		public function add() {
			if ($this->insert('provide',['SERV_ID'],[$this->getServ_id()],[':Serv_id'])){
				# code...
				return ['Success' => true];
			} else {
				return ['Success' => false];
			} //
		return ['Success' => true];
		}
		public function get() {
			/*calling from crud*/
			return $this->selectAll($this->tablename, $this->table_id);
		}
		public function delete() {
			if ($this->delete($this->tablename, $this->table_id, $this->getUser_id())) {
				# code...
				return true;
			} else {
				return false;
			}
		}

		}