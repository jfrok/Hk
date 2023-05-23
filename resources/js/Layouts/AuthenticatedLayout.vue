<script setup>
import {computed, ref} from 'vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import {Link, router} from '@inertiajs/vue3';
import Chart from "@/Components/Chart.vue";
const showingNavigationDropdown = ref(false);
// computed: {
//     return $page.
// }
</script>
<template>
    <div>
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <Link   v-if="$page.props.auth.user"
                            :href="route('dashboard')" class="logo">
<!--                        <img src="assets/img/logo.png" alt="Logo">-->
                    </Link>
<!--                    <a href="index.html" class="logo logo-small">-->
<!--&lt;!&ndash;                        <img src="assets/img/logo-small.png" alt="Logo" width="30" height="30">&ndash;&gt;-->
<!--                    </a>-->
                </div>
                <div class="menu-toggle">
                    <a href="javascript:void(0);" id="toggle_btn">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
                <div class="top-nav-search">
                    <form>
                        <input type="text" class="form-control" placeholder="Search here">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <a class="mobile_btn" id="mobile_btn" onclick="">
                    <i class="fas fa-bars"></i>
                </a>

                <ul class="nav user-menu">


<!--                    <li class="nav-item dropdown noti-dropdown me-2">-->
<!--                        <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">-->
<!--&lt;!&ndash;                            <img src="assets/img/icons/header-icon-05.svg" alt="">&ndash;&gt;-->
<!--                        </a>-->
<!--                        <div class="dropdown-menu notifications">-->
<!--                            <div class="topnav-dropdown-header">-->
<!--                                <span class="notification-title">Notifications</span>-->
<!--                                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>-->
<!--                            </div>-->
<!--                            <div class="noti-content">-->
<!--                                <ul class="notification-list">-->
<!--                                    <li class="notification-message">-->
<!--                                        <a href="#">-->
<!--                                            <div class="media d-flex">-->
<!--                                            <span class="avatar avatar-sm flex-shrink-0">-->
<!--&lt;!&ndash;                                                <img class="avatar-img rounded-circle" alt="User Image"&ndash;&gt;-->
<!--&lt;!&ndash;                                                     src="assets/img/profiles/avatar-02.jpg">&ndash;&gt;-->
<!--                                            </span>-->
<!--                                                <div class="media-body flex-grow-1">-->
<!--                                                    <p class="noti-details"><span class="noti-title">Carlson Tech</span> has-->
<!--                                                        approved <span class="noti-title">your estimate</span></p>-->
<!--                                                    <p class="noti-time"><span class="notification-time">4 mins ago</span>-->
<!--                                                    </p>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </a>-->
<!--                                    </li>-->
<!--                                    -->
<!--                                  -->
<!--                                  -->
<!--                                </ul>-->
<!--                            </div>-->
<!--                            -->
<!--                        </div>-->
<!--                    </li>-->

<!--                    <li class="nav-item zoom-screen me-2">-->
<!--                        <a href="#" class="nav-link header-nav-list win-maximize">-->
<!--&lt;!&ndash;                            <img src="assets/img/icons/header-icon-04.svg" alt="">&ndash;&gt;-->
<!--                        </a>-->
<!--                    </li>-->

                    <li class="nav-item dropdown has-arrow new-user-menus">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31"
                                 alt="Soeng Souy">
                            <div class="user-text">
                                <h6>{{ $page.props.auth.user.name }}</h6>
                                <p class="text-muted mb-0">{{ $page.props.auth.user.job }}</p>
                            </div>
                        </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="assets/img/profiles/avatar-01.jpg" alt="User Image"
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6>{{ $page.props.auth.user.name }}</h6>
                                    <p class="text-muted mb-0">{{ $page.props.auth.user.job }}</p>
                                </div>
                            </div>
                            <Link class="dropdown-item" :href="route('profile.edit')">My Profile</Link>
                            <Link class="dropdown-item" :href="route('settings.overview')">Settings</Link>
                            <Link class="dropdown-item" method="post" :href="route('logout')">Logout</Link>
<!--                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>-->
                        </div>
                    </li>

                </ul>

            </div>


            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li class="menu-title">
                                <span>Main Menu</span>
                            </li>
                            <li class="submenu" :class="{'active':$page.component == 'Dashboard'}">
                                <Link :href="route('dashboard')"><i class="feather-grid"></i> <span> Dashboard</span> </Link><span
                                    class="menu-arrow"></span>
                            </li>
                            <li class="submenu" :class="{'active':$page.component == 'Projects/Index'}">
                                <Link :href="route('project.overview')"><i class="fas fa-graduation-cap"></i> <span> Projects</span> <span
                                    class="menu-arrow"></span></Link>
                            </li>
                            <li class="submenu" :class="{'active':$page.component == 'Calendar/Index'}">
                                <Link :href="route('calendar.overview')"><i class="fas fa-graduation-cap"></i> <span> Calendar</span> <span
                                    class="menu-arrow"></span></Link>
                            </li>
                            <li class="submenu" :class="{'active':$page.component == 'Trash'}">
                                <Link :href="route('trash')"><i class="fas fa-trash-restore"></i> <span> Trash</span> <span
                                    class="menu-arrow"></span></Link>
                            </li>
                          </ul>
                    </div>
                </div>
            </div>


            <div class="page-wrapper">
                <div class="content container-fluid">

                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-sub-header">
                                    <h3 class="page-title">Welcome Admin!</h3>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">{{$page.component}}</a></li>
                                        <li class="breadcrumb-item active">Admin</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <slot />



<!--            <div class="row">-->
<!--                <div class="col-xl-3 col-sm-6 col-12">-->
<!--                    <div class="card flex-fill fb sm-box">-->
<!--                        <div class="social-likes">-->
<!--                            <p>Like us on facebook</p>-->
<!--                            <h6>50,095</h6>-->
<!--                        </div>-->
<!--                        <div class="social-boxs">-->
<!--                            <img src="assets/img/icons/social-icon-01.svg" alt="Social Icon">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-xl-3 col-sm-6 col-12">-->
<!--                    <div class="card flex-fill twitter sm-box">-->
<!--                        <div class="social-likes">-->
<!--                            <p>Follow us on twitter</p>-->
<!--                            <h6>48,596</h6>-->
<!--                        </div>-->
<!--                        <div class="social-boxs">-->
<!--                            <img src="assets/img/icons/social-icon-02.svg" alt="Social Icon">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-xl-3 col-sm-6 col-12">-->
<!--                    <div class="card flex-fill insta sm-box">-->
<!--                        <div class="social-likes">-->
<!--                            <p>Follow us on instagram</p>-->
<!--                            <h6>52,085</h6>-->
<!--                        </div>-->
<!--                        <div class="social-boxs">-->
<!--                            <img src="assets/img/icons/social-icon-03.svg" alt="Social Icon">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-xl-3 col-sm-6 col-12">-->
<!--                    <div class="card flex-fill linkedin sm-box">-->
<!--                        <div class="social-likes">-->
<!--                            <p>Follow us on linkedin</p>-->
<!--                            <h6>69,050</h6>-->
<!--                        </div>-->
<!--                        <div class="social-boxs">-->
<!--                            <img src="assets/img/icons/social-icon-04.svg" alt="Social Icon">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
        <footer>
            <p>Copyright © 2022 Jhdevelopers.</p>
        </footer>
    </div>
    </div>
    </div>
</template>
