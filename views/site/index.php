<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    </br>
    <div class="container">
        <form name="tbox" action="" method="">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 ">
                <textarea id ="text" name="msg" rows="5" cols="15"></textarea>
            </div>
            <div class="col-sm-2">
                <input id = "send" type="submit" class="btn btn-default" value="Отправить" />
            </div>
        </div>
        </form>
            </br>
            <div class="row" >
                <div id ="bigbox" class="col-sm-6 col-sm-offset-3">
                    <div id="msg-box">
                    </div>

                </div>
            </div>

    </div>
    </br>

</section>


<?php include ROOT . '/views/layouts/footer.php'; ?>