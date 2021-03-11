<style>
    #header_3 {
        margin-top: 13px;
    }
</style>

<script>
    function readed_notification(note_id) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url() . "/Note_manage_controller/readed_notification"; ?>",
            data: {
                'note_id': note_id
            },
            dataType: 'JSON',
            async: false,
            success: function() {
                window.location.href = "<?php echo site_url() . "/Income_manage_controller/load_v_income_manage" ?>"
            }
        })
    }
</script>

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

                        <a class="dropdown-toggle waves-effect waves-light notification_report" data-toggle="dropdown" href="javascript:void(0)" id="btn_noti">
                            <i class="mdi mdi-bell-ring"></i>
                            <?php
                            if ($rs_notification_unreaded != null) {
                            ?>
                                <div class="notify">
                                    <!-- แจ้งเตือนกระพิบ Start -->
                                    <span class="heartbit"></span>
                                    <span class="point"></span>
                                    <!-- แจ้งเตือนกระพิบ End -->
                                </div>
                            <?php } ?>
                        </a>

                        <ul class="dropdown-menu dropdown-user animated bounceInDown ">
                            <li>
                                <div class="drop-title">บันทึกช่วยจำ</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <?php
                                    if ($rs_notification_unreaded != null || $rs_notification_readed != null) {
                                        $count_notification = 1;
                                        foreach ($rs_notification_unreaded as $value) {
                                            if ($count_notification <= 5) { ?>

                                                <a onclick="readed_notification(<?php echo $value->note_id ?>)" class="noti" style="background: #FBFBFB">
                                                    <div class="user-img">
                                                        <img src="<?php echo base_url() . "assets/"; ?>img/bill.png" style="width:30px">
                                                    </div>
                                                    <div class="mail-contnet">
                                                        <span class="mail-desc"><?php echo $value->note_to_do_list; ?></span>
                                                        <span class="time"><?php echo $value->Day . " " . $value->Month . " " . $value->year; ?></span>
                                                    </div>
                                                </a>
                                            <?php
                                                $count_notification++;
                                            }
                                        }
                                        foreach ($rs_notification_readed as $value) {
                                            if ($count_notification <= 5) { ?>

                                                <a onclick="readed_notification(<?php echo $value->note_id ?>)" class="noti" style="background: #D1D1D1">
                                                    <div class="user-img">
                                                        <img src="<?php echo base_url() . "assets/"; ?>img/bill.png" style="width:30px">
                                                    </div>
                                                    <div class="mail-contnet">
                                                        <span class="mail-desc"><?php echo $value->note_to_do_list; ?></span>
                                                        <span class="time"><?php echo $value->Day . " " . $value->Month . " " . $value->year; ?></span>
                                                    </div>
                                                </a>
                                    <?php
                                                $count_notification++;
                                            }
                                        }
                                    } else {
                                        echo "<center><p>ไม่มีการแจ้งเตือน</p><center>";
                                    }
                                    ?>
                                </div>
                            </li>
                            <!-- FBFBFB -->
                            <li>
                                <a class="text-center" href="<?php echo site_url() . '/Note_manage_controller/load_v_note_manage'; ?>">
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
                <!-- Strat จดการบันทึกช่วยจำ-->
                <li>
                    <a href="<?php echo site_url(); ?>/Note_manage_controller/load_v_note_manage" class="waves-effect">
                        <span class="hide-menu">
                            <i class="mdi mdi-clipboard-text"></i>&emsp;จัดการบันทึกช่วยจำ
                            <span class="fa arrow"></span>
                            <span class="label label-rouded label-inverse pull-right"></span>
                        </span>
                    </a>
                </li>
                <!-- End จดการบันทึกช่วยจำ -->

            </ul>
        </div>
    </div>
</body>