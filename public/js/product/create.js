$(function () {
    let maxLength = 165;
    let count = $('#chars');

    $('#seo_description').keyup(function () {
        let rest = maxLength--;

        if (rest <= 0) {
            $(this).prop('disabled', true);
        } else {
            count.text(maxLength--);
        }
    });

    $('.numeric').maskMoney();
    $('.editor').summernote({
        placeholder: 'Escreva sua descrição aqui',
        tabsize: 2,
        height: 100
    });
    $('#keywords').tagsinput({
        tagClass: 'big'
    });
});
