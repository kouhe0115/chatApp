@extends('common.user')

@section('content')

    <div class="group__create__form">
        {!! Form::open(['route' => 'group.store']) !!}
        <div class="group__create__form__content @if(!empty($errors->first('title'))) has-error @endif">
            {!! Form::input('text', 'name', null, ['class' => 'chat__form--input', 'placeholder' => 'グループ名']) !!}
            <div class="group__create__form__content--checkbox">
                @foreach($users as $user)
                    @if($user->id !== Auth::id())
                        {!! Form::input('checkbox', 'user_id[]', $user->id, ['class' => 'group__create__form__content--checkbox--input']) !!}
                        <label class="group__create__form__content--checkbox--inputs"
                               for="customCheck1">{{ $user->name }}</label>
                    @endif
                @endforeach
            </div>
            {!! Form::submit('作成', ['class' => 'btn btn-success pull-right group__create__form__content--button']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@endsection
