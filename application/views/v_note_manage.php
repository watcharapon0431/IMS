<script>
    $(document).ready(() => {
        report_get_table_by_page_number_search(1);

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

    function delete_note(delete_note_id) {
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
                        url: "<?php echo site_url() . "/Note_manage_controller/note_delete"; ?>",
                        data: {
                            'note_id': delete_note_id
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

    function report_get_table_by_page_number_search(page_number) {
        let table = $("#report_table tbody")
        let page = $("#page_option")

        table.empty()
        page.empty()

        let count_of_master_data = $("#count_of_master_data")
        count_of_master_data.empty()

        $('#current_page').val(page_number)
        // // start ajax form
        $.ajax({
            type: "POST",
            url: "<?php echo site_url() . "/Note_manage_controller/show_note_data/" ?>",
            data: {},
            dataType: 'JSON',
            async: false,
            success: function(json_data) {
                console.log(json_data)
                let count = json_data.rs_count[0].count
                let count_data = 0
                let num = 1
                let date_modify;
                
                let btn_delete = '<a onclick=" "  type="button" class="btn btn-danger btn-circle"><i class="fa fa-minus-circle " title="ลบ"  onclick="delete_note(' + element.note_id + ')" ></i></a >';

                if (json_data.rs_all.length > 0) {
                    // start loop foreach display case's data on table
                    json_data.rs_all.forEach(function(element) {
                        let btn_edit = '<a data-toggle="modal" data-target="#modal_edit" onclick="master_data_edit(' + element.note_id + ')" type="button" class="btn btn-warning btn-circle" title="แก้ไข"><i class="fa fa-pencil "></i></a >';
                        table.append($('<tr>')
                            .append($('<td>').append("<center>" + num + "</center>"))
                            .append($('<td>').append(element.note_to_do_list))
                            .append($('<td>').append("<center>" + element.Day + ' ' + element.Month + ' ' + element.year + "</center>"))
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
                    let max_page = count / 10
                    if (count % 10 != 0) {
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
                    $("#count_of_master_data").text("แสดง " + count_data + " ข้อมูล จาก " + count + " ข้อมูล")
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
                    let text_no_data = '<center><b><p>ไม่มีรายการแบบทดสอบ</p></b></center>'
                    table.append($('<tr>').append('<td colspan="8">' + text_no_data + '</td>'))
                }
                // end if condition when have case's data equal or more than 1 data
            }
        })
        // end ajax form
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

    function delete_list(delete_id, cost_list, type_list) {
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
                window.location.reload();
            }
        )

    }

    function master_data_edit(id) {
        var note_id = id;

        $.ajax({
            type: "POST",
            url: "<?php echo site_url() . "/Note_manage_controller/note_edit/" ?>",
            data: {
                'note_id': note_id
            },
            dataType: "json",
            async: false,
            success: function(json_data) {
                if ((json_data[0].note_type) == "1") {
                    $("#type1_edit").prop('checked', false).trigger("click")
                } else {
                    $("#type2_edit").prop('checked', true).trigger("click")
                }
                $('#note_edit').val(json_data[0].note_to_do_list)
                $('#note_id_edit').val(json_data[0].note_id)
                var hour = moment(json_data[0].note_create_date, 'YYYY-MM-DD h:m:s').format('HH');
                var minute = moment(json_data[0].note_create_date, 'YYYY-MM-DD h:m:s').format('mm');

                if (hour[0] == 0) {
                    var hour_edit = (hour * 10) / 10

                    $('#hour_edit option[value=' + hour_edit + ']').attr('selected', 'selected');
                } else {
                    $('#hour_edit option[value=' + hour + ']').attr('selected', 'selected');
                }

                if (minute[0] == 0) {
                    var minute_edit = (minute * 10) / 10
                    $('#minute_edit option[value=' + minute_edit + ']').attr('selected', 'selected');

                } else {
                    $('#minute_edit option[value=' + minute + ']').attr('selected', 'selected');
                }

                var today = new Date();
                const dateTime = json_data[0].note_create_date;
                const parts = dateTime.split(/[- :]/);
                const wanted = `${parts[2]}/${parts[1]}/${parts[0]}`;
                $('#create_note_edit').val(wanted)

            }
        })

        // end try catch 
    }
    function note_data_update() {
   
        let note_id_edit = $('#note_id_edit').val()
        let note_edit = $('#note_edit').val()
        alert(note_id_edit)

        let hour_edit = $('#hour_edit').val()
        let minute_edit = $('#minute_edit').val()

        let create_note_edit = parseInt($("#create_note_edit").data('datepicker').getFormattedDate('yyyy') - 543) + $("#create_note_edit").data('datepicker').getFormattedDate('-mm-dd') 
        let note_type = $('input[name=type]:checked', '#type_note').val()

        if (note_edit != '') {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url() . "/Note_manage_controller/note_update/" ?>",
            data: {
                'note_id_edit': note_id_edit,
                'note_edit': note_edit,
                'create_note_edit': create_note_edit,
                'note_type': note_type,

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
        } else {
            swal({
                title: "แก้ไขข้อมูลไม่สำเร็จ",
                text: "กรุณากรอกข้อมูลที่สำคัญให้ครบ",
                type: "error",
                confirmButtonText: "ตกลง"
            })
        }
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
                            <div class="col-md-6">
                                <h2><i class="fa fa-list-alt" style="font-size:40px;"></i>&emsp;รายการบันทึกช่วยจำ</h2>
                            </div>
                            <div class="col-md-6" align="right">
                                <br>
                                <!-- --------------------------------------------- start report insert button ------------------------------------------------------ -->
                                <a class="btn btn-info" type="button" data-toggle="modal" data-target="#modal_insert" class="model_img img-responsive">
                                    <span class="btn-label"><i class="mdi mdi-plus-circle "></i></span>เพิ่มบันทึกช่วยจำ
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
                                        <th style=" text-align:center; width: 30%">รายการ</th>
                                        <th style="text-align:center; width: 20%"">วันที่</th>
                                        <th style=" text-align:center; width: 20%"">ดำเนินการ</th>
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
                <h4 class="modal-title" id="myModalLabel">เพิ่มบันทึกช่วยจำ</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="master_data_insert_form" onsubmit='return false'>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">ประเภทการแจ้งเตือน : <span style="color:red;"> * </span></label>
                            <span style="color:red;">
                                <p for="" id="validate_type_id"></p>
                            </span>
                            <!-- <div class="col-md-8"> -->
                                <div class="col-md-3">
                                    <input type="radio" id="type1" name="type"checked >
                                    <label for="female"> ครั้งเดียว</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" id="type2" name="type" >
                                    <label for="female"> ประจำทุกเดือน</label>
                                </div>
                            <!-- </div> -->
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">ชื่อบันทึกช่วยจำ : <span style="color:red;"> * </span></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="note" maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">วันที่ต้องการดำเนินการ : <span class="help"> *</span></label>
                            <!-- <label class="col-md-5">เวลา : <span class="help" type = "hidden"> * </span></label> -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="create_report" value="" placeholder="วัน/เดือน/ปี"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                    <!-- ----------------------- Start date validate ----------------------- -->
                                    <span style="color:red;">
                                        <p for="" id="validate_create_report"></p>
                                    </span>
                                    <!-- ----------------------- End date validate ----------------------- -->
                                </div>
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
                <button onclick="" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title" id="myModalLabel">เเก้ไขบันทึกช่วยจำ</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="master_data_edit_form" onsubmit='return false'>
                    <input type="hidden" class="form-control" id="note_id_edit" maxlength="100">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">รายการประเภทการเเจ้งเตือน : <span style="color:red;"> * </span>
                            </label>
                            <span style="color:red;">
                                <p for="" id="validate_type_id_edit"></p>
                            </span>
                            <div id="type_note">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <input type="radio" id="type1_edit" name="type" value="1">
                                        <label for="female">ครั้งเดียว</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" id="type2_edit" name="type" value="2">
                                        <label for="female">ประจำทุกเดือน</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">ชื่อบันทึกช่วยจำ : <span style="color:red;"> * </span></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="note_edit" maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="col-md-12">วันที่ต้องการดำเนินการ : <span class="help"> *</span></label>
                           
                            <div class="col-md-5">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="create_note_edit" value="" placeholder="วัน/เดือน/ปี"> <span class="input-group-addon"><i class="icon-calender"></i></span>
                                    <!-- ----------------------- Start date validate ----------------------- -->

                                    <!-- ----------------------- End date validate ----------------------- -->
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="col-md-12" align="center">
                            <!-- ----------------------- start ยกเลิก submit ----------------------- -->
                            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><span class="btn-label"><i class="fa fa-times"></i></span>ยกเลิก</button>
                            <!-- ----------------------- End ยกเลิก submit ----------------------- -->
                            &nbsp;&nbsp;&nbsp;
                            <!-- ----------------------- start ส่งข้อมูล input ----------------------- -->
                            <button onclick="note_data_update(); " class="btn btn-success" type="button"><span class="btn-label"><i class="fa fa-save"></i></span>บันทึก</button>
                            <!-- ----------------------- End ส่งข้อมูล input ----------------------- -->
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('#create_report').datepicker({
        todayHighlight: true,
        format: 'dd/mm/yyyy',
    }).datepicker("setDate", 'now');

    jQuery('#create_note_edit').datepicker({
        todayHighlight: true,
        format: 'dd/mm/yyyy',
    }).datepicker("setDate", 'now');

    function master_data_insert() {
        let note = $('#note').val()
        // let is_active_search = $('#category_id').val()
        let date = $('#create_report').val()
        var create_date = parseInt($("#create_report").data('datepicker').getFormattedDate('yyyy') - 543) + $("#create_report").data('datepicker').getFormattedDate('-mm-dd') + ' ' + $("#hour").val() + ':' + $("#minute").val() + ':' + '00'
        //  let user_id = $('#user').val()
        if ($("#type1").is(":checked") == true) {
            note_status = 1
        } else if ($("#type2").is(":checked") == true) {
            note_status = 2
        }
        if (note == '') {
            $('#note').css("border", "1px solid red");
            $('#note').focus();
        }
        if ($("#type1").is(":checked") == false && $("#type2").is(":checked") == false) {
            $('#validate_type_id').text('กรุณาเลือกประเภทการแจ้งเตือน')
        } else if (note != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url() . "/Note_manage_controller/insert_data/" ?>",
                data: {

                    'note_to_do_list': note,
                    'note_type': note_status,
                    'note_create_date': create_date,
                    // 'note_user_id':user_id

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
                    // btn_clear_modal();



                }
            })
        }


    }

    function btn_clear2() {
        document.getElementById('master_data_insert_form').reset()
        window.location.reload();
    }
</script>
</div>