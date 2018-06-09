<?php
  include_once "model/Department.php";
  $allDepthead = Department::getAllDepartmenthead();
?>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
        <font color="#337ab7" size="5" class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></font>
        &nbsp;&nbsp;&nbsp;
        <span class="font18 font_bold">จัดการพนักงาน</span>
        &nbsp;&nbsp;&nbsp;
        <a href='#modal1' data-toggle='modal'  id="addBtn">
            <button type="button" class="btn btn-primary">เพิ่มพนักงาน</button>
        </a>
    </div>
  </div>
  <br/>
  <div class="row">
      <div class="col-xs-12">
        <div class="form-inline">
          <div class="form-group">
            <label for="idDepthead" class="font16">สังกัด</label>&nbsp;&nbsp;
            <select class="form-control" name="idDepthead" id="idDepthead">
              <option value="0" >ทั้งหมด</option>
              <?php
                foreach ($allDepthead as $depthead) {
              ?>
              <option value="<?=$depthead["idDepthead"]?>"><?=$depthead["name"]?></option>
              <?php
                }
              ?>
            </select>
            &nbsp;&nbsp;
            <label for="idDept" class="font16">แผนก</label>&nbsp;&nbsp;
            <select class="form-control" name="idDept" id="idDept">
              <option value="0" >ทั้งหมด</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-xs-12">
            <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="5%"></th>
                    <th width="20%">ชื่อ - นามสกุล</th>
                    <th width="20%">สังกัด</th>
                    <th width="15%">แผนก</th>
                    <th width="20%">ตำแหน่ง</th>
                    <th width="10%">เบอร์โทรศัพท์</th>
                    <th width="10%"></th>
                </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
        </table>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form  method="post" id="modalFrm1" name="modalFrm1" action="">
        <div class="modal-header theme-background">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modalTitle">เพิ่มพนักงาน</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="cmd" id="cmd" />
    			<input type="hidden" name="idEmployee" id="idEmployee" value="0" />
          <div class="form-inline">
            <div class="form-group">
              <label for="name">คำนำหน้า</label>:
              <input type="text" id="title" name="title" class="form-control" />
            </div>
          </div>
          <br/>
          <div class="form-inline">
            <div class="form-group">
              <label for="name">ชื่อ</label>:
              <input type="text" id="firstname" name="firstname" class="form-control" />
            </div>
            <div class="form-group">
              <label for="name">นามสกุล</label>:
              <input type="text" id="lastname" name="lastname" class="form-control" />
            </div>
          </div>
          <br/>
          <div class="form-inline">
            <div class="form-group">
              <label for="name">สังกัด</label>:
              <select class="form-control" name="depthead" id="depthead">
                <option value="" >โปรดเลือก</option>
                <?php
                  foreach ($allDepthead as $depthead) {
                ?>
                <option value="<?=$depthead["idDepthead"]?>"><?=$depthead["name"]?></option>
                <?php
                  }
                ?>
              </select>
            </div>
          </div>
          <br/>
          <div class="form-inline">
            <div class="form-group">
              <label for="name">แผนก</label>:
              <select class="form-control" name="dept" id="dept" disabled>
                <option value="0" >โปรดเลือก</option>
              </select>
            </div>
          </div>
          <br/>
          <div class="form-inline">
            <div class="form-group">
              <label for="name">ตำแหน่ง</label>:
              <input type="text" id="position" name="position" class="form-control" />
            </div>
            <div class="form-group">
              <label for="name">เบอร์โทรศัพท์</label>:
              <input type="text" id="tel" name="tel" class="form-control" />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          <button type="submit" class="btn btn-primary">บันทึก</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(document).ready(function() {
  createTable(0,0);

  $('#idDepthead').change(function(){
      var idDepthead = $(this).val();
      getDept(idDepthead,"page");
      createTable(idDepthead,$('#idDept').val());
  });

  $('#idDept').change(function(){
      var idDept = $(this).val();
      createTable($('#idDepthead').val(),idDept);
  });

  $('#depthead').change(function(){
      var idDepthead = $(this).val();
      getDept(idDepthead,"modal");
  });

  var modalFrm1validator = $('#modalFrm1').validate({
    rules :{
      title:{
        required : true
      },
      firstname:{
        required : true
      },
      lastname:{
        required : true
      },
      position:{
        required : true
      },
      depthead:{
        required : true
      }
    },
    messages:{
      title:{
        required:'โปรดระบุคำนำหน้า'
      },
      firstname:{
        required:'โปรดระบุชื่อ'
      },
      lastname:{
        required:'โปรดระบุนามสกุล'
      },
      position:{
        required:'โปรดระบุตำแหน่ง'
      }
    },
    errorPlacement: function(error,element) {
      if($(element).is('input:text'))
      {
          $(element).prop('placeholder',error.text());
      }
      return false ;
    },
    highlight: function ( element, errorClass, validClass ) {
		    $( element ).closest( ".form-group" ).addClass( "has-error" );
		},
		unhighlight: function (element, errorClass, validClass) {
			  $( element ).closest( ".form-group" ).removeClass( "has-error" );
		},
    submitHandler: function(form) {
        $.ajax({
          type: "POST",
          url: "controller/EmployeeController.php",
          catch:false,
          data:$('#modalFrm1').serialize(),
          async:false,
          success:function(data){
            //console.log(data);
            var obj = jQuery.parseJSON(data);
            if(obj.success==1)
            {
              $('#modal1').modal("hide");
              createTable(0,0);
            }
            return false ;
          }
        });
        return false ;
    }
  });

  $('#addBtn').click(function(){
      clearForm($('#modalFrm1'),modalFrm1validator);
      $('#idEmployee').val("0");
      $('#cmd').val("add");
      $('#modalTitle').text("เพิ่มพนักงาน");
  });
});

