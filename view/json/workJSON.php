<?php
  include_once "../../model/Work.php";
  include_once "../../utils/Util.php";
  $cmd = $_REQUEST["cmd"];
  $idOrder = Util::getInt($_REQUEST["idOrder"]);
  if($cmd=="getAllWork")
  {
    $allWork = Work::getAllWorkById($idOrder);
    foreach ($allWork as $work) {
      $statusColor = "red" ;
      if($work["idStatus"] == 2){
        $statusColor = "green" ;
      }
      echo "<tr>";
      echo "<td align='center'></td>";
      echo "<td>".$work["topic"]."</td>";
      echo "<td>".$work["worktype_name"]."</td>";
      echo "<td>".$work["amount"]."</td>";
      echo "<td>".$work["page"]."</td>";
      echo "<td>".$work["total"]."</td>";
      echo "<td>".$work["copytype_name"]."</td>";
      echo "<td>".$work["covertype_name"]."</td>";
      echo "<td>".$work["duedate"]."</td>";
      echo "<td><font color='$statusColor'>".$work["status_name"]."</font></td>";
      echo "<td>";
      ?>
      <!-- Single button -->
        <div class="btn-group">
          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <? if($work["idStatus"] == 2) {?>
            <li><a href="javascript:updateWorkStatus(<?=$work["idWork"]?>,1);"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;กำลังดำเนินการ</a></li>
            <?}else{ ?>
            <li><a href="javascript:updateWorkStatus(<?=$work["idWork"]?>,2);"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;เสร็จแล้ว</a></li>
            <?}?>
            <li role="separator" class="divider"></li>
            <li><a href="#"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;อุปกรณ์ที่ใช้ในการจัดพิมพ์ (ยังไม่เสร็จ)</a></li>
            <li><a href="javascript:getProcessModal(<?=$work["idOrder"]?>,<?=$work["idWork"]?>);"><span class="glyphicon glyphicon-scissors" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;กระบวนการในการจัดการพิมพ์</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="javascript:editWork(<?=$work["idOrder"]?>,<?=$work["idWork"]?>)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;แก้ไข</a></li>
            <li><a href="javascript:deleteWork(<?=$work["idOrder"]?>,<?=$work["idWork"]?>);"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;ลบ</a></li>
          </ul>
        </div>
      <?
      echo "</tr>";
    }
  }
?>
