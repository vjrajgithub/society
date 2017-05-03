<?php 
include('../header.php');
include('../utility/common.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_add_owner.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
$success = "none";
$o_name = '';
$o_email = '';
$o_contact = '';
$o_pre_address = '';
$o_per_address = '';
$o_nid = '';
$o_password = '';
$owner_unit = '';
$branch_id = '';
$title = $_data['add_new_owner'];
$button_text = $_data['save_button_text'];
$successful_msg = $_data['added_owner_successfully'];
$form_url = WEB_URL . "owner/addowner.php";
$id="";
$hdnid="0";
$image_own = WEB_URL . 'img/no_image.jpg';
$img_track = '';
$rowx_unit = array();

if(isset($_POST['submit_member'])){
	/*if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){*/
		date_default_timezone_set('Asia/Kolkata');
		$date=date('Y-m-d H:i:s');
	$sk="";
$vehicle=$_POST['vehicleId'];
	
	$parking=$_POST['parkingNumber'];
	$img=$_FILES['image']['name'];
	$data=move_uploaded_file($_FILES['image']['tmp_name'],"../upload/".$img);
for($i=0;$i<=count($vehicle);$i++)
{
	$vehicle_data=$vehicle[$i];
	$parking_data=$parking[$i];

	 $sql="insert into tbl_add_owner set firstName='".$_POST['firstName']."',middleName='".$_POST['middleName']."',lastName='".$_POST['lastName']."',societyId='".$_POST['societyId']."',professionId='".$_POST['professionId']."',specialityProfession='".$_POST['specialityProfession']."',vehicleId='".$vehicle_data."',gender='".$_POST['gender']."',age='".$_POST['age']."',username='".$_POST['username']."',password='".$_POST['password']."',unit_no='".$_POST['unit_no']."',membershipNumber='".$_POST['membershipNumber']."',parkingNumber='$parking_data',mobileNumber='".$_POST['mobileNumber']."',landlineNumber='".$_POST['landlineNumber']."',emergencycontactNumber='".$_POST['emergencycontactNumber']."',emergencycontactName='".$_POST['emergencycontactName']."',intercomNumber='".$_POST['intercomNumber']."',correspondenceAddress='".$_POST['correspondenceAddress']."',imageUrl='".$img."',branch_id='".$_SESSION['objLogin']['branch_id'] ."',insertDate='".$date."'";

	$result= mysql_query($sql);
        echo $last_id = mysql_insert_id($link);//die;
                    
                   if($last_id){ 
                    echo $sql="UPDATE `tbl_unit_member` set  "
                    . "memberId ='$last_id'"
                    . " where uid = '".$_POST['unit_no']."'";		
                    //die;
                    mysql_query($sql, $link);
                   } 
}
	if($result)
	{
		$url = WEB_URL . 'owner/ownerlist.php?m=add';
		header("Location: $url");
	}
	else{
		echo"<script>alert('try')</script>";
	}
	//$last_id = mysql_insert_id();
	  //if(isset($_POST['ChkOwnerUnit'])){   /*if open */
		//foreach ($_POST['ChkOwnerUnit'] as $value) {   /*foreach open */
		//	$sql_unit="INSERT INTO `tbl_add_owner_unit_relation`(owner_id,unit_id) VALUES($last_id,$value)";
	//		mysql_query($sql_unit,$link);	 
	///	}  /* foreach close */
	 // }  /* if close */
	 // else {
	//		echo "No results";  
	//  }

	//mysql_close($link);
	//$url = WEB_URL . 'owner/ownerlist.php?m=add';
	//header("Location: $url");
	

/*else{
	$image_url = uploadImage();
	if($image_url == ''){
		$image_url = $_POST['img_exist'];
	}
	$sql = "UPDATE `tbl_add_owner` SET `o_name`='".$_POST['txtOwnerName']."',`o_email`='".$_POST['txtOwnerEmail']."',`o_password`='".$_POST['txtPassword']."',`o_contact`='".$_POST['txtOwnerContact']."',`o_pre_address`='".$_POST['txtOwnerPreAddress']."',`o_per_address`='".$_POST['txtOwnerPerAddress']."',`o_nid`='".$_POST['txtOwnerNID']."',`image`='".$image_url."' WHERE ownid='".$_GET['id']."'";
	mysql_query($sql,$link);
	if(isset($_POST['ChkOwnerUnit'])){  /* if open */
		/*$sql_unit= "DELETE FROM `tbl_add_owner_unit_relation` WHERE owner_id = ".$_GET['id'];
		mysql_query($sql_unit,$link);
		foreach ($_POST['ChkOwnerUnit'] as $value) {
			$sql_unit="INSERT INTO `tbl_add_owner_unit_relation`(owner_id,unit_id) VALUES('$_GET[id]',$value)";
			mysql_query($sql_unit,$link);
		} 
	  } 
	  else {
			$sql_unit= "DELETE FROM `tbl_add_owner_unit_relation` WHERE owner_id = ".$_GET['id'];
			mysql_query($sql_unit,$link); 
	  }
	$url = WEB_URL . 'owner/ownerlist.php?m=up';
	header("Location: $url");
}
*/
//$success = "block";
}

if(isset($_POST['update']))
{
	
	date_default_timezone_set('Asia/Kolkata');
	$date=date('Y-m-d H:i:s');
	$vehicle=$_POST['vehicleId'];
	
	$parking=$_POST['parkingNumber'];
	$img=$_FILES['image']['name'];
	$data=move_uploaded_file($_FILES['image']['tmp_name'],"../upload/".$img);
	

	

	
	 $query=mysql_query("update tbl_add_owner set firstName='".$_POST['firstName']."',middleName='".$_POST['middleName']."',lastName='".$_POST['lastName']."',societyId='".$_POST['societyId']."',professionId='".$_POST['professionId']."',specialityProfession='".$_POST['specialityProfession']."',vehicleId='".$_POST['vehicleId']."',gender='".$_POST['gender']."',age='".$_POST['age']."',username='".$_POST['username']."',password='".$_POST['password']."',unit_no='".$_POST['unit_no']."',membershipNumber='".$_POST['membershipNumber']."',parkingNumber='".$_POST['parkingNumber']."',mobileNumber='".$_POST['mobileNumber']."',landlineNumber='".$_POST['landlineNumber']."',emergencycontactNumber='".$_POST['emergencycontactNumber']."',emergencycontactName='".$_POST['emergencycontactName']."',intercomNumber='".$_POST['intercomNumber']."',correspondenceAddress='".$_POST['correspondenceAddress']."',imageUrl='".$img."',updateDate='".$date."' where memberId='".$_GET['id']."' and branch_id= '".$_SESSION['objLogin']['branch_id']."'");


	if($query)
	{
		$url = WEB_URL . 'owner/ownerlist.php?m=up';
		header("Location: $url");
	}
	else{
		echo "<script>alert('update try')</script>";
	}
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_owner where memberId = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_array($result)){
		
		$firstname = $row['firstName'];
		$middlename = $row['middleName'];
		$lastname = $row['lastName'];
		$society = $row['societyId'];
		$profession = $row['professionId'];
		$speciality = $row['specialityProfession'];
		$vehicleid = $row['vehicleId'];
		$gender=$row['gender'];
		$age=$row['age'];
		$username=$row['username'];
			$pass=$row['password'];
		$unit= $row['unit_no'];
		
		$membership = $row['membershipNumber'];
		$park=$row['parkingNumber'];
		$mobile=$row['mobileNumber'];
		$land=$row['landlineNumber'];
		$emergency= $row['emergencycontactNumber'];
		$emergencyname=$row['emergencycontactName'];
		$intercom = $row['intercomNumber'];
	$corespondance=$row['correspondenceAddress'];
		$img=$row['imageUrl'];
		$hdnid = $_GET['id'];
		$title = 'Update Owner';
		$button_text = $_data['update_button_text'];
		$successful_msg = $_data['update_owner_successfully'];
		$form_url = WEB_URL . "owner/addowner.php?id=".$_GET['id'];
	}
	$result_unit = mysql_query("SELECT unit_id FROM tbl_add_owner_unit_relation where owner_id = '" . $_GET['id'] . "'",$link);
	while($row_unit = mysql_fetch_array($result_unit)){
		array_push($rowx_unit,$row_unit['unit_id']);
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
  <h1><?php echo $_data['add_new_owner'];?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>/dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><?php echo $_data['add_new_owner_information_breadcam'];?></li>
    <li class="active"><?php echo $_data['add_new_owner_breadcam'];?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Full Width boxes (Stat box) -->
<div class="row">
  <div class="col-md-12">
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo WEB_URL; ?>owner/ownerlist.php" data-original-title="<?php echo $_data['back_text'];?>"><i class="fa fa-reply"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['add_new_owner_entry_form'];?></h3>
      </div>
      <form onSubmit="return validateMe();" action="<?php echo $form_url; ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
			  <label for="txtOwnerName"><span class="errorStar">*</span>First Name :</label>
            <input type="text" name="firstName" value="<?php echo @$firstname;?>" id="owenerName" class="form-control" />
          </div>
          
          <div class="form-group col-md-4 col-xs-12">
			  <label for="txtOwnerName"><span class="errorStar">*</span>Middle Name :</label>
            <input type="text" name="middleName" value="<?php echo @$middlename;?>" id="owenerName" class="form-control" />
          </div>
          
          <div class="form-group col-md-4 col-xs-12">
			  <label for="txtOwnerName"><span class="errorStar">*</span>Last Name :</label>
            <input type="text" name="lastName" value="<?php echo @$lastname;?>" id="owenerName" class="form-control" />
          </div>
          </div>
          
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtOwnerPreAddress"><span class="errorStar">*</span><?php echo $_data['add_new_form_field_text_5'];?> :</label>
           <select name="societyId" class="form-control">
           <option value="">Select Society Name</option>
           <?php 
			   $qs=mysql_query("select * from tbl_master_society order by societyId asc");
			   while($rec=mysql_fetch_array($qs)){
			   ?>
           	<option value="<?php echo $rec['societyId'];?>"<?php if($rec['societyId']==@$society) { echo "selected";}?>><?php echo $rec['societyName'];?></option>
           	<?php } ?>
           </select>
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtOwnerPerAddress"><span class="errorStar">*</span>Profession:</label>
            <input type="text" name="professionId" class="form-control" value="<?php echo @$profession;?>"> 
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtOwnerNID"><span class="errorStar">*</span><?php echo $_data['add_new_form_field_text_7'];?> :</label>
            <input type="text" name="specialityProfession" value="<?php echo @$speciality;?>" id="specialityProfession" class="form-control" />
          </div>
          </div>
		  <div class="row">
          <?php if(isset($_GET['id'])) { ?>
          <div class="form-group vehicle col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_field_text_8'];?> :</label>
             <input type="text" class="form-control" name="vehicleId" id="vehicleId" value="<?php echo @$vehicleid; ?>">
			 
          </div>
          <?php } else { ?>
           <div class="form-group vehicle col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_field_text_8'];?> :</label>
             <input type="text" class="form-control" name="vehicleId[]" id="vehicleId" value="<?php echo @$vehicleid; ?>">
			  <a id="plus_vehicle" style="font-size:20px;font-weight:bold;"><span class="pull-right">+</span></a>
          </div>
         
          <?php } ?>
			<script>
				$(function(){
				
			$('#plus_vehicle').click(function(){
				$('.vehicle').append("<br><label>Vehicle Id:</label><br><input type='text' name='vehicleId[]' class='form-control'>");
			})
				})
			</script>
          
           <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_gender'];?> :</label>
             <select name="gender" class="form-control">
             	<option value=""><?php echo $_data['add_new_form_select_gender'];?></option>
             	<option value="Male"<?php if(@$gender=='Male') { echo "selected";}?>>Male</option>
             	<option value="Female" <?php if(@$gender=='Female') {echo "Female";}?>>Female</option>
             </select>
          </div>
          
           <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_age'];?> :</label>
             <input type="text" class="form-control" name="age" value="<?php echo @$age; ?>">
          </div>
          </div>
          
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_username'];?> :</label>
             <input type="text" class="form-control" name="username" value="<?php echo @$username; ?>">
          </div>
          
          <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_password'];?> :</label>
             <input type="password" class="form-control" name="password" value="<?php echo @$pass; ?>">
          </div>
            <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit">Unit No:</label>
             <select name="unit_no" class="form-control">
             	<option>Select Unit No.</option>
             	<?php $qs=mysql_query("select * from tbl_add_unit order by uid asc");
				 while($res=mysql_fetch_assoc($qs)){
				 
				 ?>
				 <option value="<?php echo $res['uid']?>" <?php if($res['uid']==@$unit) { echo "selected"; }?>><?php echo $res['unit_no'];?></option>
            <?php } ?>
             </select>
          </div>
          </div>
             
          <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_membership'];?> :</label>
             <input type="text" class="form-control" name="membershipNumber" value="<?php echo @$membership; ?>">
          </div>
          <?php if(isset($_GET['id'])) { ?>
           <div class="form-group parking col-md-8 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_parking'];?> :</label>
             <input type="text" class="form-control" name="parkingNumber" value="<?php echo @$park; ?>" >
          </div>
          <?php } else { ?>
          <div class="form-group parking col-md-8 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_parking'];?> :</label>
             <input type="text" class="form-control" name="parkingNumber[]" value="<?php echo @$park; ?>" >
			 <a id="plus_parking" style="font-size:20px;font-weight:bold;"><span class="pull-right">+</span></a>
          </div>
          
          <?php } ?>
          <script>
			  $(function(){
				  $('#plus_parking').click(function(){
					  $('.parking').append("<br><label>Parking Number</label><br><input type='text' name='parkingNumber[]' class='form-control'>");
				  })
			  })
			</script>
           </div>
		   
		  <div class="row"> 
          <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_mobileno'];?> :</label>
             <input type="text" class="form-control" name="mobileNumber" value="<?php echo @$mobile; ?>">
          </div>
		  
          <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_landline'];?> :</label>
             <input type="text" class="form-control" name="landlineNumber" value="<?php echo @$land; ?>">
          </div>
          
           <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_emergencynumber'];?> :</label>
             <input type="text" class="form-control" name="emergencycontactNumber" value="<?php echo @$emergency; ?>">
          </div>
          </div>
		  
		   <div class="row">
           <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_emergencyname'];?> :</label>
             <input type="text" class="form-control" name="emergencycontactName" value="<?php echo @$emergencyname;?>">
          </div>
           <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit"><?php echo $_data['add_new_form_intercom'];?> :</label>
             <input type="text" class="form-control" name="intercomNumber" value="<?php echo @$intercom;?>">
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="ChkOwnerUnit">Correspondence Address :</label>
             <input type="text" class="form-control" name="correspondenceAddress" value="<?php echo @$corespondance;?>">
          </div>
          </div><br>
          <?php if(isset($_GET['id'])) {
			?>
         <img src="../upload/<?php echo $img; ?>" style="width: 100px; height: 100px;"><br><br>
          <?php }?>
          <div class="form-group"> <span class="btn btn-file btn btn-primary"><?php echo $_data['upload_image'];?>
            <input type="file" value="<?php echo @$img;?>" name="image"  />
            </span> 
			<input type="submit" name="<?php if(isset($_GET['id'])) { echo "update"; }else {?>submit_member<?php }?>" class="btn btn-primary pull-right" value="<?php echo $button_text; ?>"/>
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
	if($("#txtOwnerName").val() == ''){
		alert("Owner Name Required !!!");
		$("#txtOwnerName").focus();
		return false;
	}
	else if($("#txtOwnerEmail").val() == ''){
		alert("Email Required !!!");
		$("#txtOwnerEmail").focus();
		return false;
	}
	else if($("#txtPassword").val() == ''){
		alert("Password Required !!!");
		$("#txtPassword").focus();
		return false;
	}
	else if($("#txtOwnerContact").val() == ''){
		alert("Contact Number Required !!!");
		$("#txtOwnerContact").focus();
		return false;
	}
	else if($("#txtOwnerPreAddress").val() == ''){
		alert("Present Address Required !!!");
		$("#txtOwnerPreAddress").focus();
		return false;
	}
	else if($("#txtOwnerPerAddress").val() == ''){
		alert("Permanent Address Required !!!");
		$("#txtOwnerPerAddress").focus();
		return false;
	}
	else if($("#txtOwnerNID").val() == ''){
		alert("NID Required !!!");
		$("#txtOwnerNID").focus();
		return false;
	}
	else{
		return true;
	}
}
</script>
<?php include('../footer.php'); ?>
