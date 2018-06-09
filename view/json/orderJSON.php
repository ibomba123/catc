<?php
  include_once "../../model/Order.php";
  $cmd = $_REQUEST["cmd"];
  if($cmd=="getAllOrder")
  {
    $allOrder = Order::getAllOrder();
    foreach ($allOrder as $order) {
      echo "<tr>";
      echo "<td align='center'></td>";
      echo "<td><a target='_blank' href='?view=workList&idOrder=".$order["idOrder"]."'>ใบงานที่ ".$order["idOrderReal"]."</a><span class='hide'>".$order["allWork"]."</span></td>";
      echo "<td align='center'>".$order["totalWork"]."</td>";
      echo "<td>".$order["own_name"]."</td>";
      echo "<td>".$order["depthead_name"]."</td>";
      echo "<td>".$order["dept_name"]."</td>";
      echo "<td>".$order["orderdate"]."</td>";
      echo "<td>";
      if($order["status"]==1)
      {
        echo "<font color='green' size='4' class='glyphicon glyphicon-ok-circle' aria-hidden='true'></font>";
        echo "&nbsp;";
        echo "<font color='green' size='3'>เสร็จแล้ว</font>";
      }
      else{
        echo "<font color='red' size='4' class='glyphicon glyphicon-remove-circle' aria-hidden='true'></font>";
        echo "&nbsp;";
        echo "<font color='red' size='3'>ยังไม่เสร็จ</font>";
      }
      echo "</td>";
      echo "<td>";
      ?>
      <button type="button" class="btn btn-default" onclick="deleteOrder(this);" aria-label="Left Align" data-idorder="<?=$order["idOrder"]?>">
        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
      </button>
      <?php
      echo "</td>";
      echo "</tr>";
    }
  }
?>
