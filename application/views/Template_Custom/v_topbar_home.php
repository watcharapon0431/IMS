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
                        <img src="<?php echo base_url() . "assets/"; ?>img/documents-logo.png" alt="home" class="light-logo"/>
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
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="javascript:void(0)">
                            <b class="hidden-xs"><?php echo $_SESSION['case_job'] . " : "; ?></b>
                            <b class="hidden-xs" id="name_topbar"><?php echo $_SESSION['case_fname'] . ' ' . $_SESSION['case_lname']; ?></b>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-text">
                                        <h5 id="name_topbar_menu"><?php echo $_SESSION['case_fname'] . ' ' . $_SESSION['case_lname']; ?></h5>
                                        <h6><?php echo $_SESSION['case_job']; ?></h6>
                                    </div>
                                </div>
                            </li>
                            <!-- <li role="separator" class="divider"></li>
                            <li>
                                <a onclick=""><i class="mdi mdi-account-card-details"></i>&emsp;แก้ไขข้อมูลส่วนตัว</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a onclick=""><i class="mdi mdi-lock"></i>&emsp;เปลี่ยนรหัสผ่าน</a>
                            </li> -->
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
                    <a href="<?php echo site_url(); ?>/Income_manage_controller" class="waves-effect">
                        <span class="hide-menu">
                            <i class="mdi mdi-clipboard-text"></i>&emsp;จัดการรายรับ-รายจ่าย
                            <span class="fa arrow"></span>
                            <span class="label label-rouded label-inverse pull-right"></span>
                        </span>
                    </a>
                </li>
                <!-- End จัดการรายรับ-รายจ่าย -->
            </ul>
        </div>
    </div>
</body>