<?php
	class Message_model {
		use Crud;
		use dbsetter;
		private $mess_id;
		private $user_id_sender;
		private $user_id_receiver;
		private $mess_content;
		private $mess_date;
		private $mess_type;
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
			$this->tablename = "MESSAGE";
			$this->table_id = "mess_id";
		}
		public function setMess_id($mess_id) {
			$this->mess_id = $mess_id;
		}

		public function getMess_id() {
 			return $this->mess_id;
		}
		public function setUser_id_sender($user_id_sender) {
			$this->user_id_sender = $user_id_sender;
		}

		public function getUser_id_sender() {
 			return $this->user_id_sender;
		}
		public function setUser_id_receiver($user_id_receiver) {
			$this->user_id_receiver = $user_id_receiver;
		}

		public function getUser_id_receiver() {
 			return $this->user_id_receiver;
		}
		public function setMess_content($mess_content) {
			$this->mess_content = $mess_content;
		}

		public function getMess_content() {
 			return $this->mess_content;
		}
		public function setMess_date($mess_date) {
			$this->mess_date = $mess_date;
		}

		public function getMess_date() {
 			return $this->mess_date;
		}
		public function setMess_type($mess_type) {
			$this->mess_type = $mess_type;
		}

		public function getMess_type() {
 			return $this->mess_type;
		}

		public function add() {
			if ($this->insert('MESSAGE',['USER_ID_SENDER','USER_ID_RECEIVER','MESS_CONTENT','MESS_DATE','MESS_TYPE',],[$this->getUser_id_sender(),$this->getUser_id_receiver(), $this->getMess_content(),$this->getMess_date(),$this->getMess_type(),],[':User_id_sender',':User_id_receiver',':Mess_content',':Mess_date',':Mess_type',])){
				# code...
				return ['Success' => true];
			} else {
				return ['Success' => false];
			} //
		return ['Success' => true];
		}

		public function get_and_count_all_from_user(){
			try {
				//code...
				return $this->db->select("COUNT(".$this->tablename.".MESS_ID) as nb_mess,USER.USER_ID,USER.NAME,USER.SURNAME")
					->from($this->tablename.",USER")
					->where($this->tablename.".USER_ID_RECEIVER","USER.USER_ID")
					->and($this->tablename.".USER_ID_SENDER","USER.USER_ID")
					->and($this->tablename.".USER_ID_RECEIVER",$this->getUser_id_receiver())
					->group_by($this->tablename.".USER_ID_SENDER")
					->get()
					->result();
			} catch (PDOException $e) {
				//throw $th;
				echo $e->getMessage();
			}
			
			return false;

		}
		public function get_conversation_content($order = "desc"){
			try {
				//code...
				return $this->db->select("*")
					->from($this->tablename.",USER")
					->where($this->tablename.".USER_ID_RECEIVER","USER.USER_ID")
					->and($this->tablename.".USER_ID_SENDER","USER.USER_ID")
					->and($this->tablename.".USER_ID_SENDER",$this->getUser_id_sender())
					->and($this->tablename.".USER_ID_RECEIVER",$this->getUser_id_receiver())
					->order_by($this->tablename.".MESS_ID",$order)
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
			if ($this->delete($this->tablename, $this->table_id, $this->getMess_id())) {
				# code...
				return true;
			} else {
				return false;
			}
		}

		}