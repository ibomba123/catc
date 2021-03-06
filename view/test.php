
<style>
  #chartdiv {
  width		: 100%;
  height		: 400px;
  font-size	: 11px;
}
</style>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
        <font color="#337ab7" size="5" class="glyphicon glyphicon-signal" aria-hidden="true"></font>
        &nbsp;&nbsp;&nbsp;
        <span class="font18 font_bold">KPI ปริมาณงานต่อคน</span>
    </div>
  </div>
  <br/><br/>
  <div class="row">
    <div class="col-xs-3">
      <div class="panel panel-primary">
       <div class="panel-heading">
         ค้นหา
       </div>
       <div class="panel-body">
         <div class="row">
           <div class="col-xs-12">
             <span>พนักงานพิมพ์</span>
           </div>
         </div>
         <br/>
         
       </div>
     </div>
    </div>
    <div class="col-xs-9">
      <div id="chartdiv"></div>
    </div>
  </div>
</div>
<script>

var chart = null ;
$(document).ready(function(){
  getData();

  function getData()
  {
    $.ajax({
      type:"POST",
      url:"view/json/kpiJSON.php",
      catch:false,
      data:$('#filterFrm').serialize(),
      async:false,
      success:function(result){
        $('#chartdiv').html(result);
      }
    });
  }
});

</script>
