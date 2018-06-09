<?php
    require_once 'DBManager.php';
    class KPI{
      public static function getAllKPIForChart($obj)
      {
        $processQ = "";
        $workerQ = "";
        $where = "";
        $haveFilter = false ;
        if($obj["process"]!=null)
        {
          foreach ($obj["process"] as $val) {
            if($processQ!=""){
              $processQ.=",";
            }
              $processQ.= $val;
          }
          $processQ = " where idProcess in (".$processQ.")";
        }

        if($obj["worker"]!=null)
        {
          foreach ($obj["worker"] as $val) {
            if($workerQ!=""){
              $workerQ.=",";
            }
              $workerQ.= $val;
          }
          $workerQ = " and idEmployee in (".$workerQ.")";

        }

        // if($haveFilter)
        // {
        //   if($workerQ!="")
        //   {
        //     if($where!="")
        //     {
        //       $where.=" and ";
        //     }
        //     $where.=" idEmployee in (".$workerQ.") ";
        //   }
        //
        //   if($processQ!="")
        //   {
        //     if($where!="")
        //     {
        //       $where.=" and ";
        //     }
        //     $where.=" idProcess in (".$processQ.") ";
        //   }
        //   $where = "where ".$where;
        // }

        $result = array();
        // $sql = "select a.* , concat(b.title,' ',b.firstname,' ',b.lastname) as own_name from (
        //           select idEmployee , count(1) as totalWork from catc_work_process ".$where." group by idEmployee ) a
        //         left join catc_employee b on a.idEmployee = b.idEmployee";

        $sql = " select a.idEmployee , concat(a.title,' ',a.firstname,' ',a.lastname) as own_name , b.totalWork from
        (select * from catc_employee where type = 2 ".$workerQ.") a left join
        (select idEmployee , count(1) as totalWork from catc_work_process ".$processQ." group by idEmployee ) b on a.idEmployee = b.idEmployee";
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
