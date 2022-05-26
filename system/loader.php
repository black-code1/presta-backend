<?php

class Loader
{
    private $controller_folder = "app/controllers/";
    private $models_folder = "app/models/";
    private $views_folder = "app/views/";
    private $libraries_folder = "app/libraries/";
    private $base_folder = "system/base";

    public function __construct()
    {
        # code...

    }
    public function init()
    {
        # code...
        $this->getFolderContent($this->base_folder);
        $this->load("system/core/controller.php");
    }
    public function load_ressource($controller)
    {

        // $m_link = $this->models_folder . $controller . ".php";
        $link = $this->controller_folder . $controller . ".php";

            // $this->load($m_link);
          return  $this->load($link);

        # code...
    }
    public function library($lib)
    {
        # code...
        $this->load($this->libraries_folder.$lib.".php");
    }
    public function model($mod)
    {
        # code...
        $this->load($this->models_folder.$mod.".php");
    }
    public function view($view){
        #code
        $this->load($this->views_folder.$view.".php");
    }
    public function load($link)
    {
        # code...
        if (!file_exists($link) /*|| !file_exists($m_link)*/ ) {
            # code...
            return false;
        } else {
            // $this->load($m_link);
           require $link;
            return true;
        }
    }
    public function call($controller)
    {
        return new $controller();
    }
    public function ressource_has_method($ressource, $method)
    {
        return method_exists($ressource, $method);
    }
    public function getFolderContent($folder, array $excluede = null)
    {
        # code...
        $dirname = $folder;
        $dir = opendir($dirname);
        while ($file = readdir($dir)) {
            if ($file != '.' && $file != '..' && !is_dir($dirname . $file)) {
                if ($excluede != null) {
                    # code...
                    // searching for excluede file
                    foreach ($excluede as $key => $value) {
                        # code...
                        if (strpos($file, $alue) !== false) {
                            # code...
                            require '' . $dirname . '/' . $file . '';
                        }
                    }
                } else {
                    require '' . $dirname . '/' . $file . '';
                }
            }
        }
        closedir($dir);
    }
}

$loader = new Loader();
