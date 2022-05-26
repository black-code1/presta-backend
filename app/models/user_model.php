<?php
	class User_model {
		use Crud;
		use dbsetter;
		private $user_id;
		private $user_id_create;
		private $username;
		private $password;
		private $name;
		private $surname;
		private $gender;
		private $phone_number;
		private $email;
		private $address;
		private $longitude;
		private $latitude;
		private $state;
		private $status;
		private $profile_image;
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
			$this->tablename = "USER";
			$this->table_id = "user_id";
		}
		public function setUser_id($user_id) {
			$this->user_id = $user_id;
		}

		public function getUser_id() {
 			return $this->user_id;
		}
		public function setUser_id_create($user_id_create) {
			$this->user_id_create = $user_id_create;
		}

		public function getUser_id_create() {
 			return $this->user_id_create;
		}
		public function setUsername($username) {
			$this->username = $username;
		}

		public function getUsername() {
 			return $this->username;
		}
		public function setPassword($password) {
			$this->password = $password;
		}

		public function getPassword() {
 			return $this->password;
		}
		public function setName($name) {
			$this->name = $name;
		}

		public function getName() {
 			return $this->name;
		}
		public function setSurname($surname) {
			$this->surname = $surname;
		}

		public function getSurname() {
 			return $this->surname;
		}
		public function setGender($gender) {
			$this->gender = $gender;
		}

		public function getGender() {
 			return $this->gender;
		}
		public function setPhone_number($phone_number) {
			$this->phone_number = $phone_number;
		}

		public function getPhone_number() {
 			return $this->phone_number;
		}
		public function setEmail($email) {
			$this->email = $email;
		}

		public function getEmail() {
 			return $this->email;
		}
		public function setAddress($address) {
			$this->address = $address;
		}

		public function getAddress() {
 			return $this->address;
		}
		public function setLongitude($longitude) {
			$this->longitude = $longitude;
		}

		public function getLongitude() {
 			return $this->longitude;
		}
		public function setLatitude($latitude) {
			$this->latitude = $latitude;
		}

		public function getLatitude() {
 			return $this->latitude;
		}
		public function setState($state) {
			$this->state = $state;
		}

		public function getState() {
 			return $this->state;
		}
		public function setStatus($status) {
			$this->status = $status;
		}

		public function getStatus() {
 			return $this->status;
		}
		public function setProfile_image($profile_image) {
			$this->profile_image = $profile_image;
		}

		public function getProfile_image() {
 			return $this->profile_image;
		}

		public function add() {
			if ($this->insert('USER',['USER_ID_CREATE','USERNAME','PASSWORD','NAME','SURNAME','GENDER','PHONE_NUMBER','EMAIL','ADDRESS','LONGITUDE','LATITUDE','STATE','STATUS','PROFILE_IMAGE',],[$this->getUser_id_create(),$this->getUsername(),$this->getPassword(),$this->getName(),$this->getSurname(),$this->getGender(),$this->getPhone_number(),$this->getEmail(),$this->getAddress(),$this->getLongitude(),$this->getLatitude(),$this->getState(),$this->getStatus(),$this->getProfile_image(),],[':User_id_create',':Username',':Password',':Name',':Surname',':Gender',':Phone_number',':Email',':Address',':Longitude',':Latitude',':State',':Status',':Profile_image',])){
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