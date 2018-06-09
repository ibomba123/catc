<?php
    require_once 'DBManager.php';
    class Employee{
      public static function getAllEmployeeAutoComplete()
      {
        $result = array();
        $sql = "select a.* , concat(a.title,' ',a.firstname,' ',a.lastname) as fullname , b.name as deptheadname , c.name as deptname from catc_employee a
          left join catc_depthead_master b on a.depthead = b.idDepthead
          left join catc_dept_master c on a.depthead = c.idDepthead and a.dept = c.idDept
          order by a.depthead , a.dept";
        //$sql = "select concat(a.title,' ',a.firstname,' ',a.lastname) as fullname from catc_employee a";
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

      public static function getAllEmployeeWorker()
      {
        $result = array();
        $sql = "select a.* , concat(a.title,' ',a.firstname,' ',a.lastname) as fullname , b.name as deptheadname , c.name as deptname from (select * from catc_employee where type = 2) a
          left join catc_depthead_master b on a.depthead = b.idDepthead
          left join catc_dept_master c on a.depthead = c.idDepthead and a.dept = c.idDept
          order by a.depthead , a.dept";
        //$sql = "select concat(a.title,' ',a.firstname,' ',a.lastname) as fullname from catc_employee a";
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

      public static function getAllEmployee($idDepthead,$idDept)
      {
         $result = array();
         $whereSQL = "";
         if($idDepthead > 0)
         {
           $whereSQL = " where depthead = ? ";
           if($idDept > 0)
           {
             $whereSQL.=" and dept = ? ";
           };
         }
         $sql = "select a.* , b.name as deptheadname , c.name as deptname from (select * from catc_employee ".$whereSQL.") a
           left join catc_depthead_master b on a.depthead = b.idDepthead
           left join catc_dept_master c on a.depthead = c.idDepthead and a.dept = c.idDept
           order by a.depthead , a.dept";
         try {
           $db = DBManager::getConnection();
           $stmn = $db->prepare($sql);
           if($idDepthead > 0)
           {
             $stmn->bindParam(1,$idDepthead,PDO::PARAM_INT);
             if($idDept > 0)
             {
               $stmn->bindParam(2,$idDept,PDO::PARAM_INT);
             }
           }
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

      public static function add($obj)
      {
          $result = false ;
          $sql = "insert into catc_employee(title,firstname,lastname,position,tel,depthead,dept) values(?,?,?,?,?,?,?)";
          try {
            $db = DBManager::getConnection();
            $stmn = $db->prepare($sql);
            $stmn->bindParam(1,$obj["title"],PDO::PARAM_STR);
            $stmn->bindParam(2,$obj["firstname"],PDO::PARAM_STR);
            $stmn->bindParam(3,$obj["lastname"],PDO::PARAM_STR);
            $stmn->bindParam(4,$obj["position"],PDO::PARAM_STR);
            $stmn->bindParam(5,$obj["tel"],PDO::PARAM_STR);
            $stmn->bindParam(6,$obj["depthead"],PDO::PARAM_INT);
            $stmn->bindParam(7,$obj["dept"],PDO::PARAM_INT);
            //echo $sql ;
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
        $sql = "update catc_employee set title = ? , firstname = ? , lastname = ? , position = ?
        , tel = ? , depthead = ? , dept = ? where idEmployee = ?";
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->bindParam(1,$obj["title"],PDO::PARAM_STR);
          $stmn->bindParam(2,$obj["firstname"],PDO::PARAM_STR);
          $stmn->bindParam(3,$obj["lastname"],PDO::PARAM_STR);
          $stmn->bindParam(4,$obj["position"],PDO::PARAM_STR);
          $stmn->bindParam(5,$obj["tel"],PDO::PARAM_STR);
          $stmn->bindParam(6,$obj["depthead"],PDO::PARAM_INT);
          $stmn->bindParam(7,$obj["dept"],PDO::PARAM_INT);
          $stmn->bindParam(8,$obj["idEmployee"],PDO::PARAM_INT);
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
        $sql = "delete from catc_employee where idEmployee = ?";
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->bindParam(1,$obj["idEmployee"],PDO::PARAM_INT);
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
