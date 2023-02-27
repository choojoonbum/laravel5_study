<!-- resources/views/auth/login.blade.php -->
@extends('layouts.master')

@section('content')
    <form action="{{ route('session.store') }}" method="POST" role="form" class="form-auth">

        {!! csrf_field() !!}

        <div class="page-header">
            <h4>{{ trans('auth.title_login') }}</h4>
        </div>

        <div class="form-group">
            <a class="btn btn-default btn-block" href="{{ route('session.github.login') }}">
                <strong><i class="fa fa-github icon"></i> Login with Github</strong>
            </a>
        </div>

        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="{{ trans('auth.email_address') }}" value="{{ old('email') }}" autofocus/>
            {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="{{ trans('auth.password') }}">
            {!! $errors->first('password', '<span class="form-error">:message</span>')!!}
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" value="{{ old('remember', 1) }}" checked> {{ trans('auth.remember_me') }}
                </label>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">{{ trans('auth.button_login') }}</button>
        </div>

        <div class="description">
            <p>&nbsp;</p>
            <p class="text-center">{{ trans('auth.recommend_signup') }} <a href="{{ route('user.create') }}">{{ trans('auth.btutton_signup') }}</a></p>
            <p class="text-center"><a href="{{ route('reminder.create')}}">{{ trans('auth.button_remind_password') }}</a></p>
        </div>

    </form>
@stop