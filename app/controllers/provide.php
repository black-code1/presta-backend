<?php

    class Provide extends Controller 
    {
       public function __construct()
       {
           # code...
           parent::__construct();
           $this->model("provide_model",true);
           $this->base_model->setDb(new Database);
       }
       public function get_prodiver_from_service($params=null)
       {
           # code...
           return $this->get_all_from_some_one_id($params,"get_prodiver_from_service","serv_id");
       }
       public function get_service_from_provider($params=null)
       {
           # code...
           return $this->get_all_from_some_one_id($params,"get_service_from_provider","user_id");
       }
    }
    