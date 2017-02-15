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
    public static function load() {
        $db = Db::getConnection();

        $result = $db->query('SELECT * FROM messages ORDER BY mes_id Desc');
        $i = 0;
        while ($row = $result->fetch()) {
            $message[$i]['mes_date'] = $row['mes_date'];
            $message[$i]['mes_date'] = $row['mes_date'];
            $message[$i]['user_name'] = $row['user_name'];
            $message[$i]['text'] = $row['text'];
            $i++;
        }
        $text="";
        foreach ($message as $value) {
            $text = $text."<div class='messageblock' onclick='red(this)'>".$value['mes_date']." ".$value['user_name']." ".$value['text']."<i class='fa fa-pencil' ></i>"." "."<i class='fa fa-reply'></i>"." "."<i class='fa fa-trash-o' ></i></div>";
        }
        return $text;

    }

}