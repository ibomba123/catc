<?php
  include_once "../../model/Department.php";
  $cmd = $_REQUEST["cmd"];
  if($cmd=="getDept" || $cmd=="getDeptModal")
  {
    $idDepthead = $_REQUEST["idDepthead"];
    $allDept = Department::getAllDepartment($idDepthead);
    if($cmd=="getDept")
    {
      echo "<option value='0'>ทั้งหมด</option>";
    }
    else if($cmd=="getDeptModal")
    {
      echo "<option value=''>โปรดเลือก</option>";
    }
    if($idDepthead!=0)
    {
      foreach ($allDept as $dept) {
       echo "<option value='".$dept["idDept"]."'>".$dept["name"]."</option>";
      }
    }
  }
?>
