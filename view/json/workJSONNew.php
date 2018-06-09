<?php
  include_once "../../model/Work.php";
  include_once "../../utils/Util.php";
  $cmd = $_REQUEST["cmd"];
  $idOrder = Util::getInt($_REQUEST["idOrder"]);
  $allWork = Work::getAllWorkById($idOrder);
  $result = array();
  foreach ($allWork as $work) {
    $result["data"][] = $work ;
  }
  echo json_encode($result);
?>
