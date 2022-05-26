<?php
	class Vote_model {
		use Crud;
		use dbsetter;
		private $vote_id;
		private $user_id;
		private $user_id_concerned;
		private $vote_note;
		private $vote_date;
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
			$this->tablename = "VOTE";
			$this->table_id = "vote_id";
		}
		public function setVote_id($vote_id) {
			$this->vote_id = $vote_id;
		}

		public function getVote_id() {
 			return $this->vote_id;
		}
		public function setUser_id($user_id) {
			$this->user_id = $user_id;
		}

		public function getUser_id() {
 			return $this->user_id;
		}
		public function setUser_id_concerned($user_id_concerned) {
			$this->user_id_concerned = $user_id_concerned;
		}

		public function getUser_id_concerned() {
 			return $this->user_id_concerned;
		}
		public function setVote_note($vote_note) {
			$this->vote_note = $vote_note;
		}

		public function getVote_note() {
 			return $this->vote_note;
		}
		public function setVote_date($vote_date) {
			$this->vote_date = $vote_date;
		}

		public function getVote_date() {
 			return $this->vote_date;
		}

		public function add() {
			if ($this->insert('VOTE',['USER_ID','USER_ID_CONCERNED','VOTE_NOTE','VOTE_DATE',],[$this->getUser_id(),$this->getUser_id_concerned(),$this->getVote_note(),$this->getVote_date(),],[':User_id',':User_id_concerned',':Vote_note',':Vote_date',])){
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
			if ($this->delete($this->tablename, $this->table_id, $this->getVote_id())) {
				# code...
				return true;
			} else {
				return false;
			}
		}

		}