<?php
    require_once 'DBManager.php';
    class Department{

      public static function getAllDepartmenthead()
      {
         $result = array();
         $sql = "select * from catc_depthead_master";
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

      public static function getAllDepartment($idDepthead)
      {
         $result = array();
         $sql = "select * from catc_dept_master where idDepthead = ?";
         try {
           $db = DBManager::getConnection();
           $stmn = $db->prepare($sql);
           $stmn->bindParam(1,$idDepthead,PDO::PARAM_INT);
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
