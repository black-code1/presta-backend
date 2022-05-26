<?php
	class Usergroup_model {
		use Crud;
		use dbsetter;
		private $ug_id;
		private $ug_name;
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
			$this->tablename = "USERGROUP";
			$this->table_id = "ug_id";
		}
		public function setUg_id($ug_id) {
			$this->ug_id = $ug_id;
		}

		public function getUg_id() {
 			return $this->ug_id;
		}
		public function setUg_name($ug_name) {
			$this->ug_name = $ug_name;
		}

		public function getUg_name() {
 			return $this->ug_name;
		}

		public function add() {
			if ($this->insert('USERGROUP',['UG_NAME',],[$this->getUg_name(),],[':Ug_name',])){
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
			if ($this->delete($this->tablename, $this->table_id, $this->getUg_id())) {
				# code...
				return true;
			} else {
				return false;
			}
		}

		}