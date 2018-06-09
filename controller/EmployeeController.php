<?php
  require_once "../utils/Util.php";
  require_once "../model/Employee.php";

  $cmd = Util::getStr($_REQUEST["cmd"]);
  $result = array();
  $result["success"] = 0;
  $result["error"] = 0 ;

  $obj = array();
  if($cmd == "add")
  {
    $obj["title"] = Util::getStr($_REQUEST["title"]);
    $obj["firstname"] = Util::getStr($_REQUEST["firstname"]);
    $obj["lastname"] = Util::getStr($_REQUEST["lastname"]);
    $obj["position"] = Util::getStr($_REQUEST["position"]);
    $obj["tel"] = Util::getStr($_REQUEST["tel"]);
    $obj["depthead"] = Util::getInt($_REQUEST["depthead"]);
    $obj["dept"] = Util::getInt($_REQUEST["dept"]);
    if(Employee::add($obj))
    {
      $result["success"] = 1;
    }
    else {
      $result["error"] = 1 ;
    }
  }
  else if($cmd == "edit")
  {
    $obj["title"] = Util::getStr($_REQUEST["title"]);
    $obj["firstname"] = Util::getStr($_REQUEST["firstname"]);
    $obj["lastname"] = Util::getStr($_REQUEST["lastname"]);
    $obj["position"] = Util::getStr($_REQUEST["position"]);
    $obj["tel"] = Util::getStr($_REQUEST["tel"]);
    $obj["depthead"] = Util::getInt($_REQUEST["depthead"]);
    $obj["dept"] = Util::getInt($_REQUEST["dept"]);
    $obj["idEmployee"] = Util::getInt($_REQUEST["idEmployee"]);
    if(Employee::update($obj))
    {
      $result["success"] = 1;
    }
    else {
      $result["error"] = 1 ;
    }
  }
  else if($cmd == "delete")
  {
    $obj["idEmployee"] = Util::getInt($_REQUEST["idEmployee"]);
    if(Employee::delete($obj))
    {
      $result["success"] = 1;
    }
    else {
      $result["error"] = 1 ;
    }
  }

  echo json_encode($result);
?>
