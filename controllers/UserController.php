<?php

class UserController
{

    public function actionAuth()
    {

        if (isset($_SESSION['user'])) {
        echo $_SESSION['user']['first_name'];
        Message::send($_POST['message']);
        return true;
        }
        else {echo 'error';
        return true;}
    }
    public function actionload()
    {
       echo Message::load();
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

            //https://oauth.vk.com/access_token?client_id= + CLIENT_ID + &client_secret= + CLIENT_SECRET + &v=5.62&grant_type=client_credentials
            //$token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))));
            $url = 'https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params));
            $r = curl_init();
            curl_setopt($r, CURLOPT_NOPROGRESS, 0);
            curl_setopt($r, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($r, CURLOPT_URL, $url);

            $token = json_decode(curl_exec($r));

            //$token = json_decode('{"access_token":"94959f30f481a4bbd89f74b5991b5fb5bb8887512ab874cd0853a39562da6d8c6d2f4d273151773361b9f","expires_in":85506,"user_id":137891365}');
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
                User::add($userInfo['id'],$userInfo['first_name']);
                header('HTTP/1.1 301 Moved Permanently');
                header("Location:/");
            }
            else{
              echo "error";
            }

           /**if ($result) {

                echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
                echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
                echo "Ссылка на профиль пользователя: " . $userInfo['screen_name'] . '<br />';
                echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
               echo "День Рождения: " . $userInfo['bdate'] . '<br />';
                echo '<img src="' . $userInfo['photo_big'] . '" />'; echo "<br />";

            }*/
        }

    }
}


