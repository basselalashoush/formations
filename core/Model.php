<?php

class Model
{
    static $connections = [];
    public $table = false;
    public $config = 'default';
    public $db;
    /**
     * Permet d'initialiser les variable du Model
     **/
    public function __construct()
    {
        // Nom de la table
        if ($this->table === false) {
            $this->table = strtolower(get_class($this)) . 's';
        }
        // connection to the database
        $conf = Conf::$databases[$this->config];
        if (isset(Model::$connections[$this->config])) {
            $this->db = Model::$connections[$this->config];
            return true;
        }
        try {
            $pdo = new PDO(
                'mysql:host=' . $conf['host'] . ';dbname=' . $conf['database'] . ';',
                $conf['login'],
                $conf['password'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            Model::$connections[$this->db] = $pdo;
            $this->db = $pdo;
        } catch (PDOException $e) {
            //le $debug ca permet aux visiteur de ne pas voir les erreurs et rendre le piratage plus difficile
            if (Conf::$debug >= 1) {
                die($e->getMessage());
            } else {
                die('Impossible de se connecter à la base de donnée');
            }
            //initialize some variables

        }
    }
    public function find($req)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' as ' . get_class($this) . '';
        if (isset($req['conditions'])) {
            $sql .= ' WHERE ';
            if (!is_array($req['conditions'])) {
                $sql .= $req['conditions'];
            } else {
                $cond = [];
                foreach ($req['conditions'] as $k => $v) {
                    if (!is_numeric($v)) {
                        $v = '"' . addslashes($v) . '"';
                    }
                    $cond[] = "$k = $v";
                }
                $sql .= implode(' AND ', $cond);
            }
        }
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return  $pre->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     *  returns the current element
     **/
    public function findFirst($req)
    {
        return current($this->find($req));
    }
}
