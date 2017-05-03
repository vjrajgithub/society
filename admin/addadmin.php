<?php 
include('../header.php');
include('../utility/common.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_add_admin.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
//echo '<pre>';
//print_r($_data);
//echo '<pre>';
$success = "none";
$e_name = '';
$e_email = '';
$e_contact = '';
$e_pre_address = '';
$e_per_address = '';
$e_plan = '';
$e_society = '';
$e_nid = '';
$e_designation = 0;
$e_date = '';
$ending_date = '';
$e_status = 0;
$e_password = '';
$branch_id = '';
$title = $_data['add_new_employee'];
$button_text = $_data['save_button_text'];
//$successful_msg = $_data['added_admin_successfully'];
$form_url = WEB_URL . "admin/addadmin.php";
$id="";
$hdnid="0";
$image_emp = WEB_URL . 'img/no_image.jpg';
$img_track = '';

if(isset($_POST['txtEmpName'])){
//        echo '<pre>';
//    print_r($_POST);
//    echo '<pre>';
    
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	$e_password = $_POST['txtPassword'];
	$image_url = uploadImage();
	if(isset($_POST['chkEmpStaus'])){
			$e_status = 1;
	}
        date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d H:i:s');
	$sql = "INSERT INTO tbl_masteradmin(adminName,adminEmail, contactNumber, password,societyId,planId,designationId,insertDate,updateDate) values('$_POST[txtEmpName]','$_POST[txtEmpEmail]','$_POST[txtEmpContact]','$_POST[txtPassword]','$_POST[ddlSocietyType]','$_POST[ddlPlanType]','$_POST[ddlMemberType]','".$date."','".$date."')";
	mysql_query($sql,$link);
	mysql_close($link);
	$url = WEB_URL . 'admin/adminlist.php?m=add';
	header("Location: $url");
	
}
else{
	$image_url = uploadImage();
	if($image_url == ''){
		$image_url = $_POST['img_exist'];
	}
	if(isset($_POST['chkEmpStaus'])){
			$e_status = 1;
	}
        date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d H:i:s');
	$sql = "UPDATE `tbl_masteradmin` SET `adminName`='".$_POST['txtEmpName']."',`adminEmail`='".$_POST['txtEmpEmail']."',`contactNumber`='".$_POST['txtEmpContact']."',`password`='".$_POST['txtPassword']."',`societyId`='".$_POST['ddlSocietyType']."',`planId`='".$_POST['ddlPlanType']."',`designationId`='".$_POST['ddlMemberType']."',`updateDate`='".$date."' where adminId = '".$_GET['id']."'";
	mysql_query($sql,$link);
	$url = WEB_URL . 'admin/adminlist.php?m=up';
	header("Location: $url");
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_masteradmin where adminId = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		
		$e_name = $row['adminName'];
		$e_email = $row['adminEmail'];
		$e_contact = $row['contactNumber'];
                $e_plan = $row['planId'];
                $e_society = $row['societyId'];
//		$e_pre_address = $row['e_pre_address'];
//		$e_per_address = $row['e_per_address'];
//		$e_nid = $row['e_nid'];
		$e_designation = $row['designationId'];
		$e_date = $row['updateDate'];
		//$ending_date = $row['ending_date'];
		//$e_status = $row['e_status'];
		$e_password = $row['password'];
//		if($row['image'] != ''){
//			$image_emp = WEB_URL . 'img/upload/' . $row['image'];
//			$img_track = $row['image'];
//		}
		$hdnid = $_GET['id'];
		//$title = $_data['update_admin'];
		$button_text =$_data['update_button_text'];
		$successful_msg="Update Admin Successfully";
		$form_url = WEB_URL . "admin/addadmin.php?id=".$_GET['id'];
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
      <form onSubmit="return validateMe();" action="<?php //echo $form_url; ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
		<div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpName"><?php echo $_data['add_new_form_field_text_1'];?> <span style="color:red;">*</span> :</label>
            <input type="text" onkeypress="return isChar(event)" name="txtEmpName" value="<?php echo $e_name;?>" id="txtEmpName" class="form-control" />
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpEmail"><?php echo $_data['add_new_form_field_text_2'];?> <span style="color:red;">*</span> :</label>
            <input type="text"  name="txtEmpEmail" value="<?php echo $e_email;?>" id="txtEmpEmail" class="form-control" />
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtPassword"><?php echo $_data['add_new_form_field_text_3'];?> <span style="color:red;">*</span> :</label>
            <input type="text" name="txtPassword" value="<?php echo $e_password;?>" id="txtPassword" class="form-control" />
          </div>
          </div>
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpContact"><?php echo $_data['add_new_form_field_text_4'];?> <span style="color:red;">*</span> :</label>
            <input type="text" minlength="10" maxlength="10" onkeypress="return isNumber(event)" name="txtEmpContact" value="<?php echo $e_contact;?>" id="txtEmpContact" class="form-control" />
          </div>
<!--          <div class="form-group">
            <label for="txtEmpPreAddress"><?php echo $_data['add_new_form_field_text_5'];?> <span style="color:red;">*</span> :</label>
            <textarea name="txtEmpPreAddress" id="txtEmpPreAddress" class="form-control"><?php echo $e_pre_address;?></textarea>
          </div>
          <div class="form-group">
            <label for="txtEmpPerAddress"><?php echo $_data['add_new_form_field_text_6'];?> <span style="color:red;">*</span> :</label>
            <textarea name="txtEmpPerAddress" id="txtEmpPerAddress" class="form-control"><?php echo $e_per_address;?></textarea>
          </div>-->
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpNID"><?php echo $_data['add_new_form_field_text_7'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlSocietyType" id="ddlMemberType" class="form-control">
              <option value="">--<?php echo $_data['add_new_form_field_text_15'];?>--</option>
              <?php 
				  	$result_type = mysql_query("SELECT * FROM  tbl_master_society order by societyName ASC",$link);
					while($row_type = mysql_fetch_array($result_type)){
				  ?>
              <option <?php if($e_society == $row_type['societyId']){echo 'selected';}?> value="<?php echo $row_type['societyId'];?>"><?php echo $row_type['societyName'];?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpNID"><?php echo $_data['add_new_form_field_text_5'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlPlanType" id="ddlMemberType" class="form-control">
              <option value="">--<?php echo $_data['add_new_form_field_text_15'];?>--</option>
              <?php 
				  	$result_type = mysql_query("SELECT * FROM tbl_masterplan order by planName ASC",$link);
					while($row_type = mysql_fetch_array($result_type)){
				  ?>
              <option <?php if($e_plan == $row_type['planId']){echo 'selected';}?> value="<?php echo $row_type['planId'];?>"><?php echo $row_type['planName'];?></option>
              <?php }?>
            </select>
          </div>
          </div>
		  
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="ddlMemberType"><?php echo $_data['add_new_form_field_text_8'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlMemberType" id="ddlMemberType" class="form-control">
              <option value="">--<?php echo $_data['add_new_form_field_text_15'];?>--</option>
              <?php 
				  	$result_type = mysql_query("SELECT * FROM master_designation order by designationName ASC",$link);
					while($row_type = mysql_fetch_array($result_type)){
				  ?>
              <option <?php if($e_designation == $row_type['designationId']){echo 'selected';}?> value="<?php echo $row_type['designationId'];?>"><?php echo $row_type['designationName'];?></option>
              <?php }?>
            </select>
          </div>
          </div>

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
    //alert("hgdfhgdh");
	if($("#txtEmpName").val() == ''){
		$("#txtEmpName").css("border","1px solid red");
		$("#txtEmpName").focus();
		return false;
	}
	else if($("#txtEmpEmail").val() == '' || !ValidateEmail($("#txtEmpEmail").val()) ){
		$("#txtEmpEmail").css("border","1px solid red");
		$("#txtEmpEmail").focus();
		return false;
	}
	else if($("#txtPassword").val() == ''){
		$("#txtPassword").css("border","1px solid red");
		$("#txtPassword").focus();
		return false;
	}
	else if($("#txtEmpContact").val() == '' || $("#txtRContact").val().length!=10){
		$("#txtEmpContact").css("border","1px solid red");
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
