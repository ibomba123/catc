<?php
  include_once "model/Employee.php";
  include_once "model/Department.php";
  include_once "model/Master.php";
  $allWorker = Employee::getAllEmployeeWorker();
  $allProcess = Master::getAllProcess();
  $allDepthead = Department::getAllDepartmenthead();
?>

<div class="panel panel-primary">
 <div class="panel-heading">
   ค้นหา
 </div>
 <div class="panel-body">
   <form id="filterFrm" name="filterFrm">
     <div class="row">
       <div class="col-xs-12">
         <span class="font_bold">พนักงานพิมพ์ : </span>
       </div>
       <br/>
       <div class="col-xs-12">
         <select title="ทั้งหมด" name="worker[]" class="selectpicker show-tick"  data-live-search="true" id="worker" multiple>
           <?php
             foreach ($allWorker as $employee) {
               echo "<option value='".$employee["idEmployee"]."'>".$employee["fullname"]."</option>";
             }
            ?>
         </select>
       </div>
       <br/></br></br>
       <div class="col-xs-12">
         <span class="font_bold">ประเภทของงาน : </span>
       </div>
       <br/>
       <div class="col-xs-12">
         <select title="ทั้งหมด" name="process[]" class="selectpicker show-tick"  data-live-search="true" id="process" multiple>
           <?php
             foreach ($allProcess as $process) {
               echo "<option value='".$process["idProcess"]."'>".$process["name"]."</option>";
             }
            ?>
         </select>
       </div>
       <br/></br></br>
       <div class="col-xs-12">
         <span class="font_bold">ประเภทของสื่อ : </span>
       </div>
       <br/>
       <div class="col-xs-12">
         <select title="ทั้งหมด" name="workType[]" class="selectpicker show-tick"  data-live-search="true" id="workType" multiple>
           <option value="1">เอกสารประกอบการสอน</option>
           <option value="2">เอกสารอื่นๆ</option>
           <option value="3">หนังสือ</option>
           <option value="4">เคลือบพลาสติก</option>
           <option value="5">เข้าเล่ม สันห่วง + ปกพลาสติก หน้า-หลัง</option>
         </select>
       </div>
       <br/></br></br>
       <div class="col-xs-12">
         <span class="font_bold">สังกัด : </span>
       </div>
       <br/>
       <div class="col-xs-12">
         <select title="ทั้งหมด" name="dept[]" class="selectpicker show-tick"  data-live-search="true" id="dept" multiple>
         <?php
            foreach ($allDepthead as $depthead) {
              echo "<optgroup label='".$depthead["name"]."'>";
              $allDept = Department::getAllDepartment($depthead["idDepthead"]);
              echo "<option>ส่วนกลาง(ไม่ได้สังกัดแผนก)</option>";
              foreach ($allDept as $dept) {
                echo "<option>".$dept["name"]."</option>";
              }
              echo "</optgroup>";
            }
         ?>
         </select>
       </div>
       <br/></br></br>
       <div class="col-xs-12">
         <span class="font_bold">ช่วงเวลา : </span>
       </div>
       <br/>
       <div class="col-xs-12">
         <input name="startDate" type="date" class="form-control" value="<?=date("Y-m-01");?>"/>
       </div>
       <br/><br/>
       <div class="col-xs-12">
         <span class="font_bold">ถึง : </span>
       </div>

       <div class="col-xs-12">
         <input name="endDate" type="date" class="form-control" value="<?=date("Y-m-t");?>"/>
       </div>
     </div>
   </form>
 </div>
</div>
