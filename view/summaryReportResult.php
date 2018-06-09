<?php
  include_once '../model/Summary.php';
  $allWork = Summary::getAllSummary($_REQUEST);
  $month = array("-","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
?>
<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-primary">
      <div class="panel-heading">ข้อมูล</div>
        <div class="panel-body" style="padding: 20px !important;">
          <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="5%"></th>
                    <th width="30%">รายการ</th>
                    <th width="10%">ประเภท</th>
                    <th width="15%">สังกัด</th>
                    <th width="15%">แผนก</th>
                    <th width="10%">เดือน</th>
                    <th width="15%">วันรับออเดอร์</th>
                </tr>
            </thead>
            <tbody id="tbody">
              <?php
                foreach ($allWork as $work) {
                  echo "<tr>";
                  echo "<td></td>";
                  echo "<td><a href='?view=workList&idOrder=".$work["idOrder"]."'>".$work["topic"]."</a></td>";
                  echo "<td>".$work["worktype_name"]."</td>";
                  echo "<td>".$work["depthead_name"]."</td>";
                  echo "<td>".$work["dept_name"]."</td>";
                  echo "<td>".$month[$work["month"]]."</td>";
                  echo "<td>".$work["orderdate"]."</td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    var table =  $('#table1').DataTable({
      "order": [],
      "lengthMenu": [ [25,50,100,-1], [25,50,100,"ทั้งหมด"] ],
      "pageLength": -1,
      "language": {
          "emptyTable": "ไม่พบข้อมูล",
          "info": "แสดงทั้งหมด _TOTAL_ รายการ",
          "infoEmpty": "แสดงทั้งหมด 0 รายการ",
          "infoFiltered": "(จากทั้งหมด _MAX_ รายการ)",
          "lengthMenu": "แสดง _MENU_",
          "search": "ค้นหา:",
          "zeroRecords": "ไม่พบข้อมูล",
          "paginate": {
              "previous":"ก่อนหน้า",
              "next": "ถัดไป",
              "last": "หลังสุด",
              "first": "หน้าสุด"
          }
      }
    });

    table.on( 'order.dt search.dt', function () {
      table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = (i+1)+".";
        });
    }).draw();
  })
</script>
