<label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
<ul class="br-sideleft-menu">
    <li class="br-menu-item ">
        <a href="{{route('home.index')}}" class="br-menu-link {{ Route::is('home.index') ? 'active':'' }} ">
            <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
            <span class="menu-item-label">Dashboard</span>
        </a><!-- br-menu-link -->
    </li><!-- br-menu-item -->

    <li class="br-menu-item">
        <a href="{{route('pointofsale.index')}}" class="br-menu-link {{Route::is('pointofsale.index') ? 'active' :''}}">
            <i class="menu-item-icon fas fa-cart-plus tx-16"></i>
            <span class="menu-item-label">POS</span>
        </a><!-- br-menu-link -->

    </li>



    <li class="br-menu-item">
        <a href="#"
            class="br-menu-link with-sub {{ Route::is('medicine.index') || Route::is('medicine.create')||Route::is('medicine.shortage')||Route::is('medicine.nearexpired')||Route::is('medicine.expired')||Route::is('medicine.edit') ?  'active' : '' }}">
            <i class="menu-item-icon fa fa-medkit tx-24"></i>
            <span class="menu-item-label">Manage Medicine</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('medicine.index')}}"
                    class="sub-link {{ Route::is('medicine.index')? 'active' : ''}}">Medicine List</a></li>
            <li class="sub-item"><a href="{{route('medicine.create')}}"
                    class="sub-link {{ Route::is('medicine.create')? 'active' : ''}}">Add New Medicine</a></li>
            <li class="sub-item"><a href="{{ route('medicine.shortage') }}"
                    class="sub-link {{ Route::is('medicine.shortage')? 'active' : ''}}">Shortage Medicine List</a>
            </li>
            <li class="sub-item"><a href="{{route('medicine.nearexpired')}}"
                    class="sub-link {{ Route::is('medicine.nearexpired')? 'active' : ''}}">Near to Expire List</a>
            </li>
            <li class="sub-item"><a href="{{route('medicine.expired')}}"
                    class="sub-link {{ Route::is('medicine.expired')? 'active' : ''}}">Expired Medicine List</a></li>
        </ul>
    </li><!-- br-menu-item -->



    @if (Auth::user()->user_type =="admin")
    <li class="br-menu-item">
        <a href="#"
            class="br-menu-link with-sub {{Route::is('Category.index')||Route::is('Category.create')||Route::is('Category.edit') ?  'active' : ''  }}">
            <i class="menu-item-icon fa fa-medkit tx-24"></i>
            <span class="menu-item-label">Medicine Categories</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('Category.index')}}"
                    class="sub-link {{ Route::is('Category.index') ? 'active' : '' }}">Category List</a></li>
            <li class="sub-item"><a href="{{route('Category.create')}}"
                    class="sub-link {{ Route::is('Category.create') ? 'active' : '' }}">Add New Category</a></li>

        </ul>
    </li><!-- br-menu-item -->

    @endif

    @if (Auth::user()->user_type =="admin")
    <li class="br-menu-item">
        <a href="#" class="br-menu-link with-sub {{Route::is('expense-category.index')||Route::is('expense.index') ?  'active' : ''  }} ">
            <i class="menu-item-icon far fa-money-bill-alt tx-15"></i>
            <span class="menu-item-label">Manage Expenses</span>
        </a><!-- br-menu-link -->

        <ul class="br-menu-sub">
        <li class="sub-item"><a href="{{route('expense-category.index')}}" class="sub-link {{Route::is('expense-category.index') ? 'active': ''}}">Expense Category</a>
            </li>

        <li class="sub-item"><a href="{{route('expense.index')}}" class="sub-link {{Route::is('expense.index') ? 'active': '' }}">Expense List</a></li>
        </ul>
    </li><!-- br-menu-item -->

    @endif

    @if (Auth::user()->user_type =="admin")
    <li class="br-menu-item">
        <a href="#"
            class="br-menu-link with-sub {{ Route::is('executive.index')|| Route::is('executive.show')||Route::is('executive.edit')||Route::is('executive.update')||Route::is('executive.create') ?  'active' : ''  }}">
            <i class="menu-item-icon fas fa-users-cog tx-15"></i>
            <span class="menu-item-label">Manage Executives</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('executive.index')}}"
                    class="sub-link {{ Route::is('executive.index') ? 'active' : ''}}">Executive List</a></li>
        </ul>
    </li><!-- br-menu-item -->

    @endif

    @if (Auth::user()->user_type =="admin")
    <li class="br-menu-item">
        <a href="#" class="br-menu-link with-sub {{ Route::is('supplier.index') ?'active' : ''}} ">
            <i class="menu-item-icon fa fa-ship tx-15"></i>
            <span class="menu-item-label">Manage Supplier</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('supplier.index')}}"
                    class="sub-link {{ Route::is('supplier.index') ?'active' : '' }}">Supplier List</a></li>
        </ul>
    </li><!-- br-menu-item -->
    @endif

    @if (Auth::user()->user_type =="admin")
    <li class="br-menu-item">
        <a href="#"
            class="br-menu-link with-sub {{ Route::is('setting.activity')||Route::is('setting.remainder') ?  'active' : ''  }}">
            <i class="menu-item-icon fas fa-cog tx-16"></i>
            <span class="menu-item-label">Settings</span>
        </a><!-- br-menu-link -->
        <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('setting.activity')}}"
                    class="sub-link {{ Route::is('setting.activity') ? 'active' : ''}}">Activity Log</a></li>
            <li class="sub-item"><a href="{{route('setting.remainder')}}"
                    class="sub-link {{ Route::is('setting.remainder') ? 'active' : '' }}">Remindar Settings</a></li>
        </ul>
    </li><!-- br-menu-item -->

    @endif

    @if (Auth::user()->user_type =="admin")
    <li class="br-menu-item">
    <a href="#" class="br-menu-link with-sub {{Route::is('salesitem.index')||Route::is('datewise.Invoices')||Route::is('invoice.details')||Route::is('report.topSellingProduct') ? 'active' : ''}}">
            <i class="menu-item-icon far fa-money-bill-alt tx-15"></i>
            <span class="menu-item-label">Report</span>
        </a><!-- br-menu-link -->

        <ul class="br-menu-sub">
        <li class="sub-item"><a href="{{route('salesitem.index')}}" class="sub-link {{Route::is('salesitem.index') ? 'active':''}}">Sales Item Report</a></li>
        <li class="sub-item"><a href="{{route('datewise.Invoices')}}" class="sub-link {{Route::is('datewise.Invoices') ?'active': '' }}">Datewise Invoice Report</a></li>
        <li class="sub-item"><a href="{{route('report.topSellingProduct')}}" class="sub-link {{Route::is('report.topSellingProduct') ?'active': '' }}">Top Selling Product</a></li>
    </ul>

    </li><!-- br-menu-item -->
    @endif
    <br>
