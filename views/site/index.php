<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    </br>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-12">
                        <img src="/template/images/chat.png">
                    </div>
                    <div class="row">
                        <div id="name" class="col-sm-12"> <?php echo $name ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="shadow" class="col-sm-6 ">
                <form name="tbox" action="" method="">

                    <textarea id="text" name="msg" rows="5" cols="" autofocus PLACEHOLDER="Текст сообщения"
                              required></textarea>
            </div>
            <div class="col-sm-2">
                <input id="send" type="submit" class="btn btn-default" value=""/>
            </div>
        </form>
        </div>
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