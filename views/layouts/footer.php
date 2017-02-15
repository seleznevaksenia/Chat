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
    $(document).ready(function (){
        $("#send").click(function () {
            $("#error").hide();
            var text = $("#text").val();
            document.tbox.msg.value="";
               $.post("/user/auth/", {
                   message: text
               }, function (data) {
                   if(data!='error'){
                $("#msg-box").append("<div>"+data+":"+text+"   "+"<i class='fa fa-pencil' ></i>"+" " +"<i class='fa fa-reply'></i>"+"</div>");
               }
               else
            {
                $("#error").show();
            }

            });
            return false;
        });

        //Перезагрузка чата
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