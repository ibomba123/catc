<?php
    require_once 'DBManager.php';
    class Process{
      public static function add($obj)
      {
          $result = false ;
          $sql = "insert into catc_work_process(idOrder,idWork,idProcess,idEmployee) values(?,?,?,?)";
          try {
            $db = DBManager::getConnection();
            $stmn = $db->prepare($sql);
            $stmn->bindParam(1,$obj["idOrder"],PDO::PARAM_INT);
            $stmn->bindParam(2,$obj["idWork"],PDO::PARAM_INT);
            $stmn->bindParam(3,$obj["idProcess"],PDO::PARAM_INT);
            $stmn->bindParam(4,$obj["idEmployee"],PDO::PARAM_INT);
            if($stmn->execute()){
              $result = true ;
            }
          } catch (PDOException $e) {
             print_r($e);
          }
         return $result ;
      }

      public static function delete($obj)
      {
        $result = false ;
        $sql = "delete from catc_work_process where idOrder = ? and idWork = ? and idProcess = ?";
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->bindParam(1,$obj["idOrder"],PDO::PARAM_INT);
          $stmn->bindParam(2,$obj["idWork"],PDO::PARAM_INT);
          $stmn->bindParam(3,$obj["idProcess"],PDO::PARAM_INT);
          if($stmn->execute()){
            $result = true ;
          }
        } catch (PDOException $e) {
           print_r($e);
        }
       return $result ;
      }

      public static function deleteAll($obj)
      {
        $result = false ;
        $sql = "delete from catc_work_process where idOrder = ? and idWork = ?";
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->bindParam(1,$obj["idOrder"],PDO::PARAM_INT);
          $stmn->bindParam(2,$obj["idWork"],PDO::PARAM_INT);
          if($stmn->execute()){
            $result = true ;
          }
        } catch (PDOException $e) {
           print_r($e);
        }
       return $result ;
      }

      public static function deleteByIdOrder($obj)
      {
        $result = false ;
        $sql = "delete from catc_work_process where idOrder = ?";
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->bindParam(1,$obj["idOrder"],PDO::PARAM_INT);
          if($stmn->execute()){
            $result = true ;
          }
        } catch (PDOException $e) {
           print_r($e);
        }
       return $result ;
      }

      public static function getAllProcess($idOrder,$idWork)
      {
        $result = array();
        $sql = "select * from catc_work_process where idOrder = ? and idWork = ?";
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->bindParam(1,$idOrder,PDO::PARAM_INT);
          $stmn->bindParam(2,$idWork,PDO::PARAM_INT);
          $stmn->execute();
          while($row=$stmn->fetch(PDO::FETCH_ASSOC))
          {
            $result[] = $row;
          }
        } catch (PDOException $e) {
          print_r($e);
        }
        return $result ;
      }

      public static function getAllProcessMaster()
      {
        $result = array();
        $sql = "select * from catc_process_master order by idProcess";
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->execute();
          while($row=$stmn->fetch(PDO::FETCH_ASSOC))
          {
            $result[] = $row;
          }
        } catch (PDOException $e) {
          print_r($e);
        }
        return $result ;
      }
    }
?>
