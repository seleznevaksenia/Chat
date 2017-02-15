<?php

class User
{
    public static function add($vk_id,$user_name) {
        
        $db = Db::getConnection();
        //137891365

        $sql = 'SELECT COUNT(*) FROM users WHERE vk_id = :vk_id';

        $result = $db->prepare($sql);
        $result->bindParam(':vk_id', $vk_id, PDO::PARAM_STR);
        $result->execute();
        $count=$result->fetchColumn();
        if ($count == 0) {
            $sqlnew = 'INSERT INTO users (user_name,vk_id ) VALUES (:user_name, :vk_id)';

            $result = $db->prepare($sqlnew);
            $result->bindParam(':user_name', $user_name, PDO::PARAM_STR);
            $result->bindParam(':vk_id', $vk_id, PDO::PARAM_STR);
            //Тут была ошибка return $result->execute();
             $result->execute();
            $sql = 'SELECT *FROM users WHERE vk_id = :vk_id';

            $result = $db->prepare($sql);
            $result->bindParam(':vk_id', $vk_id, PDO::PARAM_STR);
            $result->execute();
            $count=$result->fetchColumn();
           return $count;
        }

        return $count;
    }
    
    /**
     * Проверяет имя: не меньше, чем 2 символа
     */
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkTel($phoneNumber)
    {
        //if (preg_match("/+380\(\d{2}\)\d{3}-\d{2}-\d{2}/", $phoneNumber)) {
        if (preg_match("/\d{12}/", $phoneNumber)) {
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет имя: не меньше, чем 6 символов
     */
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет email
     */
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    public static function checkEmailExists($email) {
        
        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }
    public static function checkUserData($email,$password) {

        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        $password = md5($password);
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetchColumn();
        if($user) {
        //print_r($user);
            return $user;
        }
        return false;
    }

    public static function auth($userId) {

        //session_start();
        $_SESSION['user'] = $userId;
    }
   public static function checkLogged(){
        if(isset($_SESSION['user']))
        {
            return $_SESSION['user'];
        }
        header("Location:/user/login");
    }
    public static function isGuest(){
        //session_start();
       if(isset($_SESSION['user']))
        {
            return false;
        }
        return true;
    }
    public static function getUserById($id)
    {


        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';
            $result = $db->prepare($sql);
            $result -> bindParam(':id',$id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result-> execute();
            return $result->fetch();
        }
    }

    public static function edit($id,$name,$password)
    {
            $db = Db::getConnection();

            $sql = "UPDATE user SET user_name = :user_name, password = :password WHERE id = :id";
            $result = $db->prepare($sql);
            $result -> bindParam(':user_name',$name, PDO::PARAM_STR);
            $result -> bindParam(':password',$password, PDO::PARAM_STR);
            $result -> bindParam(':id',$id, PDO::PARAM_INT);         //$result->setFetchMode(PDO::FETCH_ASSOC);
           return $result-> execute();
    }
}