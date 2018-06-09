<?php
  include_once "../../model/Employee.php";
  $cmd = $_REQUEST["cmd"];
  if($cmd=="getAllEmployee")
  {
    $idDepthead = $_REQUEST["idDepthead"];
    $idDept = $_REQUEST["idDept"];
    $allEmployee = Employee::getAllEmployee($idDepthead,$idDept);
    foreach ($allEmployee as $employee) {
      echo "<tr>";
      echo "<td align='center'></td>";
      echo "<td>".$employee["title"]."&nbsp;".$employee["firstname"]."&nbsp;".$employee["lastname"]."</td>";
      echo "<td>".$employee["deptheadname"]."</td>";
      if($employee["deptname"]!=null)
      {
        echo "<td>".$employee["deptname"]."</td>";
      }
      else
      {
        echo "<td> - </td>";
      }
      echo "<td>".$employee["position"]."</td>";
      echo "<td>".$employee["tel"]."</td>";
      echo "<td>";
      ?>
      <button type="button" class="btn btn-default" onclick="editEmployee(this);" aria-label="Left Align"
        data-idemployee="<?=$employee["idEmployee"]?>"
        data-title="<?=$employee["title"]?>"
        data-firstname="<?=$employee["firstname"]?>"
        data-lastname="<?=$employee["lastname"]?>"
        data-position="<?=$employee["position"]?>"
        data-depthead="<?=$employee["depthead"]?>"
        data-dept="<?=$employee["dept"]?>"
        data-tel="<?=$employee["tel"]?>" >
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
      </button> &nbsp;
      <button type="button" class="btn btn-default" onclick="deleteEmployee(this);" aria-label="Left Align" data-idemployee="<?=$employee["idEmployee"]?>">
        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
      </button>
      <?php
      echo "</td>";
      echo "</tr>";
    }

  }
?>
