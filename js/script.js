$(document).ready(function () {
    //банер
    function animateForDiv(object, time , round, length) {
        setTimeout(function () {
            $(object).css({'z-index': round, left:'100%'}).animate({left: '0'}, 4000);
        },time);
        if(length==round){
            setTimeout(function () {
                bannerAnimation();
                }, round*6000);
        }
    }
    function bannerAnimation() {
        var imgDiv = $("#forBanner").children();
        $(imgDiv).css({'z-index': 0});
        var round = 1;
        $.each(imgDiv, function () {
            animateForDiv(this, round*6000, round, imgDiv.length);
            round++;
        });

    }
    bannerAnimation();

    //функция для отправки ajax
    function sendAjax( url , message, getAnswer) {
        $.ajax({
            type:'POST',
            url: url,
            data:message,
            success: getAnswer,
            error:function(){
                alert('Ошибка');
            }
        });
        return false;
    }
    
    function loadEmployes() {
        $("#contentEmployess").html('');

        sendAjax('/main/getEmployees',
            {'name': $("#filterName").val(), 'company':$("#filterCompany").val()},
            function (data) {
                $.each(data, function (key, value) {
                    var itemEmpl = "<div class=\"item\">\n" +
                        "<div class=\"content\">\n" +
                        "<div class=\"ui checkbox\">\n" +
                        "<input type=\"checkbox\" name='"+value['id']+"'>\n" +
                        "<label>"+value['name']+"</label>\n" +
                        "</div>\n" +
                        "</div>\n" +
                        "</div>";
                    $("#contentEmployess").append(itemEmpl);
                });
            });
    }
    
    //список сотрудников
    $("#typeSurvey").change(function () {

        if($("#typeSurvey").val()!="Restrict Survey"){
            $("#listEmployees").css({'display': 'none'});

        }else{
            $("#listEmployees").css({'display': 'block'});
            loadEmployes();
        }
    });

    //фильтрация
    $("#filterName, #filterCompany").keyup(function () {
        loadEmployes();
    });

    //добавление вопросов
    $("#addQuestion").click(function(){
        var numQuestion = $("#listQuestion").children().length +1;
        var itemQuestion ="<div class=\"three fields\">\n" +
            "                      <div class=\"field\">\n" +
            "                            <label>Question</label>\n" +
            "                            <input type=\"text\" placeholder=\"Question\" name='name[q"+numQuestion+"][question]' required>\n" +
            "                        </div>\n" +
            "                        <div class=\"field\">\n" +
            "                            <label>Type of Answer</label>\n" +
            "                            <select class='typeAnswer' name='name[q"+numQuestion+"][typeAnswer]'>\n" +
            "                                <option>Option</option>\n" +
            "                                <option>Text</option>\n" +
            "                                <option>Number</option>\n" +
            "                            </select>\n" +
            "                        </div>\n" +
            "                        <div class=\"field optionList\">\n" +
            "                            <label>Options List</label>\n" +
            "                            <input type=\"text\" placeholder=\"Options List\" name='name[q"+numQuestion+"][option]'>\n" +
            "                        </div>\n" +
            "                        <div class=\"field\">\n" +
            "                            <button class=\"ui red button remove-question\"><i class=\"remove icon\"></i> Remove</button>\n" +
            "                        </div>\n" +
            "</div>";


        $("#listQuestion").append(itemQuestion);
    });

    //удаление вопросов
    $("body").on( 'click', '.remove-question',function(event){
        var parent = $(this).parent(".field");
        var row = $(parent).parent(".three");
        $(row).remove();
    });

    $("body").on('change', '.typeAnswer', function (event) {
        var parent = $(this).parent(".field");
        var row = $(parent).siblings(".optionList");
        if($(this).val()=="Option"){
            $(row).css({'display':'block'});
        }else{
            $(row).css({'display':'none'});
        }
    });

    $("#startDate").change(function () {
        var today = new Date();
        var setDate = new Date($("#startDate").val());
        if(setDate < today){
            console.log("Дата начала не может быть меньше текущей даты");
        }
    });
    $("#endDate").change(function(){
        var finishDate = new Date($("#endDate").val());
        var setDate = new Date($("#startDate").val());
        if(setDate > finishDate){
            console.log("Дата окончания должна быть  позже даты начала.");
        }
    });

    //сохранение о пройденном опросе
    $("#addHistory").click(function (event) {
        event.preventDefault();
        $("input").each(function(){
            if($(this).val()==""){
                $(this).css({'border-color':'red'});
            }
            else{
                $.ajax({
                    type:'POST',
                    url: "/main/addHistory",
                    data: {
                        'email':$("#user").html(),
                        'surv':$("#survey").html()
                    },
                    success: function (data) {
                        console.log(data);
                    },
                    error:function(){
                        alert('Ошибка');
                    }
                });
                return false;
            }
        });
        console.log("Нажато");
    });

});
