<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
      	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SwineCart @yield('title')</title>

        <link href="/css/materialize.min.css" rel="stylesheet" type="text/css">
        <link href="/css/icon.css" rel="stylesheet" type="text/css">
        <link href="/css/style.css" rel="stylesheet" type="text/css">
        <link href="/css/admin_spectator.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/js/vendor/chart.min.js"></script>
        @yield('resources')
    </head>
    <body id="admin-body">
        <ul id="admin-dropdown-menu" class="dropdown-content">
          <li><a href="#adduser">Add User</a></li>
          <li><a href="{{route('admin.breeder.messages')}}">Messages</a></li>
          <li><a href="{{ route('admin_logs') }}">Admin Logs</a></li>
          <li><a href="{{ route('maintenance_mode') }}">Maintenance Mode</a></li>
          <li><a href="{{ url('logout') }}">Log Out</a></li>
        </ul>

        <nav class="admin-layout-nav teal darken-3">
            <div class="nav-wrapper row valign-wrapper">
                <a href="#" data-activates="slide-out" class="button-collapse hide-on-large"><i class="material-icons">menu</i></a>
                <div class="col s12 m12 l8 xl6 valign">
                    <span class="admin-layout-nav-title">@yield('nav-title')</span>
                </div>
                <div class="col s12 m12 l6 xl6 hide-on-large-only">
                    <ul id="nav-mobile" class="right admin-layout-nav-menu">
                        <li><a id="admin-drowpdown-button" class="admin-layout-nav-menu-items dropdown-button" data-beloworigin="true" href="#" data-activates="admin-dropdown-menu"><i class="material-icons right">arrow_drop_down</i></a></li>
                    </ul>
                </div>
                <div class="col s12 m12 l6 xl6 hide-on-med-and-down">
                    <ul id="nav-mobile" class="right admin-layout-nav-menu">
                        <li><a class="admin-layout-nav-menu-items tooltipped" href="#adduser" data-position="bottom" data-delay="40" data-tooltip="Add User"><i class="material-icons">perm_identity</i></a></li>
                        <li><a class="admin-layout-nav-menu-items tooltipped" href="{{route('admin.breeder.messages')}}" data-position="bottom" data-delay="40" data-tooltip="Messages"><i class="material-icons">message</i></a></li>
                        <li><a class="admin-layout-nav-menu-items tooltipped" href="{{ route('admin_logs') }}" data-position="bottom" data-delay="40" data-tooltip="Administrator Logs"><i class="material-icons">book</i></a></li>
                        @if (\App::isDownForMaintenance())
                            <li><a class="admin-layout-nav-menu-items tooltipped" href="{{ route('maintenance_mode') }}" data-position="bottom" data-delay="40" data-tooltip="Maintenance Mode"><i class="material-icons red-text">settings</i></a></li>
                        @else
                            <li><a class="admin-layout-nav-menu-items tooltipped" href="{{ route('maintenance_mode') }}" data-position="bottom" data-delay="40" data-tooltip="Maintenance Mode"><i class="material-icons">settings</i></a></li>
                        @endif

                        <li><a class="admin-layout-nav-menu-items tooltipped" href="{{ url('logout') }}" data-position="bottom" data-delay="40" data-tooltip="Log Out"><i class="material-icons">power_settings_new</i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <ul id="slide-out" class="admin-side-nav side-nav fixed teal darken">
            <li>
                <div class="swinecart-logo">
                    <a href="{{route('admin_path')}}"><img id="admin-brand-logo" src="/images/logowhite.png" height=65/><span  class="brand-logo white-text">SwineCart</span></a>
                </div>
            </li>
            <li>
                <div class="side-nav-user-info">
                    <a id="this_user_information_trigger" href="#this_user_information" class="white-text"><img class="circle side-nav-user-image" src="/images/logoblack.png" height=40/>{{ Auth::user()->name }}</a>
                </div>
            </li>
            <li><a class="subheader white-text">Menu</a></li>
            <li><a class="waves-effect white-text" href="{{route('admin.userlist')}}"><i class="material-icons white-text">account_circle</i>All Users</a></li>
            <li><a class="waves-effect white-text" href="{{route('admin.spectatorlist')}}"><i class="material-icons white-text">visibility</i>Spectator List</a></li>
            <li><a class="waves-effect white-text" href="{{route('admin.pending.users')}}"><i class="material-icons white-text">verified_user</i>Pending Accounts</a></li>
            <li><a class="waves-effect white-text" href="{{route('admin.broadcast')}}"><i class="material-icons white-text">announcement</i>Send Announcement</a></li>
            <li class="hide-on-med-and-up"><a class="waves-effect white-text" href="{{ route('admin_logs') }}"><i class="material-icons white-text">book</i>Administrator Logs</a></li>
            <li><a class="waves-effect white-text" href="{{ route('maps') }}"><i class="material-icons white-text">map</i>Maps</a></li>
            <li><a class="waves-effect white-text" href="{{route('admin.statistics.dashboard')}}"><i class="material-icons white-text">trending_up</i>Site Statistics</a></li>
            <li><a class="waves-effect white-text" href="{{route('admin.manage.homepage')}}"><i class="material-icons white-text">build</i>Manage Pages</a></li>
            <li class="hide-on-med-and-up"><a class="waves-effect white-text" href="{{ url('logout') }}"><i class="material-icons white-text">power_settings_new</i>Log Out</a></li>
        </ul>
        <main class="admin-layout-main">
            <div class="container">
                @yield('pageControl')
                <div class="row">
                    <div class="col s12 m12 l12 xl12">
                        @yield('content')
                    </div>
                </div>
            </div>

            <div class="fixed-action-btn horizontal">
                <a id="back-to-top" class="btn-floating btn-large red lighten-1" data-position="top" data-delay="50" data-tooltip="Back to Top">
                    <i class="material-icons">keyboard_arrow_up</i>
                </a>
            </div>
        </main>
        <footer class="admin-layout-footer page-footer teal darken-2">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">SwineCart</h5>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2017 SwineCart
                    <span class="grey-text text-lighten-4 right">{{$counter}} Online Users</span>
                </div>
            </div>
        </footer>

        {{-- Administrator Modals --}}

        {{-- Add User Modal --}}
        <div id="adduser" class="modal">
            {!!Form::open(['route'=>'admin.add.user', 'method'=>'POST', 'class'=>'add-user-form'])!!}
            <div class="modal-content">
                <h4>Add User</h4>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m12 l12 xl12">

                        <div class="row">
                            <div class = "addusercontainer" class="row">
                                <div class="input-field col s11">
                                    <i class="material-icons prefix">account_circle</i>
                                    <input required id="username" type="text" class="validate" name="name">
                                    <label for="username">Username</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class = "addusercontainer" class="row">
                                <div class="input-field col s11">
                                    <i class="material-icons prefix">email</i>
                                    <input required id="email" type="email" class="validate" name="email">
                                    <label for="email">Email Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s11 m11 l11 xl11">
                                <i class="material-icons prefix">add_location</i>
                                <input disabled required id="farm_name" type="text" class="validate" name="farm_name">
                                <label for="farm_name">Farm Name</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s11 m11 l11 xl11">
                                <i class="material-icons prefix">info</i>
                                <input disabled required id="accredit_num" type="text" class="validate" name="accredit_num">
                                <label for="accredit_num">Accreditation Number</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12 m12 l3 xl3">
                                <input name="type" value=0 type="radio" id="breeder_radio" />
                                <label for="breeder_radio">Breeder</label>
                            </div>
                            <div class="col s12 m12 l3 xl3">
                                <input name="type" value=1 type="radio" id="spectator_radio" />
                                <label for="spectator_radio">Spectator</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id = "add-user-submit" class="btn-flat waves-effect waves-light" type="submit" name="action">Add
                    <i class="material-icons right">add</i>
                </button>
                <a href="#!" class="modal-action modal-close waves-effect waves-teal btn-flat">Close</a>
            </div>
            {!!Form::close()!!}
        </div>

        {{-- New Add User Modal --}}
        <div id="newadduser" class="modal">
            <div class="modal-content">
                <h4>Add User</h4>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m12 l12 xl12">
                        <div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                            <input required id="icon_prefix" type="text" class="validate" name="name">
                            <label for="icon_prefix">Username</label>
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                            <input required id="icon_prefix" type="text" class="validate" name="name">
                            <label for="icon_prefix">Username</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id = "add-user-submit" class="btn-flat waves-effect waves-light" type="submit" name="action">Add
                    <i class="material-icons right">add</i>
                </button>
                <a href="#!" class="modal-action modal-close waves-effect waves-teal btn-flat">Close</a>
            </div>

        </div>

        {{-- User Information Modal --}}
        <div id="this_user_information" class="modal">
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m12 l12 xl12">
                        <h5>User Information</h5>
                    </div>
                </div>
                <div class="divider"></div>
                <div id="this_user_information_content" class="row">
                    <div class="center">
                        <div class="preloader-wrapper small active">
                            <div class="spinner-layer spinner-green-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div><div class="gap-patch">
                                    <div class="circle"></div>
                                </div><div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-teal btn-flat">Close</a>
            </div>
        </div>

        <script src="/js/vendor/jquery.min.js"></script>
        <script src="/js/vendor/VueJS/vue.js"></script>
        <script src="/js/vendor/materialize.min.js"></script>
        <script src="/js/config.js"></script>
        <script type="text/javascript" src="/js/admin/admin_custom.js"></script>
        <script type="text/javascript" src="/js/admin/adminInformation.js"></script>
        <script src="/js/custom.js"></script>
        @yield('initScript')
            {{-- Custom scripts for certain pages/functionalities --}}
        @yield('customScript')
        @if(Session::has('alert-create'))
            <script type="text/javascript">
                 Materialize.toast('User Successfully Created', 4000)
            </script>
        @elseif(Session::has('alert-maintenance-off'))
            <script type="text/javascript">
                 Materialize.toast('Maintenance Mode Turned Off', 4000)
            </script>
        @elseif(Session::has('alert-maintenance-on'))
            <script type="text/javascript">
                 Materialize.toast('Maintenance Mode Turned On' , 4000)
            </script>
        @endif
    </body>
</html>
