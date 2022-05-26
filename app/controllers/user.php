<?php

class User extends Controller
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->model("user_model",true);
        $this->base_model->setDb(new Database());

    }
    function connect() {
        # code...
        //$this->view("test");
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            //            
            $result = $this->base_model->connect(html_entity_decode($_POST["username"]),html_entity_decode($_POST["password"]));
            if (empty($result)) {
                # code...
                return [
                    "success"=>false,
                    "type"=>"connect",
                    "message"=>"incorrect password or username"
                ];
            }else{
                return [
                    "success"=>true,
                    "type"=>"connect",
                    "message"=>"welcome".$_POST["username"],
                    "data"=>$result
                ];
            }
            
        }else{
            return [
                "success"=>false,
                "type"=>"connect",
                "message"=>"unset username or password"
            ];
        }
    }
    /* 
    
    */
    function read_when_user_group($params) {
        # code...
        if (isset($params["usergroup"])) {
            # code...
            return $this->base_model->get_when_user_group(html_entity_decode($params["usergroup"]));
        }
    }

}