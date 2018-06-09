<?php
    require_once 'DBManager.php';
    require_once 'Process.php';
    require_once 'Employee.php';
    class Summary{
      public static function getAllSummary($filter){
        $result = array();
        $filterSql = "" ;
        if($filter["year"]!=null)
        {
          $str = "";
          foreach ($filter["year"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql.= " and date_format(a.orderdate,'%Y') in(".$str.")" ;
        }
        if($filter["month"]!=null)
        {
          $str = "";
          foreach ($filter["month"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql.= " and date_format(a.orderdate,'%m') in(".$str.")" ;
        }
        if($filter["workType"]!=null)
        {
          $str = "";
          foreach ($filter["workType"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql.= " and workType in(".$str.")" ;
        }

        if($filter["dept"]!=null)
        {
          $str = "";
          foreach ($filter["dept"] as $dept) {
            if($str!="")
            {
              $str.=" or ";
            }
            $deptx = explode("_",$dept) ;
            $str.="(depthead = ".$deptx[0]." and dept = ".$deptx[1].")";
          }
          $filterSql.= " and (".$str.")" ;
        }

        $sql = "select a.* , date_format(a.orderdate,'%d/%m/%y') as orderdate_format , date_format(a.orderdate,'%c') as month  from (
                  select a.* , b.orderdate , c.name as worktype_name , d.depthead , d.dept , e.name as depthead_name , f.name as dept_name from catc_work a
                  left join catc_order b on a.idOrder = b.idOrder
                  left join catc_worktype_master c on a.workType = c.idType
                  left join catc_employee d on b.owner = d.idEmployee
                  left join catc_depthead_master e on d.depthead = e.idDepthead
                  left join catc_dept_master f on d.depthead = f.idDepthead and d.dept = f.idDept
                ) a where 1 $filterSql order by a.depthead , a.dept , a.orderdate";
         // echo $sql ;
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

      public static function getAllKpi($filter){
        $result = array();
        $filterSql = "" ;
        $filterSql2 = "" ;
        if($filter["year"]!=null)
        {
          $str = "";
          foreach ($filter["year"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql.= " and date_format(a.orderdate,'%Y') in(".$str.")" ;
        }
        if($filter["month"]!=null)
        {
          $str = "";
          foreach ($filter["month"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql.= " and date_format(a.orderdate,'%m') in(".$str.")" ;
        }
        if($filter["workType"]!=null)
        {
          $str = "";
          foreach ($filter["workType"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql.= " and workType in(".$str.")" ;
        }
        if($filter["dept"]!=null)
        {
          $str = "";
          foreach ($filter["dept"] as $dept) {
            if($str!="")
            {
              $str.=" or ";
            }
            $deptx = explode("_",$dept) ;
            $str.="(depthead = ".$deptx[0]." and dept = ".$deptx[1].")";
          }
          $filterSql.= " and (".$str.")" ;
        }
        if($filter["worker"]!=null)
        {
          $str = "";
          foreach ($filter["worker"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql2.= " and idEmployee in(".$str.")" ;
        }
        if($filter["process"]!=null)
        {
          $str = "";
          foreach ($filter["process"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql2.= " and idProcess in(".$str.")" ;
        }

        $sql = "select a.idEmployee ,a.idProcess, count(1) as total from catc_work_process a ,
                (
                  select a.idOrder , a.idWork from (
                    select a.* , b.orderdate ,b.owner , c.depthead , c.dept  from catc_work a
                    left join catc_order b on a.idOrder = b.idOrder
                    left join catc_employee c on b.owner = c.idEmployee
                  ) a where 1 $filterSql order by a.orderdate
                ) b where a.idOrder = b.idOrder and a.idWork = b.idWork $filterSql2 group by a.idEmployee , a.idProcess";
        //echo $sql ;
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->execute();
          while($row=$stmn->fetch(PDO::FETCH_ASSOC))
          {
            $result[$row["idEmployee"]][$row["idProcess"]] = $row["total"];
          }
        } catch (PDOException $e) {
          print_r($e);
        }
        return $result ;
      }

      public static function getAllPeper($filter){
        $result = array();
        $filterSql = "" ;
        if($filter["year"]!=null)
        {
          $str = "";
          foreach ($filter["year"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql.= " and date_format(a.orderdate,'%Y') in(".$str.")" ;
        }
        if($filter["month"]!=null)
        {
          $str = "";
          foreach ($filter["month"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql.= " and date_format(a.orderdate,'%m') in(".$str.")" ;
        }
        if($filter["workType"]!=null)
        {
          $str = "";
          foreach ($filter["workType"] as $key) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$key;
          }
          $filterSql.= " and workType in(".$str.")" ;
        }

        if($filter["dept"]!=null)
        {
          $str = "";
          foreach ($filter["dept"] as $dept) {
            if($str!="")
            {
              $str.=" or ";
            }
            $deptx = explode("_",$dept) ;
            $str.="(depthead = ".$deptx[0]." and dept = ".$deptx[1].")";
          }
          $filterSql.= " and (".$str.")" ;
        }

        $sql = "select a.month , a.work_count , b.peper from (
                  select a.month , count(1) as work_count from (
                    select a.* , b.orderdate , date_format(b.orderdate,'%m') as month , c.depthead , c.dept  from catc_work a
                    left join catc_order b on a.idOrder = b.idOrder
                    left join catc_employee c on b.owner = c.idEmployee
                  ) a where 1 $filterSql group by a.month ) a left join
                  (
                  select a.month , sum(a.peper) as peper from (
                    select a.* , if(a.workType in (1,2,3),if(a.copyType=1,a.total,a.total/2),0) as peper , b.orderdate , date_format(b.orderdate,'%m') as month , c.depthead , c.dept  from catc_work a
                    left join catc_order b on a.idOrder = b.idOrder
                    left join catc_employee c on b.owner = c.idEmployee
                  ) a where 1 $filterSql group by a.month ) b on a.month = b.month";
        //echo $sql ;
        try {
          $db = DBManager::getConnection();
          $stmn = $db->prepare($sql);
          $stmn->execute();
          while($row=$stmn->fetch(PDO::FETCH_ASSOC))
          {
            $result[$row["month"]] = $row;
          }
        } catch (PDOException $e) {
          print_r($e);
        }
        return $result ;
      }

      public static function prepareProcess($processList)
      {
        $result = array();
        $filter = "";
        if($processList!=null)
        {
          $str = "";
          foreach ($processList as $process) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$process ;
          }
          $filter.="where idProcess in ($str)";
        }
        else{
          $allProcess = Process::getAllProcessMaster();
          $str = "";
          foreach ($allProcess as $process) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$process["idProcess"] ;
          }
          $filter.="where idProcess in ($str)";
        }

        $sql = "select * from catc_process_master ".$filter." order by idProcess";
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

      public static function prepareWorker($workerList)
      {
        $result = array();
        $filter = "";
        if($workerList!=null)
        {
          $str = "";
          foreach ($workerList as $worker) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$worker ;
          }
          $filter.="where idEmployee in ($str)";
        }
        else{
          $allWorker = Employee::getAllEmployeeWorker();
          $str = "";
          foreach ($allWorker as $worker) {
            if($str!="")
            {
              $str.=",";
            }
            $str.=$worker["idEmployee"] ;
          }
          $filter.="where idEmployee in ($str)";
        }

        $sql = "select idEmployee , concat(title,' ',firstname,' ',lastname) as fullname from catc_employee ".$filter." order by idEmployee";
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
      public static function prepareMonth($monthList)
      {
        $result = array();
        if($monthList!=null)
        {
          foreach ($monthList as $month) {
            $result[] = $month ;
          }
        }
        else{
          for($i=1;$i<=12;$i++)
          {
            $result = null ;
            $result = array("01","02","03","04","05","06","07","08","09","10","11","12");

          }
        }
        return $result ;
      }
    }
?>
