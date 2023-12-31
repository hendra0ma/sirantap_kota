<!-- Mobile Header -->
<div class="app-header header">
    <div class="container-fluid">
        <div class="d-flex">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="#"></a>
            <!-- sidebar-toggle-->
            <!-- <a class="header-brand1 d-flex d-md-none">
                <img src="{{url('/')}}/assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{url('/')}}/assets/images/brand/logo-1.png" class="header-brand-img toggle-logo" alt="logo">
                <img src="{{url('/')}}/assets/images/brand/logo-2.png" class="header-brand-img light-logo" alt="logo">
                <img src="{{url('/')}}/assets/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo">
            </a> -->
            <!-- LOGO -->
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fe fe-more-vertical text-dark"></span>
                </button>
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon theme-layout nav-link-bg layout-setting" onclick="darktheme()">
                        <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                            title="Dark Theme"><i class="fe fe-moon"></i></span>
                        <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                            title="Light Theme"><i class="fe fe-sun"></i></span>
                    </a>
                </div><!-- Theme-Layout -->
                <script>
                    let darktheme = function () {
                        setTimeout(function () {
                            let body = document.body;
                            let themes = body.className.split(" ");
                            let theme = (themes.length == 3) ? "yes" : "no";
                            $.ajax({
                                url: `{{route('superadmin.theme')}}`,
                                data: {
                                    theme,
                                    "_token": "{{csrf_token()}}"
                                },
                                type: "post",
                                success: function (res) {

                                }
                            });
                        }, 300);
                    }

                </script>
                <div class="dropdown d-none d-md-flex">
                    <a class="nav-link icon full-screen-link nav-link-bg">
                        <i class="fe fe-minimize fullscreen-button"></i>
                    </a>
                </div><!-- FULL-SCREEN -->
                 <div class="dropdown d-none d-md-flex notifications">
                    <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i><span
                            class=" pulse"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow ">
                        <div class="drop-heading border-bottom">
                            <div class="d-flex">
                                <h6 class="mt-1 mb-0 fs-16 fw-semibold">Notification</h6>
                                <div class="ms-auto">
                                    <span class="badge bg-success rounded-pill">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="notifications-menu">



                        </div>
                        <div class="dropdown-divider m-0"></div>

                    </div>
                </div><!-- NOTIFICATIONS -->
                <div class="dropdown  d-none d-md-flex message">
                    <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                        <i class="fe fe-message-square"></i><span class=" pulse-danger"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div class="drop-heading border-bottom">
                            <div class="d-flex">
                                <h6 class="mt-1 mb-0 fs-16 fw-semibold">You have Messages</h6>
                                <div class="ms-auto">
                                    <span class="badge bg-danger rounded-pill">1</span>
                                </div>
                            </div>
                        </div>
                        <div class="message-menu"style="overflow-y:scroll;height:300px">
                            <?php

 $allUser = App\Models\User::where('id',"!=",Auth::user()->id)->where('role_id','!=',8)->where('role_id','!=',0)->where('role_id','!=',14)->get(); ?>
                            @foreach($allUser as $usr)
                            <a class="dropdown-item d-flex" href="#" onclick="openForm(`<?=$usr->id?>`)">
                                <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                    data-bs-image-src="{{url('/')}}/assets/images/users/1.jpg"></span>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1">{{$usr->name}}</h5>
                                        <small class="text-muted ms-auto text-end">
                                           
                                        </small>
                                    </div>
                                </div>
                            </a>
                            @endforeach

                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a href="#" class="dropdown-item text-center p-3 text-muted">See all Messages</a>
                    </div>
                </div><!-- MESSAGE-BOX -->
                <div class="dropdown d-none d-md-flex profile-1">
                    <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
                        <span>
                            <img src="" alt="profile-user"
                                class="avatar  profile-user brround cover-image">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div class="drop-heading">
                            <div class="text-center">
                                <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                                <small
                                    class="text-muted">{{ Auth::user()->role_id == 1 ?"Administrator":"uwon luyi"; }}</small>
                            </div>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item" href="/user/profile">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>

                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon fe fe-settings"></i> Settings
                        </a>
                       
                        <form action="{{ route('logout') }}" method="post">
                            @csrf


                            <button class="dropdown-item"type="submit">
                                <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                            </button>
                        </form>
                    </div>
                </div>
                <div class="dropdown d-none d-md-flex header-settings">
                    <a href="#" class="nav-link icon " data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                        <i class="fe fe-menu"></i>
                    </a>
                </div><!-- SIDE-MENU -->
            </div>
        </div>
    </div>
