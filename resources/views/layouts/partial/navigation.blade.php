<!-- resources/views/layouts/partial/navigation.blade.php -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="{{ route('home') }}" class="navbar-brand">
                Home
            </a>
        </div>

        <div class="collapse navbar-collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(! auth()->check())
                    <li>
                        <a href="{{ route('session.create') }}">{!! icon('login') !!} {{ trans('auth.title_login') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('user.create') }}">{!! icon('certificate') !!} {{ trans('auth.title_signup') }}</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('documents.show') }}"><i class="fa fa-book icon"></i> Document Viewer</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-weixin icon"></i> Forum</a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user icon"></i> {{ auth()->user()->name }} <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('session.destroy') }}"><i class="fa fa-sign-out icon"></i> Log out</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
