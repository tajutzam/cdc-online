<header class="">
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>




            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center gap-1">


                </ul>
            </div>
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('/') }}assets/images/admin.png" class="user-img" alt="user avatar">
                    <div class="user-info">
                        <p class="user-name mb-0">{{ Auth::guard('admin')->user()->name }}</p>
                        <p class="designattion mb-0">role : {{ Auth::guard('admin')->user()->role }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">

                    <li class="text-center">
                        <form action="{{ route('admin-logout', ['id' => 1]) }}" method="post">
                            <button href="" type="submit" class="btn btn-sm"> <i
                                    class="bx bx-arrow-back"></i>Keluar</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
