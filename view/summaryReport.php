<div class="container">
  <div class="row">
    <div class="col-xs-12">
        <font color="#337ab7" size="5" class="glyphicon glyphicon-signal" aria-hidden="true"></font>
        &nbsp;&nbsp;&nbsp;
        <span class="font18 font_bold">สรุปรายการสิ่งพิมพ์</span>
    </div>
  </div>
  <br/><br/>
  <div class="row">
    <div class="col-xs-12">
      <?php include "filter_summary.php"?>
    </div>
    <div class="col-xs-12">
      <div id="result"></div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    createTable();
    $('#year,#month,#workType,#dept').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        createTable();
    });
  })

  function createTable()
  {
    $.ajax({
      type:"POST",
      url:'view/summaryReportResult.php',
      cache:false,
      data:$('#filterFrm').serialize(),
      async: true,
      success: function(result) {
        $('#result').html(result);
      }
    });
  }
</script>
