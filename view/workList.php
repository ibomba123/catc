<?php
  include_once "model/Order.php";
  include_once "model/Employee.php";
  include_once "model/Process.php";
  include_once "utils/Util.php";
  $idOrder = Util::getInt($_REQUEST["idOrder"]);
  $allEmployee = Employee::getAllEmployeeAutoComplete();
  $allWorker = Employee::getAllEmployeeWorker();
  $orderInfo = Order::getOrder($idOrder);
  $allProcessMaster = Process::getAllProcessMaster();
 ?>
 <div class="container">
   <div class="row">
     <div class="col-xs-12">
       <font color="#337ab7" size="5" class="glyphicon glyphicon-list-alt" aria-hidden="true"></font>
       &nbsp;&nbsp;&nbsp;
       <span class="font18 font_bold">ข้อมูลใบงาน</span>
     </div>
   </div>
   <br/>
   <div class="row">
     <div class="col-xs-12">
       <div class="panel panel-primary">
        <div class="panel-heading">
          <span>รายละเอียด ใบงานหมายเลข <?=$orderInfo["idOrderReal"]?></span>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-4">
              <div class="row">
                <div class="col-xs-4"> <span class="font_bold">หมายเลข :</span> </div>
                <div class="col-xs-6"> <?=$orderInfo["idOrderReal"]?> </div>
              </div>
              <br/>
              <div class="row">
                <div class="col-xs-4"> <span class="font_bold">จำนวนงาน :</span> </div>
                <div class="col-xs-6"> <?=$orderInfo["totalWork"]?> </div>
              </div>
              <br/>
              <div class="row">
                <div class="col-xs-4"> <span class="font_bold">ผู้ขอ :</span> </div>
                <div class="col-xs-6"> <?=$orderInfo["own_name"]?> </div>
              </div>
              <br/>
              <div class="row">
                <div class="col-xs-5"> <span class="font_bold">วันที่(รับต้นฉบับ) :</span> </div>
                <div class="col-xs-6"> <?=$orderInfo["originaldate"]?> </div>
              </div>
            </div>
            <div class="col-xs-4">
              <div class="row">
                <div class="col-xs-4"> <span class="font_bold">สังกัด :</span> </div>
                <div class="col-xs-6"> <?=$orderInfo["depthead_name"]?></div>
              </div>
              <br/>
              <div class="row">
                <div class="col-xs-4"> <span class="font_bold">แผนก :</span> </div>
                <div class="col-xs-6"> <?=$orderInfo["dept_name"]?> </div>
              </div>
              <br/>
              <div class="row">
                <div class="col-xs-5"> <span class="font_bold">วันที่(รันออเดอร์) :</span> </div>
                <div class="col-xs-6"> <?=$orderInfo["orderdate"]?> </div>
              </div>
            </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-xs-10">
              <div class="row">
                <div class="col-xs-2"> <span class="font_bold">comment :</span> </div>
                <div class="col-xs-8"> <?=$orderInfo["comment"]?>  </div>
              </div>
            </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-xs-10">
              <div class="row">
                <div class="col-xs-2"> <span class="font_bold">สถานะใบงาน :</span> </div>
                <div class="col-xs-8"> <?=$orderInfo["status_name"]?>  </div>
              </div>
            </div>
          </div>
          <?php if($orderInfo["idStatus"]==2)
          {?>
            <br/>
            <div class="row">
              <div class="col-xs-10">
                <div class="row">
                  <div class="col-xs-2"> <span class="font_bold">วันที่เสร็จ :</span> </div>
                  <div class="col-xs-8"> <?=$orderInfo["finishdate"]?> </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <div class="row">
            <div class="col-xs-12 text-right">
              <a href='#informationModal' data-toggle='modal'>แก้ไขข้อมูล</a>
            </div>
          </div>
        </div>
      </div>
     </div>
   </div>
   <div class="row">
     <div class="col-xs-12">
       <font color="#337ab7" size="4" class="glyphicon glyphicon-list-alt" aria-hidden="true"></font>
       &nbsp;&nbsp;&nbsp;
       <span class="font16 font_bold">รายการงาน</span>
       &nbsp;&nbsp;&nbsp;
       <div class="btn-group">
         <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            กำหนดสถานะใบงาน <span class="caret"></span>
         </button>
         <ul class="dropdown-menu">
            <li><a href="javascript:updateOrderStatus(2)">เสร็จทั้งหมด</a></li>
            <li><a href="javascript:updateOrderStatus(1)">กำลังดำเนินการ</a></li>
            <li><a href="javascript:updateOrderStatus(0)">ยังไม่เริ่ม</a></li>
         </ul>
       </div>
     </div>
     <br/><br/>
     <div class="col-xs-12">
           <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
               <tr>
                   <th width="5%"></th>
                   <th width="20%">เรื่อง</th>
                   <th width="15%">ประเภท</th>
                   <th width="5%">จำนวน</th>
                   <th width="5%">หน้า</th>
                   <th width="5%">ทั้งหมด</th>
                   <th width="5%">สำเนา</th>
                   <th width="5%">ขนาด</th>
                   <th width="15%">รับวันที่</th>
                   <th width="10%">สถานะ</th>
                   <th width="10%">action</th>
               </tr>
           </thead>
           <tbody id="tbody">
           </tbody>
       </table>
   </div>
   <br/><br/>
   <div class="col-xs-12">
     <button type="button" class="btn btn-primary" id="addWorkBtn">เพิ่มงาน</button>
   </div>
   <br/><br/>
 </div>
 <br/><br/>
<?php if($orderInfo["idStatus"]==2){?>
  <div class="row">
    <div class="col-xs-12">
      <font color="#337ab7" size="4" class="glyphicon glyphicon-user" aria-hidden="true"></font>
      &nbsp;&nbsp;&nbsp;
      <span class="font16 font_bold">ผู้รับสำเนา</span>
    </div>
 </div>
  <br/>
  <form name="receiveFrm" id="receiveFrm" >
    <input type="hidden" name="cmd" value="updateReceiver"/>
    <input type="hidden" name="idOrder" value="<?=$idOrder?>"/>
    <div class="row">
        <div class="col-xs-12">
          <div class="form-inline">
            <spanv class="font_bold">ผู้รับสำเนา</span>&nbsp;&nbsp;&nbsp;:&nbsp;
            <select class="selectpicker show-tick" data-live-search="true" name="receiver" title="โปรดระบุผู้รับสำเนา">
              <?php
                foreach ($allEmployee as $employee) {
                  if($employee["idEmployee"] == $orderInfo["receiver"])
                  {
                    echo "<option value='".$employee["idEmployee"]."' selected>".$employee["fullname"]."</option>";
                  }
                  else{
                    echo "<option value='".$employee["idEmployee"]."'>".$employee["fullname"]."</option>";
                  }

                }
               ?>
            </select>
          </div>
        </div>
      </div>
      <br/>
      <div class="row">
        <div class="col-xs-12">
          <div class="form-inline">
            <label>วันที่รับ</label> :
            <input style="width:200px;" name="receivedate" type="date" class="form-control" value="<?=$orderInfo['showreceivedate']?>"/>
          </div>
        </div>
      </div>
      <br/>
      <div class="row">
        <div class="col-xs-12">
          <div class="form-inline">
              <label class="font14">เวลา : </label>
              <select name="receivehour" class="form-control" />
                <?php
                  for($i=0;$i<=23;$i++)
                  {
                    if($i==$orderInfo["showreceivehour"])
                    {
                      echo "<option value='$i' selected>$i</option>";
                    }
                    else{
                      echo "<option value='$i'>$i</option>";
                    }
                  }
                ?>
              </select>&nbsp;&nbsp;:&nbsp;&nbsp;
              <select name="receivemin" class="form-control" />
                <?php
                  for($i=0;$i<=60;$i+=15)
                  {
                    if($i==$orderInfo["showreceivemin"])
                    {
                      echo "<option value='$i' selected>$i</option>";
                    }
                    else{
                      echo "<option value='$i'>$i</option>";
                    }
                  }
                ?>
              </select>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <button type="button" id="receiveSubmit" class="btn btn-primary">ยืนยันผู้รับสำเนา</button>
          </div>
        </div>
      </div>
    </form>
<?}?>
</div>
<br/><br/><br/>
<div class="modal fade" tabindex="-1" role="dialog" id="informationModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="orderFrm" name="orderFrm">
        <input type="hidden" name="cmd" value="edit"/>
        <input type="hidden" name="idOrder" value="<?=$idOrder?>"/>
        <div class="modal-header theme-background">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modalTitle">แก้ไขข้อมูลใบงาน</h4>
        </div>
        <div class="modal-body">
          <div class="form-inline">
            <label>หมายเลข</label> :
            <input name="idOrderReal" type="text" class="form-control" value="<?=$orderInfo['idOrderReal']?>"/>
          </div>
          <br/>
          <div class="form-inline">
            <label>วันที่(รันออเดอร์)</label> :
            <input style="width:200px;" name="orderdate" type="date" class="form-control" value="<?=$orderInfo['showdate']?>"/>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <label class="font14">เวลา : </label>
            <select name="orderhour" class="form-control" />
              <?php
                for($i=0;$i<=23;$i++)
                {
                  if($i==$orderInfo["showhour"])
                  {
                    echo "<option value='$i' selected>$i</option>";
                  }
                  else{
                    echo "<option value='$i'>$i</option>";
                  }
                }
              ?>
            </select>&nbsp;&nbsp;:&nbsp;&nbsp;
            <select name="ordermin" class="form-control" />
              <?php
                for($i=0;$i<=60;$i+=15)
                {
                  if($i==$orderInfo["showmin"])
                  {
                    echo "<option value='$i' selected>$i</option>";
                  }
                  else{
                    echo "<option value='$i'>$i</option>";
                  }
                }
              ?>
            </select>
          </div>
          <br/>
          <div class="form-inline">
            <label>วันที่(รับต้นฉบับ)</label> :
            <input style="width:200px;" name="originaldate" type="date" class="form-control" value="<?=$orderInfo['showoriginaldate']?>"/>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <label class="font14">เวลา : </label>
            <select name="originalhour" class="form-control" />
              <?php
                for($i=0;$i<=23;$i++)
                {
                  if($i==$orderInfo["showoriginalhour"])
                  {
                    echo "<option value='$i' selected>$i</option>";
                  }
                  else{
                    echo "<option value='$i'>$i</option>";
                  }
                }
              ?>
            </select>&nbsp;&nbsp;:&nbsp;&nbsp;
            <select name="originalmin" class="form-control" />
              <?php
                for($i=0;$i<=60;$i+=15)
                {
                  if($i==$orderInfo["showoriginalmin"])
                  {
                    echo "<option value='$i' selected>$i</option>";
                  }
                  else{
                    echo "<option value='$i'>$i</option>";
                  }
                }
              ?>
            </select>
          </div>
          <br/>
          <div class="form-inline">
            <label>ผู้ขอ</label> :
            <select class="selectpicker show-tick" data-live-search="true" name="owner">
              <?php
                foreach ($allEmployee as $employee) {
                  if($employee["idEmployee"] == $orderInfo["owner"])
                  {
                    echo "<option value='".$employee["idEmployee"]."' selected>".$employee["fullname"]."</option>";
                  }
                  else{
                    echo "<option value='".$employee["idEmployee"]."'>".$employee["fullname"]."</option>";
                  }

                }
               ?>
            </select>
          </div>
          <br/>
          <div class="form-inline">
            <label>comment</label> :
            <textarea class="form-control" name="comment" rows="5" cols="70"><?=$orderInfo["comment"]?></textarea>
          </div>
          <br/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          <button type="button" id="submit" class="btn btn-primary">บันทึก</button>
        </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="processModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="processFrm" name="processFrm">
        <input type="hidden" name="cmd" value="saveProcess"/>
        <input type="hidden" name="idOrder"/>
        <input type="hidden" name="idWork" />
        <div class="modal-header theme-background">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modalTitle">กระบวนการในการจัดการพิมพ์</h4>
        </div>
        <div class="modal-body">
          <div class="container">
            <?
            foreach ($allProcessMaster as $processMaster) {
            ?>
            <div class="row">
              <div class="col-xs-2">
                <input type="checkbox" name="chkProcess[]" value="<?=$processMaster["idProcess"]?>" data-idprocess="<?=$processMaster["idProcess"]?>" class="chkProcess"/>
                &nbsp;&nbsp;
                <span class="font_bold"><?=$processMaster["name"]?></span>
              </div>
              <div class="col-xs-6">
                <select title="โปรดระบุผู้ปฏิบัติงาน" name="employeeProcess<?=$processMaster["idProcess"]?>" class="selectpicker show-tick employeeProcess" data-idprocess="<?=$processMaster["idProcess"]?>" data-live-search="true" name="owner" id="employee_process<?=$processMaster["idProcess"]?>" disabled>
                  <?php
                    foreach ($allWorker as $employee) {
                      echo "<option value='".$employee["idEmployee"]."'>".$employee["fullname"]."</option>";
                    }
                   ?>
                </select>
              </div>
            </div>
            <br/>
            <?
            }
            ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          <button type="button" id="processSubmit" class="btn btn-primary">บันทึก</button>
        </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="finishModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="finishFrm" name="finishFrm">
        <input type="hidden" name="cmd" value="updateOrderStatus"/>
        <input type="hidden" name="idOrder" value="<?=$idOrder?>"/>
        <input type="hidden" name="idStatus" value="2"/>
        <div class="modal-header theme-background">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modalTitle">ระบุวันที่เสร็จงาน</h4>
        </div>
        <div class="modal-body">
          <div class="form-inline">
            <label>วันที่ขอ</label> :
            <input style="width:200px;" name="finishdate" type="date" class="form-control" />
          </div>
          <br/>
          <div class="form-inline">
              <label class="font14">เวลา : </label>
              <select name="finishhour" class="form-control" />
                <?php
                  for($i=0;$i<=23;$i++)
                  {
                    echo "<option value='$i'>$i</option>";
                  }
                ?>
              </select>&nbsp;&nbsp;:&nbsp;&nbsp;
              <select name="finishmin" class="form-control" />
                <?php
                  for($i=0;$i<=60;$i+=15)
                  {
                    echo "<option value='$i'>$i</option>";
                  }
                ?>
              </select>
          </div>
          <br/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          <button type="button" id="finishSubmit" class="btn btn-primary">บันทึก</button>
        </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="workModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header theme-background">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="workModalTitle"></h4>
      </div>
      <div class="modal-body">
          <div id="chooseWorkTypeLayer" style="display:none;">
            <div class="form-inline">
              <div class="form-group">
                <label class="font16">รายการ :</label>&nbsp;&nbsp;&nbsp;
                <select class="selectpicker show-tick" name="workType" id="workType">
                  <option value="1">เอกสารประกอบการสอน</option>
                  <option value="2">เอกสารอื่นๆ</option>
                  <option value="3">หนังสือ</option>
                  <option value="4">เคลือบพลาสติก</option>
                  <option value="5">เข้าเล่ม สันห่วง + ปกพลาสติก หน้า-หลัง</option>
                </select>
              </div>
            </div>
            <br/>
          </div>
          <div id="workType1Layer" style="display:none;">
            <form id="workType1Frm" name="workType1Frm">
              <input type="hidden" name="cmd" id="cmd"/>
              <input type="hidden" name="idOrder" value="<?=$idOrder?>" />
              <input type="hidden" name="idWork" id="idWork" value="" />
              <input type="hidden" name="workType" value="1" />
              <div class="form-inline">
                <label>เรื่อง</label> :
                <input name="topic" id="topic" type="text" class="form-control" value="" style="width:450px;"/>
              </div>
              <br/>
              <div class="form-inline">
                <label>จำนวน</label> :
                <input name="amount" id="amount" type="number" data-type="1" class="form-control" value=""/>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label>หน้า</label> :
                <input name="page" id="page" type="number" data-type="1" class="form-control" value=""/>
              </div>
              <br/>
              <div class="form-inline">
                <label>รวม</label> :
                <input name="total" id="total" type="number" class="form-control" value=""/>
              </div>
              <br/>
              <div class="form-inline">
                <div class="form-group">
                  <label for="name">ขอจัดทำสำเนา</label>:&nbsp;&nbsp;&nbsp;
                  <input class="form-control"  name="copyType" type="radio" value="1">&nbsp;&nbsp;&nbsp;<label for="copy">หน้าเดียว</label>&nbsp;&nbsp;
                  <input class="form-control"  name="copyType" type="radio" value="2">&nbsp;&nbsp;&nbsp;<label for="copy">หน้าหลัง</label>&nbsp;&nbsp;
                </div>
              </div>
              <br/>
              <div class="form-inline">
                <label>วันที่(รับต้นฉบับ)</label> :
                <input style="width:200px;" name="duedate" id="duedate" type="date" class="form-control" value=""/>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label class="font14">เวลา : </label>
                <select name="duehour" id="duehour" class="form-control" />
                  <?php
                    for($i=0;$i<=23;$i++)
                    {
                      echo "<option value='$i'>$i</option>";
                    }
                  ?>
                </select>&nbsp;&nbsp;:&nbsp;&nbsp;
                <select name="duemin" id="duemin" class="form-control" />
                  <?php
                    for($i=0;$i<=60;$i+=15)
                    {
                      echo "<option value='$i'>$i</option>";
                    }
                  ?>
                </select>
              </div>
          </form>
        </div>
        <div id="workType2Layer" style="display:none;">
          <form id="workType2Frm" name="workType2Frm">
            <input type="hidden" name="cmd" id="cmd"/>
            <input type="hidden" name="idOrder" value="<?=$idOrder?>" />
            <input type="hidden" name="idWork" id="idWork" value="" />
            <input type="hidden" name="workType" value="2" />
            <div class="form-inline">
              <label>เรื่อง</label> :
              <input name="topic" id="topic" type="text" class="form-control" value="" style="width:450px;"/>
            </div>
            <br/>
            <div class="form-inline">
              <label>จำนวน</label> :
              <input name="amount" id="amount" type="number" data-type="2" class="form-control" value=""/>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label>หน้า</label> :
              <input name="page" id="page" type="number" data-type="2" class="form-control" value=""/>
            </div>
            <br/>
            <div class="form-inline">
              <label>รวม</label> :
              <input name="total" id="total" type="number" class="form-control" value=""/>
            </div>
            <br/>
            <div class="form-inline">
              <div class="form-group">
                <label for="name">ขอจัดทำสำเนา</label>:&nbsp;&nbsp;&nbsp;
                <input class="form-control"  name="copyType" type="radio" value="1">&nbsp;&nbsp;&nbsp;<label for="copy">หน้าเดียว</label>&nbsp;&nbsp;
                <input class="form-control"  name="copyType" type="radio" value="2">&nbsp;&nbsp;&nbsp;<label for="copy">หน้าหลัง</label>&nbsp;&nbsp;
              </div>
            </div>
            <br/>
            <div class="form-inline">
              <label>วันที่(รับต้นฉบับ)</label> :
              <input style="width:200px;" name="duedate" id="duedate" type="date" class="form-control" value=""/>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label class="font14">เวลา : </label>
              <select name="duehour" id="duehour" class="form-control" />
                <?php
                  for($i=0;$i<=23;$i++)
                  {
                    echo "<option value='$i'>$i</option>";
                  }
                ?>
              </select>&nbsp;&nbsp;:&nbsp;&nbsp;
              <select name="duemin" id="duemin" class="form-control" />
                <?php
                  for($i=0;$i<=60;$i+=15)
                  {
                    echo "<option value='$i'>$i</option>";
                  }
                ?>
              </select>
            </div>
        </form>
      </div>
      <div id="workType3Layer" style="display:none;">
        <form id="workType3Frm" name="workType3Frm">
            <input type="hidden" name="cmd" id="cmd"/>
            <input type="hidden" name="idOrder" value="<?=$idOrder?>" />
            <input type="hidden" name="idWork" id="idWork" value="" />
            <input type="hidden" name="workType" value="3" />
            <div class="form-inline">
              <label>เรื่อง</label> :
              <input name="topic" id="topic" type="text" class="form-control" value="" style="width:450px;"/>
            </div>
            <br/>
            <div class="form-inline">
              <label>จำนวน</label> :
              <input name="amount" id="amount" type="number" data-type="3" class="form-control" value=""/>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label>หน้า</label> :
              <input name="page" id="page" type="number" data-type="3" class="form-control" value=""/>
            </div>
            <br/>
            <div class="form-inline">
              <label>รวม</label> :
              <input name="total" id="total" type="number" class="form-control" value=""/>
            </div>
            <br/>
            <div class="form-inline">
              <div class="form-group">
                <label for="name">ขอจัดทำสำเนา</label>:&nbsp;&nbsp;&nbsp;
                <input class="form-control"  name="copyType" type="radio" value="1">&nbsp;&nbsp;&nbsp;<label for="copy">หน้าเดียว</label>&nbsp;&nbsp;
                <input class="form-control"  name="copyType" type="radio" value="2">&nbsp;&nbsp;&nbsp;<label for="copy">หน้าหลัง</label>&nbsp;&nbsp;
              </div>
            </div>
            <br/>
            <div class="form-inline">
              <label>วันที่(รับต้นฉบับ)</label> :
              <input style="width:200px;" name="duedate" id="duedate" type="date" class="form-control" value=""/>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label class="font14">เวลา : </label>
              <select name="duehour" id="duehour" class="form-control" />
                <?php
                  for($i=0;$i<=23;$i++)
                  {
                    echo "<option value='$i'>$i</option>";
                  }
                ?>
              </select>&nbsp;&nbsp;:&nbsp;&nbsp;
              <select name="duemin" id="duemin" class="form-control" />
                <?php
                  for($i=0;$i<=60;$i+=15)
                  {
                    echo "<option value='$i'>$i</option>";
                  }
                ?>
              </select>
            </div>
        </form>
      </div>
      <div id="workType4Layer" style="display:none;">
        <form id="workType4Frm" name="workType4Frm">
            <input type="hidden" name="cmd" id="cmd"/>
            <input type="hidden" name="idOrder" value="<?=$idOrder?>" />
            <input type="hidden" name="idWork" id="idWork" value="" />
            <input type="hidden" name="workType" value="4" />
            <div class="form-inline">
              <label>เรื่อง</label> :
              <input name="topic" id="topic" type="text" class="form-control" value="" style="width:450px;"/>
            </div>
            <br/>
            <div class="form-inline">
              <div class="form-group">
                <label for="name">ขนาด</label>:
                <select class="form-control" name="coverType" id="coverType">
                  <option value="0">โปรดเลือก</option>
                  <option value="1">A3</option>
                  <option value="2">A4</option>
                  <option value="3">นามบัตร</option>
                </select>
              </div>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label>จำนวน</label> :
              <input name="amount" id="amount" type="number" class="form-control" value=""/>
            </div>
            <br/>
            <div class="form-inline">
              <label>วันที่(รับต้นฉบับ)</label> :
              <input style="width:200px;" name="duedate" id="duedate" type="date" class="form-control" value=""/>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label class="font14">เวลา : </label>
              <select name="duehour" id="duehour" class="form-control" />
                <?php
                  for($i=0;$i<=23;$i++)
                  {
                    echo "<option value='$i'>$i</option>";
                  }
                ?>
              </select>&nbsp;&nbsp;:&nbsp;&nbsp;
              <select name="duemin" id="duemin" class="form-control" />
                <?php
                  for($i=0;$i<=60;$i+=15)
                  {
                    echo "<option value='$i'>$i</option>";
                  }
                ?>
              </select>
            </div>
        </form>
      </div>
      <div id="workType5Layer" style="display:none;">
        <form id="workType5Frm" name="workType5Frm">
            <input type="hidden" name="cmd" id="cmd"/>
            <input type="hidden" name="idOrder" value="<?=$idOrder?>" />
            <input type="hidden" name="idWork" id="idWork" value="" />
            <input type="hidden" name="workType" value="5" />
            <div class="form-inline">
              <label>เรื่อง</label> :
              <input name="topic" id="topic" type="text" class="form-control" value="" style="width:450px;"/>
            </div>
            <br/>
            <div class="form-inline">
              <label>จำนวน</label> :
              <input name="amount" id="amount" type="number" class="form-control" value=""/>
            </div>
            <br/>
            <div class="form-inline">
              <label>วันที่(รับต้นฉบับ)</label> :
              <input style="width:200px;" name="duedate" id="duedate" type="date" class="form-control" value=""/>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <label class="font14">เวลา : </label>
              <select name="duehour" id="duehour" class="form-control" />
                <?php
                  for($i=0;$i<=23;$i++)
                  {
                    echo "<option value='$i'>$i</option>";
                  }
                ?>
              </select>&nbsp;&nbsp;:&nbsp;&nbsp;
              <select name="duemin" id="duemin" class="form-control" />
                <?php
                  for($i=0;$i<=60;$i+=15)
                  {
                    echo "<option value='$i'>$i</option>";
                  }
                ?>
              </select>
            </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="workFrmType" id="workFrmType" value="" />
      <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
      <button type="button" id="workSubmit" class="btn btn-primary">บันทึก</button>
    </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
  $(document).ready(function(){
    createWorkTable();

    $('#submit').click(function(){
      $.ajax({
        type:"POST",
        url:"controller/OrderController.php",
        catch:false,
        data:$('#orderFrm').serialize(),
        async:false,
        success:function(result){
          var obj = jQuery.parseJSON(result);
          location.reload();
        }
      });
    });

    $('#processSubmit').click(function(){
      $.ajax({
        type:"POST",
        url:"controller/ProcessController.php",
        catch:false,
        data:$('#processFrm').serialize(),
        async:false,
        success:function(result){
          var obj = jQuery.parseJSON(result);
          $('#processModal').modal('hide');
        }
      });
    });

    $('#finishSubmit').click(function(){
      $.ajax({
        type:"POST",
        url:"controller/OrderController.php",
        catch:false,
        data:$('#finishFrm').serialize(),
        async:false,
        success:function(result){
          location.reload();
        }
      });
    });

    $('#receiveSubmit').click(function(){
      $.ajax({
        type:"POST",
        url:"controller/OrderController.php",
        catch:false,
        data:$('#receiveFrm').serialize(),
        async:false,
        success:function(result){
          location.reload();
        }
      });
    });

    $('#workSubmit').click(function(){
      var form = "#workType"+$('#workFrmType').val()+"Frm";
      $.ajax({
        type:"POST",
        url:"controller/WorkController.php",
        catch:false,
        data:$(form).serialize(),
        async:false,
        success:function(result){
          var obj = jQuery.parseJSON(result);
          console.log(obj.input);
          $('#workModal').modal('hide');
          createWorkTable();
        }
      });
    });

    $('#amount,#page').change(function(){
      var type = $(this).data('type');
      if(type<=3)
      {
        var form = "#workType"+type+"Frm";
        var amount = $(form+' #amount').val();
        var page = $(form+' #page').val();
        var total = amount * page ;
        $(form+' #total').val(total);
      }
    });

    $('.chkProcess').click(function(){
      var idProcess = $(this).data('idprocess');
      if($(this).is(':checked')){
        $('select[class~=employeeProcess][data-idprocess='+idProcess+']').prop('disabled',false);
        $('select[class~=employeeProcess][data-idprocess='+idProcess+']').selectpicker('refresh');
        $('select[class~=employeeProcess][data-idprocess='+idProcess+']').selectpicker('toggle');
      }
      else
      {
        $('select[class~=employeeProcess][data-idprocess='+idProcess+']').prop('disabled',true);
        $('select[class~=employeeProcess][data-idprocess='+idProcess+']').val("");
        $('select[class~=employeeProcess][data-idprocess='+idProcess+']').selectpicker('refresh');
      }
    })

    $('#addWorkBtn').click(function(){
      $('#chooseWorkTypeLayer').show();
      prepareAddWorkModal();
      $('#workModal').modal('show');
    });

    $('#workType').change(function(){
      prepareAddWorkModal();
    });
  });

  function createWorkTable()
  {
    $.ajax({
      type:"POST",
      url:"view/json/workJSON.php",
      catch:false,
      data:{"cmd":"getAllWork","idOrder":<?=$idOrder?>},
      async:false,
      success:function(result){
        $('#table1').dataTable().fnDestroy();
        $('#tbody').empty();
        $('#tbody').append(result);
        table = $('#table1').DataTable({
          "order": [],
          "lengthMenu": [ [25,50,100,-1], [25,50,100,"ทั้งหมด"] ],
          "pageLength": 100,
          "language": {
              "emptyTable": "ไม่พบข้อมูล",
              "info": "แสดงทั้งหมด _TOTAL_ รายการ",
              "infoEmpty": "แสดงทั้งหมด 0 รายการ",
              "infoFiltered": "(จากทั้งหมด _MAX_ รายการ)",
              "lengthMenu": "แสดง _MENU_",
              "search": "ค้นหา:",
              "zeroRecords": "ไม่พบข้อมูล",
              "paginate": {
                  "previous":"ก่อนหน้า",
                  "next": "ถัดไป",
                  "last": "หลังสุด",
                  "first": "หน้าสุด",
              }
          }
        });

        table.on( 'order.dt search.dt', function () {
          table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = (i+1)+".";
            });
        }).draw();
      }
    });
  }

  function updateWorkStatus(idWork,idStatus)
  {
    $.ajax({
      type:"POST",
      url:"controller/WorkController.php",
      catch:false,
      data:{"cmd":"updateStatus","idOrder":<?=$idOrder?>,"idWork":idWork,"idStatus":idStatus},
      async:false,
      success:function(result){
        var obj = jQuery.parseJSON(result);
        createWorkTable();
      }
    });
  }

  function updateOrderStatus(idStatus)
  {
    if(idStatus==2)
    {
      $('#finishModal').modal('show');
    }
    else{
      $.ajax({
        type:"POST",
        url:"controller/OrderController.php",
        catch:false,
        data:{"cmd":"updateOrderStatus","idOrder":<?=$idOrder?>,"idStatus":idStatus},
        async:false,
        success:function(result){
          location.reload();
        }
      });
    }
  }

  function getProcessModal(idOrder,idWork)
  {
    clearProcessModal();
    prepareProcessModal(idOrder,idWork);
    $('#processFrm input[type=hidden][name=idOrder]').val(idOrder);
    $('#processFrm input[type=hidden][name=idWork]').val(idWork);
    $('#processModal').modal('show');
  }

  function clearProcessModal()
  {
    $('.chkProcess').each(function(){
      $(this).prop('checked',false);
    })
    $('.employeeProcess').each(function(){
      $(this).prop('disabled',true);
      $(this).val("");
      $(this).selectpicker('refresh');
    })
  }

  function prepareProcessModal(idOrder,idWork)
  {
    $.ajax({
      type:"POST",
      url:"controller/ProcessController.php",
      catch:false,
      data:{"cmd":"getWorkProcess","idOrder":idOrder,"idWork":idWork},
      async:false,
      success:function(result){
        var obj = jQuery.parseJSON(result);
        var allWorkProcess = obj.allWorkProcess ;
        if(allWorkProcess.length > 0)
        {
          for(var i = 0 ; i < allWorkProcess.length ; i++)
          {
            var idProcess = allWorkProcess[i].idProcess ;
            var idEmployee = allWorkProcess[i].idEmployee ;
            $('input[type=checkbox][class~=chkProcess][data-idprocess='+idProcess+']').prop('checked',true);
            $('select[class~=employeeProcess][data-idprocess='+idProcess+']').prop('disabled',false);
            $('select[class~=employeeProcess][data-idprocess='+idProcess+']').val(idEmployee);
            $('select[class~=employeeProcess][data-idprocess='+idProcess+']').selectpicker('refresh');
          }
        }
      }
    });
  }

  function deleteWork(idOrder,idWork)
  {
    bootbox.confirm({
      message : "ต้องการลบงานนี้ใช่หรือไม่ ?",
      buttons : {
        confirm:{
          label : "ตกลง"
        },
        cancel:{
          label : "ยกเลิก"
        }
      },
      callback : function(result){
        if(result)
        {
          $.ajax({
            type: "POST",
            url: "controller/WorkController.php",
            catch:false,
            data:{"cmd":"delete","idOrder":idOrder,"idWork":idWork},
            async:false,
            success:function(data){
              var obj = jQuery.parseJSON(data);
              if(obj.success==1)
              {
                createWorkTable();
              }
            }
          });
        }
      }
    });
  }

  function editWork(idOrder,idWork)
  {
      $.ajax({
        type: "POST",
        url: "controller/WorkController.php",
        catch:false,
        data:{"cmd":"getWork","idOrder":idOrder,"idWork":idWork},
        async:false,
        success:function(data){
          var obj = jQuery.parseJSON(data);
          if(obj.success==1)
          {
            prepareWorkModal(obj.work);
          }
        }
      });
  }

  function prepareAddWorkModal()
  {
    var workType = $('#workType').val();
    $('#workModalTitle').text("เพิ่มงาน");
    $('#workFrmType').val(workType);
    hideAllWorkTypeLayer();
    resetWorkFrm(workType);
    setupWorkFunction(workType,"add");
    $('#workType'+workType+'Layer').show();
  }

  function prepareWorkModal(work)
  {
    if(work!=null)
    {
      $('#workModalTitle').text("แก้ไขงาน");
      $('#chooseWorkTypeLayer').hide();
      $('#workFrmType').val(work.workType);
      hideAllWorkTypeLayer();
      if(work.workType==1)
      {
        resetWorkFrm("1");
        setupWorkFunction("1","edit");
        $('#workType1Frm #idWork').val(work.idWork);
        $('#workType1Frm #topic').val(work.topic);
        $('#workType1Frm #amount').val(work.amount);
        $('#workType1Frm #page').val(work.page);
        $('#workType1Frm #total').val(work.total);
        $('#workType1Frm input[type=radio][name="copyType"][value='+work.copyType+']').prop('checked',true);
        $('#workType1Frm #duedate').val(work.showduedate);
        $('#workType1Frm #duehour').val(work.showduehour);
        $('#workType1Frm #duemin').val(work.showduemin);
        if(work.showduemin=="00")
        {
          $('#workType1Frm #duemin').val(0);
        }
        $('#workType1Layer').show();
      }
      else if(work.workType==2)
      {
        resetWorkFrm("2");
        setupWorkFunction("2","edit");
        $('#workType2Frm #idWork').val(work.idWork);
        $('#workType2Frm #topic').val(work.topic);
        $('#workType2Frm #amount').val(work.amount);
        $('#workType2Frm #page').val(work.page);
        $('#workType2Frm #total').val(work.total);
        $('#workType2Frm input[type=radio][name="copyType"][value='+work.copyType+']').prop('checked',true);
        $('#workType2Frm #duedate').val(work.showduedate);
        $('#workType2Frm #duehour').val(work.showduehour);
        $('#workType2Frm #duemin').val(work.showduemin);
        if(work.showduemin=="00")
        {
          $('#workType2Frm #duemin').val(0);
        }
        $('#workType2Layer').show();
      }
      else if(work.workType==3)
      {
        resetWorkFrm("3");
        setupWorkFunction("3","edit");
        $('#workType3Frm #idWork').val(work.idWork);
        $('#workType3Frm #topic').val(work.topic);
        $('#workType3Frm #amount').val(work.amount);
        $('#workType3Frm #page').val(work.page);
        $('#workType3Frm #total').val(work.total);
        $('#workType3Frm input[type=radio][name="copyType"][value='+work.copyType+']').prop('checked',true);
        $('#workType3Frm #duedate').val(work.showduedate);
        $('#workType3Frm #duehour').val(work.showduehour);
        $('#workType3Frm #duemin').val(work.showduemin);
        if(work.showduemin=="00")
        {
          $('#workType3Frm #duemin').val(0);
        }
        $('#workType3Layer').show();
      }
      else if(work.workType==4)
      {
        resetWorkFrm("4");
        setupWorkFunction("4","edit");
        $('#workType4Frm #idWork').val(work.idWork);
        $('#workType4Frm #topic').val(work.topic);
        $('#workType4Frm #amount').val(work.amount);
        $('#workType4Frm #coverType').val(work.coverType);
        $('#workType4Frm #duedate').val(work.showduedate);
        $('#workType4Frm #duehour').val(work.showduehour);
        $('#workType4Frm #duemin').val(work.showduemin);
        if(work.showduemin=="00")
        {
          $('#workType4Frm #duemin').val(0);
        }
        $('#workType4Layer').show();
      }
      else if(work.workType==5)
      {
        resetWorkFrm("5");
        setupWorkFunction("5","edit");
        $('#workType5Frm #idWork').val(work.idWork);
        $('#workType5Frm #topic').val(work.topic);
        $('#workType5Frm #amount').val(work.amount);
        $('#workType5Frm #duedate').val(work.showduedate);
        $('#workType5Frm #duehour').val(work.showduehour);
        $('#workType5Frm #duemin').val(work.showduemin);
        if(work.showduemin=="00")
        {
          $('#workType5Frm #duemin').val(0);
        }
        $('#workType5Layer').show();
      }
      $('#workModal').modal('show');
    }
  }

  function setupWorkFunction(workType,cmd)
  {
    var frmname = "#workType"+workType+"Frm";
    $(frmname+' #cmd').val(cmd);
  }

  function resetWorkFrm(workType){
    var frmname = "#workType"+workType+"Frm";
    $(frmname)[0].reset();
  }

  function hideAllWorkTypeLayer(){
    for(var i=1 ; i<=5 ; i++)
    {
      $('#workType'+i+'Layer').hide();
    }
  }



</script>
