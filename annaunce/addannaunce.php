<?php 
include('../header.php');
include('../utility/common.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_add_annaunce.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
$ev_status = 'Active';
//$ev_status = $row['status'];
		$name = '';
		$description = '';
		$address = '';
		//$e_nid = $row['event_id'];
		//$e_designation = $row['designationId'];
		$event_date = '';
		$event_time = '';
$success = "none";
$e_name = '';
$e_email = '';
$e_contact = '';
$e_pre_address = '';
$e_per_address = '';
$e_nid = '';
$e_designation = 0;
$e_date = '';
$ending_date = '';
$e_status = 0;
$e_password = '';
$branch_id = '';
$title = $_data['add_new_employee'];
$button_text = $_data['save_button_text'];
$successful_msg = $_data['added_employee_successfully'];
$form_url = WEB_URL . "annaunce/addannaunce.php";
$id="";
$hdnid="0";
$image_emp = WEB_URL . 'img/no_image.jpg';
$img_track = '';
$document_emp = WEB_URL . 'img/no_image.jpg';
$doc_track = '';

if(isset($_POST['txtEmpName'])){
        echo '<pre>';
    print_r($_POST);
    echo '<pre>';
    
    //echo count($_FILES['files']['name']);
   // die;
        date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d H:i:s');
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	//$e_password = $_POST['txtPassword'];
	 //$image_url = uploadImage();
         $documents = trim(uploadImage1(),',');
         $images = explode(",",$documents);
         echo $totalImages = count($images);
         
//	if(isset($_POST['chkEmpStaus'])){
//			$e_status = 1;
//	}
	$sql = "INSERT INTO annaunce(event_name,description, address, event_date,event_time,insertDate,updateDate,status,images,c_userid,branch_id) values('$_POST[txtEmpName]','$_POST[txtEmpPreAddress]','$_POST[txtEmpPerAddress]','$_POST[txtEmpDate]','$_POST[txtEndingDate]','".$date."','".$date."','$_POST[txtFacilityStatus]','$documents','".(int)$_SESSION['objLogin']['user_id']."','" . $_SESSION['objLogin']['branch_id'] . "')";
	mysql_query($sql,$link);
        echo $last_id = mysql_insert_id($link);//die;
        
        if($last_id){
            //echo 'for';die;
            for($i=0; $i<$totalImages; $i++) { 
                date_default_timezone_set("Asia/Kolkata");
                $date=date('Y-m-d H:i:s');
                $event = 'annauncement';
                echo $sql = "INSERT INTO annaunce_gallery(event_id,type, image_url, insertDate,updateDate ,c_userid,branch_id) values('$last_id', '$event','$images[$i]','".$date."','".$date."','".(int)$_SESSION['objLogin']['user_id']."','" . $_SESSION['objLogin']['branch_id'] . "')";
               mysql_query($sql,$link);
            }
        }
	mysql_close($link);
	$url = WEB_URL . 'annaunce/annauncelist.php?m=add';
	header("Location: $url");
	
}
else{
//    echo '<pre>';
//    print_r($_POST);
//    echo '<pre>';die;
	$image_url = uploadImage();
        echo $documents = trim(uploadImage1(),',');
	if($image_url == ''){
		//echo $documents = $_POST['img_exist'];//die;
	}if (isset($_POST['img_exist']) && $_POST['img_exist'] != '') {
            //implode(" ",$arr);
            echo $documents =$documents.','.implode(",",$_POST['img_exist']);
            echo $documents = trim($documents,',');
        }
	if(isset($_POST['chkEmpStaus'])){
			$e_status = 1;
	}
        echo $documents;
        $images = explode(",",$documents);
         echo $totalImages = count($images);//die;
	
        
        //die;
        echo $sql = "UPDATE `annaunce` SET "
                . "`event_name`='".$_POST['txtEmpName']."',"
                . "`description`='".$_POST['txtEmpPreAddress']."',"
                . "`address`='".$_POST['txtEmpPerAddress']."',"
                . "`event_date`='".$_POST['txtEmpDate']."',"
                . "`event_time`='".$_POST['txtEndingDate']."',"
                . "`updateDate`='$date',"
                . "`status`='".$_POST['txtFacilityStatus']."',"
                . "`images`='$documents'"
                ." WHERE event_id='".$_GET['id']."'";//die;
                mysql_query($sql,$link);//die;
        
        
        if($_GET['id']){
            echo $sql = "delete from annaunce_gallery WHERE event_id='".$_GET['id']."'";
            //die;
            mysql_query($sql,$link);
                for($i=0; $i<$totalImages; $i++) { 
                date_default_timezone_set("Asia/Kolkata");
                $date=date('Y-m-d H:i:s');
                $event = 'event';
                 $sql = "INSERT INTO annaunce_gallery(event_id,type, image_url, insertDate,updateDate ,c_userid,branch_id) values('$_GET[id]', '$event','$images[$i]','".$date."','".$date."','".(int)$_SESSION['objLogin']['user_id']."','" . $_SESSION['objLogin']['branch_id'] . "')";
                mysql_query($sql,$link);
            }
        }
        
        
	$url = WEB_URL . 'annaunce/annauncelist.php?m=up';
	header("Location: $url");
}

$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
    $queryAllEmployee = "SELECT et.*,gt.event_id,gt.type,gt.image_url FROM annaunce_gallery gt left join annaunce et on et.event_id = gt.event_id where  et.event_id = '" . $_GET['id'] . "' group by gt.event_id";
				//die;
                                $result = mysql_query($queryAllEmployee,$link);
	//$result = mysql_query("SELECT * FROM tbl_add_employee where eid = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_assoc($result)){
//            echo '<pre>';
//    print_r($row);
//    echo '<pre>';die;
		$ev_status = $row['status'];
		$name = $row['event_name'];
		$description = $row['description'];
		$address = $row['address'];
		$e_nid = $row['event_id'];
		//$e_designation = $row['designationId'];
		$event_date = $row['event_date'];
		$event_time = $row['event_time'];
		//$e_status = $row['status'];
		//$e_password = $row['e_password'];
//		if($row['images'] != ''){
//			$image_emp = WEB_URL . 'img/upload/' . $row['image'];
//			$img_track = $row['image'];
//		}
                if($row['images'] != ''){
                       $documents = explode(",",$row['images']);
//                        echo '<pre>';
//                        print_r ($documents);
//                        echo '</pre>';
//                        die;
//			$document_emp = WEB_URL . 'img/upload/' . $row['documents'];
//			$doc_track = $row['documents'];
		}
		$hdnid = $_GET['id'];
		$title = $_data['update_employee'];
		$button_text =$_data['update_button_text'];
		$successful_msg="Update Employee Successfully";
		$form_url = WEB_URL . "annaunce/addannaunce.php?id=".$_GET['id'];
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

function uploadImage1(){
	if((!empty($_FILES["files"]))) {
            echo $total = count($_FILES['files']['name']);
            //die;
            $newfilename = '';
            $newfilename2 ='';
           for($i=0; $i<$total; $i++) { 
                $filename = basename($_FILES['files']['name'][$i]);
                $ext = substr($filename, strrpos($filename, '.') + 1);
                
                //if(($ext == "jpg" && $_FILES["files"]["type"][$i] == 'image/jpeg') || ($ext == "png" && $_FILES["files"]["type"][$i] == 'image/png') || ($ext == "gif" && $_FILES["files"]["type"][$i] == 'image/gif')){   
                       $temp = explode(".",$_FILES["files"]["name"][$i]);
                       $newfilename = NewGuid() . '.' .end($temp);
                      //$newfilename = $newfilename.',';
                      move_uploaded_file($_FILES["files"]["tmp_name"][$i], ROOT_PATH . '/img/upload/' . $newfilename);
                      //return $newfilename;
                      
               // }
                $newfilename1 = $newfilename;
                        $newfilename2 = $newfilename2.$newfilename1.',';
	  }
	  
}
return $newfilename2;
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
<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css"/ >
<script src="/jquery.js"></script>
<script src="/build/jquery.datetimepicker.full.min.js"></script>
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
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo WEB_URL; ?>annaunce/annauncelist.php" data-original-title="<?php echo $_data['back_text'];?>"><i class="fa fa-reply"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['add_new_employee_entry_form'];?></h3>
      </div>
      <form  action="<?php echo $form_url; ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
		 <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpName"><?php echo $_data['add_new_form_field_text_1'];?> <span style="color:red;">*</span> :</label>
            <input type="text" onkeypress="return isChar(event)" name="txtEmpName" value="<?php echo $name;?>" id="txtEmpName" class="form-control" />
          </div>
<!--          <div class="form-group">
            <label for="txtEmpEmail"><?php echo $_data['add_new_form_field_text_2'];?> <span style="color:red;">*</span> :</label>
            <input type="text"  name="txtEmpEmail" value="<?php echo $e_email;?>" id="txtEmpEmail" class="form-control" />
          </div>
          <div class="form-group">
            <label for="txtPassword"><?php echo $_data['add_new_form_field_text_3'];?> <span style="color:red;">*</span> :</label>
            <input type="text" name="txtPassword" value="<?php echo $e_password;?>" id="txtPassword" class="form-control" />
          </div>
          <div class="form-group">
            <label for="txtEmpContact"><?php echo $_data['add_new_form_field_text_4'];?> <span style="color:red;">*</span> :</label>
            <input type="text" minlength="10" maxlength="10" onkeypress="return isNumber(event)" name="txtEmpContact" value="<?php echo $e_contact;?>" id="txtEmpContact" class="form-control" />
          </div>-->
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpPreAddress"><?php echo $_data['add_new_form_field_text_5'];?> <span style="color:red;">*</span> :</label>
            <textarea name="txtEmpPreAddress" id="txtEmpPreAddress" class="form-control"><?php echo $description;?></textarea>
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpPerAddress"><?php echo $_data['add_new_form_field_text_6'];?> <span style="color:red;">*</span> :</label>
            <textarea name="txtEmpPerAddress" id="txtEmpPerAddress" class="form-control"><?php echo $address;?></textarea>
          </div>
          </div>
<!--          <div class="form-group">
            <label for="txtEmpNID"><?php echo $_data['add_new_form_field_text_7'];?> <span style="color:red;">*</span> :</label>
            <input type="text" name="txtEmpNID" value="<?php echo $e_nid;?>" id="txtEmpNID" class="form-control" />
          </div>
          <div class="form-group">
            <label for="ddlMemberType"><?php echo $_data['add_new_form_field_text_8'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlMemberType" id="ddlMemberType" class="form-control">
              <option value="">--<?php echo $_data['add_new_form_field_text_15'];?>--</option>
              <?php 
				  	$result_type = mysql_query("SELECT * FROM tbl_empdesignation order by ed_id ASC",$link);
					while($row_type = mysql_fetch_array($result_type)){
				  ?>
              <option <?php if($e_designation == $row_type['ed_id']){echo 'selected';}?> value="<?php echo $row_type['ed_id'];?>"><?php echo $row_type['ed_name'];?></option>
              <?php }?>
            </select>
          </div>-->
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpDate"><?php echo $_data['add_new_form_field_text_9'];?> <span style="color:red;">*</span> :</label>
            <input type="text" name="txtEmpDate" value="<?php echo $event_date;?>" id="txtEmpDate" class="form-control datepicker"/>
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEndingDate"><?php echo $_data['add_new_form_field_text_10'];?> :</label>
            <input type="text" name="txtEndingDate" value="<?php echo $event_time;?>" id="txtEndingDate" class="form-control "/>
          </div>
            <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpAmount"><?php echo $_data['add_new_form_field_text_11'];?> :</label>
<!--            <div class="input-group">-->
<!--            <input type="text" name="txtEmpAmount" value="<?php echo $amount;?>" id="txtEmpAmount" class="form-control" />-->
            <select name="txtFacilityStatus" id="txtFacilityStatus" class="form-control">
              <option value="">--<?php echo "Select Status";?>--</option>
              
              <option <?php if($ev_status == "Active"){echo 'selected';}?> value="Active"><?php echo "Active";?></option>
              <option <?php if($ev_status == "Inactive"){echo 'selected';}?> value="Inactive"><?php echo "Inactive";?></option>
            </select>
<!--            <div class="input-group-addon"><?php echo CURRENCY;?></div>-->
<!--            </div>-->
            </div>
            </div>
<!--          <div class="form-group">
            <label for="chkRStaus"><?php echo $_data['add_new_form_field_text_11'];?> :</label>
            &nbsp;&nbsp;
            <input type="checkbox" name="chkEmpStaus" id="chkEmpStaus" <?php if($e_status == '1'){echo 'checked';}?> value="<?php echo $e_status;?>" class="minimal" />
            &nbsp;&nbsp;
            <?php if($e_status == '1'){echo $_data['add_new_form_field_text_12'];} else{echo $_data['add_new_form_field_text_13'];}?>
          </div>
          <div class="form-group">
            <label for="Prsnttxtarea"><?php echo $_data['add_new_form_field_text_14'];?> :</label>
            <img class="form-control" src="<?php echo $image_emp; ?>" style="height:100px;width:100px;" id="output"/>
            <input type="hidden" name="img_exist" value="<?php echo $img_track; ?>" />
          </div>-->
<!--          <div class="form-group"> <span class="btn btn-file btn btn-primary"><?php echo $_data['upload_image'];?>
            <input type="file" name="uploaded_file" multiple="multiple" onchange="loadFile(event)" />
            </span> </div>-->
            
            <div class="form-group"> 
                <span class="btn btn-file btn btn-primary"><?php echo "Upload Images";?>
                    <input type="file" id="imageupload" name="files[]" multiple="multiple"  />
                </span> 
            </div>

<div class="form-group col-sm-12" style="background-color: #f1f1f1;" id="preview-image">
               
            </div>            
                
                    <div class="col-sm-12 form-group">
                            <?php 
                                                        if(!empty($documents)){
                                                             $i=0;
                                                            for(;$i<=count($documents)-1;) { 
                                                                $document_emp = WEB_URL . 'img/upload/' . $documents[$i];
                                                                $document_download_emp = $document_emp = WEB_URL . 'img/upload/' . $documents[$i];
                                                                $doc_track = $documents[$i]; 
                                                                $ext = substr($documents[$i], strrpos($documents[$i], '.') + 1);
                                                                if($ext === 'pdf'){
                                                                    $document_emp = WEB_URL . 'img/upload/pdf-icon.png';
                                                                   //echo  ROOT_PATH;
                                                                }
                                                                
                                                                 $i;
                                                                ?>
                        <div class="col-sm-3" id="<?php echo $i.'deletediv';?>" >
                            <div class="form-group">
                            
                            <a href="<?php echo $document_download_emp; ?>"><img class="form-control" src="<?php echo $document_emp; ?>" style="height:100%;width:100%;" id="output"/></a>
                            <label onclick="deleteImage('<?php echo $i?>')" id="<?php echo $i;?>" for="Prsnttxtarea"><a class="btn btn-danger" data-toggle="tooltip"<i class="fa fa-trash-o"></i><?php echo 'delete';?> </a></label>
                            <input type="hidden" name="img_exist[]" value="<?php echo $doc_track; ?>" />
                          </div></div>
                             <?php $i++;} }else {?>
                <!--                                    <div class="rw_bg" style="margin-top:10px;text-align: center"><h3 class="p_head">There are no jobs related to your search</h3></div>-->

                                                                                 <?php 

                                                                        }?>
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


function deleteImage(id){
    $("#"+id+"deletediv").remove();
   //alert('ghdfghdfghd');
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
<script>
			function funFileName(fileName){
			document.getElementById("resumeUrl").innerHTML=fileName;
			}
                        
                        $('input.files').each(function() {
    alert($(this).val()); 
});
		</script>
                
<script type="text/javascript">
 $("#imageupload").on('change', function () {
 
     var countFiles = $(this)[0].files.length;
 
     var imgPath = $(this)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#preview-image");
     image_holder.empty();
 
     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg"|| extn == "pdf") {
         if (typeof (FileReader) != "undefined") {
 
             for (var i = 0; i < countFiles; i++) {
 
                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("<img  />", {
                         "src": e.target.result,
                             "class": "thumbimage form-control  col-sm-3",
                             "style": "width: 216px;height: 176px;margin-left:25px;"
                     }).appendTo(image_holder);
                 }
 
                 image_holder.show();
                 reader.readAsDataURL($(this)[0].files[i]);
             }
 
         } else {
             alert("It doesn't supports");
         }
     } else {
         alert("Select Only images");
     }
 });
 </script>     
                
<?php include('../footer.php'); ?>
