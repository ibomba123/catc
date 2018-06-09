<?php
  require_once 'DBManager.php';
  class Work{
    public static function add($obj)
    {
      $result = false ;
      $sql = "insert into catc_work(idOrder,topic,amount,page,total,copyType,coverType,workType,duedate) values(?,?,?,?,?,?,?,?,?)";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$obj["idOrder"],PDO::PARAM_INT);
        $stmn->bindParam(2,$obj["topic"],PDO::PARAM_STR);
        $stmn->bindParam(3,$obj["amount"],PDO::PARAM_INT);
        $stmn->bindParam(4,$obj["page"],PDO::PARAM_INT);
        $stmn->bindParam(5,$obj["total"],PDO::PARAM_INT);
        $stmn->bindParam(6,$obj["copyType"],PDO::PARAM_INT);
        $stmn->bindParam(7,$obj["coverType"],PDO::PARAM_INT);
        $stmn->bindParam(8,$obj["workType"],PDO::PARAM_INT);
        $stmn->bindParam(9,$obj["duedate"],PDO::PARAM_STR);
        if($stmn->execute()){
          $result = true ;
        }
      } catch (PDOException $e) {
         print_r($e);
      }
     return $result ;
    }

    public static function update($obj)
    {
      $result = false ;
      $sql = "update catc_work set topic = ? , amount = ?
      , page = ? , total = ? , copyType = ? , coverType = ? , duedate = ? where idWork = ? and idOrder = ?";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$obj["topic"],PDO::PARAM_STR);
        $stmn->bindParam(2,$obj["amount"],PDO::PARAM_INT);
        $stmn->bindParam(3,$obj["page"],PDO::PARAM_INT);
        $stmn->bindParam(4,$obj["total"],PDO::PARAM_INT);
        $stmn->bindParam(5,$obj["copyType"],PDO::PARAM_INT);
        $stmn->bindParam(6,$obj["coverType"],PDO::PARAM_INT);
        $stmn->bindParam(7,$obj["duedate"],PDO::PARAM_STR);
        $stmn->bindParam(8,$obj["idWork"],PDO::PARAM_INT);
        $stmn->bindParam(9,$obj["idOrder"],PDO::PARAM_INT);
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
      $sql = "delete from catc_work where idWork = ? and idOrder = ?";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$obj["idWork"],PDO::PARAM_INT);
        $stmn->bindParam(2,$obj["idOrder"],PDO::PARAM_INT);
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
      $sql = "delete from catc_work where idOrder = ?";
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

    public static function getAllWorkById($idOrder)
    {
      $result = array();
      $sql = "select a.idWork , a.idOrder , a.topic , a.amount , a.page , a.total , a.worktype ,a.copytype,a.covertype , a.idStatus , date_format(a.duedate,'%d/%m/%Y %H:%i') as duedate
      , b.name as worktype_name , c.name as copytype_name , d.name as covertype_name , e.name as status_name from (
              select * from catc_work where idOrder = ? ) a
              left join
              catc_worktype_master b on a.workType = b.idType
              left join
              catc_copytype_master c on a.copytype = c.idType
              left join
              catc_covertype_master d on a.covertype = d.idType
              left join
              catc_status_master e on a.idStatus = e.idStatus";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$idOrder,PDO::PARAM_INT);
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

    public static function getWorkById($idOrder,$idWork)
    {
      $result = null ;
      $sql = "select a.idWork , a.idOrder , a.topic , a.amount , a.page , a.total , a.worktype ,a.copytype,a.covertype , a.idStatus , date_format(a.duedate,'%d/%m/%Y %H:%i') as duedate
      , date_format(a.duedate,'%Y-%m-%d') as showduedate ,date_format(a.duedate,'%k') as showduehour , date_format(a.duedate,'%i') as showduemin
      , b.name as worktype_name , c.name as copytype_name , d.name as covertype_name , e.name as status_name from (
              select * from catc_work where idOrder = ? and idWork = ? ) a
              left join
              catc_worktype_master b on a.workType = b.idType
              left join
              catc_copytype_master c on a.copytype = c.idType
              left join
              catc_covertype_master d on a.covertype = d.idType
              left join
              catc_status_master e on a.idStatus = e.idStatus";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$idOrder,PDO::PARAM_INT);
        $stmn->bindParam(2,$idWork,PDO::PARAM_INT);
        $stmn->execute();
        if($row=$stmn->fetch(PDO::FETCH_ASSOC))
        {
          $result = $row;
        }
      } catch (PDOException $e) {
        print_r($e);
      }
      return $result ;
    }

    public static function updateStatus($idOrder,$idWork,$idStatus)
    {
      $result = false ;
      $sql = "update catc_work set idStatus = ? , statusdate = CURRENT_TIMESTAMP
      where idOrder = ? and idWork = ?";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$idStatus,PDO::PARAM_INT);
        $stmn->bindParam(2,$idOrder,PDO::PARAM_INT);
        $stmn->bindParam(3,$idWork,PDO::PARAM_INT);
        if($stmn->execute()){
          $result = true ;
        }
      } catch (PDOException $e) {
         print_r($e);
      }
     return $result ;
    }
  }
?>
