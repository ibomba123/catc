<?php
  require_once "../utils/Util.php";
  require_once "../model/Process.php";
  $cmd = Util::getStr($_REQUEST["cmd"]);
  $result = array();
  $result["success"] = 1;
  $result["error"] = 0 ;
  $idOrder = Util::getInt($_REQUEST["idOrder"]);
  $idWork = Util::getInt($_REQUEST["idWork"]);
  if($cmd=="saveProcess")
  {
    $obj = array(
      "idOrder" => $idOrder ,
      "idWork" => $idWork
    );
    Process::deleteAll($obj);
    $allChkProcess = $_REQUEST["chkProcess"];
    if(count($allChkProcess) > 0)
    {
      foreach ($allChkProcess as $idProcess) {
        $idEmployee = Util::getInt($_REQUEST["employeeProcess".$idProcess]);
        if($idEmployee > 0)
        {
          $obj["idProcess"] = $idProcess;
          $obj["idEmployee"] = $idEmployee;
          Process::add($obj);
        }
      }
    }
  }
  else if($cmd=="getWorkProcess"){
    $result["allWorkProcess"] = Process::getAllProcess($idOrder,$idWork);
  }
  echo json_encode($result);
?>
