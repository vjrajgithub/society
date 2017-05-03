<?php 
include('../header.php');
include('../utility/common.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_add_complain.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}

// echo '<pre>';
//    print_r($_SESSION);
//    echo '<pre>';
$disable = 'disabled=""';
$success = "none";
$c_title = '';
$c_description = '';
$c_date = '';
$c_month = '';
$c_year = '';
$c_userid = '';
$branch_id = '';
$title = $_data['text_1'];
$button_text = $_data['save_button_text'];
$successful_msg = $_data['text_8'];
$form_url = WEB_URL . "complain/addcomplain.php";
$id="";
$hdnid="0";
$e_designation = "";


//$c_title = $row['c_title'];
$complainId = '';
$memberId = '';
$workerId = '';
$c_nature = '';
$c_status = 'Pending';
$c_type = '';
//$c_description = $row['complain'];
$c_date = '';

if(isset($_POST['submit']) && $_POST['submit'] == 'addComplain'){
//    echo '<pre>';
//    print_r($_POST);
//    echo '<pre>';
//    die();
	//$xmonth = date('m');
	date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d H:i:s');
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
	echo $sql = "INSERT INTO tbl_add_complain(c_title,complainId,memberId, complain, nature,complaintType,complainstatus,eid, c_userid, branch_id,insertDate,updateDate) values('$_POST[txtCTitle]','$_POST[ddlComplainName]','$_POST[ddlMemberName]','$_POST[txtCDescription]','$_POST[ddlCamplainNature]','$_POST[ddlCamplainType]','$_POST[ddlCamplainStatus]','$_POST[ddlWorkerName]','".(int)$_SESSION['objLogin']['user_id']."','" . $_SESSION['objLogin']['branch_id'] . "','".$date."','".$date."')";
	//echo $sql;
	//die();
	mysql_query($sql,$link);
	mysql_close($link);
	$url = WEB_URL . 'complain/complainlist.php?m=add';
	header("Location: $url");
	
}
else{
//    echo '<pre>';
//    print_r($_POST);
//    echo '<pre>';
//    die();
    
        date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d H:i:s');
        if(isset($_POST['ddlCamplainStatus']) && $_POST['ddlCamplainStatus'] == 'Resolve'){
          echo $sql = "UPDATE `tbl_add_complain` SET "
                . "`c_title`='".$_POST['txtCTitle']."',"
                . "`complainId`='".$_POST['ddlComplainName']."',"
                . "`memberId`='".$_POST['ddlMemberName']."',"
                . "`complain`='".$_POST['txtCDescription']."',"
                . "`nature`='".$_POST['ddlCamplainNature']."',"
                . "`complaintType`='".$_POST['ddlCamplainType']."',"
                . "`complainstatus`='".$_POST['ddlCamplainStatus']."',"
                . "`eid`='".$_POST['ddlWorkerName']."',"
                . "`updateDate`='".$date."',"
                . "`resolveDate`='".$date."'"
                  . " WHERE id='".$_GET['id']."'";  
        }else{
	echo $sql = "UPDATE `tbl_add_complain` SET "
                . "`c_title`='".$_POST['txtCTitle']."',"
                . "`complainId`='".$_POST['ddlComplainName']."',"
                . "`memberId`='".$_POST['ddlMemberName']."',"
                . "`complain`='".$_POST['txtCDescription']."',"
                . "`nature`='".$_POST['ddlCamplainNature']."',"
                . "`complaintType`='".$_POST['ddlCamplainType']."',"
                . "`complainstatus`='".$_POST['ddlCamplainStatus']."',"
                . "`eid`='".$_POST['ddlWorkerName']."',"
                . "`updateDate`='".$date."' WHERE id='".$_GET['id']."'";
        }
//	echo $sql;
	//die();
	mysql_query($sql,$link);
	$url = WEB_URL . 'complain/complainlist.php?m=up';
	header("Location: $url");
}

$success = "block";
}
//echo '<pre>';
//    print_r($_GET);
//    echo '<pre>';
if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysql_query("SELECT * FROM tbl_add_complain where id = '" . $_GET['id'] . "'",$link);
	while($row = mysql_fetch_assoc($result)){
		
//            echo '<pre>';
//                print_r($row);
//            echo '<pre>';
            
//            $resultMasterCom = mysql_query("SELECT * FROM master_complain where complainId = '" . $row['complainId'] . "'",$link);
//            $rowCom = mysql_fetch_assoc($resultMasterCom);
//            
//            
//            $resultMemberCom = mysql_query("SELECT * FROM tbl_add_member where memberId = '" . $row['memberId'] . "'",$link);
//            $rowCom = mysql_fetch_assoc($resultMasterCom);
            
//            echo '<pre>';
//                print_r($rowCom);
//            echo '<pre>';
                $disable = '';
		$c_title = $row['c_title'];
                $complainId = $row['complainId'];
                $memberId = $row['memberId'];
                $workerId = $row['eid'];
                $c_nature = $row['nature'];
                $c_status = $row['complainstatus'];
                $c_type = $row['complaintType'];
		$c_description = $row['complain'];
		$c_date = $row['insertDate'];
		$hdnid = $_GET['id'];
		$title = $_data['text_1_1'];
		$button_text = $_data['update_button_text'];
		$successful_msg = $_data['text_9'];
		$form_url = WEB_URL . "complain/addcomplain.php?id=".$_GET['id'];
                //die();
	}
	
	//mysql_close($link);

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
<div class="row">
  <div class="col-md-12">
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo WEB_URL; ?>complain/complainlist.php" data-original-title="<?php echo $_data['back_text'];?>"><i class="fa fa-reply"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['text_4'];?></h3>
      </div>
      <form onSubmit="return validateMe();" action="<?php echo $form_url; ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
		<div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtCTitle"><?php echo $_data['text_5'];?> <span style="color:red;">*</span> :</label>
            <input type="text" onkeypress="return isChar(event)" name="txtCTitle" value="<?php echo $c_title;?>" id="txtCTitle" class="form-control" />
          </div>            
            <div class="form-group col-md-4 col-xs-12">
            <label for="ddlMemberType"><?php echo $_data['text_11'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlComplainName" id="ddlComplainName" class="form-control">
              <option value="">--<?php echo "Select Complain Name";?>--</option>
              <?php 
				  	$result_type = mysql_query("SELECT * FROM master_complain order by complainName ASC",$link);
					while($row_type = mysql_fetch_array($result_type)){
				  ?>

              <option <?php if($complainId == $row_type['complainId']){echo 'selected';}?> value="<?php echo $row_type['complainId'];?>"><?php echo $row_type['complainName'];?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="ddlMemberType"><?php echo $_data['text_12'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlMemberName" id="ddlMemberName" class="form-control">
              <option value="">--<?php echo "Select Member Name";?>--</option>
              <?php 
				  	$result_type = mysql_query("SELECT * FROM tbl_add_owner order by ownerName ASC",$link);
					while($row_type = mysql_fetch_array($result_type)){
				  ?>
              <option <?php if($memberId == $row_type['memberId']){echo 'selected';}?>  value="<?php echo $row_type['memberId'];?>"><?php echo $row_type['ownerName'];?></option>
              <?php }?>
            </select>
          </div>  
          </div>  
            
            
          <div class="row">
          <div class="form-group col-md-8 col-xs-12">
            <label for="txtCDescription"><?php echo $_data['text_6'];?> <span style="color:red;">*</span> :</label>
            <textarea name="txtCDescription" id="txtCDescription" class="form-control"><?php echo $c_description;?></textarea>
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="ddlMemberType"><?php echo $_data['text_13'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlCamplainNature" id="ddlCamplainNature" class="form-control">
              <option value="">--<?php echo "Select Camplain Nature";?>--</option>
              
              <option <?php if($c_nature == "Complain"){echo 'selected';}?> value="Complain"><?php echo "Complain";?></option>
              <option <?php if($c_nature == "Suggestion"){echo 'selected';}?> value="Suggestion"><?php echo "Suggestion";?></option>
              <option <?php if($c_nature == "Request"){echo 'selected';}?> value="Request"><?php echo "Request";?></option>
              
            </select>
          </div> 
          </div> 
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="ddlMemberType"><?php echo $_data['text_14'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlCamplainType" id="ddlCamplainType" class="form-control">
              <option value="">--<?php echo "Select Camplain Type";?>--</option>
              
              <option  <?php if($c_type == "Individual"){echo 'selected';}?>  value="Individual"><?php echo "Individual";?></option>
              <option <?php if($c_type == "Society"){echo 'selected';}?>  value="Society"><?php echo "Society";?></option>
              
            </select>
          </div>   

          <div class="form-group col-md-4 col-xs-12">
            <label for="ddlMemberType"><?php echo $_data['text_16'];?> <span style="color:red;">*</span> :</label>
            <select <?php echo $disable ;?> name="ddlCamplainStatus" id="ddlCamplainStatus" class="form-control">
              <option value="">--<?php echo "Select Camplain Status";?>--</option>
              
              <option <?php if($c_status == "Resolve"){echo 'selected';}?> value="Resolve"><?php echo "Resolve";?></option>
              <option <?php if($c_status == "Pending"){echo 'selected';}?> value="Pending"><?php echo "Pending";?></option>
              
            </select>
          </div>  

          <div class="form-group col-md-4 col-xs-12">
            <label for="ddlMemberType"><?php echo $_data['text_17'];?> <span style="color:red;">*</span> :</label>
            <select name="ddlWorkerName" id="ddlWorkerName" class="form-control">
              <option value="">--<?php echo "Select Worker Name";?>--</option>
              <?php 
				  	$result_type = mysql_query("SELECT * FROM tbl_add_employee order by e_name ASC",$link);
					while($row_type = mysql_fetch_array($result_type)){
				  ?>
              <option <?php if($workerId == $row_type['eid']){echo 'selected';}?> value="<?php echo $row_type['eid'];?>"><?php echo $row_type['e_name'];?></option>
              <?php }?>
            </select>
          </div>  
          </div>  
            
<!--          <div class="form-group">
            <label for="txtCDate"><?php echo $_data['text_7'];?> <span style="color:red;">*</span> :</label>
            <input type="text" name="txtCDate" value="<?php echo $c_date;?>" id="txtCDate" class="form-control datepicker"/>
          </div>-->
		  <div class="row">
          <div class="form-group col-md-12">
              <input type="submit" name="submit" value="Add Complain" class="btn btn-primary pull-right" value="<?php echo $button_text; ?>"/>
          </div>
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
	if($("#txtCTitle").val() == ''){
            $("#txtCTitle").css("border","1px solid red");
		$("#txtCTitle").focus();
		return false;
	}
	else if($("#ddlComplainName").val() == ''){
		$("#ddlComplainName").css("border","1px solid red");
		$("#ddlComplainName").focus();
		return false;
	}
	else if($("#ddlMemberName").val() == ''){
		$("#ddlMemberName").css("border","1px solid red");
		$("#ddlMemberName").focus();
		return false;
	}
        else if($("#txtCDescription").val() == ''){
		$("#txtCDescription").css("border","1px solid red");
		$("#txtCDescription").focus();
		return false;
	}
	else if($("#ddlCamplainNature").val() == ''){
		$("#ddlCamplainNature").css("border","1px solid red");
		$("#ddlCamplainNature").focus();
		return false;
	}
        else if($("#ddlCamplainType").val() == ''){
		$("#ddlCamplainType").css("border","1px solid red");
		$("#ddlCamplainType").focus();
		return false;
	}
        else if($("#ddlCamplainStatus").val() == ''){
		$("#ddlCamplainStatus").css("border","1px solid red");
		$("#ddlCamplainStatus").focus();
		return false;
	}
	else if($("#ddlWorkerName").val() == ''){
		$("#ddlWorkerName").css("border","1px solid red");
		$("#ddlWorkerName").focus();
		return false;
	}
	else{
		return true;
	}
}

          $("#txtCTitle").keypress(function(){
		  
		  
		$(this).css("border","1px solid #d2d6de");  
		  
	  });
          $("#ddlComplainName").change(function(){
		  
		  
		$(this).css("border","1px solid #d2d6de"); 
		  
	  });
          $("#ddlMemberName").change(function(){
		  
		  
		$(this).css("border","1px solid #d2d6de");  
		  
	  });
          $("#txtCDescription").keypress(function(){
		  
		  
		$(this).css("border","1px solid #d2d6de");  
		  
	  });
          $("#ddlCamplainNature").change(function(){
		  
		  
		$(this).css("border","1px solid #d2d6de");  
		  
	  });
          $("#ddlCamplainType").change(function(){
		  
		  
		$(this).css("border","1px solid #d2d6de");  
		  
	  });
          $("#ddlCamplainStatus").change(function(){
		  
		  
		$(this).css("border","1px solid #d2d6de");  
		  
	  });
          $("#ddlWorkerName").change(function(){
		  
		  
		$(this).css("border","1px solid #d2d6de");  
		  
	  });
          
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
          
</script>
<?php include('../footer.php'); ?>
