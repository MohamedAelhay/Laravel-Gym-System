<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="#"><i class="fa fa-link"></i> <span>Gym Managers</span></a></li>
            <li><a href="{{route('CityManagers.index')}}"><i class="fa fa-link"></i> <span>City Managers</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Users</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Cities</span></a></li>
            <li><a href="{{route('gyms.index')}}"><i class="fa fa-link"></i> <span>Gyms</span></a></li>
            <li><a href="/package"><i class="fa fa-link"></i> <span>Training Packages</span></a></li>
            <li><a href="/session"><i class="fa fa-link"></i> <span>Training Sessions</span></a></li>            
            <li><a href="#"><i class="fa fa-link"></i> <span>Coaches</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Attendance</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Buy Packages</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Revenue</span></a></li>
            

{{-- 
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>link</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li> --}}



        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
