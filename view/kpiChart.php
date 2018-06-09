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
      <?php include "filter.php"?>
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

  $('#process , #worker').change(function(){
    getData();
  })

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
