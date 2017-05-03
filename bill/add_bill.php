<?php

include('../header.php');
include('../utility/common.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_add_bill.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
$success = "none";
$bill_type = '';
$bill_date = '';
$bill_month = '';
$bill_year = '';
$total_amount = '';
$deposit_bank_name = '';
$bill_details = '';
$branch_id = '';
$title = $_data['text_1'];
$button_text = $_data['save_button_text'];
$successful_msg = $_data['text_15'];
$form_url = WEB_URL . "bill/add_bill.php";
$id="";
$hdnid="0";

if(isset($_POST['submit_bill'])){
	//echo"<script>alert('hello')</script>";
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
		date_default_timezone_set('Asia/Kolkata');
		$date=date('Y-m-d H:i:s');
		$billdate = $_POST['bill_date'];
		$bill_part = explode("/",$billdate);
		$bill_date_format=$bill_part[2]."-".$bill_part[0]."-".$bill_part[1];
		$duedate = $_POST['duedate'];
		$due = explode("/",$duedate);
		$due_format = $due[2]."-".$due[0]."-".$due[1];
		
		$monthfrom=$_POST['monthFrom'];
		$monthFrom=explode("/",$monthfrom);
		$from = $monthFrom[2]."-".$monthFrom[0]."-".$monthFrom[1];
		
		$monthto=$_POST['monthTo'];
		$monthTo=explode("/",$monthto);
		$to=$monthTo[2]."-".$monthTo[0]."-".$monthTo[1];
		
		$billtype= $_POST['bill_type'];
		$cost=$_POST['cost'];
		for($i=0;$i<count($billtype);$i++)
		{
			$bill=$billtype[$i];
			$cost_data=$cost[$i];
		$sql = "INSERT INTO tbl_admin_billing(unit_no,memberName,monthFrom,monthTo,bill_date,duedate,bill_type,cost,total,branch_id,insertDate) values('$_POST[unit_no]','$_POST[memberName]','$from','$to','$bill_date_format','$due_format','$bill','$cost_data','$_POST[total]','" . $_SESSION['objLogin']['branch_id'] . "','$date')";
		$result=mysql_query($sql,$link);
		}
		//mysql_close($link);
		if($result)
		{
		$url = WEB_URL . 'bill/bill_list.php?m=add';
		header("Location: $url");
		}
		else{
			echo "<script>alert('try')</script>";
		}
		
	}
	else{
		$billdate = $_POST['bill_date'];
		$bill_part = explode("/",$billdate);
		$bill_date_format=$bill_part[2]."-".$bill_part[0]."-".$bill_part[1];
		$duedate = $_POST['duedate'];
		$due = explode("/",$duedate);
		$due_format = $due[2]."-".$due[0]."-".$due[1];
		
		$billtype= $_POST['bill_type'];
		for($i=0;$i<count($billtype);$i++)
		{
			$billing=$billtype[$i];
		$sql = "UPDATE `tbl_admin_billing` SET `unit_no`='".$_POST['unit_no']."',`memberName`='".$_POST['memberName']."',`monthFrom`='".$_POST['monthFrom']."',monthTo='".$_POST['monthTo']."',`bill_date`='".$bill_date_format."',`duedate`='".$due_format."',bill_type='".$billing."',`total`='".$_POST['total']."' WHERE billingId='".$_GET['id']."'";
		$result = mysql_query($sql,$link);
		}
		//mysql_close($link);
		if($result)
		$url = WEB_URL . 'bill/bill_list.php?m=up';
		header("Location: $url");
	}

	$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_admin_billing where billingId = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$unit = $row['unit_no'];
		$member=$row['memberName'];
		$from=$row['monthFrom'];
		$to =$row['monthTo'];
		$billdate=$row['bill_date'];
		$duedate=$row['duedate'];
		$type=$row['bill_type'];
		$total = $row['total'];
		$cost=$row['cost'];
		$hdnid = $_GET['id'];
		
		$button_text = $_data['update_button_text'];
		$successful_msg = $_data['text_16'];
		$form_url = WEB_URL . "bill/add_bill.php?id=".$_GET['id'];
	}
	
	//mysql_close($link);

}
?>
<!-- Content Header (Page header) -->
<script>
$(funciton(){
  $('#plus').click(function() { 
	var x = $('.charge').val();
	alert(x);
	})

  })
