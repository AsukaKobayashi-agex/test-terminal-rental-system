$(function () {

    $('#sidebarToggle').click(function () {
        if ($('#accordionSidebar').hasClass('toggled')) {
            document.cookie = 'sideOpen=1'
        } else {
            document.cookie = 'sideOpen=0'
        }

    });

    $('#sidebarToggleTop').click(function () {
        if ($('#accordionSidebar').hasClass('toggled')) {
            document.cookie = 'sideOpen=1'
        } else {
            document.cookie = 'sideOpen=0'
        }

    });

});
