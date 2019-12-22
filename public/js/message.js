$(function () {

    function buildHTML(data, src) {
        let html = `<div class="kaiwa auth__user" data_id = "${ data.id }">
                        <figure class="kaiwa-img-left">
                            <img src="${src}" alt="no-img2" class="user__image">
                        </figure>
                        <div class="kaiwa-text-right">
                            <p class="kaiwa-text">
                                ${data}
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

        // jQueryのajaxメソッドを使用しajax通信
        $.ajax({
            type: "GET", // GETメソッドで通信
            url: "chat/stores", // 取得先のURL
            // cache: false, // キャッシュしないで読み込み
            data: {message_id},
            dataType: 'json',

            // 通信成功時に呼び出されるコールバック
            success: function (data) {
                // console.log(data.message)
                // alert('Ajax通信成功！！！！！')
                if (message_id == data[message_id + 1]) {
                    let src = $('.user__image').attr('src');
                    // let html = buildHTML(data[message_id - 1].message, src);
                    // console.log(data.data.message)
                    console.log(data);
                    $('.chat__area__content').append(html);
                    scroll_view();
                }
                console.log(data);
                console.log(data[message_id - 1].message);
            },
            // 通信エラー時に呼び出されるコールバック
            error: function () {
                // alert("Ajax通信エラー");
            }
        });

    }

    window.addEventListener('load', function () {
        setInterval(dojQueryAjax, 5000);
    });


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

// function dojQueryAjax() {
//     // jQueryのajaxメソッドを使用しajax通信
//     $.ajax({
//         type: "GET", // GETメソッドで通信
//         url: "ajax.html", // 取得先のURL
//         cache: false, // キャッシュしないで読み込み
//         // 通信成功時に呼び出されるコールバック
//         success: function (data) {
//             $('#ajaxreload').html(data);
//
//         },
//         // 通信エラー時に呼び出されるコールバック
//         error: function () {
//
//             alert("Ajax通信エラー");
//         }
//     });
//
// }
//
// window.addEventListener('load', function () {
//     setTimeout(dojQueryAjax, 5000);
// });