</div>
<div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <div class="d-flex order-lg-2 ms-auto">
            <div class="dropdown d-md-flex">
                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                    <span class="dark-layout" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Dark Theme"><i
                            class="fe fe-moon"></i></span>
                    <span class="light-layout" data-bs-placement="bottom" data-bs-toggle="tooltip"
                        title="Light Theme"><i class="fe fe-sun"></i></span>
                </a>
            </div><!-- Theme-Layout -->
            <div class="dropdown d-md-flex">
                <a class="nav-link icon full-screen-link nav-link-bg">
                    <i class="fe fe-minimize fullscreen-button"></i>
                </a>
            </div><!-- FULL-SCREEN -->
            <div class="dropdown d-none d-md-flex notifications">
                <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i><span class=" pulse"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow ">
                    <div class="drop-heading border-bottom">
                        <div class="d-flex">
                            <h6 class="mt-1 mb-0 fs-16 fw-semibold">You have Notification</h6>
                            <div class="ms-auto">
                                <span class="badge bg-success rounded-pill">3</span>
                            </div>
                        </div>
                    </div>
                    <div class="notifications-menu">
                        <a class="dropdown-item d-flex" href="chat.html">
                            <div class="me-3 notifyimg  bg-primary-gradient brround box-shadow-primary">
                                <i class="fe fe-message-square"></i>
                            </div>
                            <div class="mt-1">
                                <h5 class="notification-label mb-1">New review received</h5>
                                <span class="notification-subtext">2 hours ago</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex" href="chat.html">
                            <div class="me-3 notifyimg  bg-secondary-gradient brround box-shadow-primary">
                                <i class="fe fe-mail"></i>
                            </div>
                            <div class="mt-1">
                                <h5 class="notification-label mb-1">New Mails Received</h5>
                                <span class="notification-subtext">1 week ago</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex" href="cart.html">
                            <div class="me-3 notifyimg  bg-success-gradient brround box-shadow-primary">
                                <i class="fe fe-shopping-cart"></i>
                            </div>
                            <div class="mt-1">
                                <h5 class="notification-label mb-1">New Order Received</h5>
                                <span class="notification-subtext">1 day ago</span>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <a href="#" class="dropdown-item text-center p-3 text-muted">View all
                        Notification</a>
                </div>
            </div><!-- NOTIFICATIONS -->
            <div class="dropdown  d-md-flex notifications">
                <a class="nav-link icon" data-bs-toggle="dropdown"><i class="fe fe-bell"></i><span
                        class=" pulse"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="drop-heading border-bottom">
                        <div class="d-flex">
                            <h6 class="mt-1 mb-0 fs-16 fw-semibold">You have Notification</h6>
                            <div class="ms-auto">
                                <span class="badge bg-success rounded-pill">3</span>
                            </div>
                        </div>
                    </div>
                    <div class="notifications-menu">
                       
                    </div>
                    
                </div>
            </div><!-- NOTIFICATIONS -->
            <div class="dropdown d-md-flex message">
                <a class="nav-link icon text-center" data-bs-toggle="dropdown">
                    <i class="fe fe-message-square"></i><span class=" pulse-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="drop-heading border-bottom">
                        <div class="d-flex">
                            <h6 class="mt-1 mb-0 fs-16 fw-semibold">You have Messages</h6>
                            <div class="ms-auto">
                                <span class="badge bg-danger rounded-pill"></span>
                            </div>
                        </div>
                    </div>
                    <div class="message-menu">
                    <?php
$allUser = App\Models\User::where('id',"!=",Auth::user()->id)->where('role_id','!=',8)->where('role_id','!=',0)->where('role_id','!=',14)->get(); ?>
                           @foreach($allUser as $usr)
                           <a class="dropdown-item d-flex" href="#" onclick="openForm(`<?=$usr->id?>`)">
                               <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                                   data-bs-image-src="{{url('/')}}/assets/images/users/1.jpg"></span>
                               <div class="wd-90p">
                                   <div class="d-flex">
                                       <h5 class="mb-1">{{$usr->name}}</h5>
                                       <small class="text-muted ms-auto text-end">
                                          
                                       </small>
                                   </div>
                               </div>
                           </a>
                           @endforeach
                    </div>
                    <div class="dropdown-divider m-0"></div>
                  
                </div>
            </div><!-- MESSAGE-BOX -->
            <div class="dropdown d-md-flex profile-1">
                <a href="#" data-bs-toggle="dropdown" class="nav-link pe-2 leading-none d-flex">
                    <span>
                        <img src="" alt="profile-user"
                            class="avatar  profile-user brround cover-image">
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="drop-heading">
                        <div class="text-center">
                            <h5 class="text-dark mb-0">{{ Auth::user()->name }}</h5>
                            <small class="text-muted">{{ Auth::user()->role_id == 1 ?"Administrator":"uwon luyi"; }}</small>
                        </div>
                    </div>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item" href="/user/profile">
                            <i class="dropdown-icon fe fe-user"></i> Profile
                        </a>

                        <a class="dropdown-item" href="#">
                            <i class="dropdown-icon fe fe-settings"></i> Settings
                        </a>
                    
                        <form action="{{ route('logout') }}" method="post">
                            @csrf


                            <button class="dropdown-item"type="submit">
                                <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                            </button>
                        </form>
                </div>
            </div>
            <div class="dropdown d-md-flex header-settings">
                <a href="#" class="nav-link icon " data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                    <i class="fe fe-menu"></i>
                </a>
            </div><!-- SIDE-MENU -->
        </div>
    </div>
</div>
<!-- /Mobile Header -->

<!--app-content open-->
<div class="app-content">
    <div class="side-app">
