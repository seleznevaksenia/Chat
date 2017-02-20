<?php

class UserController
{
    public function actionAuthdb()
    {

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['id'] == Message::getUserByMessage($_POST['id'])){
                echo 'yes';
            return true;
        } else {
            echo 'no';
            return true;
        }
    }
        else {echo 'error';
            return true;}
    }

    public function actionDelete()
    {
            echo Message::delete($_POST['mes_id']);
            return true;
    }

    public function actionRed()
    {
        echo Message::red($_POST['mes_id'],$_POST['text']);
        return true;
    }

    public function actionCom()
    {
        echo Message::com($_POST['parent_id'], $_POST['text']);
        return true;
    }

    public function actionAuth()
    {
        $id = NULL;
        $n = 0;
        $text = "";
        if (isset($_SESSION['user'])) {

        Message::send($_POST['message']);
            $message = Message::load();
            echo Message::recursion($id, $n, $text, $message);
        return true;
        }
        else {echo 'error';
        return true;}
    }

    public function actionRecursion()
    {
        $id = NULL;
        $n = 0;
        $text = "";
        $message = Message::load();
        if (isset($message)) {
            echo Message::recursion($id, $n, $text, $message);
        }
        return true;
    }

    public function actionLogout()
    {
        //session_start();
        unset($_SESSION['user']);
        header("Location:/");
    }
    public function actionLoginVk()
    {

        $url = 'http://oauth.vk.com/authorize';

        $params = array(
            'client_id'     => APP_ID,
            'redirect_uri'  => APP_SECRET,
            'response_type' => 'code'
        );

        if (isset($_GET['code'])) {
            $result = false;
            $params = array(
                'client_id' => APP_ID,
                'client_secret' => APP_SECRET,
                'code' => $_GET['code'],
                'redirect_uri' => REDIRECT_URI
            );

            $url = 'https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params));
            $r = curl_init();
            curl_setopt($r, CURLOPT_NOPROGRESS, 0);
            curl_setopt($r, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($r, CURLOPT_URL, $url);

            $token = json_decode(curl_exec($r));


            if ($token->{"access_token"}) {
                $params = array(
                    'uids'         => $token->{"user_id"},
                    'fields'       => 'uid,first_name,last_name,screen_name,bdate,sex,photo_big',
                    'access_token' => $token->{"access_token"},
                    'v'=> '5.62'
                );
                $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

                if (isset($userInfo['response'][0]['id'])) {
                    $userInfo = $userInfo['response'][0];
                    $result = true;
                }
            }
            if ($result) {
                $_SESSION['user'] = $userInfo;
                $id=User::add($userInfo['id'],$userInfo['first_name']);

                header('HTTP/1.1 301 Moved Permanently');
                header("Location:/");
            }
            else{
              echo "error";
            }

        }

    }
}


