@extends('common.user')

@section('content')

{{--    <nav class="navbar navbar-fixed-left">--}}
{{--        <div class="container">--}}
{{--            <div class="navbar-header navbar-left-header">--}}
{{--                <p>--}}
{{--                    GROUP--}}
{{--                </p>--}}
{{--                <div class="plus__btn">--}}
{{--                    <a href="{{ route('group.create') }}">--}}
{{--                        <i class="fa fa-plus plus__btn--icon"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="navbar-collapse collapse">--}}
{{--                <ul class="nav-left-list">--}}
{{--                    @foreach($groups as $group)--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('chat.index'), $group->id }}"><i--}}
{{--                                    class="fa fa-briefcase">{{ $group->name }}</i></a>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}

    <div class="chat__area">
        <div class="chat__area__header">
            <p class="chat__area__header--group__name">Group Name : </p>
            <p class="chat__area__header--group__member">Group Member : </p>
        </div>

        <div class="chat__area__content">
{{--            @foreach($groups as $group)--}}
{{--                @if($group->user_id === Auth::id())--}}
{{--                    <div class="kaiwa auth__user">--}}
{{--                        <figure class="kaiwa-img-left">--}}
{{--                            <img src="{{ $group->user->avatar }}" alt="no-img2">--}}
{{--                        </figure>--}}
{{--                        <div class="kaiwa-text-right">--}}
{{--                            <p class="kaiwa-text">--}}
{{--                                {{ $group->user->chats->message }}--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="kaiwa">--}}
{{--                        <figure class="kaiwa-img-right">--}}
{{--                            <img src="https://fotopus.com/photos/hd.php?cd=3323439" alt="no-img2">--}}
{{--                            <figcaption class="kaiwa-img-description">--}}
{{--                            </figcaption>--}}
{{--                        </figure>--}}
{{--                        <div class="kaiwa-text-left">--}}
{{--                            <p class="kaiwa-text">--}}
{{--                                {{ $group->message }}--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endforeach--}}
        </div>

        <div class="chat__area__input__area">
            {!! Form::open(['route' => 'chat.store']) !!}
            <div class="chat__form @if(!empty($errors->first('title'))) has-error @endif">
                {!! Form::input('text', 'message', null, ['class' => 'chat__form--input', 'placeholder' => 'メッセージ入力']) !!}
                {{--                <span class="help-block">{{$errors->first('title')}}</span>--}}
                {!! Form::submit('Add', ['class' => 'btn btn-success pull-right chat__form--button']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
