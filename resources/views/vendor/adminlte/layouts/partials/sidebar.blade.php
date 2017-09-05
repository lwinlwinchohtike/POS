<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
        <div class="user-panel">
            <div class="pull-left image">
               <a href="#"><i class="fa fa-circle text-success"></i></a>
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>  
            </div>
        </div>
        @endif

        <!-- search form (Optional) -->
       <!--  <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">POS SYSTEM</li>
            <!-- Optionally, you can add icons to the links -->
            <li {{{ (Request::is('backend/home') ? 'class=active' : '') }}}><a href="{{ url('backend/home') }}"><i class='fa fa-dashboard'></i> <span>{{ trans('adminlte_lang::message.dashboard') }}</span></a></li>

           
            @if(Auth::user()->hasPermission("view-category") OR Auth::user()->hasPermission("view-product") OR Auth::user()->hasPermission("view-product-tracking"))
            <li class="treeview">
                <a href="#"><i class='fa fa-shopping-cart'></i> <span>{{ trans('adminlte_lang::message.product_categories') }}</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    
                    @if(Auth::user()->hasPermission("view-category"))
                    <li {{{ (Request::is('backend/categories') ? 'class=active' : '') }}}><a href="{{ url('backend/categories') }}"><i class='fa fa-list-alt'></i> <span>{{ trans('adminlte_lang::message.category') }}</span></a></li>
                    @endif

                    @if(Auth::user()->hasPermission("view-product"))
                    <li {{{ (Request::is('backend/products') ? 'class=active' : '') }}}><a href="{{ url('backend/products') }}"><i class='glyphicon glyphicon-barcode'></i> <span>{{ trans('adminlte_lang::message.product') }}</span></a></li>
                    @endif

                    @if(Auth::user()->hasPermission("view-product-tracking"))
                    <li {{{ (Request::is('backend/inventories') ? 'class=active' : '') }}}><a href="{{ url('backend/inventories') }}"><i class='glyphicon glyphicon-check'></i> <span>{{ trans('adminlte_lang::message.product_track') }}</span></a></li> 
                    @endif
                    
                </ul>               
            </li>
            @endif
           
            @if(Auth::user()->hasPermission("view-customer"))
            <li {{{ (Request::is('backend/customers') ? 'class=active' : '') }}}><a href="{{ url('backend/customers') }}"><i class='fa fa-user'></i> <span>{{ trans('adminlte_lang::message.customer') }}</span></a></li>
            @endif
           
            @if(Auth::user()->hasPermission("view-supplier"))
            <li {{{ (Request::is('backend/suppliers') ? 'class=active' : '') }}}><a href="{{ url('backend/suppliers') }}"><i class='fa fa-user'></i> <span>{{ trans('adminlte_lang::message.supplier') }}</span></a></li>
            @endif
            
            @if(Auth::user()->hasPermission("view-purchase"))
            <li {{{ (Request::is('backend/purchase') ? 'class=active' : '') }}}><a href="{{ url('backend/purchase') }}"><i class='fa fa-inbox'></i> <span>{{ trans('adminlte_lang::message.purchase') }}</span></a></li>          
            @endif

            @if(Auth::user()->hasPermission("view-sales"))
            <li {{{ (Request::is('backend/sales') ? 'class=active' : '') }}}><a href="{{ url('backend/sales') }}"><i class='fa fa-inbox'></i> <span>{{ trans('adminlte_lang::message.sales') }}</span></a></li>
            @endif
            
            @if(Auth::user()->hasPermission("view-sales-report") OR Auth::user()->hasPermission("view-purchase-report"))
            <li class="treeview">
                <a href="#"><i class='fa fa-list-alt'></i> <span>{{ trans('adminlte_lang::message.reports') }}</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @if(Auth::user()->hasPermission("view-sales-report"))
                    <li {{{ (Request::is('backend/salesreportbydate') ? 'class=active' : '') }}}><a href="{{ url('backend/salesreportbydate') }}"><i class='fa fa-list-alt'></i> <span>{{ trans('adminlte_lang::message.salesreport') }}</span></a></li>
                    @endif
                    
                    @if(Auth::user()->hasPermission("view-purchase-report"))
                    <li {{{ (Request::is('backend/purchasereport') ? 'class=active' : '') }}}><a href="{{ url('backend/purchasereportbydate') }}"><i class='fa fa-list-alt'></i> <span>{{ trans('adminlte_lang::message.purchasereport') }}</span></a></li>
                    @endif
                </ul>               
            </li>
            @endif

           
            @if(Auth::user()->hasPermission("view-role") OR Auth::user()->hasPermission("view-user") OR Auth::user()->hasPermission("view-payment-method"))
            <li class="treeview">
                <a href="#"><i class='fa fa-cog'></i> <span>{{ trans('adminlte_lang::message.setting') }}</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">  
                    @if(Auth::user()->hasPermission("view-role"))              
                    <li {{{ (Request::is('backend/roles') ? 'class=active' : '') }}}><a href="{{ url('backend/roles') }}"><i class='fa fa-user'></i> <span>{{ trans('adminlte_lang::message.role') }}</span></a></li>               
                    @endif

                    @if(Auth::user()->hasPermission("view-user"))
                    <li {{{ (Request::is('backend/users') ? 'class=active' : '') }}}><a href="{{ url('backend/users') }}"><i class='fa fa-users'></i> <span>{{ trans('adminlte_lang::message.user') }}</span></a></li>               
                    @endif

                    @if(Auth::user()->hasPermission("view-payment-method"))
                    <li {{{ (Request::is('backend/payments') ? 'class=active' : '') }}}><a href="{{ url('backend/payments') }}"><i class='fa fa-money'></i> <span>{{ trans('adminlte_lang::message.payment') }}</span></a></li>
                    @endif               
                </ul>
            </li>
             @endif
           


<!-- 
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li> -->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>