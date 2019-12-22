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

    <div class="chat__area">
        <div class="chat__area__header">
            <p class="chat__area__header--group__name">Group Name : {{ $group->name }}</p>

            <p class="chat__area__header--group__member">Group Member :
                @foreach($groupUsers as $user)
                    {{ $user->name }}
                @endforeach

            </p>

        </div>

        <div class="chat__area__content">
            @if(!is_null($groupUserChat))
                @foreach($groupUserChat as $guc)
                    @if($guc->user_id === Auth::id())
                        <div class="kaiwa auth__user" data_id = "{{ $guc->id }}">
                            <figure class="kaiwa-img-left">
                                <img src="{{ $guc->user->avatar }}" alt="no-img2" class="user__image">
                            </figure>
                            <div class="kaiwa-text-right">
                                <p class="kaiwa-text">
                                    {!! nl2br(e($guc->message)) !!}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="kaiwa" data_id = "{{ $guc->id }}">
                            <figure class="kaiwa-img-right">
                                <img src="{{ $guc->user->avatar }}" alt="no-img2">
                                <figcaption class="kaiwa-img-description">
                                </figcaption>
                            </figure>
                            <div class="kaiwa-text-left">
                                <p class="kaiwa-text">
                                    {!! nl2br(e($guc->message)) !!}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="chat__area__input__area">
{{--            {!! Form::open(['route' => ['chat.store', $group->id]]) !!}--}}
            {!! Form::open(['route' => ['api.store', $group->id],'id' => 'new__message']) !!}
            <div class="chat__form @if(!empty($errors->first('title'))) has-error @endif">
                {!! Form::input('text', 'message', null, ['class' => 'chat__form--input', 'placeholder' => 'メッセージ入力', 'id' => 'chat__form--input']) !!}
                {!! Form::submit('Add', ['class' => 'btn btn-success pull-right chat__form--button']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
