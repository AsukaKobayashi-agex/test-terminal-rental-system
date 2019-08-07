$(function () {
    var cancelFlag = 0;

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

    $('a.once').click(function () {
        if( cancelFlag === 0 ){
            //++++cancelFlagが0であれば処理開始+++++

            // 1. まずcancelFlgを立てる（1にする）
            cancelFlag = 1;

        }else{
            return false;
        }
    });

    $('button.once').click(function () {
        if( cancelFlag === 0 ){
            //++++cancelFlagが0であれば処理開始+++++

            // 1. まずcancelFlgを立てる（1にする）
            cancelFlag = 1;

        }else{
            return false;
        }
    })
});
