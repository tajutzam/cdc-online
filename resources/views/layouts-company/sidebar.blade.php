   {{-- <style>
       /* Your existing styles */

       .has-arrow {
           position: relative;
       }

       .has-arrow::after {
           content: '\25B6';
           /* Unicode character for a right-pointing triangle */
           font-size: 10px;
           position: absolute;
           right: 10px;
           transition: transform 0.3s;
       }

       .has-arrow.open::after {
           transform: rotate(90deg);
       }

       /* Add any other styles as needed */
   </style> --}}
   <div class="sidebar-wrapper" data-simplebar="true">
       <div class="sidebar-header">
           <div class="auto" style="margin: 0%">
               <img src="{{ asset('/') }}assets/images/logo-icon.png" class="logo-icon" alt="logo icon"
                   style="width: 20px">
           </div>
           <div>

               <img src="{{ asset('/') }}assets/images/side-logo.png" class="logo-text" style="width: 80px">
               {{-- <h6 class="logo-text" style="color: black; text-align: start">Careear Development Center</h6> --}}
           </div>
           <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
           </div>
       </div>
       <!--navigation-->

       <ul class="metismenu" id="mena" style=" padding: 0%">

           <li>
               <a href="{{ route('company-settings') }}"class="">
                   <div class="parent-icon"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                               fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                               <path
                                   d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                               <path
                                   d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                           </svg></i>
                   </div>
                   <div class="menu-title">Pengaturan Akun</div>
               </a>
           </li>
       </ul>

       <ul class="metismenu" id="menu" style="margin-top:10px; padding: 0%">
           <div class="menu-label" style="padding-top: 0%; padding-left: 20px">Menu</div>


           <li>
               <a href="javascript:;" class="has-arrow">
                   <div class="parent-icon"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                               fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                               <path
                                   d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                           </svg></i>
                   </div>
                   <div class="menu-title">Postingan</div>
               </a>
               <ul>
                   <li style="margin-inline-start: 10%"> <a href="{{ route('vacancy-company-apply') }}"><i> <svg
                                   xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                   class="bi bi-folder2-open" viewBox="0 0 16 16">
                                   <path
                                       d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z" />
                               </svg></i>Pengajuan </a>
                   </li>
                   <li style="margin-inline-start: 10%"> <a href="{{ route('vacancy-company-history') }}"><i><svg
                                   xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                   class="bi bi-hourglass-bottom" viewBox="0 0 16 16">
                                   <path
                                       d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2z" />
                               </svg></i>Riwayat Lowongan</a>
                   </li>
                   <li style="margin-inline-start: 10%"> <a href="{{ route('information-company-history') }}"><i><svg
                                   xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                   class="bi bi-easel2-fill" viewBox="0 0 16 16">
                                   <path
                                       d="M8.447.276a.5.5 0 0 0-.894 0L7.19 1H2.5A1.5 1.5 0 0 0 1 2.5V10h14V2.5A1.5 1.5 0 0 0 13.5 1H8.809z" />
                                   <path fill-rule="evenodd"
                                       d="M.5 11a.5.5 0 0 0 0 1h2.86l-.845 3.379a.5.5 0 0 0 .97.242L3.89 14h8.22l.405 1.621a.5.5 0 0 0 .97-.242L12.64 12h2.86a.5.5 0 0 0 0-1zm3.64 2 .25-1h7.22l.25 1z" />
                               </svg></i>Riwayat Informasi</a>
                   </li>
               </ul>
           </li>


       </ul>
       {{-- <script>
        $(document).ready(function() {
            // Toggle submenus when clicking on items with the "has-arrow" class
            $('.has-arrow').click(function() {
                $(this).toggleClass('open');
                $(this).next('ul').slideToggle();
            });
        });
    </script> --}}
       <!--end navigation-->
   </div>
