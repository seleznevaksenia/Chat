<?php

class User
{
    public static function add($vk_id,$user_name) {
        
        $db = Db::getConnection();

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


    public static function auth() {
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

}