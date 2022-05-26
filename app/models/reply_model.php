<?php
	class Reply_model {
		use Crud;
		use dbsetter;
		private $user_id;
		private $mess_id;
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
			$this->tablename = "REPLY";
			$this->table_id = "user_id";
		}
		public function setUser_id($user_id) {
			$this->user_id = $user_id;
		}

		public function getUser_id() {
 			return $this->user_id;
		}
		public function setMess_id($mess_id) {
			$this->mess_id = $mess_id;
		}

		public function getMess_id() {
 			return $this->mess_id;
		}

		public function add() {
			if ($this->insert('REPLY',['MESS_ID','USER_ID'],[$this->getMess_id(),$this->getUser_id()],[':Mess_id',':User_id'])){
				# code...
				return ['Success' => true];
			} else {
				return ['Success' => false];
			} //
		return ['Success' => true];
		}
		public function get_message_from_user(){
			try {
				//code...
				return $this->db->select("*")
					->from($this->tablename.",USER,MESSAGE")
					->where($this->tablename.".USER_ID","USER.USER_ID")
					->where($this->tablename.".MESS_ID","MESSAGE.MESS_ID")
					->and($this->tablename.".USER_ID",$this->getUser_id())
					->order_by("MESSAGE.MESS_DATE","desc")
					->get()
					->result();
			} catch (PDOException $e) {
				//throw $th;
				echo $e->getMessage();
			}
			
			return false;

		}
		public function get_user_message_sender_list(){
			try {
				//code...
				return $this->db->select("COUNT(*) as nb_conversations")
					->from($this->tablename.",USER,MESSAGE")
					->where($this->tablename.".USER_ID","USER.USER_ID")
					->where($this->tablename.".MESS_ID","MESSAGE.MESS_ID")
					->group_by($this->tablename.".USER_ID")
					->order_by("MESSAGE.MESS_DATE","desc")
					->get()
					->result();
			} catch (PDOException $e) {
				//throw $th;
				echo $e->getMessage();
			}
			
			return false;

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