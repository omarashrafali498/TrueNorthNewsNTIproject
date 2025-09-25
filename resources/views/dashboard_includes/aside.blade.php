<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span>Dashboard</span>
            </a>
        </li>
        <!-- Users -->
        <li class="nav-item">
            <a class="nav-link  " data-bs-target="#users-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="users-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('users') }}" class="">
                        <i class="bi bi-circle"></i><span>All Users</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link " data-bs-target="#articles-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-text"></i><span>Articles</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="articles-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('articles') }}" class="">
                        <i class="bi bi-circle"></i><span>All Articles</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Pages Heading -->
        <li class="nav-heading">Pages</li>

        <!-- Blank Page -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li>
</aside><!-- End Sidebar-->