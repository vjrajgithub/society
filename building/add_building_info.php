<?php 
include('../header.php');
include('../utility/common.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_add_building_info.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}

if(isset($_POST['submit_society']))
{

	date_default_timezone_set('Asia/Kolkata');
	$date=date('Y-m-d H:i:s');
	 $q=mysql_query("insert into tbl_master_society set societyName='".$_POST['societyName']."',societyAddress='".$_POST['societyAddress']."',countryId='".$_POST['countryId']."',stateId='".$_POST['stateId']."',cityId='".$_POST['cityId']."',personName='".$_POST['personName']."',mobile='".$_POST['mobile']."',email='".$_POST['email']."',plan='".$_POST['plan']."',insertDate='".$date."'");
	
	
	
	
	

	
	if($q)
	{
		$url = WEB_URL . 'building/buildinglist.php?m=add';
		header("Location: $url");
	}
	else{
		echo"<script>alert('try')</script>";
	}
}
$success = "none";
$name = '';
$address = '';
$security_guard_mobile = '';
$secrataty_mobile = '';
$moderator_mobile = '';
$building_make_year = '';
$building_image = '';
$b_name = '';
$b_address = '';
$b_phone = '';
$branch_id = '';
$title = $_data['text_1'];
$button_text = $_data['save_button_text'];
$form_url = WEB_URL . "building/add_building_info.php";
$id="";
$hdnid="0";
$image_building = WEB_URL . 'img/no_image.jpg';
$img_track = '';
$rowx_unit = array();

if(isset($_POST['txtBName'])){
	$sqlx = "DELETE FROM `tbl_add_building_info`";
	mysql_query($sqlx,$link);
	$image_url = uploadImage();
	$sql = "INSERT INTO tbl_add_building_info(name,address, security_guard_mobile, secrataty_mobile,moderator_mobile,building_make_year,b_name,b_address,b_phone,building_image,branch_id) values('$_POST[txtBName]','$_POST[txtBAddress]','$_POST[txtBSecurityGuardMobile]','$_POST[txtBSecrataryMobile]','$_POST[txtBModeratorMobile]','$_POST[txtBMakeYear]','$_POST[txtBlName]','$_POST[txtBlAddress]','$_POST[txtBlPhone]','$image_url','" . $_SESSION['objLogin']['branch_id'] . "')";
	mysql_query($sql,$link);
	//mysql_close($link);
	
}
 

if(isset($_POST['Update'])){
	date_default_timezone_set('Asia/Kolkata');
	$date=date('Y-m-d H:i:s');
	 $q="update tbl_master_society set societyName='".$_POST['societyName']."',societyAddress='".$_POST['societyAddress']."',countryId='".$_POST['countryId']."',stateId='".$_POST['stateId']."',cityId='".$_POST['cityId']."',personName='".$_POST['personName']."',mobile='".$_POST['mobile']."',email='".$_POST['email']."',plan='".$_POST['plan']."',updateDate='".$date."' where societyId='".$_GET['id']."'";
	$res=mysql_query($q);
	if($res)
	{
		$url = WEB_URL . 'building/buildinglist.php?m=up';
		header("Location: $url");
	}
	else{
		echo"<script>alert('try')</script>";
	}
}
	//mysql_close($link);

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
    <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><?php echo $_data['text_2'];?></li>
    <li class="active"><?php echo $_data['text_3'];?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Full Width boxes (Stat box) -->
<?php 
	if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_master_society where societyId = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		$name = $row['societyName'];
		$address = $row['societyAddress'];
		$country = $row['countryId'];
		$state=$row['stateId'];
		$city=$row['cityId'];
		$personName = $row['personName'];
		$mobile = $row['mobile'];
		$email=$row['email'];
		$paln = $row['plan'];
		
		$hdnid = $_GET['id'];
		
		$button_text = $_data['update_button_text'];
		
		$form_url = WEB_URL . "bill/add_building_info.php?id=".$_GET['id'];
	}
	
	//mysql_close($link);

}
	?>
