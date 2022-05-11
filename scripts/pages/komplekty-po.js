$(document).ready(function() {
    $(document).on({
        mouseenter: function() {
            id = $(this).attr("href-text");
            if (id) $(id).css("display", "block");
        },
        mouseleave: function() {
            if (id) $(id).css("display", "none");
        }
    }, "td > a");

});