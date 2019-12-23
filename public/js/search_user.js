$(function () {
    let search_list = $(".user-search-result");

    function appendUser(user) {
        let html = `<div class="user__info">
                        <img src="${user.avatar}" alt="no-img2" class="user__image">
<!--                        {!! Form::input('checkbox', 'user_id[]', ${user.id}, ['class' => 'group__create__form__content&#45;&#45;checkbox&#45;&#45;input']) !!}-->
                        <input type="checkbox" name="user_id[]" value="${user.id}", class="group__create__form__content--checkbox--input">
                        <label class="group__create__form__content--checkbox--inputs"
                               for="customCheck1">${user.name}</label>
                    </div>`
        search_list.append(html);
    };

    function appendNoUser() {
        let html = ``
        search_list.append(html);
    };

    function buildHTML(id, name) {
        let html = `<div class="user__info">
                        <img src="{{ $user->avatar }}" alt="no-img2" class="user__image">

                        <label class="group__create__form__content--checkbox--inputs"
                               for="customCheck1">{{ $user->name }}</label>
                    </div>`
        return html
    }

    $("#user-search-field").on("keyup", function() {
        let word = $("#user-search-field").val();
        console.log(word)
        $.ajax({
            type: 'GET',
            url: '/users',
            data: {word : word},
            dataType: 'json'
        })
            .done(function(users) {
                console.log(users)
                $(".user-search-result").empty();
                if (users.length !== 0 && word.length !== 0) {
                    users.forEach(function (user) {
                        appendUser(user);
                    });
                }
            //     } else {
            //         appendNoUser("一致するユーザーはいません")
            //     }
            })
            // .fail(function() {
            //     alert('ユーザー検索に失敗しました')
            // });
    });

    $(".user-search-result").on('click','.group__create__form__content--checkbox--input', function() {
        let id = $(this).data('user-id');
        let name = $(this).data('user-name');
        let insertHTML = buildHTML(id, name);
        $('.chat-group-users').append(insertHTML);
        $('#user-search-field').val('');
        $(this).parent('.chat-group-user').remove();
    });

    $(".chat-group-users").on('click', '.user-search-remove', function() {
        let id = $(this).data('user-id');
        $(`#chat-group-user-${id}`).remove();
    });
});
