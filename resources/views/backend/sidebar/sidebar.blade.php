<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item menu__custom apple__radius">
        <a href="{{ URL::asset('transactions') }}" class="nav-link @yield('dashboard_active')">
            <i class="fa-solid fa-money-bills nav-icon"></i>
            <p>
                Transactions
            </p>
        </a>
    </li>
    <li class="nav-item menu__custom apple__radius">
        <a href="{{ route('deposit') }}" class="nav-link @yield('deposit_active')">
            <i class="fa-solid fa-sack-dollar nav-icon"></i>
            <p>
                Deposit
            </p>
        </a>
    </li>
    <li class="nav-item menu__custom apple__radius">
        <a href="{{ route('withdrawal') }}" class="nav-link @yield('withdrawal_active')">
            <i class="fa-solid fa-coins nav-icon"></i>
            <p>
                withdrawal
            </p>
        </a>
    </li>
</ul>
