<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Chain Select With Codeigniter and Jquery</title>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" />
		<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/	css" media="all" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js" type="text/javascript"></script>
  </head>
  <body>
    <!-- page content -->
    <?php echo form_open('chain/submit');?>
    <div id="propinsi" style="width:250px;float:left;">
    Propinsi : <br/>
    <?php
    	echo form_dropdown("provinsi_id",$option_propinsi,"","id='propinsi_id'");
    ?>
    </div>
    <div id="kota">
    Kota / Kabupaten :<br/>
   	<?php
    	echo form_dropdown("kota_id",array('Pilih Kota / Kabupaten'=>'Pilih Propinsi Dahulu'),'','disabled');
    ?>
    </div>
    <?php echo form_submit("submit","Submit"); ?>
    <?php echo form_close(); ?>
    <script type="text/javascript">
	  	$("#propinsi_id").change(function(){
	    		var selectValues = $("#propinsi_id").val();
	    		if (selectValues == 0){
	    			var msg = "Kota / Kabupaten :<br><select name=\"kota_id\" disabled><option value=\"Pilih Kota / Kabupaten\">Pilih Propinsi Dahulu</option></select>";
	    			$('#kota').html(msg);
	    		}else{
	    			var propinsi_id = {propinsi_id:$("#propinsi_id").val()};
	    			$('#kota_id').attr("disabled",true);
	    			$.ajax({
							type: "POST",
							url : "<?php echo site_url('chain/select_kota')?>",
							data: propinsi_id,
							success: function(msg){
								$('#kota').html(msg);
							}
				  	});
	    		}
	    });
	   </script>
  </body>
</html>
