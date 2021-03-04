<script>
    $(document).ready(() => {
        report_get_table_by_page_number_search(1);

    })
    report_get_table_by_page_number_search(1);

    function report_get_table_by_page_number_search(page_number) {

        let table = $("#report_table tbody")
        let page = $("#page_option")
        table.empty()
        page.empty()
        let count_of_master_data = $("#count_of_master_data")
        count_of_master_data.empty()
        $('#current_page').val(page_number)
        $.ajax({
            type: "POST",
            url: "<?php echo site_url() . "/Income_manage_controller/income_search/" ?>",
            data: {
                'page_number': page_number
            },
            dataType: 'JSON',
            async: false,
            success: function(json_data) {
                let count_data = 0
                if (json_data.rs_income.length > 0) {
                    json_data.rs_income.forEach(function(element) {
                        var button = "<center>" + element.btn_edit + ' ' + element.btn_delete + "</center>"
                        var blank = "<p></p>";
                        var add;
                        var del;
                        if (element.status == "รายรับ") {
                            add = element.cost;
                            del = blank;
                        } else {
                            add = blank;
                            del = element.cost;
                        }
                        table.append($('<tr>')
                            .append($('<td>').append("<center>" + element.create_date + "</center>"))
                            .append($('<td>').append(element.name))
                            .append($('<td>').append("<center>" + add + "</center>"))
                            .append($('<td>').append("<center>" + del + "</center>"))
                            .append($('<td>').append(button))
                        )
                        count_data++
                    })
                    $("#income_all").text(json_data.sum_income[0].sl_income+" บาท")
                    $("#expend_all").text(json_data.sum_income[0].sl_expend+" บาท")
                    $("#balance_all").text(json_data.sum_income[0].sl_balance+" บาท")
                    //--------------------------------  start declare count number pagination -------------------------------------------------
                    let count_section_page = $("#section_page").val()
                    let current_page = $("#current_page").val()
                    let max_page = json_data.case_count[0].count_case / 10
                    if (json_data.case_count[0].count_case % 10 != 0) {
                        max_page++
                    }
                    if ((count_section_page * 10) % 10 != 0) {
                        count_section_page = Math.floor(count_section_page)
                        count_section_page++ 
                        $("#section_page").val(count_section_page)
                    }
                    max_page = Math.floor(max_page)
                    let count_loop = null
                    if (max_page >= 10) {
                        count_loop = (10 * count_section_page) - 9
                    } else if (max_page < 10) {
                        count_loop = 1
                    }
                    //---------------------------------  end declare count number pagination --------------------------------------------------

                    page.append('<a style="color:black; " href="javascript:report_search_first_page()">&emsp;< |&emsp;</a>')
                    page.append('<a style="color:black; " href="javascript:report_search_page_previous()">&emsp;<&emsp;</a>')
                    $("#count_of_master_data").text("แสดง " + count_data + " ข้อมูล จาก " + json_data.case_count[0].count_case + " ข้อมูล")
                    for (count = count_loop; count <= max_page; count++) {
                        if (count <= count_section_page * 10) {
                            if (current_page == count) {
                                page.append('<a style="color:#0000FF; font-weight:bold" href="javascript:report_get_table_by_page_number_search(' + count + ')">&emsp;' + count + '&emsp;</a>')
                            } else {
                                page.append('<a style="color:black; " href="javascript:report_get_table_by_page_number_search(' + count + ')">&emsp;' + count + '&emsp;</a>')
                            }
                        }
                    }
                    page.append('<a style="color:black; " href="javascript:report_search_page_next(' + max_page + ')">&emsp;>&emsp;</a>')
                    page.append('<a style="color:black; " href="javascript:report_search_last_page(' + max_page + ')">&emsp;| >&emsp;</a>')
                } else {
                    let text_no_data = '<center><b><p>ไม่มีรายการรายรับ - รายจ่าย</p></b></center>'
                    table.append($('<tr>').append('<td colspan="8">' + text_no_data + '</td>'))
                }
                // end if condition when have case's data equal or more than 1 data
            }
        })
    }

    function report_search_page_previous() {
        let current_page = $('#current_page').val()
        if (current_page > 1) {
            if (current_page % 10 == 1) {
                let new_section_page = parseInt($('#section_page').val()) - 1
                $('#section_page').val(new_section_page)
            }
            page_temp = parseInt($('#current_page').val()) - 1
            report_get_table_by_page_number_search(page_temp)
        }
    }

    function report_search_page_next(max_count) {
        let current_page = $('#current_page').val()
        if (current_page < max_count) {
            if (current_page % 10 == 0 && current_page != max_count) {
                let new_section_page = parseInt($('#section_page').val()) + 1
                $('#section_page').val(new_section_page)
            }
            page_temp = parseInt($('#current_page').val()) + 1
            report_get_table_by_page_number_search(page_temp)
        }
    }

    function report_search_first_page() {
        $('#section_page').val(1)
        report_get_table_by_page_number_search(1)
    }

    function report_search_last_page(max_count) {
        let change_section_page_value = max_count
        if (max_count >= 10) {
            change_section_page_value = (max_count / 10)
        }
        $('#section_page').val(change_section_page_value)
        report_get_table_by_page_number_search(max_count)
    }
