<?php 
include('../header.php');
include('../utility/common.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_add_serviceprovider.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
                $s_name = '';
		$s_providerName = '';
		$s_contact = '';
		$s_mobile = '';
		$s_email = '';
		$s_address = '';
		$s_startDate = '';
		$s_endDate = '';
		$amount = '';
		$s_status = 'Active';
$success = "none";
//$e_name = '';
//$e_email = '';
//$e_contact = '';
//$e_pre_address = '';
//$e_per_address = '';
$e_nid = '';
$e_designation = 0;
$e_date = '';
$ending_date = '';
$e_status = 'Active';
$e_password = '';
$branch_id = '';
$title = $_data['add_new_employee'];
$button_text = $_data['save_button_text'];
$successful_msg = $_data['added_employee_successfully'];
$form_url = WEB_URL . "service/addserviceprovider.php";
$id="";
$hdnid="0";
$image_emp = WEB_URL . 'img/no_image.jpg';
$img_track = '';

if(isset($_POST['txtEmpName'])){
//        echo '<pre>';
//    print_r($_POST);
//    echo '<pre>';
    //die;
    
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$e_password = $_POST['txtEmpAmount'];
	$image_url = uploadImage();
        date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d H:i:s');
	if(isset($_POST['chkEmpStaus'])){
			$e_status = $_POST['chkEmpStaus'];
	}
	echo $sql = "INSERT INTO tbl_serviceform(serviceName,serviceProvider, mobileNumber, contactNumber,email,address,amc_Start_Date,amc_End_Date,amc_Amount,status,cDate,c_userid,branch_id) values('$_POST[ddlMemberType]','$_POST[txtEmpName]','$_POST[txtMobile]','$_POST[txtEmpContact]','$_POST[txtEmpEmail]','$_POST[txtEmpPreAddress]','$_POST[txtEmpDate]','$_POST[txtEndingDate]','$e_password','$e_status','".$date."','".(int)$_SESSION['objLogin']['user_id']."','" . $_SESSION['objLogin']['branch_id'] . "')";
	mysql_query($sql,$link);
	mysql_close($link);
	$url = WEB_URL . 'service/addserviceprovider.php?m=add';
	header("Location: $url");
	
}
else{
//	$image_url = uploadImage();
//	if($image_url == ''){
//		$image_url = $_POST['img_exist'];
//	}
//            echo '<pre>';
//    print_r($_POST);
//    echo '<pre>';
//    die;
        date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d H:i:s');
	if(isset($_POST['chkEmpStaus'])){
			//$e_status = 1;
	}
	echo $sql = "UPDATE `tbl_serviceform` SET "
                . "`serviceName`='".$_POST['ddlMemberType']."',"
                . "`serviceProvider`='".$_POST['txtEmpName']."',"
                . "`mobileNumber`='".$_POST['txtMobile']."',"
                . "`contactNumber`='".$_POST['txtEmpContact']."',"
                . "`email`='".$_POST['txtEmpEmail']."',"
                . "`address`='".$_POST['txtEmpPreAddress']."',"
                . "`amc_Start_Date`='".$_POST['txtEmpDate']."',"
                . "`amc_End_Date`='".$_POST['txtEndingDate']."',"
                . "`amc_Amount`='".$_POST['txtEmpAmount']."',"
                . "`status`='".$_POST['chkEmpStaus']."',"
                . "`cDate`='".$date."'"
                . " WHERE `serviceId`='".$_GET['id']."'";
        //die;
	mysql_query($sql,$link);
	$url = WEB_URL . 'service/addserviceprovider.php?m=up';
	header("Location: $url");
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_serviceform where serviceId = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_assoc($result)){
//		echo '<pre>';
//                print_r($row);
//                echo '<pre>';
//                die;
		$s_name = $row['serviceName'];
		$s_providerName = $row['serviceProvider'];
		$s_contact = $row['contactNumber'];
		$s_mobile = $row['mobileNumber'];
		$s_email = $row['email'];
		$s_address = $row['address'];
		$s_startDate = $row['amc_Start_Date'];
		$s_endDate = $row['amc_End_Date'];
		$amount = $row['amc_Amount'];
		$s_status = $row['status'];
		//$e_password = $row['e_password'];
//		if($row['image'] != ''){
//			$image_emp = WEB_URL . 'img/upload/' . $row['image'];
//			$img_track = $row['image'];
//		}
		$hdnid = $_GET['id'];
		$title = $_data['update_employee'];
		$button_text =$_data['update_button_text'];
		$successful_msg="Update Employee Successfully";
		$form_url = WEB_URL . "service/addserviceprovider.php?id=".$_GET['id'];
	}
	
	//mysql_close($link);

}

