<?php

    class Vote extends Controller 
    {
       public function __construct()
       {
           # code...
           parent::__construct();
           $this->model("vote_model",true);
           $this->base_model->setDb(new Database);
       }
    }
    