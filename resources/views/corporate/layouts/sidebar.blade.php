<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <img class="img-responsive" src="{{ imagePath($currentCorporate->details->logo) }}" alt="" style="">
        </div>

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="info text-center">
                <p>{{ $signedUser->name }}<br><small>{{ $signedUser->email }}</small></p>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{ route('backend.corporate.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            @can('manage-corporate')
                <li class="{{ is_active('users') }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.corporate.users.index') }}"><i class="fa fa-list"></i> All Users</a></li>
                    <li><a href="{{ route('backend.corporate.users.create') }}"><i class="fa fa-plus"></i> Add User</a></li>
                </ul>
            </li>
            @endcan
            @can('approve-data')
                <li><a href="{{ route('backend.corporate.data.requests.index') }}"><i class="fa fa-database"></i> Data Requests <span class="label label-danger pull-right">{{ isset($dataRequestsCount) && $dataRequestsCount ? $dataRequestsCount : '' }}</span></a></li>
            @endcan
            <li class="{{ is_active('details') }} treeview">
                <a href="#">
                    <i class="fa fa-bullhorn"></i> <span>Sponsored Items</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.corporate.listings.sponsored') }}"><i class="fa fa-list"></i> Listings</a></li>
                    <li><a href="{{ route('backend.corporate.advertisements.index') }}"><i class="fa fa-star"></i> Advertisements</a></li>
                </ul>
            </li>
            <li><a href="{{ route('backend.corporate.details.index') }}"><i class="fa fa-info"></i> Corporate Details</a></li>
            <li class="{{ is_active('branches') }} treeview">
                <a href="#">
                    <i class="fa fa-building"></i> <span>Branches</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.corporate.branches.index') }}"><i class="fa fa-list"></i> All Branches</a></li>
                    <li><a href="{{ route('backend.corporate.branches.create') }}"><i class="fa fa-plus"></i> Add Branch</a></li>
                </ul>
            </li>
            <li><a href="{{ route('backend.corporate.sliders.index') }}"><i class="fa fa-image"></i> Slider</a></li>
            <li class="{{ is_active('services') }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i> <span>Services</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @foreach($industryServices as $service)
                        <li><a href="{{ route('backend.corporate.listings.index', $service->id) }}"><i class="fa fa-credit-card"></i> {{ $service->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="{{ is_active('leads') }} treeview">
                <a href="#">
                    <i class="fa fa-flag"></i> <span>Client Leads</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.corporate.leads.index') }}"><i class="fa fa-flag"></i> All Leads</a></li>
                </ul>
            </li>
            <li class="{{ is_active('settings') }} treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('backend.corporate.settings.profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                </ul>
            </li>
            @if($currentCorporate->type_id == 3)
                <li><a href="{{ route('backend.corporate.transactions.index') }}"><i class="fa fa-credit-card"></i> Transactions</a></li>
            @endif
            <li><a href="{{ route('backend.corporate.invoices.index') }}"><i class="fa fa-dollar"></i> <span>Invoices</span> @if($invoicesCount)<span class="label bg-purple pull-right">{{ $invoicesCount }}</span> @endif</a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
