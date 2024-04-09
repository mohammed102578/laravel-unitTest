<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
    <a href="{{ url('/dashboard') }}">
        <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
        </div>
        <div class="clearfix"></div>
    </a>
</li>
       

                      <!-- Company-->
                      <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Companies-menu">
                            <div class="pull-left"><i class="fas fa-school"></i><span
                                    class="right-nav-text">{{trans('main_trans.Companies')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Companies-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('companies.index')}}">{{trans('main_trans.Companies_list')}}</a></li>

                        </ul>
                    </li>


                      <!-- Employee-->
                      <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Employees-menu">
                            <div class="pull-left"><i class="fas fa-user"></i><span
                                    class="right-nav-text">{{trans('main_trans.Employees')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Employees-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('employees.index')}}">{{trans('main_trans.Employees_list')}}</a></li>

                        </ul>
                    </li>
                    <!-- classes-->
                   
                   
                 

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
