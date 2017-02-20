//Загрузка
var load =
    $.post("/user/recursion/", {}, function (data) {
        $("#msg-box").html(data);

    });

$(function () {
    load;
});

function plus(element) {
    var id_i = $(element).attr("data-mesid");
    $('div[data-plus=' + id_i + ']').slideToggle("slow", function () {
    });

}



//Вызывает элементы для редактирования, коментирования,удаления
var flag;
var flag_id;
function showme(element){
    var id_i = $(element).attr("data-mesid");
    $.post("/user/authdb/", {id:id_i}, function (data) {

        //Флаги для проверки, что меню не открыто под другим сообщением
        //Если сообщение открыто
        if(flag && flag_id == id_i){flag = false;}
        //Если сообщение закрыто
        else if(!flag) {flag = true; flag_id = id_i;}
        //Меню открыто под другим сообщением
        else{
            return;
        }

        if (data == 'yes') {
            $('i[data-iid='+id_i+']').slideToggle("slow", function() {
            });
        }
        if(data == 'no'){
            $('i[data-comid='+id_i+']').slideToggle("slow", function() {
            });
        }
    });
    return false;
}


//Отправка сообщения
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
                $("#text").focus();
                $("#msg-box").html(data);
            }
            else
            {
                $("#error").show();
            }

        });
        return false;
    });

});

//Удаление сообщения
function del(element){
    $.post("/user/delete/", {mes_id:element.getAttribute("data-iid")}, function (data) {
        $.post("/user/recursion/", {}, function (data) {
            $("#msg-box").html(data);
            flag = false;
        });
    });
    return false;
}

//Редактирование сообщений
function red(element) {
    var mes_id = $(element).attr("data-iid");
    var elements = $(".messageblock");
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].getAttribute("data-mesid") == mes_id) {
            elements[i].style.display = 'none';
            var message = elements[i]. innerHTML;
            var newMessage = message.replace(/<span>.+<\/span>/g,"");
            elements[i].insertAdjacentHTML("afterEnd", "<div class='row'><div class='col-sm-12'><form><input id='red' type='text' value='" + newMessage + "' required/><input id = 'finish' type='submit' value='Завершить' /></form></div></div>");
            $("#red").focus();
        }
    }
    document.getElementById("finish").onclick = function() {
        var text = document.getElementById("red").value ;
        flag = false;
        $.post("/user/red/", {mes_id:mes_id,text:text}, function (data) {
            $.post("/user/recursion/", {}, function (data) {
                $("#msg-box").html(data);
            });
            return false;
        });
        return false;
    }

}

//Комментирование сообщений
function comment(element) {
    var mes_id = $(element).attr("data-iid");
    var elements = $(".messageblock");
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].getAttribute("data-mesid") == mes_id) {
            elements[i].insertAdjacentHTML("afterEnd", "<div class='row'><div class='col-sm-12'><form><input id='com' type='text' value='' required /><input id = 'finish' type='submit' value='Завершить' ></form></div></div>");
            $("#com").focus();
        }
    }
    document.getElementById("finish").onclick = function () {
        flag = false;
        var text = document.getElementById("com").value;
        $.post("/user/com/", {parent_id: mes_id, text: text}, function (data) {
            $.post("/user/recursion/", {}, function (data) {
                $("#msg-box").html(data);
            });
            return false;
        });
        return false;
    }

}

//Копирайт
$(document).ready(function () {
    var myDate = new Date();
    document.getElementById("copy").innerHTML = "Copyright © " + myDate.getUTCFullYear();
    document.getElementById("copy").innerHTML = "Copyright © " + myDate.getUTCFullYear();
})
