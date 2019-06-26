
function submitAction(url,name) {
    document.name.attr('action', url);
    $('form').submit();
}

$(function () {
    $('.checkbox').click(function () {
        if ($('#dataTable :checked').length !== 0) {
            $('.bundle').removeAttr('disabled')
        } else {
            $('.bundle').attr('disabled', true)
        }
        if ($('#dataTable :checked').length === $('#dataTable :input').length) {
            $('#check_all').prop('checked', 'checked');
        } else {
            $('#check_all').prop('checked', false);
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
