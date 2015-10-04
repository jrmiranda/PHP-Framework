<?php

/**
 * Desenvolvido por Júnior Miranda
 */
defined('SYSTEM_PATH') or die('Acesso direto bloqueado');

class Model {

    private static $instance;
    public $pdo;
    
    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

            if (DEV_MODE) {
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $ex) {
            if (DEV_MODE) {
                echo $ex->getMessage();
            }
        }
    }
    
    public function insert($table, $data, $retid = 1) {
        $size = count($data);
        $keys = implode(', ', array_keys($data));
        $values = str_repeat('?, ', $size - 1) . '?';
        $i = 1;
        
        $query = 'INSERT INTO ' . $table
                . ' (' . $keys . ')'
                . ' VALUES '
                . '(' . $values . ')';
        
        $stmt = $this->pdo->prepare($query);
        
        foreach ($data as &$value) {
            $stmt->bindParam($i++, $value);
        }
        
        if (!$retid) {
            return $stmt->execute();
        } else {
            $stmt->execute();
            return $this->pdo->lastInsertId();
        }
    }
    
    public function select($table, $select = '*', $where = '', $order = '') {
        $size = count($where);
        $keys = $where == '' ? '' : ' WHERE `' . implode('` = ? AND `', array_keys($where)) . '` = ?';
        $order = $order == '' ? '' : ' ORDER BY ' . $order;
        $i = 1;
        
        $query = 'SELECT '
                . $select
                . ' FROM '
                . '`' . $table . '`'
                . $keys
                . $order;
        
        $stmt = $this->pdo->prepare($query);
        
        if (is_array($where)) {
            foreach ($where as &$value) {
                $stmt->bindParam($i++, $value);
            }
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function get($table, $select = '*', $where = '') {
        $size = count($where);
        $keys = $where == '' ? '' : ' WHERE `' . implode('` = ? AND `', array_keys($where)) . '` = ?';
        $i = 1;
        
        $query = 'SELECT '
                . $select
                . ' FROM '
                . '`' . $table . '`'
                . $keys
                . ' LIMIT 1';
        
        $stmt = $this->pdo->prepare($query);
        
        if (is_array($where)) {
            foreach ($where as &$value) {
                $stmt->bindParam($i++, $value);
            }
        }
        
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function search($table, $select, $field, $like) {
        $query = 'SELECT '. $select
                . ' FROM `' . $table . '`'
                . ' WHERE `' . $field . '` LIKE \'%' . $like . '%\'';
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function update($table, $data, $where) {
        $update = array2string($data, ', ', '=', '`', '\'');
        $where = array2string($where, ' AND ', '=', '`', '\'');
        
        $query = 'UPDATE `'. $table . '`'
                . ' SET ' . $update
                . ' WHERE ' . $where;
        
        $stmt = $this->pdo->prepare($query);
        
        return $stmt->execute();
    }
    
    public function delete($table, $where) {
        $where = array2string($where, ' AND ', '=', '`', '\'');

        $query = 'DELETE FROM ' . $table . ' WHERE ' . $where;
        $stmt = $this->pdo->prepare($query);
        
        return $stmt->execute();
    }
    
    public function save_settings($config) {
        
    }
    
    public function get_settings($config) {
        
    }

    public static function get_instance() {
        if (!is_object(self::$instance)) {
            self::$instance = new Model();
        }
        return self::$instance;
    }

}
