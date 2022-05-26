<?php
	class Service_model {
		use Crud;
		use dbsetter;
		private $serv_id;
		private $serv_desc;
		private $serv_name;
		private $serv_add_date;
		private $serv_type;
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
			$this->tablename = "SERVICE";
			$this->table_id = "serv_id";
		}
		public function setServ_id($serv_id) {
			$this->serv_id = $serv_id;
		}

		public function getServ_id() {
 			return $this->serv_id;
		}
		public function setServ_desc($serv_desc) {
			$this->serv_desc = $serv_desc;
		}

		public function getServ_desc() {
 			return $this->serv_desc;
		}
		public function setServ_name($serv_name) {
			$this->serv_name = $serv_name;
		}

		public function getServ_name() {
 			return $this->serv_name;
		}
		public function setServ_add_date($serv_add_date) {
			$this->serv_add_date = $serv_add_date;
		}

		public function getServ_add_date() {
 			return $this->serv_add_date;
		}
		public function setServ_type($serv_type) {
			$this->serv_type = $serv_type;
		}

		public function getServ_type() {
 			return $this->serv_type;
		}

		public function add() {
			if ($this->insert('SERVICE',['SERV_DESC','SERV_NAME','SERV_ADD_DATE','SERV_TYPE'],[$this->getServ_desc(),$this->getServ_name(),$this->getServ_add_date(),$this->getServ_type()],[':Serv_desc',':Serv_name',':Serv_add_date',':Serv_type'])){
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
		public function get_by_type($order)
		{
			# code...
			try {
				//code...
				return $this->db->select("*")
				->from($this->tablename)
				->where($this->tablename.".SERV_TYPE",$this->getServ_type())
				->get()
				->result();
			} catch (PDOException $e) {
				//throw $th;
				$e->getMessage();
			}
		}
		public function delete() {
			if ($this->delete($this->tablename, $this->table_id, $this->getServ_id())) {
				# code...
				return true;
			} else {
				return false;
			}
		}

		}