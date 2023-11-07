<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-white-primary elevation-4"
    style="position: fixed; top: 0; left: 0; bottom: 0; width: 250px;">

    <!-- -----Brand Logo----- -->

    <a href="{{ route('home') }}" style="height: 85px; width: 100%" class="">

        @if (@App\Models\Setting::first()->application_logo)
            <img src="{{ Storage::url(App\Models\Setting::first()->application_logo) }}"
                style=" height: 85px; width: 100%;" alt="Logo" class="brand-image">
        @else
            <img src="{{ asset('uploads/land-logo.png') }}" style=" height: 85px; width: 100%; " alt="Logo"
                class="brand-image">
        @endif

    </a>

    <!-- ----- End of Brand Logo----- -->

    <style>
        @import url('https://fonts.maateen.me/kalpurush/font.css');

        body {
            font-family: 'Kalpurush', Arial, sans-serif !important;
        }

        .nav-sidebar .nav-link p {
            color: black;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #20c997;
        }

        .nav-sidebar .nav-link:hover {
            background-color: rgba(41, 171, 135, 0.5);
        }

        body:not(.layout-fixed) .main-sidebar {
            background-color: white;
        }

        .menu-open>.nav-link>.fa-angle-left {
            transform: rotate(-90deg);
        }

        .menu-open .nav-treeview {
            display: block;
        }

        /* body:not(.layout-fixed) .main-sidebar {
            height: 65rem;
        } */

        /* Add this to your existing CSS */

        #digital-guard-file ul.nav-treeview {
            display: none;
        }

        #digital-guard-file.open ul.nav-treeview {
            display: block;
        }
    </style>

    <!--Start Sidebar -->
    <div class="sidebar">
        <nav class="mb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt text-dark"></i>
                        <p class="ml-2">ড্যাশবোর্ড</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('menu-lists.index') }}" class="nav-link {{ activeSegment('menu-lists') }}">
                        <i class="fa-solid fa-bars text-dark"></i>
                        <p class="ml-2">মেনু তালিকা</p>
                    </a>
                </li>

                <!-- Start section of Home Page Menu -->

                <li
                    class="nav-item has-treeview 
                {{ 
                    request()->is('admin/sliders*') ||
                    request()->is('admin/apps-and-softwares*') || 
                    request()->is('admin/land-related-media-links*')
                    ? 'menu-is-opening menu-open'
                    : '' }}">
                    <a href="#" class="nav-link {{ 
                    request()->is('admin/sliders*') ||
                    request()->is('admin/apps-and-softwares*') || 
                    request()->is('admin/land-related-media-links*')
                     ? 'active' : '' }}">
                        <i class="fas fa-home text-dark"></i>
                        <p class="ml-2 active ">হোম পেইজ</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sliders.index') }}"
                                class="nav-link {{ activeSegment('sliders') }} ml-4">
                                <i class="fa-solid fa-sliders text-dark"></i>
                                <p class=" active ml-2">স্লাইডার</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('apps-and-softwares.index') }}"
                                class="nav-link {{ activeSegment('apps-and-softwares') }} ml-4">
                                <i class="fa-brands fa-app-store text-dark"></i>
                                <p class=" active ml-2">জমির তথ্য ও সফটওয়্যার</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('land-related-media-links.index') }}"
                                class="nav-link {{ activeSegment('land-related-media-links') }} ml-4">
                                <i class="fa-brands fa-medium text-dark"></i>
                                <p class=" active ml-2">জমি সংক্রান্ত মিডিয়া লিঙ্ক</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- End section of Home Page Menu --}}

                <li class="nav-item has-treeview">
                    <a href="{{ route('notices.index') }}" class="nav-link {{ activeSegment('notices') }}">
                        <i class="fa-solid fa-triangle-exclamation text-dark"></i>
                        <p class="ml-2">নোটিশ</p>
                    </a>
                </li>
                <!------- Start section of জমি সংক্রান্ত ভিডিও লিঙ্ক ------->
                <li class="nav-item">
                    <a href="{{ route('land-related-video-links.index') }}"
                        class="nav-link {{ activeSegment('land-related-video-links') }}">
                        <i class="fa-solid fa-video text-dark"></i>
                        <p class="ml-2">জমি সংক্রান্ত ভিডিও লিঙ্ক</p>
                    </a>
                </li>
                <!------- Start section of ছবি ও তথ্য চিত্র ------->
                <li class="nav-item">
                    <a href="{{ route('festivals-images.index') }}"
                        class="nav-link {{ activeSegment('festivals-images') }}">
                        <i class="fa-solid fa-file-image text-dark"></i>
                        <p class="ml-2">ছবি ও তথ্য চিত্র </p>
                    </a>
                </li>

                <!------- Start section of ভূমিসেবা সমূহ ------->

                <li class="nav-item has-treeview 
                {{ 
                    request()->is('admin/services*')
                    ? 'menu-is-opening menu-open'
                    : '' }}">
                    <a href="#" class="nav-link {{ 
                    request()->is('admin/services*')
                     ? 'active' : '' }}">
                        <i class="fas fa-layer-group text-dark"></i>
                        <p class="ml-2">ভূমিসেবা সমূহ</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">

                        <!-- Start section of সেবা -->

                        <li class="nav-item has-treeview">
                            <a href="{{ route('services.index') }}"
                                class="nav-link {{ activeSegment('services') }} ml-4">
                                <i class="fa-solid fa-toolbox text-dark"></i>
                                <p class="">সেবা</p>
                            </a>
                        </li>
                        <!-- End section of সেবা -->
                    </ul>
                </li>
                <!------- End section of ভূমিসেবা সমূহ ------->


                <!-- Start section of প্রকল্প সম্পর্কিত -->

                <li class="nav-item has-treeview {{ 
                    request()->is('admin/prokolpo_poricaloks*') ||
                    request()->is('admin/prokolpo_sarsongkheps*') || 
                    request()->is('admin/uddessho_lokkhos*') || 
                    request()->is('admin/nagoriker_subidhas*') || 
                    request()->is('admin/prokolper_outputs*')
                    ? 'menu-is-opening menu-open'
                    : '' }}">
                    <a href="#" class="nav-link {{ 
                        request()->is('admin/prokolpo_poricaloks*') ||
                        request()->is('admin/prokolpo_sarsongkheps*') || 
                        request()->is('admin/uddessho_lokkhos*') || 
                        request()->is('admin/nagoriker_subidhas*') || 
                        request()->is('admin/prokolper_outputs*')
                         ? 'active' : '' }}">
                        <i class="fa-solid fa-dharmachakra text-dark"></i>
                        <p class="ml-2">প্রকল্প সম্পর্কিত</p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('prokolpo_poricaloks.index') }}"
                                class="nav-link {{ activeSegment('prokolpo_poricaloks') }} ml-4">
                                <i class="fa-solid fa-user text-dark ml-3"></i>
                                <p class="ml-2"> প্রকল্প পরিচালক</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('prokolpo_sarsongkheps.index') }}"
                                class="nav-link {{ activeSegment('prokolpo_sarsongkheps') }} ml-4">
                                <i class="fa-solid fa-diagram-project text-dark ml-3"></i>
                                <p class="ml-2"> প্রকল্প সারসংক্ষেপ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('uddessho_lokkhos.index') }}"
                                class="nav-link {{ activeSegment('uddessho_lokkhos') }} ml-4">
                                <i class="fa-solid fa-bullseye text-dark ml-3"></i>
                                <p class="ml-2">উদ্দেশ্যে ও লক্ষ্য</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nagoriker_subidhas.index') }}"
                                class="nav-link {{ activeSegment('nagoriker_subidhas') }} ml-4">
                                <i class="fa-solid fa-users-rectangle text-dark ml-3"></i>
                                <p class="ml-2">নাগরিকের সুবিধা</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('prokolper_outputs.index') }}"
                                class="nav-link {{ activeSegment('prokolper_outputs') }} ml-4">
                                <i class="fa-solid fa-right-from-bracket text-dark ml-3"></i>
                                <p class="ml-2">প্রকল্পের আউটপুট</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End section of প্রকল্প সম্পর্কিত -->



                <!------- Start section of ডিজিটাল গার্ড ফাইল ------->

                <li class="nav-item has-treeview {{ 
                    request()->is('admin/ayinbidhis*') ||
                    request()->is('admin/poripotro_proggapons*') || 
                    request()->is('admin/nitimalas*') || 
                    request()->is('admin/manuals*') || 
                    request()->is('admin/faqs*')
                    ? 'menu-is-opening menu-open'
                    : '' }}">
                    <a href="#" class="nav-link {{ 
                        request()->is('admin/ayinbidhis*') ||
                        request()->is('admin/poripotro_proggapons*') || 
                        request()->is('admin/nitimalas*') || 
                        request()->is('admin/manuals*') || 
                        request()->is('admin/faqs*')
                         ? 'active' : '' }}">
                        <i class="fa-regular fa-file-archive text-dark"></i>
                        <p class="ml-2">ডিজিটাল গার্ড ফাইল </p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('ayinbidhis.index') }}"
                                class="nav-link {{ activeSegment('ayinbidhis') }} ml-4">
                                <i class="fa-solid fa-gavel text-dark ml-3"></i>
                                <p class="ml-2">আইন-ও-বিধি</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('poripotro_proggapons.index') }}"
                                class="nav-link {{ activeSegment('poripotro_proggapons') }} ml-4">
                                <i class="fa-solid fa-paperclip text-dark ml-3"></i>
                                <p class="ml-2">পরিপত্র/প্রজ্ঞাপন</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('nitimalas.index') }}"
                                class="nav-link {{ activeSegment('nitimalas') }} ml-4">
                                <i class="fa-solid fa-arrow-up-a-z text-dark ml-3"></i>
                                <p class="ml-2">নীতিমালা ও শর্তাবলী</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('manuals.index') }}"
                                class="nav-link {{ activeSegment('manuals') }} ml-4">
                                <i class="fa-solid fa-handshake text-dark ml-3"></i>
                                <p class="ml-2">ভূমির ম্যানুয়াল সমূহ</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('faqs.index') }}" class="nav-link {{ activeSegment('faqs') }} ml-4">
                                <i class="fa-regular fa-circle-question text-dark ml-3"></i>
                                <p class="ml-2">সাধারণ জিজ্ঞাসা</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!------- End section of ডিজিটাল গার্ড ফাইল -------->



                <li class="nav-item has-treeview" id="digital-guard-file">
                    <a href="{{ route('vhumi_sheba_forms.index') }}"
                        class="nav-link {{ activeSegment('vhumi_sheba_forms') }}">
                        <i class="fa-solid fa-sheet-plastic text-dark"></i>
                        <p class="ml-2">ভূমিসেবা ফর্ম</p>
                    </a>
                </li>




                <li class="nav-item has-treeview">
                    <a href="{{ route('recent-updates.index') }}"
                        class="nav-link {{ activeSegment('recent-updates') }}">
                        <i class="fa-regular fa-pen-to-square text-dark"></i>
                        <p class="ml-2">সাম্প্রতিক আপডেট</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('settings.index') }}" class="nav-link {{ activeSegment('settings') }}">
                        <i class="nav-icon fas fa-cogs text-dark"></i>
                        <p class="ml-2">সেটিংস</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link" onclick="document.getElementById('logout-form').submit()">
                        <i class="fas fa-sign-out-alt text-dark"></i>
                        <p class="ml-2">লগ আউট </p>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </nav>
        <!--End of sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const digitalGuardFileDropdown = document.getElementById('digital-guard-file');
        const submenuItems = digitalGuardFileDropdown.querySelectorAll('.nav-item');

        digitalGuardFileDropdown.addEventListener('click', function (event) {
            event.stopPropagation();
            digitalGuardFileDropdown.classList.toggle('menu-open');
        });


        document.addEventListener('click', function (event) {
            if (!digitalGuardFileDropdown.contains(event.target)) {
                digitalGuardFileDropdown.classList.remove('menu-open');
            }
        });


        submenuItems.forEach(function (submenuItem) {
            submenuItem.addEventListener('click', function (event) {
                event.stopPropagation();

            });
        });
    });

</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const digitalGuardFileDropdown = document.getElementById('digital-guard-file');
        const submenuItems = digitalGuardFileDropdown.querySelectorAll('.nav-item');

        digitalGuardFileDropdown.addEventListener('click', function() {
            digitalGuardFileDropdown.classList.toggle('open');
        });

        document.addEventListener('click', function(event) {
            if (!digitalGuardFileDropdown.contains(event.target)) {
                digitalGuardFileDropdown.classList.remove('open');
            }
        });

        submenuItems.forEach(function(submenuItem) {
            submenuItem.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    });
</script>
