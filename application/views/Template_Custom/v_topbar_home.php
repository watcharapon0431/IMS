<style>
    #header_3 {
        margin-top: 13px;
    }
</style>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="#">
                        <img src="<?php echo base_url() . "assets/"; ?>img/documents-logo.png" alt="home" class="light-logo" />
                        </b>
                        <span class="hidden-xs"><img src="<?php echo base_url() . "assets/"; ?>img/IMS-text.png" alt="home" class="light-logo" width="70%" /></span>
                    </a>
                </div>
                <div>
                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                    </ul>
                </div>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                    <li class="dropdown">

                        <a class="dropdown-toggle waves-effect waves-light notification_report" data-toggle="dropdown" href="javascript:void(0)">
                            <i class="mdi mdi-bell-ring"></i>
                            <div class="notify">
                                <!-- แจ้งเตือนกระพิบ Start -->
                                <span class="heartbit"></span>
                                <span class="point"></span>
                                <!-- แจ้งเตือนกระพิบ End -->
                            </div>
                        </a>

                        <ul class="dropdown-menu dropdown-user animated bounceInDown ">
                            <li>
                                <div class="drop-title">บันทึกช่วยจำ</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <a onclick="" class="noti" style="background: #E9E6E6;">
                                        <div class="user-img">
                                            <img src="<?php echo base_url() . "assets/"; ?>img/bill.png" style="width:30px">
                                        </div>
                                        <div class="mail-contnet">
                                            <span class="mail-desc">จ่ายค่าไฟ</span>
                                            <span class="time">08/03/2021</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="<?php echo site_url() . ' '; ?>">
                                    <strong>รายการแจ้งเตือนทั้งหมด</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="javascript:void(0)">
                            <b class="hidden-xs"><?php echo $_SESSION['position_name'] . " : "; ?></b>
                            <b class="hidden-xs" id="name_topbar"><?php echo $_SESSION['user_fname'] . ' ' . $_SESSION['user_lname']; ?></b>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-text">
                                        <h5 id="name_topbar_menu"><?php echo $_SESSION['user_fname'] . ' ' . $_SESSION['user_lname']; ?></h5>
                                        <h6><?php echo $_SESSION['position_name']; ?></h6>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="<?php echo site_url(); ?>/IMS_controller/index"><i class="mdi mdi-power"></i>&emsp;ออกจากระบบ</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>


    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav">
            <div class="sidebar-head">
                <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu"></span></h3>
            </div>
            <ul class="nav" id="side-menu">
                <!-- Strat จัดการรายรับ-รายจ่าย -->
                <li class="devider"></li>
                <li>
                    <a href="<?php echo site_url(); ?>/Income_manage_controller/load_v_income_manage" class="waves-effect">
                        <span class="hide-menu">
                            <i class="mdi mdi-clipboard-text"></i>&emsp;จัดการรายรับ-รายจ่าย
                            <span class="fa arrow"></span>
                            <span class="label label-rouded label-inverse pull-right"></span>
                        </span>
                    </a>
                </li>
                <!-- End จัดการรายรับ-รายจ่าย -->
                <!-- Strat สรุปรายรับ-รายจ่าย -->
                <li>
                    <a href="<?php echo site_url(); ?>/Income_manage_controller/load_v_summary_income" class="waves-effect">
                        <span class="hide-menu">
                            <i class="mdi mdi-clipboard-text"></i>&emsp;สถิติรายรับ-รายจ่าย
                            <span class="fa arrow"></span>
                            <span class="label label-rouded label-inverse pull-right"></span>
                        </span>
                    </a>
                </li>
                <!-- End สรุปรายรับ-รายจ่าย -->
                 <!-- Strat ประเภทรายรับ-รายจ่าย -->
                 <li>
                    <a href="<?php echo site_url(); ?>/category_manage_controller/load_v_category_manage" class="waves-effect">
                        <span class="hide-menu">
                            <i class="mdi mdi-clipboard-text"></i>&emsp;ประเภทรายรับ-รายจ่าย
                            <span class="fa arrow"></span>
                            <span class="label label-rouded label-inverse pull-right"></span>
                        </span>
                    </a>
                </li>
                <!-- End ประเภทรายรับ-รายจ่าย -->


            </ul>
        </div>
    </div>
</body>