</script>

<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="col-md-10">
                                <div class="col-md-6">
                                    <h2><i class="fa fa-list-alt" style="font-size:40px;"></i>&emsp;จัดการรายรับ-รายจ่าย</h2>
                                </div>
                                <div class="col-md-2">
                                    <center><b>รายรับทั้งหมด</b></center>

                                    <center>
                                        <h1 id="income_all" style="color: blue; margin-top: 10px;">25</h1>
                                    </center>
                                    
                                    
                                </div>
                                <div class="col-md-2">
                                    <center><b>รายจ่ายทั้งหมด</b></center>

                                    <center>
                                        <h1 id="expend_all" style="color: red; margin-top: 10px;">25</h1>
                                    </center>
                                    
                                    
                                </div>
                                <div class="col-md-2">
                                    <center><b>คงเหลือ</b></center>

                                    <center>
                                        <h1 id="balance_all" style="color: green; margin-top: 10px;">25</h1>
                                    </center>
                      
                                    
                                </div>
                            </div>

                            <div class="col-md-2" align="right">
                                <br>
                                <!-- --------------------------------------------- start report insert button ------------------------------------------------------ -->
                                <a class="btn btn-info" type="button" data-toggle="modal" data-target="#modal_insert" class="model_img img-responsive">
                                    <span class="btn-label"><i class="mdi mdi-plus-circle "></i></span>เพิ่มรายการรายรับ-รายจ่าย
                                </a>
                                <!-- ---------------------------------------------- end report insert button ------------------------------------------------------- -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="white-box">
                    <div class="table-responsive">
                        <div class="dataTables_wrapper no-footer">
                            <!-- ------------------------------------------ start report data table ------------------------------------------------------ -->
                            <table id="report_table" class="table table-striped dataTable no-footer display" role="grid" aria-describedby="myTable_info">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; width: 10%"">วันที่</th>
                                        <th style=" text-align:center; width: 30%">รายการ</th>
                                        <th style="text-align:center; width: 20%"">รายรับ</th>
                                        <th style=" text-align:center; width: 20%"">รายจ่าย</th>
                                        <th style="text-align:center; width: 20%"">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <td style=" text-align:center; width: 10%"">วันที่</th>
                                        <td style=" text-align:center; width: 30%">รายการ</th>
                                        <td style="text-align:center; width: 20%"">รายรับ</th>
                                        <td style=" text-align:center; width: 20%"">รายจ่าย</th>
                                        <td style="text-align:center; width: 20%"">ดำเนินการ</th>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- ---------------------------------------------- end report data table ------------------------------------------------------- -->

                            <!-- --------------------------------------------- start pagination ------------------------------------------------------ -->
                            <div class=" col-md-12">
                                            <div class="col-md-4" align="left">
                                                <p id="count_of_master_data"></p>
                                            </div>
                                            <input type="hidden" id="current_page" value="1">
                                            <input type="hidden" id="section_page" value="1">
                                            <div id="page_option" class="col-md-8" align="right">

                                            </div>
                        </div>
                        <!-- ---------------------------------------------- end pagination ------------------------------------------------------- -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- --------------------------------------------- start modal master data insert  --------------------------------------------- -->
