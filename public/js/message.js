$(function () {

    let userId = '';
    let updateTime = 5000;

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
        let html = `<div class="kaiwa" data_id = "${ data.id }">
                        <figure class="kaiwa-img-right">
                            <img src="${data.user.avatar}" alt="no-img2">
                            <figcaption class="kaiwa-img-description">
                            </figcaption>
                        </figure>
                        <div class="kaiwa-text-left">
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

    function getUserId() {
        $.ajax({
            type: "GET",
            url: "/user/id",
            dataType: 'json',

            success: function (data) {
                console.log(data)
                userId = data
            },
            error: function () {
                alert("Ajax通信エラー");
            }
        });
    }

    function autoLord() {
        let message_id = $('.kaiwa').last().attr('data_id') ? $('.kaiwa').last().attr('data_id') : 0;
        if (message_id !== 0) {
            $.ajax({
                type: "GET",
                url: "chat/show",
                data: {message_id},
                dataType: 'json',

                success: function (data) {
                    if(data.length !== 0){
                        $.each(data, function(i, data){
                            $('.chat__area__content').append(lordbuildHTML(data));
                        });
                    }
                },
                error: function () {
                    alert("Ajax通信エラー?");
                }
            });
        }
    }

    function addMessage(message) {
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

            success: function (data) {
                console.log(data)
                let src = $('.user__image').attr('src');
                let html = postbuildHTML(data, src);
                $('.chat__area__content').append(html);
                $('.chat__form--input').val('');
                scroll_view();
                $('.chat__form--button').prop('disabled', false);
            },
            error: function () {
                alert('Ajaxリクエスト失敗');
            }
        });
    }

    $('#new__message').on('submit', function (e) {
        e.preventDefault();
        let message = document.getElementById('chat__form--input').value;
        addMessage(message)
    });

    setInterval(autoLord, updateTime);

    $(window).on('load', function() {
        scroll_view()
        getUserId()
    });
});

