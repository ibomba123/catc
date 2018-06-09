<?php
  require_once 'DBManager.php';
  class Order{
    public static function add($obj)
    {
      $result = 0 ;
      $sql = "insert into catc_order(owner,receiver,comment,orderdate,originaldate,idOrderReal) values(?,?,?,?,?,?)";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$obj["owner"],PDO::PARAM_INT);
        $stmn->bindParam(2,$obj["receiver"],PDO::PARAM_INT);
        $stmn->bindParam(3,$obj["comment"],PDO::PARAM_STR);
        $stmn->bindParam(4,$obj["orderdate"],PDO::PARAM_STR);
        $stmn->bindParam(5,$obj["originaldate"],PDO::PARAM_STR);
        $stmn->bindParam(6,$obj["idOrderReal"],PDO::PARAM_INT);
        if($stmn->execute()){
          $result = $db->lastInsertId();
        }
      } catch (PDOException $e) {
         print_r($e);
      }
     return $result ;
    }

    public static function update($obj)
    {
      $result = false ;
      $sql = "update catc_order set owner = ? , receiver = ? , comment = ? , orderdate = ? , originaldate = ? , idOrderReal = ? where idOrder = ?";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$obj["owner"],PDO::PARAM_INT);
        $stmn->bindParam(2,$obj["receiver"],PDO::PARAM_INT);
        $stmn->bindParam(3,$obj["comment"],PDO::PARAM_STR);
        $stmn->bindParam(4,$obj["orderdate"],PDO::PARAM_STR);
        $stmn->bindParam(5,$obj["originaldate"],PDO::PARAM_STR);
        $stmn->bindParam(6,$obj["idOrderReal"],PDO::PARAM_INT);
        $stmn->bindParam(7,$obj["idOrder"],PDO::PARAM_INT);
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
      $sql = "delete from catc_order where idOrder = ?";
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

    public static function updateRealId($idOrder,$idOrderReal)
    {
      $result = false ;
      $sql = "update catc_order set idOrderReal =  ? where idOrder = ?";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$obj["idOrderReal"],PDO::PARAM_INT);
        $stmn->bindParam(2,$obj["idOrder"],PDO::PARAM_INT);
        if($stmn->execute()){
          $result = true ;
        }
      } catch (PDOException $e) {
         print_r($e);
      }
     return $result ;
    }



    public static function getLastOrderId()
    {
      $result = 1 ;
      $sql = "select max(idOrder) as maxId from catc_order";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->execute();
        if($row=$stmn->fetch(PDO::FETCH_ASSOC))
        {
          $result = $row["maxId"]+1;
        }
      } catch (PDOException $e) {
        print_r($e);
      }
      return $result ;
    }

    public static function getOrder($idOrder)
    {
      $result = null ;
      $sql = "select a.* , b.totalWork from
              (
                select a.* , b.name as depthead_name , c.name as dept_name , d.name as status_name from
                (
                  select a.idOrder,a.idOrderReal,date_format(a.orderdate,'%d/%m/%Y %H:%i') as orderdate , date_format(a.orderdate,'%Y-%m-%d') as showdate
                  ,date_format(a.orderdate,'%H') as showhour , date_format(a.orderdate,'%i') as showmin
                  ,date_format(a.originaldate,'%d/%m/%Y %H:%i') as originaldate , date_format(a.originaldate,'%Y-%m-%d') as showoriginaldate
                  ,date_format(a.originaldate,'%H') as showoriginalhour , date_format(a.originaldate,'%i') as showoriginalmin
                  ,a.owner , a.comment , b.dept , b.depthead , concat(b.title,' ',b.firstname,' ',b.lastname) as own_name , a.idStatus , a.receiver ,
                  date_format(a.finishdate,'%d/%m/%Y %H:%i') as finishdate , date_format(a.receivedate,'%d/%m/%Y %H:%i') as receivedate , date_format(a.receivedate,'%Y-%m-%d') as showreceivedate
                  ,date_format(a.receivedate,'%H') as showreceivehour , date_format(a.receivedate,'%i') as showreceivemin
                  from catc_order a ,
                  catc_employee b
                  where a.idOrder = ? and a.owner = b.idEmployee
                )a
                left join catc_depthead_master b on a.depthead = b.idDeptHead
                left join catc_dept_master c on a.depthead = c.idDepthead and a.dept = c.idDept
           	    left join catc_status_master d on a.idStatus = d.idStatus
              ) a ,
              (select idOrder , count(idWork) as totalWork from catc_work group by idOrder) b
              where a.idOrder = b.idOrder";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$idOrder,PDO::PARAM_INT);
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

    public static function getAllOrder()
    {
      $result = array();
      $sql = "select a.* , b.totalWork from
              (
                select a.* , b.name as depthead_name , c.name as dept_name from
                (
                  select a.idOrder,a.idOrderReal,date_format(a.orderdate,'%d/%m/%Y %H:%i') as orderdate ,a.owner , a.comment , b.dept , b.depthead , concat(b.title,' ',b.firstname,' ',b.lastname) as own_name from catc_order a ,
                  catc_employee b
                  where a.owner = b.idEmployee
                )a
                left join catc_depthead_master b on a.depthead = b.idDeptHead
                left join catc_dept_master c on a.depthead = c.idDepthead and a.dept = c.idDept
              ) a ,
              (select idOrder , count(idWork) as totalWork from catc_work group by idOrder) b
              where a.idOrder = b.idOrder order by a.idOrderReal";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->execute();
        while($row=$stmn->fetch(PDO::FETCH_ASSOC))
        {
          $status = self::chkAllComplete($row["idOrder"]);
          if($status)
          {
            $row["status"] = 1;
          }
          else{
            $row["status"] = 0;
          }
          $result[] = $row;
        }
      } catch (PDOException $e) {
        print_r($e);
      }
      return $result ;
    }

    public static function chkAllComplete($idOrder)
    {
      $result = true;
      $sql = "select * from catc_work where idOrder = ? and idStatus <> 2";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$idOrder,PDO::PARAM_INT);
        $stmn->execute();
        if($row=$stmn->fetch(PDO::FETCH_ASSOC))
        {
          $result = false;
        }
      } catch (PDOException $e) {
        print_r($e);
      }
      return $result ;
    }

    public static function getOrderByIdOrderReal($idOrderReal)
    {
      $result = null;
      $sql = "select * from catc_order where idOrderReal = ?";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$idOrderReal,PDO::PARAM_INT);
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

    public static function updateOrderStatus($obj)
    {
      $result = false ;
      $sql = "update catc_order set idStatus = ? , finishdate = ? where idOrder = ?";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$obj["idStatus"],PDO::PARAM_INT);
        $stmn->bindParam(2,$obj["finishdate"],PDO::PARAM_STR);
        $stmn->bindParam(3,$obj["idOrder"],PDO::PARAM_INT);
        if($stmn->execute()){
          $result = true ;
        }
      } catch (PDOException $e) {
         print_r($e);
      }
     return $result ;
    }

    public static function updateReciver($obj)
    {
      $result = false ;
      $sql = "update catc_order set receiver = ? , receivedate = ? where idOrder = ?";
      try {
        $db = DBManager::getConnection();
        $stmn = $db->prepare($sql);
        $stmn->bindParam(1,$obj["receiver"],PDO::PARAM_INT);
        $stmn->bindParam(2,$obj["receivedate"],PDO::PARAM_STR);
        $stmn->bindParam(3,$obj["idOrder"],PDO::PARAM_INT);
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
