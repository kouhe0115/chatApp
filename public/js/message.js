$(function () {

    function postbuildHTML(data, src) {
        let html = `<div class="kaiwa auth__user" data_id = "${ data.id }">
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

    function lordbuildHTML(data) {
        let html = `<div class="kaiwa auth__user" data_id = "${ data.id }">
                        <figure class="kaiwa-img-left">
                            <img src="${data.user.avatar}" alt="no-img2" class="user__image">
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

    function dojQueryAjax() {
        let message_id = $('.kaiwa').last().attr('data_id');

        $.ajax({
            type: "GET",
            url: "chat/stores",
            data: {message_id},
            dataType: 'json',

            success: function (data) {
                if (data.id == null && data.id != message_id) {
                    // console.log(data)
                    $.each(data, function(i, data){
                        $('.chat__area__content').append(lordbuildHTML(data));
                    });
                    scroll_view();
                }
            },
            error: function () {
                alert("Ajax通信エラー");
            }
        });

    }

    let updateTime = 5000;
    setInterval(dojQueryAjax, updateTime);

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
                let html = postbuildHTML(data, src);
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

