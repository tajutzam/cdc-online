<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('/') }}assets/images/logoblack.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
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
                <li> <a href="index.html"><i class='bx bx-radio-circle'></i>Notifications</a>
                </li>
                <li> <a href="index2.html"><i class='bx bx-radio-circle'></i>Prodi</a>
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
                <li> <a href="app-chat-box.html"><i class='bx bx-radio-circle'></i>Berita</a>
                </li>
                <li> <a href="app-file-manager.html"><i class='bx bx-radio-circle'></i>User</a>
                </li>
                <li> <a href="app-contact-list.html"><i class='bx bx-radio-circle'></i>Legalisir</a>
                </li>
                <li> <a href="app-to-do.html"><i class='bx bx-radio-circle'></i>Todo List</a>
                </li>
                <li> <a href="app-invoice.html"><i class='bx bx-radio-circle'></i>Invoice</a>
                </li>
                <li> <a href="app-fullcalender.html"><i class='bx bx-radio-circle'></i>Calendar</a>
                </li>
            </ul>
        </li>
        <div class="menu-label">Profile</div>
        <a href="user-profile.html">
            <div class="parent-icon"><i class="bx bx-user-circle"></i>
            </div>
            <div class="menu-title">Admin Profile</div>
        </a>
        <div class="menu-label">Auth</div>
       <a href="user-profile.html">
            <div class="parent-icon"><i class="bx bx-log-out-circle"></i>
            </div>
            <div class="menu-title">Admin Profile</div>
        </a>

    </ul>

    <!--end navigation-->
</div>
