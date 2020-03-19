<header class="main-header">
    <!-- Logo -->
    <a href="{{url("cms/")}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>D</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{settings.webname}}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('dist/img/avatar.png')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{account.name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                {{account.email}}
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
{#                                    <a href="{{ path('change_language', {'lang': language_code}) }}">{{language_name}}</a>#}
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url('cms/profile') }}" class="btn btn-default btn-flat">Профил</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{url('/cms/profile/logout')}}" class="btn btn-default btn-flat">Изход</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