</script>
<section class="content-header">
  <h1><?php echo $title;?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><?php echo $_data['text_2'];?></li>
    <li class="active"><?php echo $_data['text_3'];?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Full Width boxes (Stat box) -->
<div class="row">
  <div class="col-md-12">
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo WEB_URL; ?>bill/bill_list.php" data-original-title="<?php echo $_data['back_text'];?>"><i class="fa fa-reply"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['text_4'];?></h3>
      </div>
      <form onSubmit="return validateMe();"  method="post" enctype="multipart/form-data">
        <div class="box-body">
		<div class="row">
         <div class="form-group col-md-6 col-xs-12">
            <label for="unit_no"><span class="errorStar">*</span>Unit Number:</label>
            <select name="unit_no" id="unit_no" class="form-control" onChange="unitAjax(this.value)">
              <option value="">--<?php echo $_data['text_6'];?>--</option>
              <?php 
				  	$result_unit = mysql_query("SELECT * FROM tbl_add_unit order by uid ASC",$link);
					while($row_unit = mysql_fetch_array($result_unit)){?>
              <option value="<?php echo $row_unit['uid'];?>"<?php if($row_unit['uid']==@$unit) {echo "selected";}?>><?php echo $row_unit['unit_no'];?></option>
              <?php } ?>
            </select>
          </div>
          
          <div class="form-group col-md-6 col-xs-12">
		  <div id="member_data">
            <label for="unitno"><span class="errorStar">*</span>Member Name:</label>
            <select name="memberName" id="unit_no" class="form-control">
              <option value="">--<?php echo $_data['text_6'];?>--</option>
              
            </select>
          </div>
			</div>
         </div>
   
          <div class="row">
          <div class="form-group col-md-6 col-xs-12">
            <label for="ddlBillMonth"><span class="errorStar">*</span>Bill Period :</label><br>
           <div class="col-md-5 col-xs-12">From: <input type="text" name="monthFrom" id="from" value="<?php echo @$from;?>"></div>
           
           <div class="col-md-5 col-xs-12">To :<input style="margin-left:17px;" type="text" name="monthTo" id="to" value="<?php echo @$to;?>"></div>
          </div>
          
          
          <div class="form-group col-md-6 col-xs-12">
            <label for="ddlBillYear"><span class="errorStar">*</span>Bill Date :</label>
           <input type="text" name="bill_date" id="bill_date" class="form-control" value="<?php echo @$bill_date; ?>">
            
          </div>
          </div>
    
          <div class="row">
           <div class="form-group col-md-6 col-xs-12">
            <label for="ddlBillYear"><span class="errorStar">*</span><?php echo $_data['due_date'];?> :</label>
           <input type="text" name="duedate" id="duedate" class="form-control due" value="<?php if(isset($_GET['id'])) {echo $duedate;} ?>">
            
          </div>
          
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
	
		   $(function(){
		//alert('fasdfdsfdsfsdf');
	var total=0;
		 $('body').on('keyup','.charge',function() {
			 
			//alert('hello'); 
		var c = 	$(this).val();
		//alert(c);
//$(this).siblings('.brother').val(c);	  
			// var e =Nuc);
			  total= Number(total) + Number(c);
			 $("#total").val(total);
			 //var total = e;
			 
			 
			 
			// $(this).next('input').find('.brother').text(c);
			 //var d= $('#totalvalue').val();
			// var t = (d/100)*c;
			//$(this).parent().next('td').find('.brother').val(t) ;
			
			  
			 
			// console.log(c);
			 
			 
			 
			
		 }); 
		 
	 });

	  
  $( function() {
	
    $( ".due" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  
	  $('#bill_date').datepicker({ dateFormat: 'yy-mm-dd' });
	  
	  $('#from').datepicker({dateFormat : 'yy-mm-dd'});
	  $('#to').datepicker({dateFormat : 'yy-mm-dd'});
  } );
  </script>
            <div class="bill_append">
            <div class="form-group col-md-3 col-xs-12">
            <label for="ddlBillType"><span class="errorStar">*</span><?php echo $_data['text_5'];?> :</label><br>
            <select name="bill_type[]" id="bill_type" class="form-control">
              <option value="">--<?php echo $_data['text_6'];?>--</option>
              <?php 
				  	$result_unit = mysql_query("SELECT * FROM tbl_add_bill_type order by bt_id ASC",$link);
					while($row_unit = mysql_fetch_array($result_unit)){?>
              <option value="<?php echo $row_unit['bt_id'];?>"<?php if($row_unit['bt_id']==@$type) {echo "selected";}?>><?php echo $row_unit['bill_type'];?></option>
              <?php } ?>
            </select>
			</div>
			<div class="form-group col-md-3 col-xs-12">	
            <?php if(isset($_GET['id'])) { ?>
           
          
          	  
		   <label>Cost:</label><input type="text" name="cost" value="<?php echo $cost;?>" class="charge form-control">
           <?php } else { ?>
           <label >Cost:</label><input type="text" name="cost[]" class="charge form-control">
           <?php  } ?>
		   <a id="bill_click" style="font-size:20px; font-weight:bold; cursor:pointer;"><span class="pull-right">+</span></a>
           </div>
           </div>
          </div>
          
          
           
          
          <script>
			  $(function(){
				  $("#bill_click").click(function(){
					  $(".bill_append").append("<div class='col-md-6'></div><div class='col-md-3 col-xs-12'><label>Bill Type</label><select name='bill_type[]' class='form-control'><option>Select Bill Type</option><?php $result_unit = mysql_query("SELECT * FROM tbl_add_bill_type order by bt_id ASC",$link);
					while($row_unit = mysql_fetch_array($result_unit)){?> <option value='<?php echo $row_unit['bt_id'];?>'><?php echo $row_unit['bill_type'];?></option> <?php } ?></select></div><div class='col-md-3 col-xs-12'> <label> Cost:</label><input type='text' name='cost[]' class='charge form-control'></div>");
				  })
			  })
		  </script>
		<div class="row">
          <div class="form-group col-md-6 col-xs-12">
            <label for="txtTotalAmount"><span class="errorStar">*</span><?php echo $_data['text_12'];?> :</label>
            <div class="input-group">
              <input type="text" name="total" value="<?php if(isset($_GET['id'])) {echo $total;}?>" id="total" class="form-control"/>
              <div class="input-group-addon"></div>
            </div>
          </div>
          </div>
          
       
          <div class="form-group pull-right">
            <input type="submit" name="submit_bill" class="btn btn-primary" value="<?php echo $button_text; ?>"/>
          </div>
        </div>
        <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
      </form>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row -->


<script type="text/javascript">
	
	function unitAjax(str) 
{ 
//alert(str);
if (str=="") 
  { 
  return; 
  }  
if (window.XMLHttpRequest) 
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest(); 
  } 
else 
  {// code for IE6, IE5 
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
  } 
 //alert('hell)');
xmlhttp.open("GET","../ajax/unitAjax.php?q="+str,true);
xmlhttp.send();
xmlhttp.onreadystatechange=function() 
  { 
	//lert('lfjkdsalkfjd');
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    { 
	//alert(xmlhttp.responseText);
document.getElementById("member_data").innerHTML=xmlhttp.
responseText; 
    }  }
}  
	
	
function validateMe(){
	if($("#ddlBillType").val() == ''){
		alert("Bill Type Required !!!");
		$("#ddlBillType").focus();
		return false;
	}
	else if($("#txtBillDate").val() == ''){
		alert("Date is Required !!!");
		$("#txtBillDate").focus();
		return false;
	}
	else if($("#ddlBillMonth").val() == ''){
		alert("Bill Month is Required !!!");
		$("#ddlBillMonth").focus();
		return false;
	}
	else if($("#ddlBillYear").val() == ''){
		alert("Bill Year is Required !!!");
		$("#ddlBillYear").focus();
		return false;
	}
	else if($("#txtTotalAmount").val() == ''){
		alert("Total is Required !!!");
		$("#txtTotalAmount").focus();
		return false;
	}
	else if($("#txtDepositBankName").val() == ''){
		alert("Bank Name is Required !!!");
		$("#txtDepositBankName").focus();
		return false;
	}
	else if($("#txtBillDetails").val() == ''){
		alert("Bill Details Required !!!");
		$("#txtBillDetails").focus();
		return false;
	}
	else{
		return true;
	}
}
</script>
<?php include('../footer.php'); ?>
