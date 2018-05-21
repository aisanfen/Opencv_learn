<?php
/**
 * Created by PhpStorm.
 * User: wangling
 * Date: 2018/5/16
 * Time: 22:12
 */
session_start();
include "database.php";
class blog_server {
    private $config=array();
    public function __construct($config) {
        $this->config=$config;
    }
    public function url_decode() {
        if(isset($_GET)){
            $path=array_keys($_GET);
            if(empty($path)){
                echo $this->index();
                exit();
            }
            $url=preg_split("/\//",$path[0]);
            array_shift($url);
//            var_dump($url);
            switch ($url[0]){
                case "index":
                    echo $this->index();
                    break;
                case "login":
                    echo $this->login();
                    break;
                case "message":
                    echo $this->message();
                    break;
                case "logout":
                    echo $this->logout();
                    break;
                case "xss":
                    echo $this->xss();
                    break;
                default:
                    echo $this->index();
                    break;
            }
        }
    }
    private function index(){

        $page=<<<HTML
<!DOCTYPE html>
<html>
<head>
<title>留言板</title>
</head>
<body>
%s
<table>
<tr>
<td>用户</td>
<td>留言</td>
<td>时间</td>
</tr>
</table>
</body>
</html>
HTML;
        if(isset($_SESSION) and isset($_SESSION['username'])){
            return sprintf($page,"欢迎".$_SESSION['username']."的到来");
        }else{
            return sprintf($page,"您还未登录请<a href='index.php?/login'>登录</a>");
        }
    }
    private function login(){
        if(isset($_POST['username']) and isset($_POST['password'])){
            $username=$_POST['username'];
            $password=$_POST['password'];
            $database=new database($this->config);
            $uinfo=$database->check_userinfo($username,$password);
            if($uinfo!=null){

            }else return json_encode(array("message","账号或密码错误"));
            return null;
        }
        $page=<<<HTML
<!DOCTYPE html>
<html>
<head>
<title>留言板</title>
</head>
<body>
<form method="post" action="index.php?/login">
<table>
<tr>
<td>用户名:</td>
<td><input name="username" type="text"></td>
</tr>
<tr>
<td>密码:</td>
<td><input name="password" type="test"></td>
</tr>
<tr>
<td colspan="2"><input style="width:100%;" type="submit"></td>
</tr>
</table>
</form>
</body>
</html>
HTML;

        return $page;
    }
    private function message(){
        $page=<<<HTML
<!DOCTYPE html>
<html>
<head>
<title>留言板</title>
</head>
<body>
%s
</body>
</html>
HTML;
        $board=<<<HTML
<form action="index.php?/message" method="post">
<textarea name="content">
此处填写留言
</textarea>
<input type="submit" value="提交留言">
</form> 
HTML;

        if(isset($_SESSION) and isset($_SESSION['username'])){
            return sprintf($page,"欢迎".$_SESSION['username']."的到来");
        }else{
            return sprintf($page,"您还未登录请<a href='index.php?/login'>登录</a>");
        }
        return $page;

    }
    private function logout(){
        unset($_SESSION);
        session_destroy();
        header("Location:index.php?/index");
    }
    public function request(){
        if(isset($_POST)){
            echo "Request";
        }
    }
    public function xss(){
        if(isset($_GET['xss']))echo $_GET['xss'];
    }

    public function run() {
        $this->url_decode();
    }
}