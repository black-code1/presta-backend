<?php

    class Service extends Controller 
    {
       public function __construct()
       {
           # code...
           parent::__construct();
           $this->model("service_model",true);
           $this->base_model->setDb(new Database);
       }
       public function get_by_type($params=null)
       {
           # code...
           return $this->get_all_from_some_one_id($params,"get_by_type","serv_type");
       }
    }
    