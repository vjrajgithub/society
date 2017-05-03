<?php 
include('../header.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_facility_setting.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
        $f_name = '';
	$f_event = '';
	$f_rate = '';
	$f_status = '';
        
        $f_charge = '';
	$emp_name ='';
	$designation = '';
	$month_id ='';
	$amount ='0.00';
	$issue_date = '';
	$branch_id = '';
	$button_text = $_data['save_button_text'];
	$form_url = WEB_URL . "setting/facility_setting.php";

	$hval = 0;
	
	$station_logo = WEB_URL . 'img/no_image.jpg';
	$img_track = '';

if(isset($_POST['txtFacilityName'])){
    echo '<pre>';
    print_r($_POST);
    echo '<pre>';
    //die;
                    date_default_timezone_set("Asia/Kolkata");
                    $date=date('Y-m-d H:i:s');
                    if($_POST['hdnSpid'] == '0'){
                    $year = date('Y');
                    echo $sql="INSERT INTO `master_facility`(`facilityName`,`event_for`,`rate`,`status`,`cDate`,c_userid,branch_id) VALUES ('$_POST[txtFacilityName]','$_POST[txtFacilityFor]','$_POST[txtFacilityCharge]','$_POST[txtFacilityStatus]','".$date."','".(int)$_SESSION['objLogin']['user_id']."','" . $_SESSION['objLogin']['branch_id'] . "')";	
                    //die;
                    mysql_query($sql, $link);
                    mysql_close($link);
		    $url = WEB_URL . 'setting/facility_setting.php?m=add';
		    header("Location: $url");
		}
else{
	date_default_timezone_set("Asia/Kolkata");
        $date=date('Y-m-d H:i:s');
//            echo '<pre>';
//    print_r($_POST);
//    echo '<pre>';
//    die;
	$sql_update="UPDATE `master_facility` set "
                . "facilityName ='".$_POST['txtFacilityName']."',"
                . "`event_for`='".$_POST['txtFacilityFor']."',"
                . "`rate`='".$_POST['txtFacilityCharge']."',"
                . "`status`='".$_POST['txtFacilityStatus']."',"
                . "`cDate`='".$date."' where facilityId = '".$_GET['id']."'";	
			mysql_query($sql_update, $link);
			mysql_close($link);
                        $url = WEB_URL . 'setting/facility_setting.php?m=up';
                        header("Location: $url");
			/*echo "<script>alert('Update Successfully');</script>";*/
		}

$success = "block";
}

if(isset($_GET['spid']) && $_GET['spid'] != ''){
		$result_location = mysql_query("SELECT * FROM master_facility where facilityId= '" . (int)$_GET['spid'] . "'  ",$link);
		if($row = mysql_fetch_assoc($result_location)){
//                    echo '<pre>';
//                    print_r($row);
//                    echo '<pre>';
//                    die;
		 	$f_name = $row['facilityName'];
			$f_event = $row['event_for'];
			$f_rate = $row['rate'];
			$f_status = $row['status'];
			//$issue_date = $row['issue_date'];
			$button_text = $_data['update_button_text'];
			$form_url = WEB_URL . "setting/facility_setting.php?id=".$_GET['spid'];
			$hval = $row['facilityId'];
		}
			
	}
	
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1><?php echo $_data['text_1'];?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><a href="<?php echo WEB_URL?>setting/setting.php"><?php echo $_data['setting'];?></a></li>
    <li class="active"><?php echo $_data['text_1'];?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Full Width boxes (Stat box) -->
<div class="row">
  <div class="col-md-12">
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo WEB_URL; ?>setting/setting.php" data-original-title="<?php echo $_data['back_text'];?>"><i class="fa fa-reply"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['text_2'];?></h3>
      </div>
      <form onSubmit="return validateMe();" action="<?php echo $form_url; ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
		<div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpName"><?php echo $_data['text_3'];?> <span style="color:red;">*</span> :</label>
            <input type="text" onkeypress="return isChar(event)" name="txtFacilityName" value="<?php echo $f_name;?>" id="txtFacilityName" class="form-control" />
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="ddlEmpMonth"><?php echo $_data['text_6'];?> :</label>
            <select name="txtFacilityFor" id="txtFacilityFor" class="form-control">
              <option value="">--<?php echo "Event For";?>--</option>
              <option <?php if($f_event == "HOUR"){echo 'selected';}?> value="HOUR"><?php echo "HOUR";?></option>
              <option <?php if($f_event == "FIRST HALF DAY"){echo 'selected';}?> value="FIRST HALF DAY"><?php echo "FIRST HALF(8 AM to 4 PM)";?></option>
              <option <?php if($f_event == "SECOND HALF DAY"){echo 'selected';}?> value="SECOND HALF DAY"><?php echo "SECOND HALF(4 PM to 12 AM)";?></option>
              <option <?php if($f_event == "DAY"){echo 'selected';}?> value="DAY"><?php echo "DAY";?></option>
              <option <?php if($f_event == "MONTH"){echo 'selected';}?> value="MONTH"><?php echo "MONTH";?></option>
              <option <?php if($f_event == "YEAR"){echo 'selected';}?> value="YEAR"><?php echo "YEAR";?></option>
            </select>
          </div>  
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpName"><?php echo $_data['text_5'];?> <span style="color:red;">*</span> :</label>
            <input type="text" onkeypress="return isChar(event)" name="txtFacilityCharge" value="<?php echo $f_rate;?>" id="txtFacilityCharge" class="form-control" />
          </div>
          </div>
          
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpAmount"><?php echo $_data['text_7'];?> :</label>
<!--            <div class="input-group">-->
<!--            <input type="text" name="txtEmpAmount" value="<?php echo $amount;?>" id="txtEmpAmount" class="form-control" />-->
            <select name="txtFacilityStatus" id="txtFacilityStatus" class="form-control">
              <option value="">--<?php echo "Select Status";?>--</option>
              
              <option <?php if($f_status == "Active"){echo 'selected';}?> value="Active"><?php echo "Active";?></option>
              <option <?php if($f_status == "Inactive"){echo 'selected';}?> value="Inactive"><?php echo "Inactive";?></option>
<!--              <option <?php if($c_nature == "Request"){echo 'selected';}?> value="Request"><?php echo "Request";?></option>-->
            </select>
<!--            <div class="input-group-addon"><?php echo CURRENCY;?></div>-->
<!--            </div>-->
          </div>
          </div>
<!--          <div class="form-group">
            <label for="txtEmpIssueDate"><?php echo $_data['text_8'];?> :</label>
            <input type="text" name="txtEmpIssueDate" value="<?php echo $issue_date;?>" id="txtEmpIssueDate" class="form-control datepicker" />
          </div>-->
          <div class="form-group pull-right">
            <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $button_text; ?>"/>
			&nbsp;
            <input type="reset" onClick="javascript:window.location.href='<?php echo WEB_URL; ?>setting/facility_setting.php';" name="btnReset" id="btnReset" value="<?php echo $_data['reset'];?>" class="btn btn-primary"/>
          </div>
        </div>
        <input type="hidden" name="hdnSpid" value="<?php echo $hval; ?>"/>
      </form>
      <h4 style="text-align:center; color:red;"><?php echo $_data['reset_text'];?></h4>
      <!-- /.box-body -->
<?php
$delinfo = 'none';
$addinfo = 'none';
$msg = "";
 if(isset($_GET['delid']) && $_GET['delid'] != '' && $_GET['delid'] > 0){
		$sqlx= "DELETE FROM `master_facility` WHERE facilityId = ".$_GET['delid'];
		mysql_query($sqlx,$link); 
		$delinfo = 'block';
	}
if(isset($_GET['m']) && $_GET['m'] == 'add'){
	$addinfo = 'block';
	$msg = $_data['text_9'];
}
if(isset($_GET['m']) && $_GET['m'] == 'up'){
	$addinfo = 'block';
	$msg = $_data['text_10'];
        
        
}
//echo '<pre>';
//        print_r($_data);
//        echo '<pre>';
?>      
      <!-- Main content -->
      <section class="content">
      <!-- Full Width boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="alert alert-danger alert-dismissable" style="display:<?php echo $delinfo; ?>">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
            <h4><i class="icon fa fa-ban"></i> <?php echo $_data['delete_text'];?> !</h4>
            <?php echo $_data['text_11'];?> </div>
          <div class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
            <h4><i class="icon fa fa-check"></i> <?php echo $_data['success'];?> !</h4>
            <?php echo $msg; ?> </div>
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><?php echo $_data['text_12'];?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table sakotable table-bordered table-striped dt-responsive">
                <thead>
                  <tr>
                    <th><?php echo $_data['text_3'];?></th>
                    <th><?php echo $_data['text_6'];?></th>
                    <th><?php echo $_data['text_5'];?></th>
                    <th><?php echo $_data['text_7'];?></th>
<!--                    <th><?php echo $_data['text_8'];?></th>-->
                    <th><?php echo $_data['action_text'];?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                 echo $queryAllFacility = "SELECT * FROM master_facility where c_userid = '".(int)$_SESSION['objLogin']['user_id']."' AND branch_id = '" . $_SESSION['objLogin']['branch_id'] . "' ";
				$result = mysql_query($queryAllFacility,$link);
				while($row = mysql_fetch_assoc($result)){
                                    ?>
                  <tr>
                    <td><?php echo $row['facilityName']; ?></td>
                    
                    <td><?php echo $row['event_for']; ?></td>
                    <td><?php echo $row['rate']; ?></td>
                    
                    <td><?php echo $row['status']; ?></td>
                    <td><a class="btn btn-success" data-toggle="tooltip" href="javascript:;" onclick="$('#employee_view_<?php echo $row['facilityId']; ?>').modal('show');" data-original-title="<?php echo $_data['view_text'];?>"><i class="fa fa-eye"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL;?>setting/facility_setting.php?spid=<?php echo $row['facilityId']; ?>" data-original-title="<?php echo $_data['edit_text'];?>"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger" data-toggle="tooltip" onclick="deleteEmployeeSalary(<?php echo $row['facilityId']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i class="fa fa-trash-o"></i></a>
                      <div id="employee_view_<?php echo $row['facilityId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header orange_header">
                              <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                              <h3 class="modal-title"><?php echo $_data['text_12'];?></h3>
                            </div>
                            <div class="modal-body model_view" align="center">&nbsp;
                              <div><!--<img class="photo_img_round" style="width:100px;height:100px;" src="<?php //echo $station_logo;  ?>" />--></div>
<!--                              <div class="model_title"><?php echo $row['e_name']; ?></div>-->
                            </div>
                            <div class="modal-body">
                              <h3 style="text-decoration:underline;"><?php echo $_data['details_information'];?></h3>
                              <div class="row">
                                <div class="col-xs-12"> 
<!--                                    <b><?php echo $_data['text_13'];?> :</b> <?php echo $row['ownerName']; ?><br/>-->
                                    <b><?php echo $_data['text_3'];?> :</b> <?php echo $row['facilityName']; ?><br/>
                                    <b><?php echo $_data['text_6'];?> :</b> <?php echo $row['event_for']; ?><br/>
                                    <b><?php echo $_data['text_5'];?> :</b> <?php echo $row['rate']; ?><br/>
                                    <b><?php echo $_data['text_7'];?> :</b> <?php echo $row['status']; ?><br/>
<!--                                <b><?php echo $_data['text_7'];?> :</b> <?php if($currency_position == 'left') {echo $global_currency.$row['amount'];}else { echo $row['amount'].$global_currency;}?><br/>
                                    <b><?php echo $_data['text_8'];?> :</b> <?php echo $row['issue_date']; ?><br/>-->
                              </div>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                      </div></td>
                  </tr>
                  <?php } mysql_close($link); ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.box -->
  </div>
</div>
<!-- /.row -->
<script type="text/javascript">
  function deleteEmployeeSalary(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Employee Salary ?");
	if(iAnswer){
		window.location = '<?php echo WEB_URL;?>setting/facility_setting.php?delid=' + Id;
	}
  }
  </script>

<?php include('../footer.php'); ?>
