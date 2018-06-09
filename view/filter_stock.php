<?php
  include_once "model/Master.php";
  include_once "model/Department.php";
  $allWorkType = Master::getAllWorkType();
  $allDepthead = Department::getAllDepartmenthead();
?>
<div class="panel panel-primary">
 <div class="panel-heading">
   ค้นหา
 </div>
 <div class="panel-body">
   <form id="filterFrm" name="filterFrm">
     <div class="row">
       <div class="col-xs-4">
         <div class="row">
           <div class="col-xs-5">
             <label for="year">ปี : </label>
           </div>
           <div class="col-xs-5">
             <select  title="ทั้งหมด" name="year[]" class="selectpicker show-tick"  id="year" data-actions-box="true" multiple>
               <option value="2017">2017</option>
               <option value="2018">2018</option>
             </select>
           </div>
         </div>
       </div>
       <div class="col-xs-1">
       </div>
       <div class="col-xs-4">
         <div class="row">
           <div class="col-xs-5">
             <label for="year">เดือน : </label>
           </div>
           <div class="col-xs-5">
             <select title="ทั้งหมด" name="month[]" class="selectpicker show-tick"  id="month" data-actions-box="true" multiple>
               <option value="01">มกราคม</option>
               <option value="02">กุมภาพันธ์</option>
               <option value="03">มีนาคม</option>
               <option value="04">เมษายน</option>
               <option value="05">พฤษภาคม</option>
               <option value="06">มิถุนายน</option>
               <option value="07">กรกฎาคม</option>
               <option value="08">สิงหาคม</option>
               <option value="09">กันยายน</option>
               <option value="10">ตุลาคม</option>
               <option value="11">พฤศจิกายน</option>
               <option value="12">ธันวาคม</option>
             </select>
           </div>
         </div>
       </div>
     </div>
     <br/>
     <div class="row">
       <div class="col-xs-4">
         <div class="row">
           <div class="col-xs-5">
             <label for="year">ประเภทของสื่อ : </label>
           </div>
           <div class="col-xs-5">
             <select  title="ทั้งหมด" name="workType[]" class="selectpicker show-tick"  id="workType" data-actions-box="true" multiple>
               <?php
                foreach ($allWorkType as $workType) {
                  echo "<option value='".$workType["idType"]."'>".$workType["name"]."</option>";
                }
               ?>
             </select>
           </div>
         </div>
       </div>
       <div class="col-xs-1">
       </div>
       <div class="col-xs-4">
         <div class="row">
           <div class="col-xs-5">
             <label for="year">สังกัด : </label>
           </div>
           <div class="col-xs-5">
             <select title="ทั้งหมด" name="dept[]" class="selectpicker show-tick"  data-live-search="true" data-actions-box="true" id="dept" multiple>
             <?php
                foreach ($allDepthead as $depthead) {
                  echo "<optgroup label='".$depthead["name"]."'>";
                  $allDept = Department::getAllDepartment($depthead["idDepthead"]);
                  echo "<option value='".$depthead["idDepthead"]."_0'>ส่วนกลาง(ไม่ได้สังกัดแผนก)</option>";
                  foreach ($allDept as $dept) {
                    echo "<option value='".$depthead["idDepthead"]."_".$dept["idDept"]."'>".$dept["name"]."</option>";
                  }
                  echo "</optgroup>";
                }
             ?>
             </select>
           </div>
         </div>
       </div>
     </div>
   </form>
   <br/>
 </div>
</div>
