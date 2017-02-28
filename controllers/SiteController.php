
<?php


class SiteController
{


    public function actionIndex()
    {
        if (isset($_SESSION['user'])) {
            $name = $_SESSION['user']['first_name'] . ", you are online...";
        } else {
            $name = "You are offline...";
        }
        require_once(ROOT . '/views/site/index.php');

        return true;
    }

}
