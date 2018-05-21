<?php

/**
 * Created by PhpStorm.
 * User: wangling
 * Date: 2018/5/16
 * Time: 21:56
 */
class database {
    private $config;

    public function __construct($config) {
        $this->config = $config;
        if($this->init_datebase()){
            $this->init_tables();
        }
    }

    private function create_pdo_datebase() {
        return new PDO($this->config['database'], $this->config['username'], $this->config['password']);
    }

    private function init_datebase() {
        $pdo = new PDO($this->config['init'], $this->config['username'], $this->config['password']);
        $res=$pdo->query("create database " . $this->config['db_name']);
        return $res;
    }
    private function init_tables() {
        $pdo = new PDO($this->config['init'], $this->config['username'], $this->config['password']);
        $res=$pdo->query("create database " . $this->config['db_name']);
        return $res;
    }

    public function check_userinfo($username, $password) {
        $sql="select username,password from `user` where username='$username' and passwod='$password'";
        $res=$this->create_pdo_datebase()->query($sql);
        return $res==false?null:$res->fetch();
    }
}