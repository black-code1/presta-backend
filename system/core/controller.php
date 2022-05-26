<?php

class Controller 
{
    protected $load;
    protected $base_model=null;
    public function __construct()
    {
        $this->load = new Loader();
    }
    public function init()
    {
        $this->load = new Loader();
    }
    public function library($lib)
    {
        # code...
        $this->load->library($lib);
        $this->$lib = new $lib();
    }
    public function view($view)
    {
        # code...
        $this->load->view($view);
        //$this->$view = new $vie();
    }
    /* 

    */
    public function model($mod,$is_base=false)
    {
        # code...
        /*         
        $this->load->model($mod);
        $this->$mod = new $mod();    */     
        $this->load->model($mod);
        if ($is_base) {
            # code...
            $this->base_model = new $mod();
        }else{
            $this->$mod = new $mod();
        }
        
    }
    public function count(){
        return [
            "success"=>true,
            "type"=>"count",
            "message"=>"count correctly",
            "data"=> $this->base_model->count_all()[0]
        ];
    }
    //add a classroom
    /* 
        add
    */
    public function add()
    {
        # code...
        //
        if (isset($_POST["form_data"]) && !empty($_POST["form_data"])) {
            # code...
            $this->base_model->hydrater($_POST["form_data"]);
            if (this->base_model->add($classroom)["success"]) {
                return [
                    "success"=>true,
                    "type"=>"add",
                    "message"=>"element successfull added"
                ];
            }else{
                return [
                    "success"=>false,
                    "type"=>"add",
                    "message"=>"eror xhen trying to add element"
                ];
            }
        }else{
            return [
                "success"=>false,
                "type"=>"add",
                "message"=>"form_data is undefned fill it and retry"
            ];
        }


    }
    /* 
        read
    */
    function read() {
        # code...
        return $this->base_model->get();
    }
    /* 
        read when id
    */
    function read_when_id($params) {
        # code...
        if (isset($params["id"])) {
            # code...
            $this->base_model->set_id(html_entity_decode($params["id"]));
            return $this->base_model->get_where_id();
        }else{
            return [
                "success"=>false,
                "type"=>"read",
                "message"=>"connot read without id"
            ];
        }
    }
    function delete($params = null) {
        # code...=null 
        if ( $params!= null && isset($params["id"])) {
            # code...
            $this->base_model->set_id($params["id"]);
            return $this->base_model->delete();
        }else{
            return [
                "success"=>false,
                "type"=>"delete",
                "message"=>"connot delete without id"
            ];
        }
    }
          /* 
       */
      public function right_order($order)
      {
          # code...
          return in_array($order,["desc","asc"]);
      }
      public function get_all_from_some_one_id($params,$method,$id)
      {
          # code...
          if($params != null && $this->map_isset($id,$params)){
            if ($this->map_intval($id,$params)) {
                # code...
                $this->base_model->hydrater($params);
                if (isset($params["order"])) {
                    # code...
                    if ($this->right_order($params["order"])) {
                        # code...
                        return $this->base_model->$method($params["order"]);
                    }
                }else{
                    return $this->base_model->$method();
                }
            }else{
                $keys ="";
                if (is_array($id)) {
                    # code...
                    $keys = implode(",",$id);
                }else{
                    $keys = $id;
                }
                return [
                    "success"=>false,
                    "type"=>$method,
                    "message"=>"the ".$keys." have to be an integer ",
                ];
            }
         }else{
            return [
                "success"=>false,
                "type"=>$method,
                "message"=>"the parameter is null or is not an integer.",
            ];
         }
      }
      public function map_isset($map,$tab)
      {
          # code...
          if (is_string($map)) {
              # code...
              return isset($tab[$map]);
          }else{
              if (is_array($map)) {
                  # code...
                  foreach ($map as $key => $value) {
                    # code...
                    if (!isset($tab[$value])) {
                        # code...
                        return false;
                    }
                }
                return true ;
              }
          }
          return false;

      }
      public function map_intval($map,$tab)
      {
          # code...
          if (is_string($map)) {
              # code...
              return intval($tab[$map]);
          }else{
              if (is_array($map)) {
                # code...
                  foreach ($map as $key => $value) {
                    # code...
                    if (!intval($tab[$value])) {
                        # code...
                        return false;
                    }
                }
                return true ;
            }
            return true ;
        }
          return false;

      }

}