<div id="modal_insert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="btn_clear2();" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title" id="myModalLabel">เพิ่มรายรับ-รายจ่าย</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="master_data_insert_form" onsubmit='return false'>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">ประเภทรายการ : <span style="color:red;"> * </span></label>
                            <span style="color:red;">
                                <p for="" id="validate_type_id"></p>
                            </span>
                            <div class="col-md-9">
                                <div class="col-md-3">
                                    <input type="radio" id="type1" name="type">
                                    <label for="female"> รายรับ</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" id="type2" name="type" checked>
                                    <label for="female"> รายจ่าย</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">ชื่อรายการ : <span style="color:red;"> * </span></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="list" maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">ประเภทการใช้จ่าย : <span style="color:red;"> * </span></label>
                            <div class="col-md-6">
                                <select class="form-control" id="is_active_search">
                                    <option value='' selected>- เลือกประเภทการใช้จ่ายที่ต้องการ -</option>
                                    <option value=1>ใช้หนี้</option>
                                    <option value=2>เงินเดือน</option>
                                    <option value=3>อาหาร</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-5">วันที่ใช้จ่าย : <span class="help"> *</span></label>
                            <label class="col-md-5">เวลา : <span class="help"> *</span></label>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="create_report" value="" placeholder="วัน/เดือน/ปี"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                    <!-- ----------------------- Start date validate ----------------------- -->
                                    <span style="color:red;">
                                        <p for="" id="validate_create_report"></p>
                                    </span>
                                    <!-- ----------------------- End date validate ----------------------- -->
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select id="hour" class="form-control">
                                <?php
                                    for ($i = 0; $i < 24; $i++) {
                                    ?>
                                        <?php
                                        if ($i == 0 || $i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9) {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo "0" . $i; ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="minute" class="form-control">
                                <?php
                                    for ($i = 0; $i < 60; $i++) {
                                    ?>
                                        <?php
                                        if ($i == 0 || $i == 1 || $i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 || $i == 7 || $i == 8 || $i == 9) {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo "0" . $i; ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">จำนวนเงิน : <span style="color:red;"> * </span></label>
                            <div class="col-md-5">
                                <input type="number" class="form-control check" id="money" maxlength="50" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12" align="center">
                            <!-- ----------------------- start ยกเลิก submit ----------------------- -->
                            <button onclick="btn_clear2();" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="btn-label"><i class="fa fa-times"></i></span>ยกเลิก</button>
                            <!-- ----------------------- End ยกเลิก submit ----------------------- -->
                            &nbsp;&nbsp;&nbsp;
                            <!-- ----------------------- start ส่งข้อมูล input ----------------------- -->
                            <button onclick="master_data_insert(); btn_clear();" class="btn btn-success" type="button"><span class="btn-label"><i class="fa fa-save"></i></span>บันทึก</button>
                            <!-- ----------------------- End ส่งข้อมูล input ----------------------- -->
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ---------------------------------------------- end modal master data insert  ---------------------------------------------- -->
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0;
        /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance: textfield;
        /* Firefox */
    }
</style>
<script>
    $(document).ready(() => {
        var input = document.querySelector('input.check');
        input.addEventListener('keyup', function(e) {
            this.value = this.value.replace(/[^0-9]/, '');
        });
        var today = new Date();
        // set input id hour = current hour
        $("#hour").val(today.getHours())
        // set input id minute = current minute
        $("#minute").val(today.getMinutes())

        // When Click toggle sorting
        $("#sorting_date").click(function() {
            if ($("#type_sorting_date").val() == "ASC") {
                $("#icon_sorting_date").attr('class', 'mdi mdi-arrow-down-bold');
                $("#type_sorting_date").val("DESC")
                report_get_table_by_page_number_search($("#current_page").val())
            } else {
                $("#icon_sorting_date").attr('class', 'mdi mdi-arrow-up-bold');
                $("#type_sorting_date").val("ASC")
                report_get_table_by_page_number_search($("#current_page").val())
            }
        })


        // start when click at row on table for display v_detail_report
        $('#report_table tbody').on('click', 'td', function() {
            // declare when click element on row table
            let check_col = $(this).index(),
                check_row = $(this).parent().index();
            // if condition when dont click on btn-delete id button 
            if (check_col != 0 && check_col != 7) {
                // set row  is colunm index 2 for sent display v_detail_report
                let $row = $(this).closest("tr"),
                    $tds = $row.find("td:nth-child(2)")
                // declare code is null string
                let code = ""

                // start loop set code value
                $.each($tds, function() {
                    code = $(this).text()
                })
                code = code.trim()
                // end loop set code value

                // let url = "<?php echo site_url() . "/Case_report_controller_ajax/report_get_detail/" ?>"
                // window.location.href = url + code
            }
        })
        // end when click at row on table for display v_detail_report
    })



    jQuery('#create_report').datepicker({
        todayHighlight: true,
        format: 'dd/mm/yyyy',
    }).datepicker("setDate", 'now');

    function master_data_insert() {
        if ($("#type1").is(":checked") == true) {
            case_status = 1
        } else if ($("#type2").is(":checked") == true) {
            case_status = 2
        }
        let list = $('#list').val()
        let is_active_search = $('#is_active_search').val()
        let date = $('#create_report').val()
        var create_date = parseInt($("#create_report").data('datepicker').getFormattedDate('yyyy') - 543) + $("#create_report").data('datepicker').getFormattedDate('-mm-dd') + ' ' + $("#hour").val() + ':' + $("#minute").val() + ':' + '00'
        let money = $('#money').val()

        if (is_active_search == 0) {
            $('#is_active_search').css("border", "1px solid red");
            $('#is_active_search').focus();
        }

        if (money == '' || money < 1) {
            $('#money').css("border", "1px solid red");
            $('#money').focus();
        }

        if (list == '') {
            $('#list').css("border", "1px solid red");
            $('#list').focus();
        }

        if ($("#type1").is(":checked") == false && $("#type2").is(":checked") == false) {
            $('#validate_type_id').text('กรุณาเลือกประเภทรายรับ - รายจ่าย')
        } else if (money != '' && money > 0 && list != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url() . "/Income_manage_controller/insert_data/" ?>",
                data: {

                    'list_type': case_status,
                    'list_detail': list,
                    'list_category_id': is_active_search,
                    'list_create_date': create_date,
                    'list_cost': money,

                },
                dataType: "text",
                async: false,
                success: function(data) {


                    swal({
                        title: "บันทึกข้อมูลสำเร็จ",
                        text: "ข้อมูลของคุณถูกบันทึกเรียบร้อย",
                        type: "success",
                        confirmButtonText: "ตกลง",
                    })

                    window.location.reload();



                }
            })
        }


    }

    function delete_list(delete_id,cost_list,type_list) {
        swal({
                title: "คุณต้องการลบรายการนี้ใช่หรือไม่",
                text: "ข้อมูลของคุณจะสูญหาย!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: 'red',
                confirmButtonText: "ยืนยัน",
                closeOnConfirm: false,
                cancelButtonText: 'ยกเลิก'
            },

            function(result) {

                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url() . "/Income_manage_controller/delete_list"; ?>",
                        data: {
                            'list_id': delete_id,
                            'list_cost': cost_list,
                            'list_type': type_list,
                        },
                        dataType: 'JSON',
                        async: false,
                       
                        success: function(json_data) {
                            swal({
                                title: "ลบข้อมูลสำเร็จ",
                                text: "ข้อมูลของคุณถูกลบเรียบร้อย",
                                type: "success",
                                confirmButtonText: "ตกลง"
                            })
                            // delete_list();
                            // window.location.reload();
                        }
                    })
                }
            })
    }

    function btn_clear2() {
        document.getElementById('master_data_insert_form').reset()
        window.location.reload();
    }
</script>