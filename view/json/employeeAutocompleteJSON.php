<?php
  header('Content-Type: application/json');
  include_once "../../model/Employee.php";
  $allEmployee = Employee::getAllEmployeeAutoComplete();
  echo json_encode($allEmployee);
?>