function deleteEmployee(obj)
{
  var idEmployee = $(obj).data('idemployee');
  bootbox.confirm({
    message : "ต้องการลบพนักงานคนนี้ใช่หรือไม่ ?",
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
          url: "controller/EmployeeController.php",
          catch:false,
          data:{"cmd":"delete","idEmployee":idEmployee},
          async:false,
          success:function(data){
            var obj = jQuery.parseJSON(data);
            if(obj.success==1)
            {
              createTable(0,0);
            }
          }
        });
      }
    }
  })
}

function editEmployee(obj)
{
  var idEmployee = $(obj).data('idemployee');
  var title = $(obj).data('title');
  var firstname = $(obj).data('firstname');
  var lastname = $(obj).data('lastname');
  var position = $(obj).data('position');
  var depthead = $(obj).data('depthead');
  var dept = $(obj).data('dept');
  var tel = $(obj).data('tel');

  $('#idEmployee').val(idEmployee);
  $('#title').val(title);
  $('#firstname').val(firstname);
  $('#lastname').val(lastname);
  $('#position').val(position);
  $('#tel').val(tel);
  $('#depthead').val(depthead);
  getDept(depthead,"modal");
  if(dept!=0)
  {
      $('#dept').val(dept);
  }
  else {
    $('#dept').val("");
  }
  $('#modalTitle').text("แก้ไขพนักงาน");
  $('#cmd').val("edit");
  $('#modal1').modal("show");
}

function clearForm(form,validator)
{
  form[0].reset();
  validator.resetForm();
  form.find('.form-group').removeClass('has-error');
  getDept("","modal");
}

function createTable(idDepthead,idDept)
{
  //console.log(idDepthead,idDept)
  $.ajax({
    type:"POST",
    url:"view/json/employeeJSON.php",
    catch:false,
    data:{"idDepthead":idDepthead,"idDept":idDept,"cmd":"getAllEmployee"},
    async:false,
    success:function(result){
      //console.log(result);
      $('#table1').dataTable().fnDestroy();
      $('#tbody').empty();
      $('#tbody').append(result);
      table =  $('#table1').DataTable({
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
                "first": "หน้าสุด"
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

function getDept(idDepthead,type)
{
  var cmd = "getDept";
  if(type=="modal")
  {
    cmd = "getDeptModal"
  }
  $.ajax({
    type:"POST",
    url:"view/json/departmentJSON.php",
    catch:false,
    data:{"idDepthead":idDepthead,"cmd":cmd},
    async:false,
    success:function(result){
      if(type=="page")
      {
        $('#idDept').empty();
        $('#idDept').append(result);
      }
      else if(type="modal")
      {
        $('#dept').empty();
        $('#dept').append(result);
        if(idDepthead!="")
        {
          $('#dept').prop('disabled',false);
        }
        else {
          $('#dept').prop('disabled',true);
        }

      }
    }
  });
}
</script>
