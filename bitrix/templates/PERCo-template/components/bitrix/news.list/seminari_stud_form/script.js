$(document).ready(function() {
    $(":submit").attr("disabled", "disabled");
    if (speclAll == "")
        $("#zayavka").css("display", "none");
    $(".list_spec").html(speclAll);
    if ($("#form_checkbox_hotel_552").prop("checked")) {
        $("#info").css("display", "none");
        $("#data_zaezda").css("display", "none");
        $("#data_viezda").css("display", "none");
        $("#vid_nomera").css("display", "none");
    }
    $("[name=form_radio_hotel]").change(function() {
        if ($("#form_checkbox_hotel_553").prop("checked")) {
            $("#info").fadeIn('slow');
            $("#data_zaezda").fadeIn('slow');
            $("#data_viezda").fadeIn('slow');
            $("#vid_nomera").fadeIn('slow');
        } else {
            $("#info").fadeOut('slow');
            $("#data_zaezda").fadeOut('slow');
            $("#data_viezda").fadeOut('slow');
            $("#vid_nomera").fadeOut('slow');
        }
    });
    $("#seminars").change(function() {
        $("#datesem > p").fadeOut('slow');
        $("[name=LIST_DATE]").prop("checked", false);
        var sel = $("#seminars").val();
        if (sel != "0") {
            $("#specialists").fadeIn('slow');
            $("#hotel").fadeIn('slow');
            switch (sel) {
                case "1": // Для руководителей
                    $(".obzor").fadeIn('slow');
                    break;
                case "2": // Для пользователей
                    $(".praktika").fadeIn('slow');
                    break;
                case "3": // Для инсталляторов/администраторов
                    $(".allsem").fadeIn('slow');
                    break;
                case "4": // Для инсталляторов/администраторов
                    $(".service").fadeIn('slow');
                    break;
            }
            if ($("#datesem").attr("sem") != "0")
                $(":submit").removeAttr("disabled");
            else
                $("#datesem > p").fadeIn('slow');
        } else {
            $("#specialists").fadeOut('slow');
            $("#hotel").fadeOut('slow');
            $(":submit").attr("disabled", "disabled");
        }
    });


    $('.list_spec [type="checkbox"]').click(function() {
        var result = "",
            user = $("[name=LIST_SPEC]:checked");
        $.each(user, function(n, v) {
            var i = 0;
            var datares = "",
                datas = $("#datesem [name=LIST_DATE]:checked")
            $.each(datas, function(m, z) {
                if (i == 0)
                    datares = "," + z.value + "|";
                else
                    datares += z.value + "|";
                i++;
            })
            result += v.value + datares + ";";
        });
        if (result != "")
            $("[name = form_hidden_560]").val(result);
        console.log($("[name = form_hidden_560]").val());
    });
});