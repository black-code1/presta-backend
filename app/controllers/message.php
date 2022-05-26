<?php

    class Message extends Controller 
    {
       public function __construct()
       {
           # code...
           parent::__construct();
           $this->model("message_model",true);
           $this->base_model->setDb(new Database);
       }

       public function get_and_count_all_from_user($params=null)
       {
           # code...
         return $this->get_all_from_some_one_id($params,"get_and_count_all_from_user","user_id_receiver");
       }
       public function get_conversation_content($params=null)
       {
           # code...
         return $this->get_all_from_some_one_id($params,"get_conversation_content",["user_id_sender","user_id_receiver"]);
       }
    }
    