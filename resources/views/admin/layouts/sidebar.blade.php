<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image text-center">
                <img src="/assets/img/logo.png" alt="User Image">
            </div>
            <div class="info text-center">
                <p>
                    {{Auth::user()->name}}
                    <br>
                    <small>{{Auth::user()->email}}</small>
                </p>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{ route('backend.admin.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="{{ is_active('corporates') }} treeview">
                <a href="#">
                    <i class="fa fa-building"></i> <span>Corporates</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.corporates.index') }}"><i class="fa fa-list"></i> All Corporates</a></li>
                    <li><a href="{{ route('backend.admin.corporates.create') }}"><i class="fa fa-plus"></i> Add Corporate</a></li>
                </ul>
            </li>
            <li class="{{ is_active('users') }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.users.index') }}"><i class="fa fa-list"></i> All Users</a></li>
                    <li><a href="{{ route('backend.admin.users.create') }}"><i class="fa fa-plus"></i> Add User</a></li>
                </ul>
            </li>
            <li class="{{ is_active('advertisements') }} treeview">
                <a href="#">
                    <i class="fa fa-bullhorn"></i> <span>Advertisements</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.advertisements.index') }}"><i class="fa fa-list"></i> All Advertisements</a></li>
                    <li><a href="{{ route('backend.admin.advertisements.create') }}"><i class="fa fa-plus"></i> Add Advertisement</a></li>
                </ul>
            </li>

            <li class="{{ is_active('invoices') }} treeview">
                <a href="#">
                    <i class="fa fa-credit-card"></i> <span>Invoices</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.invoices.index') }}"><i class="fa fa-credit-card"></i> Invoices</a></li>
                    <li><a href="{{ route('backend.admin.transactions.index') }}"><i class="fa fa-credit-card"></i> Transactions</a></li>
                </ul>
            </li>

            <li class="{{ is_active('news') }} treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>News</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.posts.index') }}"><i class="fa fa-list"></i> All Posts</a></li>
                    <li><a href="{{ route('backend.admin.posts.create') }}"><i class="fa fa-plus"></i> Add Post</a></li>
                </ul>
            </li>
            <li class="{{ is_active('faqs') }} treeview">
                <a href="#">
                    <i class="fa fa-question"></i> <span>FAQs</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.faqs.index') }}"><i class="fa fa-list"></i> All FAQs</a></li>
                    <li><a href="{{ route('backend.admin.faqs.create') }}"><i class="fa fa-plus"></i> Add FAQ</a></li>
                </ul>
            </li>
            <li class="{{ is_active('faq-categories') }} treeview">
                <a href="#">
                    <i class="fa fa-question-circle"></i> <span>FAQs Categories</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.faq-categories.index') }}"><i class="fa fa-list"></i> All Categories</a></li>
                    <li><a href="{{ route('backend.admin.faq-categories.create') }}"><i class="fa fa-plus"></i> Add Category</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{ route('backend.admin.corporate-types.index') }}">
                    <i class="fa fa-photo"></i> <span>Corporate Types Slides</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.corporate-types.index') }}"><i class="fa fa-photo"></i> Corporate Types Slides</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{ route('backend.admin.learn') }}">
                    <i class="fa fa-book"></i> <span>Learn</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.learn') }}"><i class="fa fa-book"></i> Learn</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{ route('backend.admin.listings.index') }}">
                    <i class="fa fa-star"></i> <span>Sponsored Listings</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.listings.index') }}"><i class="fa fa-star"></i> Sponsored Listings</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{ route('backend.admin.logs.index') }}">
                    <i class="fa fa-list"></i> <span>Log</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.logs.index') }}"><i class="fa fa-list"></i> Log</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="{{ route('backend.admin.billing.index') }}">
                    <i class="fa fa-dollar"></i> <span>Billing Settings</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.admin.billing.index') }}"><i class="fa fa-dollar"></i> Billing Settings</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="/logout">
                    <i class="fa fa-power-off"></i> <span>Logout</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
