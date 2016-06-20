<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Q</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Qarenhom</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if($newNotifications)
                            <span class="label label-warning">{{ $newNotifications }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{ $newNotifications ?: 'no new' }} notifications</li>
                        <li>
                            <ul class="menu">
                                @foreach($navNotifications as $notification)
                                    <li>
                                        <a href="{{ $notification->url }}">
                                            <i class="{{ $notification->icon }} text-aqua"></i> {{ $notification->body }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="{{ route('backend.corporate.notifications.index') }}">View all</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/logout"><i class="fa fa-power-off"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>