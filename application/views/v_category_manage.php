<div id="page-wrapper">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <h2><i class="fa fa-list-alt" style="font-size:40px;"></i>&emsp;รายการประเภทรายรับ-รายจ่าย</h2>
                            </div>
                            <div class="col-md-6" align="right">
                                <br>
                                <!-- --------------------------------------------- start report insert button ------------------------------------------------------ -->
                                <a class="btn btn-info" type="button" data-toggle="modal" data-target="#modal_insert" class="model_img img-responsive">
                                    <span class="btn-label"><i class="mdi mdi-plus-circle "></i></span>เพิ่มประเภทรายรับ-รายจ่าย
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

                            <!-- --------------------------------------------- start report data table ------------------------------------------------------ -->
                            <table id="report_table" class="table table-striped dataTable no-footer display" role="grid" aria-describedby="myTable_info">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; width: 10%"">ลำดับ</th>
                                        <th style=" text-align:center; width: 25%">รายการ</th>
                                        <th style=" text-align:center; width: 15%">ประเภท</th>
                                        <th style="text-align:center; width: 10%"">วันที่บันทึก</th>
                                        <th style=" text-align:center; width: 10%"">วันที่แก้ไขล่าสุด</th>
                                        <th style=" text-align:center; width: 10%"">สถานะ</th>
                                        <th style=" text-align:center; width: 25%"">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>

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
<div id="modal_insert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="btn_clear2();" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title" id="myModalLabel">เพิ่มประเภทรายรับ-รายจ่าย</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="master_data_insert_form" onsubmit='return false'>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">ลำดับ : </label>
                            <div class="col-md-2">
                                <input type="number" class="form-control" id="order_no" minlength="1" maxlength="<?php echo $count; ?>" value="<?php echo $count; ?>" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">

                            <label class="col-md-12">ประเภทรายการ : <span style="color:red;"> * </span></label>

                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <input type="radio" id="type1" name="type">
                                    <label for="female"> รายรับ</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" id="type2" name="type">
                                    <label for="female"> รายจ่าย</label>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <span style="color:red;">
                                    <p for="" id="validate_type_id"></p>
                                </span>
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">ชื่อรายการ : <span style="color:red;"> * </span></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="list" maxlength="100">
                                <span style="color:red;">
                                    <p for="" id="validate_list"></p>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <input type="checkbox" class="js-switch" data-color="#99d683" id="is_active" checked="true" data-switchery="true" style="display: none;">
                            </div>
                            <div class="col-md-10" style="margin-top: 5px" id="label_is_active" align="left">

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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">เเก้ไขประเภทรายรับ-รายจ่าย</h4>
                <input type="radio" id="category_id_edit" name="type" hidden>
            </div>
            <!-- <div class="modal-body"> -->
            <form class="form-horizontal" id="master_data_edit_form" onsubmit='return false'>
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="col-md-12">ประเภทรายการ : <span style="color:red;"> * </span></label>
                        <span style="color:red;">
                            <p for="" id="validate_type_id_edit"></p>
                        </span>
                        <div id="type_category">
                            <div class="col-md-9">
                                <div class="col-md-3">
                                    <input type="radio" id="type1_edit" name="type" value="1">
                                    <label for="female"> รายรับ</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" id="type2_edit" name="type" value="2">
                                    <label for="female"> รายจ่าย</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-12">
                        <label class="col-md-12">ชื่อประเภท : <span style="color:red;"> * </span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="category_name" maxlength="100">
                            <span style="color:red;">
                                <p for="" id="validate_list_edit"></p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <input type="checkbox" class="js-switch" data-color="#99d683" id="is_active_edit" checked="true" data-switchery="true" style="display: none;">
                        </div>
                        <div class="col-md-10" style="margin-top: 5px" id="label_is_active_edit" align="left">

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
                        <button onclick="category_data_update(); " class="btn btn-success" type="button"><span class="btn-label"><i class="fa fa-save"></i></span>บันทึก</button>
                        <!-- ----------------------- End ส่งข้อมูล input ----------------------- -->
                    </div>
                </div>
            </form>
            <!-- </div> -->
        </div>
    </div>
</div>
<!-- --------------------------------------------- start modal master data insert  --------------------------------------------- -->

