<script>
        // สรุปรายงานตามรายปี
$(document).ready(() => {
    search_summary();
});

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
            console.log(json_data);
            var month = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"]
            if(json_data.summary_list != null){
                let count = 1;
                json_data.summary_list.forEach(function(element) {
                        table.append($('<tr>')
                            .append($('<td>').append("<center>" + count + "</center>"))
                            .append($('<td>').append(month[element.sl_month-1]))
                            .append($('<td>').append("<center>" + element.sl_income + "</center>"))
                            .append($('<td>').append("<center>" + element.sl_expend + "</center>"))
                            .append($('<td>').append("<center>" + element.sl_balance + "</center>"))
                        )
                        count++;
                    })
            }else{
                let text_no_data = '<center><b><p>ไม่มีรายการรายรับ - รายจ่าย</p></b></center>'
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
                                <h2><i class="fa fa-list-alt" style="font-size:30px;"></i>&emsp;สถิติรายรับ-รายจ่าย</h2>
                            </div>
                            <div class="col-md-2">
                                <!-- ----------------------------------------------- start year select -------------------------------------------- -->
                                <div class="form-group">
                                    <label class="col-md-12">ปี : </label>
                                    <div class="col-md-12">
                                        <select class="form-control" id="select_year" onchange="search_summary()">
                                            <?php
                                            if ($years == null) {
                                                echo "<option value=" . date("Y") . ">" . (date("Y") + 543) . "</option>";
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
                    <br>
                    <div class="table-responsive">

                        <!-- ---------------------------------------- start master data table --------------------------------- -->
                        <table id="report_table" class="table table-striped dataTable no-footer display" role="grid" aria-describedby="myTable_info">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width:15%">ลำดับ</th>
                                    <th style="text-align: center; width:25%">เดือน</th>
                                    <th style="text-align: center; width:20%">รายรับ (บาท)</th>
                                    <th style="text-align: center; width:20%">รายจ่าย (บาท)</th>
                                    <th style="text-align: center; width:20%">คงเหลือ (บาท)</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!-- ----------------------------------------- end master data table ---------------------------------- -->

                        <!-- ------------------------------------------ start pagination -------------------------------------- -->
                        <div class="col-md-12">
                            <div class="col-md-4" align="left">
                                <p id="count_of_master_data"></p>
                            </div>
                            <input type="hidden" id="current_page" value="1">
                            <input type="hidden" id="section_page" value="1">
                            <div id="page_option" class="col-md-8" align="right">

                            </div>
                        </div>
                        <!-- ------------------------------------------- end pagination --------------------------------------- -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>