
$(function () {
    //チェックがない場合に全チェックボタンを外し、一括ボタンを無効化
    $('.checkbox').click(function () {
        if ($('#dataTable :checked').length === $('#dataTable :input').length) {
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
});
