<?php
  include_once "model/Order.php";
  // $allOrder = Order::getAllOrder();
  // print_r($allOrder);
 ?>
 <div class="container">
   <div class="row">
     <div class="col-xs-12">
       <font color="#337ab7" size="5" class="glyphicon glyphicon-list-alt" aria-hidden="true"></font>
       &nbsp;&nbsp;&nbsp;
       <span class="font18 font_bold">รายการใบงาน</span>
     </div>
   </div>
   <br/>
   <div class="row">
     <div class="col-xs-12">
           <table id="table1" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
               <tr>
                   <th width="5%"></th>
                   <th width="10%">รายการ</th>
                   <th width="5%">จำนวนงาน</th>
                   <th width="20%">ผู้ขอ</th>
                   <th width="15%">สังกัด</th>
                   <th width="15%">แผนก</th>
                   <th width="15%">วันที่ลงรายการ</th>
                   <th width="10%">สถานะ</th>
                   <th width="5%">action</th>
               </tr>
           </thead>
           <tbody id="tbody">
           </tbody>
       </table>
   </div>
 </div>
</div>
<script>
  $(document).ready(function(){
    createTable();
  });

  function deleteOrder(obj)
  {
    var idOrder = $(obj).data('idorder');
    bootbox.confirm({
      message : "ต้องการลบใบงานนี้ใช่หรือไม่ ?",
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
            url: "controller/OrderController.php",
            catch:false,
            data:{"cmd":"delete","idOrder":idOrder},
            async:false,
            success:function(data){
              var obj = jQuery.parseJSON(data);
              if(obj.success==1)
              {
                createTable();
              }
            }
          });
        }
      }
    })
  }

  function createTable()
  {
    $.ajax({
      type:"POST",
      url:"view/json/orderJSON.php",
      catch:false,
      data:{"cmd":"getAllOrder"},
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
</script>