<div class="row">
  <div class="col-md-12">
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo WEB_URL; ?>dashboard.php" data-original-title="<?php echo $_data['back_text'];?>"><i class="fa fa-reply"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 style="color:red;font-weight:bold;" class="box-title"><?php echo $_data['text_4'];?></h3>
      </div>
      <form  action="" method="post" enctype="multipart/form-data">
        <div class="box-body">
		<div class="row">
        <div class="form-group col-md-4 col-xs-12">
          <label for="txtBName"><span style="color:red;">*</span><?php echo $_data['text_5'];?> :</label>
          <input type="text" name="societyName" value="<?php echo $name;?>"  id="societyName" class="form-control" />
        </div>
        <div class="form-group col-md-4 col-xs-12">
          <label for="txtBAddress"><span style="color:red;">*</span><?php echo $_data['text_6'];?> :</label>
          <textarea name="societyAddress" id="societyAddress" class="form-control"><?php echo $address;?></textarea>
        </div>
        <div class="form-group col-md-4 col-xs-12">
          <label for="txtBSecurityGuardMobile"><span style="color:red;">*</span><?php echo $_data['text_7'];?>:</label>
         <select name="countryId" class="form-control" onChange="countryAjax(this.value)">
         	<option value="">Select Country</option>
         	<?php 
			 $q=mysql_query("select * from master_country order by countryId asc");
			 while($country_data=mysql_fetch_assoc($q))
			 {
			 ?>
        <option value="<?php echo $country_data['countryId'];?>"<?php if($country_data['countryId']==@$country){ echo "selected";}?>><?php echo $country_data['countryName'];?></option>
        <?php }?>
         </select>
        </div>
        </div>
		
		<div class="row">
        <div class="form-group col-md-4 col-xs-12">
          <label for="txtBSecrataryMobile"><span style="color:red;">*</span><?php echo $_data['text_8'];?> :</label>
          <div id="state_data">
         <select name="stateId" class="form-control">
         	<option value="">Select State</option>
         	
         </select>
         </div>
        </div>
        <div class="form-group col-md-4 col-xs-12">
          <label for="txtBModeratorMobile"><span style="color:red;">*</span><?php echo $_data['text_9'];?> :</label>
          <div id="city_data">
          <select name="cityId" class="form-control">
          	<option value="1">Select City</option>
          	
          </select>
			</div>
        </div>
        <div class="form-group col-md-4 col-xs-12">
          <label for="txtBMakeYear"><span style="color:red;">*</span><?php echo $_data['text_10'];?> :</label>
          <input type="text" name="personName" value="<?php if(isset($_GET['id'])){echo $personName;}?>" class="form-control">
        </div>
        </div>
        <div class="row">
         <div class="form-group col-md-4 col-xs-12">
          <label for="txtBMakeYear"><span style="color:red;">*</span><?php echo $_data['mobile'];?> :</label>
          <input type="text" name="mobile" value="<?php if(isset($_GET['id'])){ echo $mobile; }?>" class="form-control">
        </div>
        
         <div class="form-group col-md-4 col-xs-12">
          <label for="txtBMakeYear"><span style="color:red;">*</span><?php echo $_data['email'];?> :</label>
          <input type="text" name="email" value="<?php if(isset($_GET['id'])) { echo $email; }?>" class="form-control">
        </div>
     
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtBlName"><span style="color:red;">*</span><?php echo $_data['building_plan'];?> :</label>
            <input type="text" name="plan" id="plan" value="<?php if(isset($_GET['id'])) { echo $paln; }?>" class="form-control" />
          </div>
         </div>
          
       
          <div class="form-group pull-right">
            <input type="submit" name="submit_society" class="btn btn-primary" value="<?php echo $button_text; ?>"/>
          </div>
        
      </form>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
</div>
<!-- /.row -->
<script type="text/javascript">
	
function countryAjax(str) 
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
xmlhttp.open("GET","../ajax/stateAjax.php?q="+str,true);
xmlhttp.send();
xmlhttp.onreadystatechange=function() 
  { 
	//lert('lfjkdsalkfjd');
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    { 
	//alert(xmlhttp.responseText);
document.getElementById("state_data").innerHTML=xmlhttp.
responseText; 
    }  }
} 

	function cityAjax(str) 
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
xmlhttp.open("GET","../ajax/cityAjax.php?q="+str,true);
xmlhttp.send();
xmlhttp.onreadystatechange=function() 
  { 
	//lert('lfjkdsalkfjd');
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    { 
	//alert(xmlhttp.responseText);
document.getElementById("city_data").innerHTML=xmlhttp.
responseText; 
    }  }
} 
	
	
function validateMe(){
	if($("#txtBName").val() == ''){
		alert("Name is Required !!!");
		$("#txtBName").focus();
		return false;
	}
	else if($("#txtBAddress").val() == ''){
		alert("Address is Required !!!");
		$("#txtBAddress").focus();
		return false;
	}
	else if($("#txtBSecurityGuardMobile").val() == ''){
		alert("Security Guard Number is Required !!!");
		$("#txtBSecurityGuardMobile").focus();
		return false;
	}
	else if($("#txtBSecrataryMobile").val() == ''){
		alert("Secratary Number is Required !!!");
		$("#txtBSecrataryMobile").focus();
		return false;
	}
	else if($("#txtBModeratorMobile").val() == ''){
		alert("Moderator Number is Required !!!");
		$("#txtBModeratorMobile").focus();
		return false;
	}
	else if($("#txtBMakeYear").val() == ''){
		alert("Year is Required !!!");
		$("#txtBMakeYear").focus();
		return false;
	}
	else if($("#txtBlName").val() == ''){
		alert("Builder Name is Required !!!");
		$("#txtBlName").focus();
		return false;
	}
	else if($("#txtBlAddress").val() == ''){
		alert("Builder Address is Required !!!");
		$("#txtBlAddress").focus();
		return false;
	}
	else if($("#txtBlPhone").val() == ''){
		alert("Builder Phone is Required !!!");
		$("#txtBlPhone").focus();
		return false;
	}
	else{
		return true;
	}
}
</script>
<?php include('../footer.php'); ?>
