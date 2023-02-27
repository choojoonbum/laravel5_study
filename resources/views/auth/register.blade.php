<!-- resources/views/auth/register.blade.php -->
@extends('layouts.master')

@section('content')
    <form action="{{ route('user.store') }}" method="POST" role="form" class="form-auth">

        {!! csrf_field() !!}

        <div class="page-header">
            <h4>{{ trans('auth.title_signup') }}</h4>
            <p class="text-muted">
                {!!  trans('auth.title_signup_help', ['url' => route('session.create')]) !!}
            </p>
        </div>

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <input type="text" name="name" class="form-control" placeholder="{{ trans('auth.name') }}" value="{{ old('name') }}" autofocus/>
            {!! $errors->first('name', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <input type="email" name="email" class="form-control" placeholder="{{ trans('auth.email_address') }}" value="{{ old('email') }}"/>
            {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <input type="password" name="password" class="form-control" placeholder="{{ trans('auth.password') }}"/>
            {!! $errors->first('password', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('auth.password_confirmation') }}" />
            {!! $errors->first('password_confirmation', '<span class="form-error">:message</span>') !!}
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-lg btn-block" type="submit">
                {{ trans('auth.button_signup') }}
            </button>
        </div>

    </form>
@stop
