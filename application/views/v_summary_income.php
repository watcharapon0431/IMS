<script>
    // สรุปรายงานตามรายปี
    $(document).ready(() => {

        search_summary()

        // start when click at row on table 
        $('#report_table tbody').on('click', 'td', function() {
            // declare when click element on row table
            let check_col = $(this).index()
            let check_row = $(this).parent().index()
            let $row = $(this).closest("tr")
            let $tds = $row.find("td:nth-child(1)")
            let month = ''

            // start loop set txt value
            $.each($tds, function() {
                month = $(this).text()
            })
            month = month.trim()
            // end loop set txt value

            // url is string website
            if (month != 'ไม่มีรายการสถิติรายรับ - รายจ่าย') {
                let url = "<?php echo site_url() . " " ?>"
                // link to url and sent parameter
                // window.location.href = url + txt
                console.log(month, $('#select_year').val());
                let year = $('#select_year').val()
                var table = $('#detail_table tbody');
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url() . "/Income_manage_controller/get_detail_list/"; ?>",
                    data: {
                        'year': year,
                        'month': month
                    },
                    dataType: 'JSON',
                    async: false,
                    success: function(json_data) {
                        toggle_modal();
                        console.log(json_data);
                        if (json_data.list != null) {
                            $('#detail_table').find('td').remove();
                            var total = 0;
                            var income = 0;
                            var expend = 0;
                            count = 1;
                            json_data.list.forEach(function(element) {
                                if (element.category_type == 1) {
                                    total = total + parseFloat(element.list_cost); // คงเหลือ
                                    income = income + parseFloat(element.list_cost); // ผลรวมรายรับ
                                    table.append($('<tr>')
                                        .append($('<td>').append("<center>" + count++ + "</center>"))
                                        .append($('<td>').append(element.category_name))
                                        .append($('<td>').append("<center>" + element.list_cost + "</center>"))
                                        .append($('<td>').append("<center>-</center>"))
                                        .append($('<td>').append("<center>" + total + "</center>"))
                                    )
                                } else if (element.category_type == 2) {
                                    total = total - parseFloat(element.list_cost); // คงเหลือ
                                    expend = expend + parseFloat(element.list_cost); // ผลรวมรายจ่าย
                                    table.append($('<tr>')
                                        .append($('<td>').append("<center>" + count++ + "</center>"))
                                        .append($('<td>').append(element.category_name))
                                        .append($('<td>').append("<center>-</center>"))
                                        .append($('<td>').append("<center>" + element.list_cost + "</center>"))
                                        .append($('<td>').append("<center>" + total + "</center>"))
                                    )
                                }
                            })
                            table.append($('<tr>')
                                .append($('<td>').append("<center>สรุป</center>"))
                                .append($('<td>').append(""))
                                .append($('<td>').append("<center>" + income + "</center>"))
                                .append($('<td>').append("<center>" + expend + "</center>"))
                                .append($('<td>').append("<center>" + total + "</center>"))
                            )
                        } else {
                            $('#detail_table').find('td').remove();
                            let text_no_data = '<center><b><p>ไม่มีรายการรายรับ - รายจ่าย</p></b></center>'
                            table.append($('<tr>').append('<td colspan="8">' + text_no_data + '</td>'))
                        }
                    }
                })
            }
        })
        // end when click at row on table 
    });

    function toggle_modal() {
        $("#modal_summary").modal("toggle");
    }

    function search_summary() {
        var table = $('#report_table tbody');
        let year = $('#select_year').val()
        $.ajax({
            type: "POST",
            url: "<?php echo site_url() . "/Income_manage_controller/get_summary_list/"; ?>",
            data: {
                'year': year,
            },
            dataType: 'JSON',
            async: false,
            success: function(json_data) {
                var month = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"]
                if (json_data.summary_list != null) {
                    $('#report_table').find('td').remove();

                    count = 1;
                    json_data.summary_list.forEach(function(element) {
                        table.append($('<tr>')
                            .append($('<td hidden>').append("<center>" + element.sl_month + "</center>"))
                            .append($('<td>').append("<center>" + count++ + "</center>"))
                            .append($('<td>').append(month[element.sl_month - 1]))
                            .append($('<td>').append("<center>" + element.sl_income + "</center>"))
                            .append($('<td>').append("<center>" + element.sl_expend + "</center>"))
                            .append($('<td>').append("<center>" + element.sl_balance + "</center>"))
                        )
                    })
                } else {
                    $('#report_table').find('td').remove();
                    let text_no_data = '<center><b><p>ไม่มีรายการสถิติรายรับ - รายจ่าย</p></b></center>'
                    table.append($('<tr>').append('<td colspan="8">' + text_no_data + '</td>'))
                }
            }
        })
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
                                <h2><i class="fa fa-list-alt" style="font-size:40px;"></i>&emsp;สถิติรายรับ-รายจ่าย</h2>
                            </div>
                            <div class="col-md-2">
                                <!-- ----------------------------------------------- start year select -------------------------------------------- -->
                                <div class="form-group">
                                    <label class="col-md-12">ปี : </label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="select_year" onchange="search_summary()">
                                            <?php
                                            if ($years == null) {
                                                echo "<option value=" . date("Y") . ">" . (date("Y")) . "</option>";
                                            } else {
                                                foreach ($years as $value) {
                                                    $years = $value->sl_year + 543;
                                                    echo "<option value='$value->sl_year'>$years</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- ------------------------------------------------ end year select --------------------------------------------- -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="white-box">
                    <div class="table-responsive">

                        <!-- ---------------------------------------- start master data table --------------------------------- -->
                        <table id="report_table" class="table table-striped dataTable no-footer display" role="grid" aria-describedby="myTable_info">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width:15%">ลำดับ</th>
                                    <th style="text-align: center; width:25%">เดือน</th>
                                    <th style="text-align: center; width:20%">รายรับ</th>
                                    <th style="text-align: center; width:20%">รายจ่าย</th>
                                    <th style="text-align: center; width:20%">คงเหลือ</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!-- ----------------------------------------- end master data table ---------------------------------- -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_summary" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button onclick="toggle_modal();" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title" id="myModalLabel">รายละเอียดสถิติ-รายรับรายจ่าย</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">

                    <!-- ---------------------------------------- start master data table --------------------------------- -->
                    <table id="detail_table" class="table table-striped dataTable no-footer display" role="grid" aria-describedby="myTable_info">
                        <thead>
                            <tr>
                                <th style="text-align: center; width:15%">ลำดับ</th>
                                <th style="text-align: center; width:25%">ประเภทรายการ</th>
                                <th style="text-align: center; width:20%">รายรับ</th>
                                <th style="text-align: center; width:20%">รายจ่าย</th>
                                <th style="text-align: center; width:20%">คงเหลือ</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <!-- ----------------------------------------- end master data table ---------------------------------- -->

                </div>
            </div>
        </div>
    </div>
</div>