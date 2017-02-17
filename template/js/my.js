//Загрузка
var load =
    $.post("/user/load/", {}, function (data) {
        $("#msg-box").html(data);
    });

$(function () {
    load;
});

//Вызывает элементы для редактирования, коментирования,удаления
var flag;
var flagCom;
var n;
var flag_id;
function showme(element){
    //var id_i = element.getAttribute("data-mesid");
    var id_i = $(element).attr("data-mesid");
    //$.post("/user/authdb/", {id:element.getAttribute("data-mesid")}, function (data) {
    //var elements = document.getElementsByTagName("i");
    $.post("/user/authdb/", {id:id_i}, function (data) {
        if(flag && flag_id == id_i){flag = false;}
        else if(!flag) {flag = true; flag_id = id_i;}
        else{
            return;
        }
        if (data == 'yes') {

            $('i[data-iid='+id_i+']').slideToggle("slow", function() {
            });
        }



                /*if (flag) {
                    for (var i = 0; i < elements.length; i++) {
                        if (elements[i].getAttribute("data-iid") == id_i) {
                            elements[i].style.display = 'none';
                            flag = false;
                        }
                    }
                }
                else {
                    //Добавить уловие для запреда действия

                        for (var i = 0; i < elements.length; i++) {
                            if (elements[i].getAttribute("data-iid") == id_i) {
                                elements[i].style.display = 'block';
                                flag = true;
                            }
                        }
                }*/

        if(data == 'no'){
            $('i[data-comid='+id_i+']').slideToggle("slow", function() {
            });

            /**if(flagCom){
                for (var i = 0; i < elements.length; i++) {
                    if (elements[i].getAttribute("data-comid") == id_i ) {
                        elements[i].style.display = 'none';
                    }
                    flagCom = false;
                }
            }
            else{
                //Добавить уловие
                for (var i = 0; i < elements.length; i++) {
                    if (elements[i].getAttribute("data-comid") == id_i ) {
                        elements[i].style.display = 'block';
                    }
                    flagCom = true;
                }
            }**/
        }
    });
    return false;
}


//Попітка написать сообщение без авторизации
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
                $("#msg-box").html(data);
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
//Удаление сообщения
function del(element){
    $.post("/user/delete/", {mes_id:element.getAttribute("data-iid")}, function (data) {
        $.post("/user/load/", {}, function (data) {
            $("#msg-box").html(data);
        });
    });
    return false;
}

//Редактирование сообщений
function red(element) {
    var mes_id = element.getAttribute("data-iid");
    var elements = document.getElementsByClassName("messageblock");
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].getAttribute("data-mesid") == mes_id) {
            elements[i].style.display = 'none';
            var message = elements[i]. innerHTML;
            var newMessage = message.replace(/<span>.+<\/span>/g,"");

            elements[i].insertAdjacentHTML("afterEnd", "<div class='row'><div class='col-sm-12'><input id='red' type='text' value='"+newMessage+"'/></div></div><div id = 'finish' >Завершить</div>");
        }
    }
    document.getElementById("finish").onclick = function() {
        var text = document.getElementById("red").value ;
        $.post("/user/red/", {mes_id:mes_id,text:text}, function (data) {
            $.post("/user/load/", {}, function (data) {
                $("#msg-box").html(data);
            });
            return false;
        });
        return false;
    }

}
    /*$.post("/user/red/", {mes_id:mes_id}, function (data) {

        $.post("/user/load/", {}, function (data) {
            $("#msg-box").html(data);
        });
    });
    return false;
}**/


//Копирайт
$(document).ready(function () {
    var myDate = new Date();
    document.getElementById("copy").innerHTML = "Copyright © " + myDate.getUTCFullYear();
    document.getElementById("copy").innerHTML = "Copyright © " + myDate.getUTCFullYear();
})
