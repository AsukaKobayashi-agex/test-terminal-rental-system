
$(function () {
    //チェックがない場合に全チェックボタンを外し、一括ボタンを無効化
    $('.checkbox label,.checkbox input').click(function () {
        if ($('.checkbox').length === $('.checkbox :checked').length) {
            $('#check_all').prop('checked', 'checked');
        } else {
            $('#check_all').prop('checked', false);
        }
        if ($('#dataTable :checked').length !== 0) {
            $('.bundle').removeAttr('disabled')
        } else {
            $('.bundle').attr('disabled', true)
        }
    });

    //全チェックボタン
    $('#check_all').click(function () {
        $('input:checkbox').prop('checked', this.checked);

        if ($('#dataTable :checked').length !== 0) {
            $('.bundle').removeAttr('disabled')
        } else {
            $('.bundle').attr('disabled', true)
        }

    });

    $('.mylist-check-all label,.mylist-check-all input').click(function () {
        var checkItem = $(this).parents('thead').next('tbody').find('input');
        $(checkItem).prop('checked', this.checked);
        if ($('.data-table :checked').length !== 0) {
            $('.bundle').removeAttr('disabled')
        } else {
            $('.bundle').attr('disabled', true)
        }
    });

    $('.mylist-checkbox label,.mylist-checkbox input').click(function () {
        var mylistCheckAll = $(this).parents('tbody').prev('thead').find('input');
        var group = $(this).parents('tbody').find('input:checkbox');
        var groupchecked = $(this).parents('tbody').find(':checked');
        if ($(group).length === $(groupchecked).length) {
            $(mylistCheckAll).prop('checked', 'checked');
        } else {
            $(mylistCheckAll).prop('checked', false);
        }
        if ($('.data-table :checked').length !== 0) {
            $('.bundle').removeAttr('disabled')
        } else {
            $('.bundle').attr('disabled', true)
        }
    });

});