//for image upload
function uploadImage(){
	if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
	  $filename = basename($_FILES['uploaded_file']['name']);
	  $ext = substr($filename, strrpos($filename, '.') + 1);
	  if(($ext == "jpg" && $_FILES["uploaded_file"]["type"] == 'image/jpeg') || ($ext == "png" && $_FILES["uploaded_file"]["type"] == 'image/png') || ($ext == "gif" && $_FILES["uploaded_file"]["type"] == 'image/gif')){   
	  	$temp = explode(".",$_FILES["uploaded_file"]["name"]);
	  	$newfilename = NewGuid() . '.' .end($temp);
		move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], ROOT_PATH . '/img/upload/' . $newfilename);
		return $newfilename;
	  }
	  else{
	  	return '';
	  }
	}
	return '';
}
function NewGuid() { 
    $s = strtoupper(md5(uniqid(rand(),true))); 
    $guidText = 
        substr($s,0,8) . '-' . 
        substr($s,8,4) . '-' . 
        substr($s,12,4). '-' . 
        substr($s,16,4). '-' . 
        substr($s,20); 
    return $guidText;
}
	
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1><?php echo $title;?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>/dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><?php echo $_data['add_new_employee_information_breadcam'];?></li>
    <li class="active"><?php echo $_data['add_new_employee_breadcam'];?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Full Width boxes (Stat box) -->
