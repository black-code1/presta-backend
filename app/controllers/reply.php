<?php

    class Reply extends Controller 
    {
       public function __construct()
       {
           # code...
           parent::__construct();
           $this->model("reply_model",true);
           $this->base_model->setDb(new Database);
       }
       
    }
    