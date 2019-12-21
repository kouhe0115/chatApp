@extends('common.user')

@section('content')

<nav class="navbar navbar-fixed-left">
    <div class="container">
        <div class="navbar-header navbar-left-header">
            <p>
                GROUP
            </p>
            <div class="plus__btn">
                <a href="{{ route('group.create') }}">
                    <i class="fa fa-plus plus__btn--icon"></i>
                </a>
            </div>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav-left-list">
                @foreach($groups as $group)
                    <li>
                        <a href="{{ route('group.show', $group->id) }}"><i class="fa fa-briefcase">{{ mb_substr($group->name, 0, 10) }}</i></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

@endsection
