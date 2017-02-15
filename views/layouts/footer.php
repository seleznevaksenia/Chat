<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p id ="copy" class="pull-left"></p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->



<script src="/template/js/jquery.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/jquery.scrollUp.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/template/js/jquery.prettyPhoto.js"></script>
<script src="/template/js/main.js"></script>

<script>

    //Загрузка
    $(function () {
        $.post("/user/load/", {}, function (data) {
            $("#msg-box").html(data);
        });
    });

    //Редактировать
    $(function () {
    $("#text").click(function () {
        this.css("border", "1px solid red");
        alert('hello');
    });
    });

    function red(element){
        var node = document.createElement("I");
        element.style.color = "red";
        element.children[0].style.opacity = 1;
        element.children[1].style.opacity = 1;
        element.children[2].style.opacity = 1;

    }


    $(document).ready(function () {
        $("#send").click(function () {
            $("#error").hide();
            var text = $("#text").val();
            document.tbox.msg.value="";

            //Ajax
               $.post("/user/auth/", {
                   message: text
               }, function (data) {
                   if(data!='error'){
                       var myDate = new Date();
                       var pict = "<i class='fa fa-pencil' ></i>"+" "+"<i class='fa fa-reply'></i>"+" "+"<i class='fa fa-trash-o' ></i>";
                $("#msg-box").prepend("<div class='messageblock' onclick='red(this)'>"+myDate.getFullYear()+"-"+myDate.getUTCMonth()+"-"+myDate.getUTCDay()+" "+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds()+" "+data+":"+text+" "+pict+"</div>");
               }
               else
            {
                $("#error").show();
            }

            });
            return false;
        });


        //Перезагрузка чата
        $("#load").click(function () {
       $.post("/user/load/", {}, function (data) {
            $("#msg-box").html(data);
        });
            return false;
    });

    });

</script>

<script>
    $(document).ready(function () {
        var myDate = new Date();
        document.getElementById("copy").innerHTML = "Copyright © " + myDate.getUTCFullYear();
        document.getElementById("copy").innerHTML = "Copyright © " + myDate.getUTCFullYear();
    });

</script>
</body>
</html>