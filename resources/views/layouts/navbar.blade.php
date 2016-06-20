<nav class="navbar navbar-default top-nav" id="top-nav">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="{{ Auth::user()->role_id == 1 ? route('account.index') : route('backend.corporate.settings.profile')  }}">{{Auth::user()->name}}</a></li>
                    @if(Auth::user()->role_id == 2)
                        <li><a href="{{ route('backend.corporate.index') }}"><i class="fa fa-gear"></i> {{trans('main.backend')}}</a></li>
                    @elseif(Auth::user()->role_id == 3)
                        <li><a href="{{ route('backend.admin.index') }}"><i class="fa fa-gear"></i> {{trans('main.backend')}}</a></li>
                    @endif
                    <li><a href="{{ action('Auth\AuthController@logout') }}"><i class="fa fa-power-off"></i> {{trans('main.logout')}}</a></li>
                @else
                    <li><a href="{{ action('Auth\AuthController@login') }}">{{trans('main.login')}}</a></li>
                    <li><a href="{{ action('Auth\AuthController@register') }}">{{trans('main.register')}}</a></li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-left">
                <li><a href="{{ route('learn.index') }}">{{trans('main.learn')}}</a></li>
                <li><a href="{{ route('tools.index') }}">{{trans('main.tools')}}</a></li>
                <li><a href="{{ route('partners.index') }}">{{trans('main.partners')}}</a></li>
                <li><a href="{{ route('news.index') }}">{{trans('main.news')}}</a></li>
                <li><a href="{{ route('help.index') }}">{{trans('main.help')}}</a></li>
                @if(config('app.locale') == 'ar')
                <li><a href="{{ switchLangUrl() }}" id="en" class="langChange">{{trans('main.english')}}</a></li>
                @else
                <li><a href="{{ switchLangUrl() }}" id="ar" class="langChange">{{trans('main.arabic')}}</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<nav class="navbar navbar-default" id="second-nav">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="/assets/img/logo.png" class="img-responsive">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav navbar-right flip">
                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">{{trans('main.home')}}</a></li>
                <li class="{{ is_active('banking') }}"><a href="{{ route('industries.show', 'banking') }}">{{trans('main.banking')}}</a></li>
                <li class="{{ is_active('broadband') }}"><a href="{{ route('industries.show', 'broadband') }}">{{trans('main.mobile_broadband')}}</a></li>
                <li class="{{ is_active('travel') }}"><a href="{{ route('industries.show', 'travel') }}">{{trans('main.travel')}}</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>