<!-- ---------------------------------------------- end modal master data insert  ---------------------------------------------- -->
<script>
    $(document).ready(() => {
        report_get_table_by_page_number_search(1);



        $("#list").change(function() {
            if ($('#list').val().trim() == '') {
                $('#list').css("border", "1px solid red");
                $('#list').focus();
                $('#validate_list').text('กรุณากรอกชื่อรายการ')
            } else {
                $('#list').css("border", "");
                $('#validate_list').text('')
            }
        });

        $("#category_name").change(function() {
            if ($('#category_name').val().trim() == '') {
                $('#category_name').css("border", "1px solid red");
                $('#category_name').focus();
                $('#validate_list_edit').text('กรุณากรอกชื่อรายการ')
            } else {
                $('#category_name').css("border", "");
                $('#validate_list_edit').text('')
            }
        });



        var today = new Date();
        // set input id hour = current hour
        $("#hour").val(today.getHours())
        // set input id minute = current minute
        $("#minute").val(today.getMinutes())

        // When Click toggle sorting
        $("#sorting_date").on(function() {
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

        // call report_get_table function


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

        $("#btn_search").on("click", () => {
            report_get_table_by_page_number_search(1)
        })

        $("#label_is_active").append('<p>ใช้งาน</p>')

        $("#is_active").on("change", () => {
            $("#label_is_active").empty()
            if ($("#is_active").prop('checked')) {
                $("#label_is_active").append('<p>ใช้งาน</p>')
            } else {
                $("#label_is_active").append('<p>ไม่ใช้งาน</p>')
            }
        })

        $("#label_is_active_edit").append('<p>ใช้งาน</p>')

        $("#is_active_edit").on("change", () => {
            $("#label_is_active_edit").empty()
            if ($("#is_active_edit").prop('checked')) {
                $("#label_is_active_edit").append('<p>ใช้งาน</p>')
            } else {
                $("#label_is_active_edit").append('<p>ไม่ใช้งาน</p>')
            }
        })


    })

    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'))
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data())
        })
    })

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
            url: "<?php echo site_url() . "/Category_manage_controller/show_category_data/" ?>",
            data: {},
            dataType: 'JSON',
            async: false,
            success: function(json_data) {
                console.log(json_data)
                let count_data = 0
                let num = 1
                var date_modify;
                let btn_edit = '<a data-toggle="modal" data-target="#modal_edit" onclick=" "  type="button" class="btn btn-warning btn-circle" title="แก้ไข" ><i class="fa fa-pencil "></i></a >';
                let btn_delete = '<a onclick=" "  type="button" class="btn btn-danger btn-circle"><i class="fa fa-minus-circle " title="ลบ"></i></a >';

                if (json_data.rs_all.length > 0) {
                    // start loop foreach display case's data on table
                    json_data.rs_all.forEach(function(element) {
                        var status;

                        if (element.date_modify == "0000-00-00") {
                            date_modify = "-";
                        } else {
                            date_modify = element.date_modify;
                        }
                        if (element.category_type == 1) {
                            status = "รายรับ";
                        } else {
                            status = "รายจ่าย";
                        }
                        if (element.category_status == 1) {
                            is_active = "ใช้งาน"
                        } else {
                            is_active = "ไม่ใช้งาน"
                        }
                        let btn_edit = '<a data-toggle="modal" data-target="#modal_edit" onclick="master_data_edit(' + element.category_id + ')"  type="button" class="btn btn-warning btn-circle" title="แก้ไข" ><i class="fa fa-pencil "></i></a >';
                        let btn_delete = '<a onclick="delete_category(' + element.category_id + ')"  type="button" class="btn btn-danger btn-circle"><i class="fa fa-minus-circle " title="ลบ"></i></a >';
                        table.append($('<tr>')
                            .append($('<td>').append("<center>" + num + "</center>"))
                            .append($('<td>').append(element.category_name))
                            .append($('<td>').append("<center>" + status + "<center>"))
                            .append($('<td>').append("<center>" + element.date_create + "</center>"))
                            .append($('<td>').append("<center>" + date_modify + "</center>"))
                            .append($('<td>').append("<center>" + is_active + "</center>"))
                            .append($('<td>').append("<center>" + btn_edit + ' ' + btn_delete + "</center>"))
                        )
                        count_data++
                        num++
                    })
                    // end loop foreach display case's data on table
                    // console.log(table);
                    //--------------------------------  start declare count number pagination -------------------------------------------------
                    let count_section_page = $("#section_page").val()
                    let current_page = $("#current_page").val()
                    // alert(json_data.count_question)
                    let max_page = json_data.rs_count[0].count_category / 10
                    if (json_data.rs_count[0].count_category % 10 != 0) {
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
                    $("#count_of_master_data").text("แสดง " + count_data + " ข้อมูล จาก " + json_data.rs_count[0].count_category + " ข้อมูล")
                    for (count = count_loop; count <= max_page; count++) {

                        if (count <= count_section_page * 10) {
                            if (current_page == count) {
                                page.append('<a style="color:#0000FF; font-weight:bold" href="javascript:report_get_table_by_page_number_search(' + count + ')">&emsp;' + 1 + '&emsp;</a>')
                            } else {
                                page.append('<a style="color:black; " href="javascript:report_get_table_by_page_number_search(' + count + ')">&emsp;' + count + '&emsp;</a>')
                            }

                        }
                    }
                    page.append('<a style="color:black; " href="javascript:report_search_page_next(' + max_page + ')">&emsp;>&emsp;</a>')
                    page.append('<a style="color:black; " href="javascript:report_search_last_page(' + max_page + ')">&emsp;| >&emsp;</a>')
                } else {
                    let text_no_data = '<center><b><p>ไม่มีรายการแบบทดสอบ</p></b></center>'
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

    jQuery('#create_report').datepicker({
        todayHighlight: true,
        format: 'dd/mm/yyyy',
    }).datepicker("setDate", 'now');



    function master_data_edit(id) {
        var category_id = id;
        try {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url() . "/Category_manage_controller/category_edit/" ?>",
                data: {
                    'category_id': category_id
                },
                dataType: "json",
                async: false,
                success: function(json_data) {
                    console.log(json_data)
                    $('#category_id_edit').val(json_data[0].category_id)
                    if ((json_data[0].category_type) == "1") {
                        $("#type1_edit").prop('checked', false).trigger("click")
                    } else {
                        $("#type2_edit").prop('checked', true).trigger("click")
                    }
                    $('#category_name').val(json_data[0].category_name)

                    if ((json_data[0].category_status) == "1") {
                        $("#is_active_edit").prop('checked', false).trigger("click")
                    } else {
                        $("#is_active_edit").prop('checked', true).trigger("click")
                    }
                }
            })
        } catch (e) {
            // alert when can't edit 
            swal({
                title: "แก้ไขข้อมูลไม่สำเร็จ",
                text: "ข้อมูลของคุณไม่ได้ถูกแก้ไข",
                type: "error",
                confirmButtonText: "ตกลง"
            })
        }
        // end try catch 
    }

    function category_data_update() {

        // let category_id_edit = $('#category_id_edit').val()
        let category_id = $('#category_id_edit').val()
        let category_detail = $('#category_name').val()
        let category_types = $('input[name=type]:checked', '#type_category').val()
        let is_active = $('#is_active_edit').is(":checked")
        if (is_active == true) {
            is_active = 1
        } else {
            is_active = 0
        }

        if ($('#category_name').val().trim() == '') {
            $('#category_name').css("border", "1px solid red");
            $('#category_name').focus();
            $('#validate_list_edit').text('กรุณากรอกจำนวนเงิน')
        } else {
            $('#category_name').css("border", "");
            $('#validate_list_edit').text('')
        }
        // alert(category_detail)

        $.ajax({
            type: "POST",
            url: "<?php echo site_url() . "/Category_manage_controller/category_update/" ?>",
            data: {

                'category_id': category_id,
                'category_name': category_detail,
                'category_type': category_types,
                'is_active': is_active

            },
            dataType: "json",
            async: false,
            success: function(data) {

                if (data == true) {
                    $('#modal_edit').modal('toggle')
                    // notify alert when update success
                    swal({
                        title: "แก้ไขข้อมูลสำเร็จ",
                        text: "ข้อมูลของคุณถูกแก้ไขเรียบร้อย",
                        type: "success",
                        confirmButtonText: "ตกลง"
                    })
                    window.location.reload();

                } else {
                    // notify alert when update unsuccess
                    swal({
                        title: "แก้ไขข้อมูลไม่สำเร็จ",
                        type: "error",
                        confirmButtonText: "ตกลง"
                    })

                }
            }
        });

    }

    function delete_category(delete_category_id) {
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
                        url: "<?php echo site_url() . "/Category_manage_controller/category_delete"; ?>",
                        data: {
                            'category_id': delete_category_id
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


                        }
                    })
                }
                window.location.reload();
            }
        )
    }


    function btn_clear2() {
        document.getElementById('master_data_insert_form').reset()
        window.location.reload();
    }


    function master_data_insert() {

        if ($("#type1").is(":checked") == true) {
            category_tpye = 1
        } else if ($("#type2").is(":checked") == true) {
            category_tpye = 2
        }

        let category_name = $('#list').val()
        let category_seq = $('#order_no').val()

        let is_active = $('#is_active').is(":checked")
        if (is_active == true) {
            is_active = 1
        } else {
            is_active = 2
        }

        if ($('#list').val().trim() == '') {
            $('#list').css("border", "1px solid red");
            $('#list').focus();
            $('#validate_list').text('กรุณากรอกจำนวนเงิน')
        } else {
            $('#list').css("border", "");
            $('#validate_list').text('')
        }

        if ($("#type1").is(":checked") == false && $("#type2").is(":checked") == false) {
            $('#validate_type_id').text('กรุณาเลือกประเภทรายรับ - รายจ่าย')
        } else if (category_name != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url() . "/Category_manage_controller/category_insert/" ?>",
                data: {

                    'category_name': category_name,
                    'category_tpye': category_tpye,
                    'category_seq': category_seq,
                    'is_active': is_active

                },
                dataType: 'JSON',
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
</script>