<div class="main-sidebar">
    <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard.index') }}">Info.In</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('dashboard.index') }}">IF</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li>
            <a 
                href="{{ route("dashboard.index") }}"
            ><i class="fas fa-fire"></i> <span>Dashboard</a>
        </li>
            @if (Auth::user()->role_id == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-eye"></i> <span>Pengunjung</span></a>
                    <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route("admin.visitors.index") }}">Daftar Pengunjung</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>User</span></a>
                    <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route("admin.user.list") }}">Daftar User</a></li>
                    <li><a class="nav-link" href="{{ route("admin.eo.list") }}">Daftar Event Organizer</a></li>
                    <li><a class="nav-link" href="{{ route("admin.admin.list") }}">Daftar Admin</a></li>
                    <li><a class="nav-link" href="{{ route("admin.blacklist.list") }}">Daftar Blacklist</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->role_id == 3 || Auth::user()->role_id == 2)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bank"></i> <span>Bank</span></a>
                    <ul class="dropdown-menu">
                        @if (Auth::user()->role_id == 3)
                        <li><a class="nav-link" href="{{ route("admin.bank.index") }}">Daftar Bank</a></li>
                        @endif
                        <li><a class="nav-link" href="{{ route("admin.bank.user.list") }}">Daftar Rekening</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->role_id)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-hand-holding-usd"></i> <span>Donation</span></a>
                    <ul class="dropdown-menu">
                        @if (Auth::user()->role_id == 3 || Auth::user()->role_id == 2)
                        <li><a class="nav-link" href="{{ route("donation.index") }}">Daftar Donation</a></li>
                        @endif
                        <li><a class="nav-link" href="{{ route("donation.transaction") }}">Daftar Transaksi</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-calendar-week"></i> <span>Event</span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="nav-link" href="{{ route("event.index") }}">
                                Daftar Event
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->role_id == 3)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tags"></i> <span>Kategori</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route("categories.index") }}">Daftar Kategori</a></li>
                    </ul>
                </li>
            @endif
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-pencil-alt"></i> <span>Artikel</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route("articles.index") }}">Daftar Artikel</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>