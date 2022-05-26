<?php
/**
 * miag-api
 *
 * api of the miag CGE exclusive use application
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2020, vitteck-team
 *
 *the use of this code is reserved exclusively for
 *developers and miag employees this code is private and
 *will not be shared anyone who has access to its sources
 *will be considered as hackers
 *
 * @package    maig-api
 * @author    vitteck-team -beis
 * @copyright    Copyright (c) 2020, beis. (https://vitteck.com/)
 * @copyright    Copyright (c) 2020, vitteck-team (https://vitteck.com/)
 * @license
 * @link    https://vitteck.com
 * @since    Version 1.0.0
 * @filesource
 */

/**
 * groups together a set of generic
 * functions related to sql queries,
 * including an insertion function,
 * selection functions and a deletion function.
 *
 * @package Miag
 * @subpackage Trait
 * @category Database
 * @author beis
 * @link
 */
trait Crud
{
    private $tablename;
    /**
     * select all information of a table
     *
     * select informations of table given sort
     * by id
     *
     * @param string $table
     * @param string $tableid
     * @return array
     */
    public function selectAll($tablename, $tableid)
    {
        try
        {
            return $this->db->select('*')
                ->from($tablename)
                ->order_by($tableid, 'desc')
                ->get()
                ->result();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
    public function get_where_id($id){
        try {
            //code...
            $this->db->select("*")
            ->from($this->tablename)
            ->where(strtoupper($this->tableid),$id)
            ->get()
            ->result();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
    public function count_all()
    {
        try
        {
            return $this->db->select('COUNT(*) as count')
                ->from($this->tablename)
                ->get()
                ->result();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    /**
     * select all information of a table
     *
     * select informations of table given according
     * with the id
     *
     * @param string $tablename
     * @param string $tableid
     * @param string $value
     * @return array
     */
    public function selectAllWhere($tablename, $tableid, $value)
    {
        try
        {
            $this->db->select('*')
                ->from($tablename)
                ->where($tableid, ':id')
                ->order_by($tableid, 'desc')
                ->get();
            $this->db->bind(':id', $value);
            return $this->db->result();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function selectAllWhereTableIdSmall($last_id)
    {
        try
        {
            $this->db->query('select * from ' . $this->tablename . ' where ' . $this->table_id . '>:id');
            $this->db->bind(':id', $last_id);
            return $this->db->result();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function Join(Type $var = null)
    {
        # code...
    }

    public function gettable_id()
    {
        # code...
        return $this->table_id;
    }

    /**
     * count all information of a table
     *
     * @param string $tablename
     * @return array
     */
    public function selectCount($tablename)
    {
        try {
            return $this->db->select('COUNT(*)')
                ->from($tablename)
                ->get()
                ->result();
            // return $this->db->rowCount();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getwithlimit($start, $end){
        try {
            return $this->db->select('*')
                ->from($this->tablename)
                ->limit($start, $end)
                ->get()
                ->result();
            // return $this->db->rowCount();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getwhereattr($attr)
    {
        /*calling from crud*/
        $method = 'get' . ucfirst($attr);
        return $this->selectAllWhere($this->tablename, strtoupper($attr), $this->$method());
    }

    /**
     * add a record to a table
     *
     * it constructs a query from the data tables passed in parameter
     *
     * @param string $tablename
     * @param array $attributes
     * @param array $values
     * @param array $alias
     * @return bool
     */
    public function insert($tablename, $attributes, $values, $alias)
    {
        try {
            for ($i = 0; $i < count($attributes); $i++) {
                # code...
                $this->db->set($attributes[$i], $values[$i]);
            }

        } catch (PDOException $e) {

            echo 'error :' . $e->getMessage();

        }

        if ($this->db->add($tablename)) {
            # code...
            $fichier = fopen('save.txt', 'a+');
            $reqsave = "";
            foreach ($values as $key => $value) {
                # code...
                $reqsave .= "'" . $value . "',";
            }
            $reqsave = substr($reqsave, 0, -1);
            fputs($fichier, "`insert into " . $tablename . " (" . implode(',', $attributes) . ") values (" . $reqsave . ")\n");
            $fichier = fclose($fichier);
            return true;
        } else {
            return false;
        }
    }
    public function upd($tablename, $attributes, $values)
    {
/*         $request = "update ".$tablename." set ";
        try {
            for ($i = 0; $i < count($attributes); $i++) {
                //.
                $request.=$attributes[$i]."=:".$attributes[$i];
                //
                if ($i!=count($attributes)-1) {
                    # code...
                    $request.=",";
                }
            }
        $this->db->query($request)

        } catch (PDOException $e) {

            echo 'error :' . $e->getMessage();

        } */
    }

    public function delete($tablename, $id, $value)
    {
        try {
            $this->db->query('delete from ' . $tablename . ' where ' . $id . '=:id');
            $this->db->bind(':id', $value);
        } catch (PDOException $e) {
            echo 'error :' . $e->getMessage();
        }

        /*execution*/
        if ($this->db->execute()) {
            # code...
            // $fichier = fopen('data/save/save.txt', 'a+');
            // fputs($fichier, "`delete from " . $tablename . " where " . $id . "='" . $value . "'\n");
            // $fichier = fclose($fichier);
            return true;

        } else {
            return false;
        }
    }
}
