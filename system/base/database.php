    <?php

class Database
{

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "service";

    private $dbh;
    private $error;
    private $stmt = "";
    private $request = "";
    private $attributes = [];
    private $values = [];
    private $alias = [];

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        );
        //Create a new PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            //catch any error of type PDOException
            $this->error = $e->getMessage();
        }
    }

    public function checktype($value = '')
    {
        # code...
        switch (true) {
            case is_int($value):
                return (int) $value;
                break;
            default:
                return "'" . $value . "'";
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
        // return $this->resultSet();
    }

    public function select($type)
    {
        $this->request = "select " . $type;
        return $this;
    }
    public function select_distinct($type)
    {
        $this->request .= "select " . $type;
        return $this;
    }
    public function from($table)
    {
        $this->request .= " from " . $table;
        return $this;
    }
    public function where($attribute, $value,$operator = "=")
    {
        $this->request .= " where " . $attribute . $operator . $value;
        return $this;
    }
    public function where_not($attribute, $value)
    {
        $this->request .= " where " . $attribute . "!=" . $value;
        return $this;
    }
    function  and ($attribute, $value) {
        $this->request .= " and " . $attribute . "=" . $value;
        return $this;
    }
    public function and_not($attribute, $value)
    {
        $this->request .= " and " . $attribute . "!=" . $value;
        return $this;
    }
    public function limit($start, $end)
    {
        $this->request .= " limit " . $start . "," . $end;
        return $this;
    }
    function  or ($attribute, $value) {
        $this->request .= " or " . $attribute . "=" . $value;
        return $this;
    }
    public function group_by($attribute)
    {
        $this->request .= " group by " . $attribute;
        return $this;
    }
    public function order_by($attribute, $sort)
    {
        $this->request .= " order by " . $attribute . " " . $sort;
        return $this;
    }
    public function set($attribute, $value, $alias = null)
    {
        # code...
        array_push($this->attributes, $attribute);
        array_push($this->values, $value);
        if (isset($alias)) {
            # code...
            array_push($this->alias, $alias);
        } else {
            array_push($this->alias, ':' . $attribute);
        }

    }

    public function add($tablename)
    {
        # code...
        $this->request = 'insert into ' . $tablename . ' (' . implode(',', $this->attributes) . ') values (' . implode(',', $this->alias) . ')';
        $this->stmt = $this->dbh->prepare($this->request);

        for ($i = 0; $i < count($this->alias); $i++) {
            # code...
            $this->bind($this->alias[$i], $this->values[$i]);
        }
        $this->reset();
        return $this->execute();
    }

    public function update($tablename)
    {
        # code...
        $sets = "";
        for ($i = 0; $i < count($this->attributes); $i++) {
            # code...
            if ($i < count($this->attributes) - 1) {
                # code...
                $sets .= $this->attributes[$i] . ' = ' . $this->values[$i] . ',';
            } else {
                $sets .= $this->attributes[$i] . ' = ' . $this->values[$i] . ' ';
            }
        }
        $this->request = 'update ' . $tablename . ' set ' . $sets . $this->request;
        // echo $this->request;
        $this->stmt = $this->dbh->prepare($this->request);

        // for ($i=0; $i <count($this->alias) ; $i++) {
        //  # code...
        //     echo $this->alias[$i];
        //  $this->bind($this->alias[$i],$this->values[$i]);
        // }
        $this->reset();
        return $this->execute();
    }

    public function reset()
    {
        # code...
        $this->request = "";
        $this->attributes = [];
        $this->values = [];
        $this->alias = [];
    }
    public function get()
    {
        $this->stmt = $this->dbh->prepare($this->request);
        return $this;
    }
    public function result()
    {
        // echo $this->request;
        return $this->resultset();
    }
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }

    public function endTransaction()
    {
        return $this->dbh->commit();
    }

    public function cancelTransaction()
    {
        return $this->dbh->rollBack();
    }

    public function debugDumpParams()
    {
        return $this->stmt->debugDumpParams();
    }
}

?>
