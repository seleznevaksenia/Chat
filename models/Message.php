<?php

class Message
{
    private $text = "";
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
        return $result->execute();
    }

    public static function getSatus($mes_id)
    {

        $db = Db::getConnection();
        $result1 = $db->prepare('SELECT status FROM messages WHERE mes_id = :mes_id');
        $result1->bindParam(':mes_id', $mes_id, PDO::PARAM_STR);
        $result1->execute();
        $i = 0;
        while ($row = $result1->fetch()) {
            $child[$i]['status'] = $row['status'];
            $i++;
        }
        return $child;
    }

    public static function delete($mes_id) {
        $child = self::getSatus($mes_id);
        $db = Db::getConnection();
        $sql = 'DELETE FROM messages WHERE mes_id = :mes_id';
        $result = $db->prepare($sql);
        $result->bindParam(':mes_id', $mes_id, PDO::PARAM_STR);
        $result->execute();
        if ($child[0]['status'] == 1) {
            $massive = Message::findchild($mes_id);
            foreach ($massive as $item) {
                self::delete($item['mes_id']);
            }
        }
        return true;
    }

    public static function red($mes_id,$text) {
        $db = Db::getConnection();
        $sql = "UPDATE messages SET text = :text  WHERE mes_id = :mes_id";
        $result = $db->prepare($sql);
        $result -> bindParam(':text',$text, PDO::PARAM_STR);
        $result -> bindParam(':mes_id',$mes_id, PDO::PARAM_STR);
        return $result-> execute();
    }

    public static function com($parent_id, $text)
    {
        $db = Db::getConnection();
        $name = $_SESSION['user']['first_name'];
        $vk = $_SESSION['user']['id'];
        $sql = "UPDATE messages SET status = 1  WHERE mes_id = :mes_id";
        $result = $db->prepare($sql);
        $result->bindParam(':mes_id', $parent_id, PDO::PARAM_STR);
        $result->execute();

        $sql = 'INSERT INTO messages (user_name, text, vk_id,parent_id)'
            . 'VALUES (:user_name, :text, :vk_id, :parent_id)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $name, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':vk_id', $vk, PDO::PARAM_STR);
        $result->bindParam(':parent_id', $parent_id, PDO::PARAM_STR);
        return $result->execute();
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
            $message[$i]['parent_id'] = $row['parent_id'];
            $message[$i]['status'] = $row['status'];
            $i++;
        }
        if (isset($message)) {
            return $message;
        } else {
            echo "Начните диалог...";
        }
    }

    public static function findchild($id)
    {
        $db = Db::getConnection();
        $result = $db->prepare('SELECT mes_id FROM messages WHERE parent_id = :parent_id');
        $result->bindParam(':parent_id', $id, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $message[$i]['mes_id'] = $row['mes_id'];
            $i++;
        }

        return $message;
    }


    public static function recursion($id, $n, $text, $message)
    {
        foreach ($message as $item) {
            if ($item['parent_id'] == $id) {

                $text .= "<div style='padding-left:" . $n . "px' class='messageblock' data-parentid='" . $item['parent_id'] . "'  data-mesid=" . $item['mes_id'] . " onclick='showme(this)'><span>" . $item['mes_date'] . " " . $item['user_name'] . ":</span> " . $item['text'] . "</div><i class='fa fa-pencil' data-iid=" . $item['mes_id'] . " onclick='red(this)'>Редактировать</i>" . " " . "<i class='fa fa-reply' data-iid=" . $item['mes_id'] . " data-comid=" . $item['mes_id'] . " onclick='comment(this)'>Комментировать</i>" . " " . "<i class='fa fa-trash-o' data-iid=" . $item['mes_id'] . "   onclick='del(this)'>Удалить</i><div style='margin-left:" . $n . "px' onclick='plus(this)' data-mesid=" . $item['mes_id'] . "  class = 'status" . $item['status'] . "' ></div><hr style='color:blue'>";

                if ($item['status'] == 1) {
                    if ($n >= 210) {
                        $n = 210;
                        $text = self::recursion($item['mes_id'], $n, $text . "<div class='tog' data-plus=" . $item['mes_id'] . ">", $message) . "</div></br>";

                    } else {
                        $text = self::recursion($item['mes_id'], $n + 30, $text . "<div class='tog' data-plus=" . $item['mes_id'] . ">", $message) . "</div></br>";
                    }
                }
            }
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