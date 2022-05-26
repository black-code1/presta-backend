<?php

    class Usergroup extends Controller 
    {
       public function __construct()
       {
           # code...
           parent::__construct();
           $this->model("usergroup_model",true);
           $this->base_model->setDb(new Database);
       }
    }
    