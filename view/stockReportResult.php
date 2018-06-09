<?php
  include_once '../model/Summary.php';
  //$allWork = Summary::getAllSummary($_REQUEST);
  $monthText = array(
    "00"=>"-",
    "01"=>"มกราคม",
    "02"=>"กุมภาพันธ์",
    "03"=>"มีนาคม",
    "04"=>"เมษายน",
    "05"=>"พฤษภาคม",
    "06"=>"มิถุนายน",
    "07"=>"กรกฎาคม",
    "08"=>"สิงหาคม",
    "09"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม");
  $prepareMonth = Summary::prepareMonth($_REQUEST["month"]);
  $allPeper = Summary::getAllPeper($_REQUEST);
  $total = array();
  //print_r($allPeper);
?>
<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-primary">
      <div class="panel-heading">ข้อมูล</div>
        <div class="panel-body" style="padding: 20px !important;">
          <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="10%"></th>
                    <th width="30%">เดือน</th>
                    <th width="30%">จำนวนงาน</th>
                    <th width="30%">กระดาษที่ใช้</th>
                </tr>
            </thead>
            <tbody id="tbody">
              <?php
                foreach ($prepareMonth as $month) {
                  echo "<tr>";
                  echo "<td></td>";
                  echo "<td>".$monthText[$month]."</td>";
                  $flag = false ;
                  foreach ($allPeper as $peper) {
                    if($peper["month"]==$month)
                    {
                      echo "<td>".number_format($peper["work_count"])."</td>";
                      echo "<td>".number_format(ceil($peper["peper"]))."</td>";
                      $flag = true ;
                      $total["work_count"]+=$peper["work_count"];
                      $total["peper"]+=$peper["peper"];
                    }
                  }
                  if(!$flag)
                  {
                    echo "<td>0</td>";
                    echo "<td>0</td>";
                  }
                  echo "</tr>";
                }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <th>รวม</th>
                <td><?=number_format($total["work_count"])?></td>
                <td><?=number_format(ceil($total["peper"]))?></td>
              </tr>
            </tFoot>
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
      },
      "columnDefs": [
        { "orderable": false, "targets": 0 },
        { "orderable": false, "targets": 1 }
      ]
    });

    table.on( 'order.dt search.dt', function () {
      table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = (i+1)+".";
        });
    }).draw();
  })
</script>
