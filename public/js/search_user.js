$(function () {
    let search_list = $(".user-search-result");

    function appendUser(user) {
        let html = `<div class="user__info">
                        <img src="${user.avatar}" alt="no-img2" class="user__image" data-user-img="${user.avatar}">
<!--                        {!! Form::input('checkbox', 'user_id[]', ${user.id}, ['class' => 'group__create__form__content&#45;&#45;checkbox&#45;&#45;input']) !!}-->
                        <input type="checkbox" class="group__create__form__content--checkbox--input" data-user-id="${user.id}">
                        <label class="group__create__form__content--checkbox--inputs"
                               for="customCheck1" data-user-name="${user.name}">${user.name}</label>
                    </div>`
        search_list.append(html);
    };

    function appendNoUser() {
        let html = ``
        search_list.append(html);
    };

    function buildHTML(id, name, img) {
        let html = `<div class="user__info">
                        <img src="${img}" alt="no-img2" class="user__image">
                        <input type="hidden" name="user_id[]" value="${id}", class="group__create__form__content--checkbox--input" data-user-id="${id}">
                        <label class="group__create__form__content--checkbox--inputs"
                               for="customCheck1">${name}</label>
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
                } else {
                    appendNoUser("一致するユーザーはいません")
                }
            })
            .fail(function() {
                alert('ユーザー検索に失敗しました')
            });
    });

    $(".user-search-result").on('click','.group__create__form__content--checkbox--input', function() {
        console.log($(this))
        let id = $(this).data('user-id');
        let name = $('.group__create__form__content--checkbox--inputs').data('user-name');
        let img = $('.user__image').data('user-img');
        // let insertHTML = buildHTML(id, name,img);
        $('.add__users').append(buildHTML(id, name,img));
    });

    // $(".chat-group-users").on('click', '.user-search-remove', function() {
    //     let id = $(this).data('user-id');
    //     $(`#chat-group-user-${id}`).remove();
    // });
});
