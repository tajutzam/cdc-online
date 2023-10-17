<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="mx-auto">
            <img src="{{ asset('/') }}assets/images/logoblack.png" class="logo-icon" alt="logo icon">
        </div>
        {{-- <div>
            <h4 class="logo-text">Admin</h4>
        </div> --}}
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <div class="menu-label">Menu</div>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Admin</div>
            </a>
            <ul>
                <li> <a href="{{ route('dashboard') }}"><i class='bx bx-radio-circle'></i>Dashboard</a>
                </li>
                <li> <a href="{{ route('notifications') }}"><i class='bx bx-radio-circle'></i>Notifications</a>
                </li>
                <li> <a href="{{ route('prodi') }}"><i class='bx bx-radio-circle'></i>Prodi</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Application</div>
            </a>
            <ul>
                <li> <a href="{{ route('post') }}"><i class='bx bx-radio-circle'></i>Post</a>
                </li>
                <li> <a href="{{ route('berita') }}"><i class='bx bx-radio-circle'></i>Berita</a>
                </li>
                <li> <a href="{{ route('user') }}"><i class='bx bx-radio-circle'></i>Alumni</a>
                </li>
                <li> <a href="{{ route('legalisir') }}"><i class='bx bx-radio-circle'></i>Legalisir</a>
                </li>
            </ul>
        </li>

    </ul>

    <!--end navigation-->
</div>
