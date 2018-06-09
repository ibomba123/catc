<?php
  include_once "model/Department.php";
  include_once "model/Employee.php";
  include_once "model/Order.php";
  $allDepthead = Department::getAllDepartmenthead();
  $allEmployee = Employee::getAllEmployeeAutoComplete();
  $lastId = Order::getLastOrderId();
?>
<div class="container">
  <form name="orderForm" id="orderFrm" method="post">
    <input type="hidden" name="cmd" value="add" />
    <div class="row">
      <div class="col-xs-12">
          <font color="#337ab7" size="5" class="glyphicon glyphicon-list-alt" aria-hidden="true"></font>
          &nbsp;&nbsp;&nbsp;
          <span class="font18 font_bold">กรอกแบบฟอร์มขอรับการสนับสนุนงานโรงพิมพ์</span>
      </div>
    </div>
    <br/><br/>
    <div class="row">
      <div class="col-xs-7">
        <div class="panel panel-primary">
          <div class="panel-body">
            <!-- <div class="row">
              <div class="col-xs-12">
                  <label class="font14"><u>ใบงานหมายเลข : <?=$lastId?></u></label>&nbsp;&nbsp;&nbsp;
              </div>
            </div>
            <br/> -->
            <div class="row">
              <div class="col-xs-12">
                  <div class="form-inline">
                    <label class="font14">หมายเลขใบงาน (กำหนดเอง) : </label>
                    <input style="width:100px;" name="idOrderReal" id="idOrderReal" type="number" class="form-control" />
                  </div>
              </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-xs-12">
                  <div class="form-inline">
                    <label class="font14">วันที่(รันเลข ออเดอร์) : </label>
                    <input style="width:200px;" name="orderdate" type="date" class="form-control" />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="font14">เวลา : </label>
                    <select name="orderhour" class="form-control" />
                      <?php
                        for($i=0;$i<=23;$i++)
                        {
                          echo "<option>$i</option>";
                        }
                      ?>
                    </select>
                    &nbsp;&nbsp;:&nbsp;&nbsp;
                    <select name="ordermin" class="form-control" />
                      <?php
                        for($i=0;$i<=60;$i+=15)
                        {
                          echo "<option>$i</option>";
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
                    <label class="font14">วันที่(รับต้นฉบับ) : </label>
                    <input style="width:200px;" name="originaldate" type="date" class="form-control" />
                    &nbsp;&nbsp;:&nbsp;&nbsp;
                    <label class="font14">เวลา : </label>
                    <select name="originalhour" class="form-control" />
                      <?php
                        for($i=0;$i<=23;$i++)
                        {
                          echo "<option>$i</option>";
                        }
                      ?>
                    </select>
                    &nbsp;&nbsp;:&nbsp;&nbsp;
                    <select name="originalmin" class="form-control" />
                      <?php
                        for($i=0;$i<=60;$i+=15)
                        {
                          echo "<option>$i</option>";
                        }
                      ?>
                    </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br/><br/>
    <div class="row">
      <div class="col-xs-9">
        <div class="row">
          <div class="col-xs-2">
              <label class="font16">ผู้ขอทำสำเนา :</label>&nbsp;&nbsp;&nbsp;
          </div>
          <div class="col-xs-3">
            <div class="form-group">
              <select class="selectpicker show-tick" data-live-search="true" name="owner">
                <?php
                  foreach ($allEmployee as $employee) {
                    echo "<option value='".$employee["idEmployee"]."'>".$employee["fullname"]."</option>";
                  }
                 ?>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <hr/><br/>
    <input type="hidden" id="indexType1" value="1">
    <input type="hidden" id="indexType2" value="1">
    <input type="hidden" id="indexType3" value="1">
    <input type="hidden" id="indexType4" value="1">
    <input type="hidden" id="indexType5" value="1">
    <div class="row">
      <div class="col-xs-12">
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
      </div>
      <br/><br/><br/>
      <div class="col-xs-12" id="dataDiv1">
        <div class="repeater1">
          <div data-repeater-list="type1">
            <div data-repeater-item>
              <div class="panel panel-primary" id="panel">
                <div class="panel-heading">
                    <label class="font14">เอกสารประกอบการสอน รายการที่</label> <label class="font14" id="index">1</label>
                </div>
                <div class="panel-body">
                  <div class="form-inline">
                    <div class="form-group">
                      <label for="name">เรื่อง</label>:
                      <input type="text" id="topic" name="topic" class="form-control" size="100"/>
                    </div>
                  </div>
                  <br/>
                  <div class="form-inline">
                    <div class="form-group" id="amountDiv">
                      <label for="name">จำนวน</label>:
                      <input type="number" id="amount" name="amount" class="form-control" value="0" onchange="calculateTotal(this);"/>
                      <label for="name">ชุด</label>
                    </div>
                    <div class="form-group" id="pageDiv">
                      <label for="name">ชุดละ</label>:
                      <input type="number" id="page" name="page" class="form-control" value="0" onchange="calculateTotal(this);"/>
                      <label for="name">หน้า</label>
                    </div>
                    <div class="form-group" id="totalDiv">
                      <label for="name">รวม</label>:
                      <input type="number" id="total" name="total" class="form-control" value="0"/>
                      <label for="name">หน้า</label>
                    </div>
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
                    <div class="form-group">
                      <label for="name">ต้องการรับวันที่</label>:&nbsp;&nbsp;&nbsp;
                      <input name="duedate" type="date" class="form-control" />
                      &nbsp;&nbsp;เวลา&nbsp;&nbsp;
                      <select name="duehour" class="form-control" />
                        <?php
                          for($i=0;$i<=23;$i++)
                          {
                            echo "<option>$i</option>";
                          }
                        ?>
                      </select>&nbsp;&nbsp;:&nbsp;&nbsp;
                      <select name="duemin" class="form-control" />
                        <?php
                          for($i=0;$i<=60;$i+=15)
                          {
                            echo "<option>$i</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="text-right" style="margin:10px;">
                  <span data-repeater-delete class="btn btn-danger btn-md">
                    <span class="glyphicon glyphicon-remove"></span> ลบ
                  </span>
                </div>
              </div>
              <br/>
              <hr/>
            </div>
          </div>
          <div class="text-left">
            <span data-repeater-create class="btn btn-info btn-md">
              <span class="glyphicon glyphicon-plus"></span> เพิ่มรายการ
            </span>
          </div>
        </div>
      </div>

      <div class="col-xs-12" id="dataDiv2" style="display:none;">
        <div class="repeater2">
          <div data-repeater-list="type2">
            <div data-repeater-item>
              <div class="panel panel-success" id="panel">
                <div class="panel-heading">
                    <label class="font14">เอกสารอื่นๆ รายการที่</label> <label class="font14" id="index">1</label>
                </div>
                <div class="panel-body">
                  <div class="form-inline">
                    <div class="form-group">
                      <label for="name">เรื่อง</label>:
                      <input type="text" id="topic" name="topic" class="form-control" size="100"/>
                    </div>
                  </div>
                  <br/>
                  <div class="form-inline">
                    <div class="form-group" id="amountDiv">
                      <label for="name">จำนวน</label>:
                      <input type="number" id="amount" name="amount" class="form-control" onchange="calculateTotal(this);"/>
                      <label for="name">ชุด</label>
                    </div>
                    <div class="form-group" id="pageDiv">
                      <label for="name">ชุดละ</label>:
                      <input type="number" id="page" name="page" class="form-control" onchange="calculateTotal(this);"/>
                      <label for="name">หน้า</label>
                    </div>
                    <div class="form-group" id="totalDiv">
                      <label for="name">รวม</label>:
                      <input type="number" id="total" name="total" class="form-control"/>
                      <label for="name">หน้า</label>
                    </div>
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
                    <div class="form-group">
                      <label for="name">ต้องการรับวันที่</label>:&nbsp;&nbsp;&nbsp;
                      <input name="duedate" type="date" class="form-control" />
                      &nbsp;&nbsp;เวลา&nbsp;&nbsp;
                      <select name="duehour" class="form-control" />
                        <?php
                          for($i=0;$i<=23;$i++)
                          {
                            echo "<option>$i</option>";
                          }
                        ?>
                      </select>&nbsp;&nbsp;:&nbsp;&nbsp;
                      <select name="duemin" class="form-control" />
                        <?php
                          for($i=0;$i<=60;$i+=15)
                          {
                            echo "<option>$i</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="text-right" style="margin:10px;">
                    <span data-repeater-delete class="btn btn-danger btn-md">
                      <span class="glyphicon glyphicon-remove"></span> ลบ
                    </span>
                  </div>
                </div>
              </div>
              <hr/>
            </div>
          </div>
          <div class="text-left">
            <span data-repeater-create class="btn btn-info btn-md">
              <span class="glyphicon glyphicon-plus"></span> เพิ่มรายการ
            </span>
          </div>
        </div>
      </div>

      <div class="col-xs-12" id="dataDiv3" style="display:none;">
        <div class="repeater3">
          <div data-repeater-list="type3">
            <div data-repeater-item>
              <div class="panel panel-info" id="panel">
                <div class="panel-heading">
                    <label class="font14">หนังสือ รายการที่</label> <label class="font14" id="index">1</label>
                </div>
                <div class="panel-body">
                  <div class="form-inline">
                    <div class="form-group">
                      <label for="name">เรื่อง</label>:
                      <input type="text" id="topic" name="topic" class="form-control" size="100"/>
                    </div>
                  </div>
                  <br/>
                  <div class="form-inline">
                    <div class="form-group" id="amountDiv">
                      <label for="name">จำนวน</label>:
                      <input type="number" id="amount" name="amount" class="form-control" onchange="calculateTotal(this);"/>
                      <label for="name">เล่ม</label>
                    </div>
                    <div class="form-group" id="pageDiv">
                      <label for="name">เล่มละ</label>:
                      <input type="number" id="page" name="page" class="form-control" onchange="calculateTotal(this);"/>
                      <label for="name">หน้า</label>
                    </div>
                    <div class="form-group" id="totalDiv">
                      <label for="name">รวม</label>:
                      <input type="number" id="total" name="total" class="form-control"/>
                      <label for="name">หน้า</label>
                    </div>
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
                    <div class="form-group">
                      <label for="name">ต้องการรับวันที่</label>:&nbsp;&nbsp;&nbsp;
                      <input name="duedate" type="date" class="form-control" />
                      &nbsp;&nbsp;เวลา&nbsp;&nbsp;
                      <select name="duehour" class="form-control" />
                        <?php
                          for($i=0;$i<=23;$i++)
                          {
                            echo "<option>$i</option>";
                          }
                        ?>
                      </select>&nbsp;&nbsp;:&nbsp;&nbsp;
                      <select name="duemin" class="form-control" />
                        <?php
                          for($i=0;$i<=60;$i+=15)
                          {
                            echo "<option>$i</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="text-right" style="margin:10px;">
                  <span data-repeater-delete class="btn btn-danger btn-md">
                    <span class="glyphicon glyphicon-remove"></span> ลบ
                  </span>
                </div>
              </div>
              <hr/>
            </div>
          </div>
          <div class="text-left">
            <span data-repeater-create class="btn btn-info btn-md">
              <span class="glyphicon glyphicon-plus"></span> เพิ่มรายการ
            </span>
          </div>
        </div>
      </div>

      <div class="col-xs-12" id="dataDiv4" style="display:none;">
        <div class="repeater4">
          <div data-repeater-list="type4">
            <div data-repeater-item>
              <div class="panel panel-warning" id="panel">
                <div class="panel-heading">
                    <label class="font14">เคลือบพลาสติก รายการที่</label> <label class="font14" id="index">1</label>
                </div>
                <div class="panel-body">
                  <div class="form-inline">
                    <div class="form-group">
                      <label for="name">เรื่อง</label>:
                      <input type="text" id="topic" name="topic" class="form-control" size="100"/>
                    </div>
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
                    <div class="form-group">
                      <label for="name">จำนวน</label>:
                      <input type="number" id="amount" name="amount" class="form-control"/>
                      <label for="name">แผ่น</label>
                    </div>
                  </div>
                  <br/>
                  <div class="form-inline">
                    <div class="form-group">
                      <label for="name">ต้องการรับวันที่</label>:&nbsp;&nbsp;&nbsp;
                      <input name="duedate" type="date" class="form-control" />
                      &nbsp;&nbsp;เวลา&nbsp;&nbsp;
                      <select name="duehour" class="form-control" />
                        <?php
                          for($i=0;$i<=23;$i++)
                          {
                            echo "<option>$i</option>";
                          }
                        ?>
                      </select>&nbsp;&nbsp;:&nbsp;&nbsp;
                      <select name="duemin" class="form-control" />
                        <?php
                          for($i=0;$i<=60;$i+=15)
                          {
                            echo "<option>$i</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="text-right" style="margin:10px;">
                    <span data-repeater-delete class="btn btn-danger btn-md">
                      <span class="glyphicon glyphicon-remove"></span> ลบ
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-left">
            <span data-repeater-create class="btn btn-info btn-md">
              <span class="glyphicon glyphicon-plus"></span> เพิ่มรายการ
            </span>
          </div>
        </div>
      </div>

      <div class="col-xs-12" id="dataDiv5" style="display:none;">
        <div class="repeater5">
          <div data-repeater-list="type5">
            <div data-repeater-item>
              <div class="panel panel-danger" id="panel">
                <div class="panel-heading">
                    <label class="font14">เข้าเล่ม สันห่วง + ปกพลาสติก หน้า-หลัง รายการที่</label> <label class="font14" id="index">1</label>
                </div>
                <div class="panel-body">
                  <div class="form-inline">
                    <div class="form-group">
                      <label for="name">เรื่อง</label>:
                      <input type="text" id="topic" name="topic" class="form-control" size="100"/>
                    </div>
                  </div>
                  <br/>
                  <div class="form-inline">
                    <div class="form-group">
                      <label for="name">จำนวน</label>:
                      <input type="number" id="amount" name="amount" class="form-control"/>
                      <label for="name">เล่ม</label>
                    </div>
                  </div>
                  <br/>
                  <div class="form-inline">
                    <div class="form-group">
                      <label for="name">ต้องการรับวันที่</label>:&nbsp;&nbsp;&nbsp;
                      <input name="duedate" type="date" class="form-control" />
                      &nbsp;&nbsp;เวลา&nbsp;&nbsp;
                      <select name="duehour" class="form-control" />
                        <?php
                          for($i=0;$i<=23;$i++)
                          {
                            echo "<option>$i</option>";
                          }
                        ?>
                      </select>&nbsp;&nbsp;:&nbsp;&nbsp;
                      <select name="duemin" class="form-control" />
                        <?php
                          for($i=0;$i<=60;$i+=15)
                          {
                            echo "<option>$i</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="text-right" style="margin:10px;">
                    <span data-repeater-delete class="btn btn-danger btn-md">
                      <span class="glyphicon glyphicon-remove"></span> ลบ
                    </span>
                  </div>
                </div>
              </div>
              <hr/>
            </div>
          </div>
          <div class="text-left">
            <span data-repeater-create class="btn btn-info btn-md">
              <span class="glyphicon glyphicon-plus"></span> เพิ่มรายการ
            </span>
          </div>
        </div>
      </div>
    </div>
    <hr/><br/>
    <div class="row">
      <div class="col-xs-9">
        <div class="row">
          <div class="col-xs-2">
              <label class="font16">Comment :</label>&nbsp;&nbsp;&nbsp;
          </div>
          <div class="col-xs-10">
              <textarea class="form-control" name="comment" rows="5" cols="70"></textarea>
          </div>
        </div>
      </div>
    </div>
    </br></br>
    <div class="row">
      <div class="col-xs-12">
        <button type="submit" class="btn btn-primary">บันทึก</button>
        <button type="button" id="resetBtn" class="btn btn-danger">ล้างค่า</button>
      </div>
    </div>
    <br/>
    <br/>
    <br/>
  </form>
</div>

<script>
  $(document).ready(function(){

    $('#idOrderReal').change(function(){
      var idOrderReal = $(this).val();
      if(idOrderReal>0)
      {
        $.ajax({
          type: "POST",
          url: "controller/OrderController.php",
          data:{"cmd":"checkIdOrderReal","idOrderReal":idOrderReal},
          catch:false,
          async:false,
          success:function(data){
            var obj = jQuery.parseJSON(data);
            if(obj.exist)
            {
              var idOrder = obj.order.idOrder ;
              bootbox.confirm({
                closeButton: false,
                message : "ใบงานหมายเลข "+idOrderReal+" มีอยู่ในระบบแล้ว",
                buttons : {
                  confirm:{
                    label : "ดำเนินการต่อ"
                  },
                  cancel:{
                    label : "ดูใบงานที่มีอยู่"
                  }
                },
                callback : function(result){
                  if(!result)
                  {
                    window.open('?view=workList&idOrder='+idOrder, '_blank');
                  }
                }
              });
            }
          }
        });
      }
    });
    $('.repeater1').repeater({
      show: function () {
          var index = parseInt($('#indexType1').val())+1;
          $('#indexType1').val(index);
          $(this).children('#panel').children('.panel-heading').children('#index').text(index);
          $(this).slideDown();
      },
      hide: function(deleteElement) {
        var index = parseInt($('#indexType1').val())-1;
        $('#indexType1').val(index);
        $(this).slideUp(deleteElement);
      },
      isFirstItemUndeletable: true
    });

    $('.repeater2').repeater({
      show: function () {
          var index = parseInt($('#indexType2').val())+1;
          $('#indexType2').val(index);
          $(this).children('#panel').children('.panel-heading').children('#index').text(index);
          $(this).slideDown();
      },
      hide: function(deleteElement) {
        var index = parseInt($('#indexType2').val())-1;
        $('#indexType2').val(index);
        $(this).slideUp(deleteElement);
      },
      isFirstItemUndeletable: true
    });

    $('.repeater3').repeater({
      show: function () {
          var index = parseInt($('#indexType3').val())+1;
          $('#indexType3').val(index);
          $(this).children('#panel').children('.panel-heading').children('#index').text(index);
          $(this).slideDown();
      },
      hide: function(deleteElement) {
        var index = parseInt($('#indexType3').val())-1;
        $('#indexType3').val(index);
        $(this).slideUp(deleteElement);
      },
      isFirstItemUndeletable: true
    });

    $('.repeater4').repeater({
      show: function () {
          var index = parseInt($('#indexType4').val())+1;
          $('#indexType4').val(index);
          $(this).children('#panel').children('.panel-heading').children('#index').text(index);
          $(this).slideDown();
      },
      hide: function(deleteElement) {
        var index = parseInt($('#indexType4').val())-1;
        $('#indexType4').val(index);
        $(this).slideUp(deleteElement);
      },
      isFirstItemUndeletable: true
    });

    $('.repeater5').repeater({
      show: function () {
          var index = parseInt($('#indexType5').val())+1;
          $('#indexType5').val(index);
          $(this).children('#panel').children('.panel-heading').children('#index').text(index);
          $(this).slideDown();
      },
      hide: function(deleteElement) {
        var index = parseInt($('#indexType5').val())-1;
        $('#indexType5').val(index);
        $(this).slideUp(deleteElement);
      },
      isFirstItemUndeletable: true
    });



    $('#workType').change(function(){
      for(var i=1;i<=5;i++)
      {
        if($(this).val()==i)
        {
          $('#dataDiv'+i).show();
        }
        else{
          $('#dataDiv'+i).hide();
        }
      }
    });

    $('#resetBtn').click(function(){
      location.reload();
    });


    var orderFrmValidator = $('#orderFrm').validate({
      rules :{
        owner:{
          required : true
        },
        receiver:{
          required : true
        }
      },
      messages:{
        owner:{
          required:'โปรดระบุผู้ขอทำสำเนา'
        },
        receiver:{
          required:'โปรดระบุผู้รับสำเนา'
        }
      },
      submitHandler: function(form) {
          $.ajax({
            type: "POST",
            url: "controller/OrderController.php",
            catch:false,
            data:$('#orderFrm').serialize(),
            async:false,
            success:function(data){
              var obj = jQuery.parseJSON(data);
              if(obj.success==1)
              {
                bootbox.alert({
                    message: "บันทึกข้อมูลเรียบร้อย",
                    callback: function () {
                        location.reload();
                    }
                })
              }
              return false ;
            }
          });
          return false ;
      }
    });
  });

  function calculateTotal(element){
    var type = $(element).prop('id');
    var total = 0;
    var val1 = $(element).val();
    var val2 = 0;
    if(type=="amount")
    {
      val2 = $(element).parent().siblings('#pageDiv').children('#page').val() ;
    }else if(type=="page")
    {
      val2 = $(element).parent().siblings('#amountDiv').children('#amount').val() ;
    }
    if(val1!="" && val2!="")
    {
      total = val1 * val2 ;
    }
    $(element).parent().siblings('#totalDiv').children('#total').val(total);
  }

</script>
