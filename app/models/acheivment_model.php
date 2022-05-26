<?php
	class Acheivment_model {
		use Crud;
		use dbsetter;
		private $ach_id;
		private $user_id;
		private $serv_id;
		private $ach_name;
		private $ach_desc;
		private $ach_date;
		//CONTS
		const ACHEIV_INFO = "USER.name,USER.USER_ID as userId ,ACHEIVMENT.*,SERVICE.*";
		const ACHEIV_TABLES = "ACHEIVMENT,SERVICE,USER";

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
			$this->tablename = "ACHEIVMENT";
			$this->table_id = "ach_id";
		}
		public function setAch_id($ach_id) {
			$this->ach_id = $ach_id;
		}

		public function getAch_id() {
 			return $this->ach_id;
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
		public function setAch_name($ach_name) {
			$this->ach_name = $ach_name;
		}

		public function getAch_name() {
 			return $this->ach_name;
		}
		public function setAch_desc($ach_desc) {
			$this->ach_desc = $ach_desc;
		}

		public function getAch_desc() {
 			return $this->ach_desc;
		}
		public function setAch_date($ach_date) {
			$this->ach_date = $ach_date;
		}

		public function getAch_date() {
 			return $this->ach_date;
		}
		//basic crud méthods 
		public function add() {
			if ($this->insert('ACHEIVMENT',['USER_ID','SERV_ID','ACH_NAME','ACH_DESC','ACH_DATE',],[$this->getUser_id(),$this->getServ_id(),$this->getAch_name(),$this->getAch_desc(),$this->getAch_date(),],[':User_id',':Serv_id',':Ach_name',':Ach_desc',':Ach_date',])){
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
			if ($this->delete($this->tablename, $this->table_id, $this->getAch_id())) {
				# code...
				return true;
			} else {
				return false;
			}
		}

		/* 
		advance methods
		
		*/
		/* 
		@name get_all
		@param $order: define the date order of the selection
		@description list all the acheivments ordered by date
		*/
		public function get_all($order = "desc" )
		{
			# code...
			try {
				//code...
				return $this->db->select(self::ACHEIV_INFO)
				->from(self::ACHEIV_TABLES)
				->where($this->tablename.".USER_ID","USER.USER_ID")
				->and($this->tablename.".SERV_ID","SERVICE.SERV_ID")
				->order_by($this->tablename.".ACH_DATE",$order)
				->get()
				->result();
			} catch (PDOException $e) {
				//throw $th;
				echo $e->getMessage();
			}
		}

		/* 
		@name get_all_by_service
		@description : list all the acheivments from a service
		*/
		public function get_all_by_service($order="desc")
		{
			# code...
			try {
				//code...
				return $this->db->select(self::ACHEIV_INFO)
				->from(self::ACHEIV_TABLES)
				->where($this->tablename.".USER_ID","USER.USER_ID")
				->and($this->tablename.".SERV_ID","SERVICE.SERV_ID")
				->and($this->tablename.".SERV_ID",$this->getServ_id())
				->order_by($this->tablename.".ACH_ID",$order)
				->get()
				->result();
			} catch (PDOException $e) {
				//throw $th;
				echo $e->getMessage();
			}
		}
				/* 
		@name get_all_from_user
		@description : list all the acheivments from a USER
		*/
		public function get_all_from_user($order = "desc")
		{
			# code...
			try {
				//code...
				return $this->db->select(self::ACHEIV_INFO)
				->from(self::ACHEIV_INFO)
				->where($this->tablename.".USER_ID","USER.USER_ID")
				->and($this->tablename.".SERV_ID","SERVICE.SERV_ID")
				->and($this->tablename.".USER_ID",$this->getUser_id())
				->order_by($this->tablename."ACH_ID",$order)
				->get()
				->result();
			} catch (PDOException $e) {
				//throw $th;
				echo $e->getMessage();
			}
		}


		/* 
		@name get_all_from_user_and_service
		@description : list all the acheivments from a USER and service
		*/
		public function get_all_from_user_and_service($order = "desc")
		{
			# code...
			try {
				//code...
				return $this->db->select(self::ACHEIV_INFO)
				->from(self::ACHEIV_INFO)
				->where($this->tablename.".USER_ID","USER.USER_ID")
				->and($this->tablename.".SERV_ID","SERVICE.SERV_ID")
				->and($this->tablename.".USER_ID",$this->getUser_id())
				->and($this->tablename.".SERV_ID",$this->getServ_id())
				->order_by($this->tablename."ACH_ID",$order)
				->get()
				->result();
			} catch (PDOException $e) {
				//throw $th;
				echo $e->getMessage();
			}
		}
				/* 
		@name count_all_by_service
		@description : count all the acheivments from a service
		*/
		public function count_all_by_service()
		{
			# code...
			try {
				//code...
				return $this->db->select("COUNT(*) as nb_acheiv,SERVICE.NAME,SERVICE.DESCRIPTION")
				->from($this->tablename.",SERVICE")
				->and($this->tablename.".SERV_ID","SERVICE.SERV_ID")
				->group_by("SERVICE.SERV_ID")
				->get()
				->result();
			} catch (PDOException $e) {
				//throw $th;
				echo $e->getMessage();
			}
		}
						/* 
		@name count_all_from_user_by_service
		@description : count all the acheivments from a USER by the service ID
		*/
		public function count_all_from_user_by_service()
		{
			# code...
			try {
				//code...
				return $this->db->select("COUNT(".$this->tablename.".ACHEIV_ID) as nb_acheiv,SERVICE.NAME,SERVICE.DESCRIPTION")
				->from($this->tablename.",SERVICE")
				->and($this->tablename.".SERV_ID","SERVICE.SERV_ID")
				->and($this->tablename.".USER_ID",$this->getUser_id())
				->group_by($this->tablename."SERV_ID")
				->get()
				->result();
			} catch (PDOException $e) {
				//throw $th;
				echo $e->getMessage();
			}
		}
		/* 
		@name count_all_from_user_and_service
		@description : list all the acheivments from a USER and service
		*/
		public function count_all_from_user_and_service($order = "desc")
		{
			# code...
			try {
				//code...
				return $this->db->select("COUNT(".$this->tablename.".ACHEIV_ID) as nb_acheiv,SERVICE.NAME,SERVICE.DESCRIPTION")
				->from($this->tablename.",SERVICE")
				->where($this->tablename.".USER_ID","USER.USER_ID")
				->and($this->tablename.".SERV_ID","SERVICE.SERV_ID")
				->and($this->tablename.".USER_ID",$this->getUser_id())
				->and($this->tablename.".SERV_ID",$this->getServ_id())
				->group_by("SERVICE.SERV_ID")
				->get()
				->result();
			} catch (PDOException $e) {
				//throw $th;
				echo $e->getMessage();
			}
		}
		


	}