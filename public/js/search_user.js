$(function () {
    let search_list = $(".user-search-result");

    function appendUser(user) {
        let html = `<div class="user__info" id="${user.id}">
                        <img src="${user.avatar}" alt="no-img2" class="user__image" data-user-img="${user.avatar}">
                        <input type="checkbox" class="group__create__form__content--checkbox--input" name="user_id[]" value="${user.id}" data-user-id="${user.id}">
                        <label class="group__create__form__content--checkbox--inputs"
                               for="customCheck1" data-user-name="${user.name}">${user.name}</label>
                    </div>`
        search_list.append(html);
    };

    function appendNoUser(text) {
        search_list.append(text);
    };

    function searchUser() {
        let word = $("#user-search-field").val();
        $.ajax({
            type: 'GET',
            url: '/users',
            data: {word: word},
            dataType: 'json',

            success: function (users) {
                $(".user-search-result").empty();
                if (users.length !== 0 && word.length !== 0) {
                    users.forEach(function (user) {
                        appendUser(user);
                    })
                } else {
                    appendNoUser("一致するユーザーはいません")
                }
            },
            error: function () {
                alert('ユーザー検索に失敗しました')
            }
        });
    }



    $(".user-search-result").on('click','.group__create__form__content--checkbox--input', function() {
        let id = $(this).data('user-id');
        let userClone = $(`#${id}`).clone(true);
        $('.add__users').append(userClone);
        $(`#${id}`).remove();

    });

    $(".chat-group-users").on('click', '.group__create__form__content--checkbox--input', function() {
        let id = $(this).data('user-id');
        $(`#${id}`).remove();
    });

    $("#user-search-field").on("keyup", function() {
        searchUser()
    });
});
