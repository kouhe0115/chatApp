@extends('common.user')

@section('content')

    <nav class="navbar navbar-fixed-left">
        <div class="container">
            <div class="navbar-header navbar-left-header">
                <p>
                    GROUP
                </p>
                <a href="{{ route('group.create') }}" , class="plus__btn">
                    <i class="fa fa-plus plus__btn--icon"></i>
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav-left-list">
                    @foreach($groups as $group)
                        <li>
                            <a href="{{ route('group.show', $group->id) }}"><i
                                    class="fa fa-briefcase">{{ mb_substr($group->name, 0, 10) }}</i></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    {!! Form::open(['route' => 'group.store']) !!}
        <div class="chat-group-form">
            <div class='chat-group-form__field'>
                <div class='chat-group-form__field--left'>
                    <label for="name" class="chat-group-form__label">Group Name</label>
                </div>
                <div class='chat-group-form__field--right'>
                    {!! Form::input('text', 'name', null, ['class' => 'chat__group_name chat-group-form__input', 'placeholder' => 'グループ名を入力してください']) !!}
                </div>
            </div>

            <div class='chat-group-form__field clearfix'>
                <div class='chat-group-form__field--left'>
                    <label for="name" class="chat-group-form__label">Search User</label>
                </div>
                <div class='chat-group-form__field--right'>
                    <div class='chat-group-form__search clearfix'>
                        <input id="user-search-field" class="chat-group-form__input" placeholder="追加したいユーザー名を入力してください">
                    </div>
                        <div class="group__create__form__content--checkbox user-search-result">
{{--                            @foreach($users as $user)--}}
{{--                                @if($user->id !== Auth::id())--}}
{{--                                    <div class="user__info">--}}
{{--                                        <img src="{{ $user->avatar }}" alt="no-img2" class="user__image">--}}
{{--                                        {!! Form::input('checkbox', 'user_id[]', $user->id, ['class' => 'group__create__form__content--checkbox--input']) !!}--}}
{{--                                        <label class="group__create__form__content--checkbox--inputs"--}}
{{--                                               for="customCheck1">{{ $user->name }}</label>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>

            <div class='chat-group-form__field clearfix'>
                <div class='chat-group-form__field--left'>
                    <label for="chat_group_チャットメンバー" class="chat-group-form__label">チャットメンバー</label>
                </div>
                <div class='chat-group-form__field--right'>
                    <div class='chat-group-users'>
{{--                        <div class='chat-group-user clearfix'>--}}
{{--                            %input{name: "group[user_ids][]",type:'hidden', value:"#{users.user_id}"}--}}
{{--                        </div>--}}
{{--                        <p class='chat-group-user__name'>--}}
{{--                            = users.user.name--}}
{{--                        </p>--}}
                        <div class="group__create__form__content--checkbox">
{{--                            @foreach($users as $user)--}}
{{--                                @if($user->id !== Auth::id())--}}
{{--                                    <div class="user__info">--}}
{{--                                        <img src="{{ $user->avatar }}" alt="no-img2" class="user__image">--}}
{{--                                        {!! Form::input('checkbox', 'user_id[]', $user->id, ['class' => 'group__create__form__content--checkbox--input']) !!}--}}
{{--                                        <label class="group__create__form__content--checkbox--inputs"--}}
{{--                                               for="customCheck1">{{ $user->name }}</label>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class='chat-group-form__field clearfix'>
                <div class='chat-group-form__field--left'></div>
                <div class='chat-group-form__field--right'>
                    {!! Form::submit('作成', ['class' => 'btn btn-success pull-right group__create__form__content--button']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}

@endsection

