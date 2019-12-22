$(function () {

    function buildHTML(data, src) {
        let html = `<div class="kaiwa auth__user">
                        <figure class="kaiwa-img-left">
                            <img src="${src}" alt="no-img2" class="user__image">
                        </figure>
                        <div class="kaiwa-text-right">
                            <p class="kaiwa-text">
                                ${data.message}
                            </p>
                        </div>
                    </div>`
        return html;
    }

    function scroll_view() {
        $('.chat__area__content').animate({scrollTop: $(".chat__area__content")[0].scrollHeight}, '1000');
    }

    $('#new__message').on('submit', function (e) {
        e.preventDefault();
        let message = document.getElementById('chat__form--input').value;

        $.ajax({
            url: 'chat/store',
            data: {
                message: message,
            },
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
        })
            .done(function (data) {
                let src = $('.user__image').attr('src');
                let html = buildHTML(data, src);
                $('.chat__area__content').append(html);
                $('.chat__form--input').val('');
                scroll_view();
                $('.chat__form--button').prop('disabled', false);
            })

            .fail(function (data) {
                alert('Ajaxリクエスト失敗');
            });
    });
});

