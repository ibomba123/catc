<?php
  include_once '../model/Summary.php';
  $prepareProcess = Summary::prepareProcess($_REQUEST["process"]);
  $prepareWorker = Summary::prepareWorker($_REQUEST["worker"]);
  $allKpi = Summary::getAllKpi($_REQUEST);
  $totalWoker = array();
  $totalProcess = array();
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
                    <th width="20%">พนักงานพิมพ์</th>
                    <?php
                      foreach ($prepareProcess as $process) {
                        echo "<th>".$process["name"]."</th>";
                      }
                    ?>
                    <th>รวม</th>
                </tr>
            </thead>
            <tbody id="tbody">
              <?php
              foreach ($prepareWorker as $worker) {
                echo "<tr>";
                echo "<td></td>";
                echo "<td>".$worker["fullname"]."</td>";
                foreach ($prepareProcess as $process) {
                  $workTotal = 0 ;
                  if($allKpi[$worker["idEmployee"]][$process["idProcess"]]!=null)
                  {
                    $workTotal = $allKpi[$worker["idEmployee"]][$process["idProcess"]] ;
                  }
                  echo "<td>".$workTotal."</td>";
                  $totalWoker[$worker["idEmployee"]]+=$workTotal ;
                  $totalProcess[$process["idProcess"]]+=$workTotal ;
                }
                echo "<td>".$totalWoker[$worker["idEmployee"]]."</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
            <tFoot>
              <tr>
                <th colspan="2">รวม</th>
                <?php
                $summary = 0 ;
                foreach ($prepareProcess as $process) {
                  echo "<td>".$totalProcess[$process["idProcess"]]."</td>";
                  $summary+=$totalProcess[$process["idProcess"]] ;
                }
                echo "<td>".$summary."</td>";
                ?>
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
      }
    });

    table.on( 'order.dt search.dt', function () {
      table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = (i+1)+".";
        });
    }).draw();
  })
</script>
