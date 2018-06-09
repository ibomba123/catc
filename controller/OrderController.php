<?php
  require_once "../utils/Util.php";
  require_once "../model/Work.php";
  require_once "../model/Order.php";
  require_once "../model/Process.php";
  date_default_timezone_set("Asia/Bangkok");
  $cmd = Util::getStr($_REQUEST["cmd"]);
  $result = array();
  $result["success"] = 1;
  $result["error"] = 0 ;
  //$result["request"] = $_REQUEST;
  if($cmd=="add")
  {
    $obj = array();
    $obj["owner"] = Util::getInt($_REQUEST["owner"]);
    $obj["receiver"] = Util::getInt($_REQUEST["receiver"]);
    $obj["comment"] = Util::getStr($_REQUEST["comment"]);
    $obj["idOrderReal"] = Util::getInt($_REQUEST["idOrderReal"]);
    if(Util::getStr($_REQUEST["orderdate"])!="")
    {
      $date = Util::getStrDefine($_REQUEST["orderdate"],date("Y-m-d"));
      $hour = Util::getStrDefine($_REQUEST["orderhour"],date("H"));
      $min = Util::getStrDefine($_REQUEST["ordermin"],date("i"));

      $obj["orderdate"] = $date." ".$hour.":".$min;
    }
    else {
      $obj["orderdate"] = null;
    }
    if(Util::getStr($_REQUEST["originaldate"])!="")
    {
      $date = Util::getStrDefine($_REQUEST["originaldate"],date("Y-m-d"));
      $hour = Util::getStrDefine($_REQUEST["originalhour"],date("H"));
      $min = Util::getStrDefine($_REQUEST["originalmin"],date("i"));

      $obj["originaldate"] = $date." ".$hour.":".$min;
    }
    else {
      $obj["originaldate"] = null;
    }
    $obj["idOrder"] = Order::add($obj);
    if($obj["idOrderReal"] == 0)
    {
      Order::updateRealId($obj["idOrder"],$obj["idOrder"]);
    }
    $type1 = $_REQUEST["type1"];
    $type2 = $_REQUEST["type2"];
    $type3 = $_REQUEST["type3"];
    $type4 = $_REQUEST["type4"];
    $type5 = $_REQUEST["type5"];
    foreach ($type1 as $key => $work) {
      $obj["workType"] = 1 ;
      if(trim($work["topic"]) != "")
      {
        $obj["topic"] = $work["topic"];
        $obj["amount"] = Util::getInt($work["amount"]);
        $obj["page"] = Util::getInt($work["page"]);
        $obj["total"] = Util::getInt($work["total"]);
        $obj["copyType"] = Util::getInt($work["copyType"]);
        $obj["coverType"] = Util::getInt($work["coverType"]);
        $obj["comment"] = Util::getStr($work["comment"]);
        if($work["duedate"]!="")
        {
          $date = Util::getStrDefine($work["duedate"],date("Y-m-d"));
          $hour = Util::getStrDefine($work["duehour"],date("H"));
          $min = Util::getStrDefine($work["duemin"],date("i"));

          $obj["duedate"] = $date." ".$hour.":".$min;
        }
        else {
          $obj["duedate"] = null;
        }
        Work::add($obj);
      }
    }

    foreach ($type2 as $key => $work) {
      $obj["workType"] = 2 ;
      if(trim($work["topic"]) != "")
      {
        $obj["topic"] = $work["topic"];
        $obj["amount"] = Util::getInt($work["amount"]);
        $obj["page"] = Util::getInt($work["page"]);
        $obj["total"] = Util::getInt($work["total"]);
        $obj["copyType"] = Util::getInt($work["copyType"]);
        $obj["coverType"] = Util::getInt($work["coverType"]);
        $obj["comment"] = Util::getStr($work["comment"]);
        if($work["duedate"]!="")
        {
          $date = Util::getStrDefine($work["duedate"],date("Y-m-d"));
          $hour = Util::getStrDefine($work["duehour"],date("H"));
          $min = Util::getStrDefine($work["duemin"],date("i"));

          $obj["duedate"] = $date." ".$hour.":".$min;
        }
        else {
          $obj["duedate"] = null;
        }
        Work::add($obj);
      }
    }

    foreach ($type3 as $key => $work) {
      $obj["workType"] = 3 ;
      if(trim($work["topic"]) != "")
      {
        $obj["topic"] = $work["topic"];
        $obj["amount"] = Util::getInt($work["amount"]);
        $obj["page"] = Util::getInt($work["page"]);
        $obj["total"] = Util::getInt($work["total"]);
        $obj["copyType"] = Util::getInt($work["copyType"]);
        $obj["coverType"] = Util::getInt($work["coverType"]);
        $obj["comment"] = Util::getStr($work["comment"]);
        if($work["duedate"]!="")
        {
          $date = Util::getStrDefine($work["duedate"],date("Y-m-d"));
          $hour = Util::getStrDefine($work["duehour"],date("H"));
          $min = Util::getStrDefine($work["duemin"],date("i"));

          $obj["duedate"] = $date." ".$hour.":".$min;
        }
        else {
          $obj["duedate"] = null;
        }
        Work::add($obj);
      }
    }

    foreach ($type4 as $key => $work) {
      $obj["workType"] = 4 ;
      if(trim($work["topic"]) != "")
      {
        $obj["topic"] = $work["topic"];
        $obj["amount"] = Util::getInt($work["amount"]);
        $obj["page"] = Util::getInt($work["page"]);
        $obj["total"] = Util::getInt($work["total"]);
        $obj["copyType"] = Util::getInt($work["copyType"]);
        $obj["coverType"] = Util::getInt($work["coverType"]);
        $obj["comment"] = Util::getStr($work["comment"]);
        if($work["duedate"]!="")
        {
          $date = Util::getStrDefine($work["duedate"],date("Y-m-d"));
          $hour = Util::getStrDefine($work["duehour"],date("H"));
          $min = Util::getStrDefine($work["duemin"],date("i"));

          $obj["duedate"] = $date." ".$hour.":".$min;
        }
        else {
          $obj["duedate"] = null;
        }
        Work::add($obj);
      }
    }

    foreach ($type5 as $key => $work) {
      $obj["workType"] = 5 ;
      if(trim($work["topic"]) != "")
      {
        $obj["topic"] = $work["topic"];
        $obj["amount"] = Util::getInt($work["amount"]);
        $obj["page"] = Util::getInt($work["page"]);
        $obj["total"] = Util::getInt($work["total"]);
        $obj["copyType"] = Util::getInt($work["copyType"]);
        $obj["coverType"] = Util::getInt($work["coverType"]);
        $obj["comment"] = Util::getStr($work["comment"]);
        if($work["duedate"]!="")
        {
          $date = Util::getStrDefine($work["duedate"],date("Y-m-d"));
          $hour = Util::getStrDefine($work["duehour"],date("H"));
          $min = Util::getStrDefine($work["duemin"],date("i"));

          $obj["duedate"] = $date." ".$hour.":".$min;
        }
        else {
          $obj["duedate"] = null;
        }
        Work::add($obj);
      }
    }
  }
  else if($cmd=="edit")
  {
    $obj = array();
    $obj["idOrder"] = Util::getInt($_REQUEST["idOrder"]);
    $obj["idOrderReal"] = Util::getInt($_REQUEST["idOrderReal"]);
    $obj["owner"] = Util::getInt($_REQUEST["owner"]);
    $obj["receiver"] = Util::getInt($_REQUEST["receiver"]);
    $obj["comment"] = Util::getStr($_REQUEST["comment"]);
    if(Util::getStr($_REQUEST["orderdate"])!="")
    {
      $date = Util::getStrDefine($_REQUEST["orderdate"],date("Y-m-d"));
      $hour = Util::getStrDefine($_REQUEST["orderhour"],date("H"));
      $min = Util::getStrDefine($_REQUEST["ordermin"],date("i"));
      $obj["orderdate"] = $date." ".$hour.":".$min;
    }
    else {
      $obj["orderdate"] = null;
    }

    if(Util::getStr($_REQUEST["originaldate"])!="")
    {
      $date = Util::getStrDefine($_REQUEST["originaldate"],date("Y-m-d"));
      $hour = Util::getStrDefine($_REQUEST["originalhour"],date("H"));
      $min = Util::getStrDefine($_REQUEST["originalmin"],date("i"));

      $obj["originaldate"] = $date." ".$hour.":".$min;
    }
    else {
      $obj["originaldate"] = null;
    }

    Order::update($obj);
    //$result["request"] = $obj;
  }
  else if($cmd=="updateOrderStatus")
  {
    $obj = array();
    $obj["idOrder"] = Util::getInt($_REQUEST["idOrder"]);
    $obj["idStatus"] = Util::getInt($_REQUEST["idStatus"]);
    if(Util::getStr($_REQUEST["finishdate"])!="")
    {
      $date = Util::getStrDefine($_REQUEST["finishdate"],date("Y-m-d"));
      $hour = Util::getStrDefine($_REQUEST["finishhour"],date("H"));
      $min = Util::getStrDefine($_REQUEST["finishmin"],date("i"));
      $obj["finishdate"] = $date." ".$hour.":".$min;
    }
    else {
      $obj["finishdate"] = null;
    }
    Order::updateOrderStatus($obj);
    if($obj["idStatus"] == 2)
    {
      $allWork = Work::getAllWorkById($obj["idOrder"]);
      foreach ($allWork as $work) {
        Work::updateStatus($obj["idOrder"],$work["idWork"],$obj["idStatus"]);
      }
    }
  }
  else if($cmd=="updateReceiver")
  {
    $obj = array();
    $obj["idOrder"] = Util::getInt($_REQUEST["idOrder"]);
    $obj["receiver"] = Util::getInt($_REQUEST["receiver"]);
    if(Util::getStr($_REQUEST["receivedate"])!="")
    {
      $date = Util::getStrDefine($_REQUEST["receivedate"],date("Y-m-d"));
      $hour = Util::getStrDefine($_REQUEST["receivehour"],date("H"));
      $min = Util::getStrDefine($_REQUEST["receivemin"],date("i"));
      $obj["receivedate"] = $date." ".$hour.":".$min;
    }
    else {
      $obj["receivedate"] = null;
    }
    Order::updateReciver($obj);
  }
  else if($cmd=="delete")
  {
    $obj = array();
    $obj["idOrder"] = Util::getInt($_REQUEST["idOrder"]);
    Process::deleteByIdOrder($obj);
    Work::deleteByIdOrder($obj);
    if(Order::delete($obj))
    {
      $result["success"] = 1;
    }
    else {
      $result["error"] = 1 ;
    }
  }
  else if($cmd=="checkIdOrderReal")
  {
    $idOrderReal = Util::getInt($_REQUEST["idOrderReal"]);
    if($idOrderReal > 0)
    {
      $result["order"] = Order::getOrderByIdOrderReal($idOrderReal);
      if($result["order"]!=null)
      {
        $result["exist"] = true ;
      }
      else{
        $result["exist"] = false ;
      }
    }
    else{
      $result["exist"] = false ;
    }
  }

  echo json_encode($result);
?>