<div class="row">
  <div class="col-md-12">
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo WEB_URL; ?>employee/employeelist.php" data-original-title="<?php echo $_data['back_text'];?>"><i class="fa fa-reply"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['add_new_employee_entry_form'];?></h3>
      </div>
      <form onSubmit="return validateMe();" action="<?php echo $form_url; ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
		
		<div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="ddlMemberType"><?php echo $_data['add_new_form_field_text_16'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlMemberType" id="ddlMemberType" class="form-control">
              <option value="">--<?php echo $_data['add_new_form_field_text_17'];?>--</option>
              <?php 
				  	$result_type = mysql_query("SELECT * FROM master_servicelist order by serviceName ASC",$link);
					while($row_type = mysql_fetch_array($result_type)){
				  ?>
              <option <?php if($s_name == $row_type['serviceId']){echo 'selected';}?> value="<?php echo $row_type['serviceId'];?>"><?php echo $row_type['serviceName'];?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpName"><?php echo $_data['add_new_form_field_text_1'];?> <span style="color:red;">*</span> :</label>
            <input type="text" onkeypress="return isChar(event)" name="txtEmpName" value="<?php echo $s_providerName;?>" id="txtEmpName" class="form-control" />
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpEmail"><?php echo $_data['add_new_form_field_text_2'];?> <span style="color:red;">*</span> :</label>
            <input type="text"  name="txtEmpEmail" value="<?php echo $s_email;?>" id="txtEmpEmail" class="form-control" />
          </div>
          </div>
		  
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtPassword"><?php echo $_data['add_new_form_field_text_3'];?> <span style="color:red;">*</span> :</label>
            <input type="text" name="txtMobile" value="<?php echo $s_mobile;?>" id="txtMobile" class="form-control" />
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpContact"><?php echo $_data['add_new_form_field_text_4'];?> <span style="color:red;">*</span> :</label>
            <input type="text" minlength="10" maxlength="10" onkeypress="return isNumber(event)" name="txtEmpContact" value="<?php echo $s_contact;?>" id="txtEmpContact" class="form-control" />
          </div>
            <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpContact"><?php echo $_data['add_new_form_field_text_18'];?> <span style="color:red;">*</span> :</label>
            <input type="text" onkeypress="return isNumber(event)" name="txtEmpAmount" value="<?php echo $amount;?>" id="txtEmpAmount" class="form-control" />
          </div>
          </div>
		  
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpPreAddress"><?php echo $_data['add_new_form_field_text_5'];?> <span style="color:red;">*</span> :</label>
            <textarea name="txtEmpPreAddress" id="txtEmpPreAddress" class="form-control"><?php echo $s_address;?></textarea>
          </div>
<!--          <div class="form-group">
            <label for="txtEmpPerAddress"><?php echo $_data['add_new_form_field_text_6'];?> <span style="color:red;">*</span> :</label>
            <textarea name="txtEmpPerAddress" id="txtEmpPerAddress" class="form-control"><?php echo $e_per_address;?></textarea>
          </div>
          <div class="form-group">
            <label for="txtEmpNID"><?php echo $_data['add_new_form_field_text_7'];?> <span style="color:red;">*</span> :</label>
            <input type="text" name="txtEmpNID" value="<?php echo $e_nid;?>" id="txtEmpNID" class="form-control" />
          </div>
          <div class="form-group">
            <label for="ddlMemberType"><?php echo $_data['add_new_form_field_text_8'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlMemberType" id="ddlMemberType" class="form-control">
              <option value="">--<?php echo $_data['add_new_form_field_text_15'];?>--</option>
              <?php 
				  	$result_type = mysql_query("SELECT * FROM tbl_add_member_type order by member_id ASC",$link);
					while($row_type = mysql_fetch_array($result_type)){
				  ?>
              <option <?php if($e_designation == $row_type['member_id']){echo 'selected';}?> value="<?php echo $row_type['member_id'];?>"><?php echo $row_type['member_type'];?></option>
              <?php }?>
            </select>
          </div>-->
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpDate"><?php echo $_data['add_new_form_field_text_9'];?> <span style="color:red;">*</span> :</label>
            <input type="text" name="txtEmpDate" value="<?php echo $s_startDate;?>" id="txtEmpDate" class="form-control datepicker"/>
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEndingDate"><?php echo $_data['add_new_form_field_text_10'];?> :</label>
            <input type="text" name="txtEndingDate" value="<?php echo $s_endDate;?>" id="txtEndingDate" class="form-control datepicker"/>
          </div>
          </div>
          <div class="form-group">
            <label for="chkRStaus"><?php echo $_data['add_new_form_field_text_11'];?> :</label>
            &nbsp;&nbsp;
            <input type="checkbox" name="chkEmpStaus" id="chkEmpStaus" <?php if($s_status == 'Active'){echo 'checked';}?> value="<?php echo $s_status;?>" class="minimal" />
            &nbsp;&nbsp;
            <?php if($s_status == 'Active'){echo $_data['add_new_form_field_text_12'];} else{echo $_data['add_new_form_field_text_13'];}?>
          </div>
<!--          <div class="form-group">
            <label for="Prsnttxtarea"><?php echo $_data['add_new_form_field_text_14'];?> :</label>
            <img class="form-control" src="<?php echo $image_emp; ?>" style="height:100px;width:100px;" id="output"/>
            <input type="hidden" name="img_exist" value="<?php echo $img_track; ?>" />
          </div>
          <div class="form-group"> <span class="btn btn-file btn btn-primary"><?php echo $_data['upload_image'];?>
            <input type="file" name="uploaded_file" onchange="loadFile(event)" />
            </span> </div>-->
          <div class="form-group pull-right">
            <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $button_text; ?>"/>
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
function validateMe(){
	if($("#txtEmpName").val() == ''){
		$("#ddlCamplainType").css("border","1px solid red");
		$("#txtEmpName").focus();
		return false;
	}
	else if($("#txtEmpEmail").val() == '' || !ValidateEmail($("#txtEmpEmail").val()) ){
		$("#ddlCamplainType").css("border","1px solid red");
		$("#txtEmpEmail").focus();
		return false;
	}
	else if($("#txtPassword").val() == ''){
		$("#ddlCamplainType").css("border","1px solid red");
		$("#txtPassword").focus();
		return false;
	}
	else if($("#txtEmpContact").val() == '' || $("#txtRContact").val().length!=10){
		$("#ddlCamplainType").css("border","1px solid red");
		$("#txtEmpContact").focus();
		return false;
	}
	else if($("#txtEmpPreAddress").val() == ''){
		$("#ddlCamplainType").css("border","1px solid red");
		$("#txtEmpPreAddress").focus();
		return false;
	}
	else if($("#txtEmpPerAddress").val() == ''){
		$("#ddlCamplainType").css("border","1px solid red");
		$("#txtEmpPerAddress").focus();
		return false;
	}
	else if($("#txtEmpNID").val() == ''){
		$("#ddlCamplainType").css("border","1px solid red");
		$("#txtEmpNID").focus();
		return false;
	}
	else if($("#ddlMemberType").val() == ''){
		$("#ddlCamplainType").css("border","1px solid red");
		$("#ddlMemberType").focus();
		return false;
	}
	else if($("#txtEmpDate").val() == ''){
		$("#ddlCamplainType").css("border","1px solid red");
		$("#txtEmpDate").focus();
		return false;
	}
	else{
		return true;
	}
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function validateEmail(email) 
{
    var re = /\S+@\S+\.\S+/;
    if(re.test(email))
        {
            return true;
        }
    else {
        return false;
    }
}

function isChar(evt)
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) || charCode==8 ||charCode==9) {
        return true;
    }
    return false;
}

function ValidateEmail(email) {
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
    };
</script>
<?php include('../footer.php'); ?>
