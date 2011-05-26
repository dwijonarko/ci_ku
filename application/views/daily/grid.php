<!DOCTYPE HTML>
<html lang="en-US">
 	<head>
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" />
		<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
		<link type="text/css" href="<?php echo base_url()?>jqgrid/css/ui.jqgrid.css" rel="stylesheet" />
		<link type="text/css" href="<?php echo base_url()?>jqgrid/css/jquery.searchFilter.css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>jqgrid/js/i18n/grid.locale-en.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>jqgrid/jquery.jqGrid.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>jqgrid/jquery.jqGrid.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>jqgrid/jquery.layout.js"></script>

		<title>Demo Jquery JqGrid Codeigniter</title>
	</head>
	<body>
		<?
			$ci =& get_instance();
			$base_url = base_url();
		?>

		<script type="text/javascript">
			jQuery().ready(function (){
				jQuery("#list1").jqGrid({
		   			url:'<?=$base_url.'index.php/daily/loadDataGrid'?>',      //another controller function for generating data
					mtype : "post",             //Ajax request type. It also could be GET
					datatype: "json",            //supported formats XML, JSON or Arrray
		   			colNames:['Date','Name','Amount'],       //Grid column headings
		   			colModel:[
				   		{name:'date',index:'date', width:30, align:"left"},
				   		{name:'name',index:'name', width:20, align:"left"},
				   		{name:'amount',index:'amount', width:20, align:"right"},
		  			],
				   	rowNum:10,
				   	width: 450,
						height: 300,
				   	rowList:[10,20,30],
				   	pager: '#pager1',
				   	sortname: 'id',
				    viewrecords: true,
					rownumbers: true,
					gridview: true,
					caption:"List Daily"
				}).navGrid('#pager1',{edit:false,add:false,del:false});
			});
		</script>

		<table id="list1"></table> <!--Grid table-->
		<div id="pager1"></div>  <!--pagination div-->
	</body>
</html>

