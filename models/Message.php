<?php

class Message
{
    public static function send($text) {
        $db = Db::getConnection();
        $name = $_SESSION['user']['first_name'];
        $vk = $_SESSION['user']['id'];
        $sql = 'INSERT INTO messages (user_name, text, vk_id)'
            . 'VALUES (:user_name, :text, :vk_id)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $name, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':vk_id', $vk, PDO::PARAM_STR);

        //Тут была ошибка return $result->execute();
        return $result->execute();
    }
    public static function delete($mes_id) {
        $db = Db::getConnection();
        $sql = 'DELETE FROM messages WHERE mes_id = :mes_id';
        $result = $db->prepare($sql);
        $result->bindParam(':mes_id', $mes_id, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function red($mes_id,$text) {
        $db = Db::getConnection();
        $sql = "UPDATE messages SET text = :text  WHERE mes_id = :mes_id";
        $result = $db->prepare($sql);
        $result -> bindParam(':text',$text, PDO::PARAM_STR);
        $result -> bindParam(':mes_id',$mes_id, PDO::PARAM_STR);
        return $result-> execute();
    }



    public static function load() {
        $db = Db::getConnection();

        $result = $db->query('SELECT * FROM messages ORDER BY mes_id Desc');
        $i = 0;
        while ($row = $result->fetch()) {
            $message[$i]['mes_id'] = $row['mes_id'];
            $message[$i]['mes_date'] = $row['mes_date'];
            $message[$i]['user_name'] = $row['user_name'];
            $message[$i]['text'] = $row['text'];
            $i++;
        }
        $text="";
        foreach ($message as $value) {
            $text = $text."<div class='messageblock' data-mesid=".$value['mes_id']." onclick='showme(this)'><span>".$value['mes_date']." ".$value['user_name']."</span> ".$value['text']."</div><i class='fa fa-pencil' data-iid=".$value['mes_id']." onclick='red(this)'>Редактировать</i>"." "."<i class='fa fa-reply' data-iid=".$value['mes_id']." data-comid=".$value['mes_id'].">Комментировать</i>"." "."<i class='fa fa-trash-o' data-iid=".$value['mes_id']."   onclick='del(this)'>Удалить</i>";
        }
        return $text;

    }

    public static function getUserByMessage($id) {
        $db = Db::getConnection();
        $sql = 'SELECT vk_id FROM messages WHERE mes_id = :mes_id';
        $result = $db->prepare($sql);
        $result->bindParam(':mes_id', $id, PDO::PARAM_STR);
        $result->execute();
        $id = $result->fetch();
        return $id['vk_id'];

    }





}