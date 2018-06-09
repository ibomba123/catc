<?php
  require_once "../utils/Util.php";
  require_once "../model/Work.php";
  require_once "../model/Order.php";
  require_once "../model/Process.php";
  $cmd = Util::getStr($_REQUEST["cmd"]);
  $result = array();
  $result["success"] = 1;
  $result["error"] = 0 ;
  $idOrder = Util::getInt($_REQUEST["idOrder"]);
  $idWork = Util::getInt($_REQUEST["idWork"]);
  if($cmd=="getWork")
  {
    $result["work"] = Work::getWorkById($idOrder,$idWork);
  }
  else if($cmd=="add")
  {
    $obj["idOrder"] = $idOrder;
    $obj["workType"] = Util::getStr($_REQUEST["workType"]);
    $obj["topic"] = Util::getStr($_REQUEST["topic"]);
    $obj["amount"] = Util::getInt($_REQUEST["amount"]);
    $obj["page"] = Util::getInt($_REQUEST["page"]);
    $obj["total"] = Util::getInt($_REQUEST["total"]);
    $obj["copyType"] = Util::getInt($_REQUEST["copyType"]);
    $obj["coverType"] = Util::getInt($_REQUEST["coverType"]);
    if($_REQUEST["duedate"]!="")
    {
      $date = Util::getStrDefine($_REQUEST["duedate"],date("Y-m-d"));
      $hour = Util::getStrDefine($_REQUEST["duehour"],date("H"));
      $min = Util::getStrDefine($_REQUEST["duemin"],date("i"));

      $obj["duedate"] = $date." ".$hour.":".$min;
    }
    else {
      $obj["duedate"] = null;
    }
    $result["input"] = $obj ;
    $result["result"] = Work::add($obj);
  }
  else if($cmd=="edit")
  {
    $obj["idOrder"] = $idOrder;
    $obj["idWork"] = $idWork;
    $obj["topic"] = Util::getStr($_REQUEST["topic"]);
    $obj["amount"] = Util::getInt($_REQUEST["amount"]);
    $obj["page"] = Util::getInt($_REQUEST["page"]);
    $obj["total"] = Util::getInt($_REQUEST["total"]);
    $obj["copyType"] = Util::getInt($_REQUEST["copyType"]);
    $obj["coverType"] = Util::getInt($_REQUEST["coverType"]);
    if($_REQUEST["duedate"]!="")
    {
      $date = Util::getStrDefine($_REQUEST["duedate"],date("Y-m-d"));
      $hour = Util::getStrDefine($_REQUEST["duehour"],date("H"));
      $min = Util::getStrDefine($_REQUEST["duemin"],date("i"));

      $obj["duedate"] = $date." ".$hour.":".$min;
    }
    else {
      $obj["duedate"] = null;
    }
    $result["input"] = $obj ;
    $result["result"] = Work::update($obj);
  }
  else if($cmd=="updateStatus")
  {
    $idStatus = Util::getInt($_REQUEST["idStatus"]);
    Work::updateStatus($idOrder,$idWork,$idStatus);
  }
  else if($cmd=="delete")
  {
    $obj = array();
    $obj["idOrder"] = Util::getInt($_REQUEST["idOrder"]);
    $obj["idWork"] = Util::getInt($_REQUEST["idWork"]);
    Process::deleteAll($obj);
    if(Work::delete($obj))
    {
      $result["success"] = 1;
    }
    else {
      $result["error"] = 1 ;
    }
  }
  echo json_encode($result);
?>
