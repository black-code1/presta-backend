<?php
/* 

*/
    class Acheivment extends Controller 
    {
       public function __construct()
       {
           # code...
           parent::__construct();
           $this->model("acheivment_model",true);
           $this->base_model->setDb(new Database);
       }
       /* 
       @param $param
       @description 
       */
       public function get_all($params=null)
       {
           # code...
           if($params != null && isset($params["order"])){
               //
            if (in_array($params["order"],["desc","asc"])) {
                # code...
                //
                return $this->base_model->get_all($params["order"]);
            }else{
                //
             return [
                 "success"=>false,
                 "type"=>"list user acheivments",
                 "message"=>"ther order type given get to be desc or asc",
             ];
            }
         }else{
            return $this->base_model->get_all();
         }

       }

      public function get_all_by_service($params=null)
      {
          # code...
          return $this->get_all_from_some_one_id($params,"get_all_by_service","serv_id");
      }
      /* 
      
      */
      public function get_all_from_user($params=null)
      {
          # code...
        return $this->get_all_from_some_one_id($params,"get_all_from_user","user_id");
      }
        /* 
      
      */
      public function get_all_from_user_and_service($params=null)
      {
          # code...
        return $this->get_all_from_some_one_id($params,"get_all_from_user_and_service",["user_id","serv_id"]);
      }
        /* 
      
      */
      public function count_all_by_service()
      {
          # code...
        return $this->count_all_by_service();
      }
      public function count_all_from_user_by_service($params=null)
      {
          # code...
          return $this->get_all_from_some_one_id($params,"count_all_from_user_by_service","user_id");
      }
      public function count_all_from_user_and_service($params=null)
      {
          # code...
        return $this->get_all_from_some_one_id($params,"count_all_from_user_and_service",["user_id","serv_id"]);
      }


    }
    