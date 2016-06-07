<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>KitchenCabinetCo.com | Spring Hill, Tennessee | Admin Page</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
   <script language="JavaScript"><!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
// -->
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="../tinymce/tinymce.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function() {
tinymce.init({
theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
    font_size_style_values: "12px,13px,14px,16px,18px,20px",
	forced_root_block: false,
	force_br_newlines : true,
	force_p_newlines: false,
	convert_urls:false,
	selector: "textarea",
	theme: "modern",
	width : "700px",
	height:"350",
	relative_urls : false,
	remove_script_host : true,
	plugins: [
		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen",
		"insertdatetime media nonbreaking save table contextmenu directionality",
		"emoticons template paste textcolor moxiemanager"
	],
	toolbar1: "insertfile undo redo | styleselect | bold italic | | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	toolbar2: "print preview media | forecolor backcolor emoticons",
	image_advtab: true,
	templates: [
		{title: 'Test template 1', content: '<b>Test 1</b>'},
		{title: 'Test template 2', content: '<em>Test 2</em>'}
	],
	autosave_ask_before_unload: false
});
});

function select_all (form, count) {
//alert("hello");
 for (i = 1; i <= count; i++) {
  eval('dfm.chkbox_'+i+'.checked = true;');
  }
 }
 
 function clear_all (form, count) {
//alert("hello");
 for (i = 1; i <= count; i++) {
  eval('dfm.chkbox_'+i+'.checked = false;');
  }
 }
 
function checkAll(dfm, checktoggle)
{
  var checkboxes = new Array(); 
  checkboxes = document[dfm].getElementsByTagName('input');
 
  for (var i=0; i<checkboxes.length; i++)  {
    if (checkboxes[i].type == 'checkbox')   {
      checkboxes[i].checked = checktoggle;
    }
  }
}

      
$(document).ready(function () {

	$('#checkAllCheckBox').click(function () {
		$('table.tableClass input:checkbox').not(this).prop('checked', this.checked);
	});
});

</script>
</head>
<?php 
include("../carter.inc"); 
$cxn = mysqli_connect($host,$user,$password,$database)
or die ("couldn't connect to server");
?>
<body>
<div id="container">
   <div id="header"><IMG SRC="images/admin_header.jpg"></div>
   <div id="body">
		<div id="body_container">