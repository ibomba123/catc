<?php
  require_once 'DBManager.php';
  class Master{
    public static function getAllProcess()
    {
      $result = array();
      $sql = "select * from catc_process_master";
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->execute();
          while($row=$stmn->fetch(PDO::FETCH_ASSOC))
          {
            $result[] = $row ;
          }
        } catch (PDOException $e) {
           print_r($e);
        }
       return $result ;
    }

    public static function getAllWorkType()
    {
      $result = array();
      $sql = "select * from catc_worktype_master";
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->execute();
          while($row=$stmn->fetch(PDO::FETCH_ASSOC))
          {
            $result[] = $row ;
          }
        } catch (PDOException $e) {
           print_r($e);
        }
       return $result ;
    }

  }
?>
