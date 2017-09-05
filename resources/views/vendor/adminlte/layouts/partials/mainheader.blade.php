<!-- Main Header -->
<header class="main-header">


    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>POS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><i class='fa fa-shopping-cart'></i> <b> Point</b><i> of </i><b>Sales</b> </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">               
                <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> <span class="hidden-xs">{{ Auth::user()->name }}</span>

                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('/backend/users/'.Auth::user()->id.'/edit') }}"><span class="fa fa-gears"></span>Account Settings</a></li>
                                    <li class="divider"></li>
                                    <li>
                                    <a href="{{ url('/logout') }}" id="logout"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                 <span class="glyphicon glyphicon-log-out"></span>
                                        {{ trans('adminlte_lang::message.signout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">Auth::user()->id
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>
                                    </li>
                                </ul>
                            </li>
            </ul>
        </div>
    </nav>
</header>
