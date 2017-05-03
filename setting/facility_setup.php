<?php 
include('../header.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_facility_setup.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
                        $emp_name = '';
                        $no_of_hours = '';
			$facility = '';
			$totalCharge = '';
			$startDate = '';
			$endDate  = '';
        $f_charge = '';
	//$emp_name ='';
	$designation = '';
	$month_id ='';
	$amount ='0.00';
	$issue_date = '';
	$branch_id = '';
	$button_text = $_data['save_button_text'];
	$form_url = WEB_URL . "setting/facility_setup.php";

	$hval = 0;
	
	$station_logo = WEB_URL . 'img/no_image.jpg';
	$img_track = '';

if(isset($_POST['ddlEmpName'])){
    echo '<pre>';
    print_r($_POST);
    echo '<pre>';
    //die;
                    date_default_timezone_set("Asia/Kolkata");
                    $date=date('Y-m-d H:i:s');
                    if($_POST['hdnSpid'] == '0'){
                    $year = date('Y');
                    echo $sql="INSERT INTO `tbl_book_facility`(`facilityId`,`memberId`,`totalCharge`,noDayeHour,startDate,endDate,`cDate`) VALUES ('$_POST[ddlEmpMonth]','$_POST[ddlEmpName]','$_POST[txtEmpAmount]','$_POST[no_of_hours]','$_POST[txtEnentStart]','$_POST[txtEnentEnd]','".$date."')";	
                    //die;
                    mysql_query($sql, $link);
                    mysql_close($link);
		    $url = WEB_URL . 'setting/facility_setup.php?m=add';
		    header("Location: $url");
		}
else{
	date_default_timezone_set("Asia/Kolkata");
        $date=date('Y-m-d H:i:s');
	 $sql_update="UPDATE `tbl_book_facility` set "
                . "facilityId ='".$_POST['ddlEmpMonth']."',"
                . "`memberId`='".$_POST['ddlEmpName']."',"
                . "`noDayeHour`='".$_POST['no_of_hours']."',"
                . "`totalCharge`='".$_POST['txtEmpAmount']."',"
                . "`startDate`='".$_POST['txtEnentStart']."',"
                . "`endDate`='".$_POST['txtEnentEnd']."',"
                . "`cDate`='".$date."' where id = '".$_GET['id']."'";	
			mysql_query($sql_update, $link);
			mysql_close($link);
		    $url = WEB_URL . 'setting/facility_setup.php?m=up';
		    header("Location: $url");
			/*echo "<script>alert('Update Successfully');</script>";*/
		}

$success = "block";
}

if(isset($_GET['spid']) && $_GET['spid'] != ''){
		$result_location = mysql_query("SELECT * FROM tbl_book_facility where id= '" . (int)$_GET['spid'] . "' ",$link);
		if($row = mysql_fetch_assoc($result_location)){
//                    echo '<pre>';
//                    print_r($row);
//                    echo '<pre>';
//                    die;
                        $no_of_hours = $row['noDayeHour'];
		 	$emp_name = $row['memberId'];
			$facility = $row['facilityId'];
			$totalCharge = $row['totalCharge'];
			$startDate = $row['startDate'];
			$endDate  = $row['endDate'];
			$button_text = $_data['update_button_text'];
			$form_url = WEB_URL . "setting/facility_setup.php?id=".$_GET['spid'];
			$hval = $row['id'];
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
            <label for="ddlEmpName"><?php echo $_data['text_3'];?> :</label>
<!--            <select onchange="getDesgInfo(this.value)" name="ddlEmpName" id="ddlEmpName" class="form-control">-->
            <select name="ddlEmpName" id="ddlEmpName" class="form-control">
              <option value="">--<?php echo $_data['text_4'];?>--</option>
              <?php 
				  	$result_emp = mysql_query("SELECT * FROM tbl_add_owner order by memberId ASC",$link);
					while($row_emp = mysql_fetch_array($result_emp)){?>
              <option <?php if($emp_name == $row_emp['memberId']){echo 'selected';}?> value="<?php echo $row_emp['memberId'];?>"><?php echo $row_emp['firstName'].$row_emp['middleName'].$row_emp['lastName'];?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-4 col-xs-12">
            <label for="ddlEmpMonth"><?php echo $_data['text_6'];?> :</label>
            <select onchange="getActiveEventFor(this.value);" name="ddlEmpMonth" id="ddlEmpMonth" class="form-control">
              <option value="">--<?php echo $_data['text_6'];?>--</option>
              <?php 
			  $result_month = mysql_query("SELECT * FROM master_facility group by facilityName order by facilityId ASC ",$link);
					while($row_month = mysql_fetch_array($result_month)){?>
              <option <?php if($facility == $row_month['facilityId']){echo 'selected';}?> value="<?php echo $row_month['facilityId'];?>"><?php echo $row_month['facilityName'];?></option>
              <?php } ?>
            </select>
          </div> 
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpDesignation"><?php echo $_data['text_17'];?> :</label>
<!--            <input  type="text" name="txtEmpDesignation" value="<?php echo $designation;?>" id="txtEmpDesignation" class="form-control" />-->
            <select  name="txtEmpDesignation" id="ddlEventFor" class="form-control">
<!--              <option value="">--<?php echo "Select Facility Charge";?>--</option>
              
              <option <?php if($month_id == "500 / hour"){echo 'selected';}?> value="500 / hour"><?php echo "500 / hour";?></option>
              <option <?php if($month_id == "2000 / day"){echo 'selected';}?> value="2000 / day"><?php echo "2000 / day";?></option>-->
<!--              <option <?php if($c_nature == "Request"){echo 'selected';}?> value="Request"><?php echo "Request";?></option>-->
            </select>
<!--              <input type="hidden" id="hdnDesg" name="hdnDesg" value="<?php echo $designation;?>" />-->
          </div>
          </div>
		  
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpDesignation"><?php echo $_data['text_5'];?> :</label>
<!--            <input  type="text" name="txtEmpDesignation" value="<?php echo $designation;?>" id="txtEmpDesignation" class="form-control" />-->
            <select disabled="" name="txtEmpDesignation" id="txtEmpDesignation" class="form-control">
              
            </select>
<!--              <input type="hidden" id="hdnDesg" name="hdnDesg" value="<?php echo $designation;?>" />-->
          </div>
            
            <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpAmount"><?php echo $_data['text_18'];?> :</label>
             <input type="text" name="txtEnentStart" value="<?php echo $startDate;?>" id="txtEnentStart" class="form-control datepicker" />

            </div>
            
            <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpAmount"><?php echo $_data['text_19'];?> :</label>
             <input  type="text" name="txtEnentEnd" value="<?php echo $endDate;?>" id="txtEnentEnd" class="form-control datepicker" />

            </div>
            </div>
          
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpAmount"><?php echo $_data['text_7'];?> :</label>
             <input  type="text" name="no_of_hours" value="<?php echo $no_of_hours;?>" id="no_of_hours" class="form-control" />

          </div>
            <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpAmount"><?php echo $_data['text_16'];?> :</label>
            <input readonly="" onfocusin="getTotalAmount()" type="text" name="txtEmpAmount" value="<?php //echo $designation;?>" id="txtEmpAmount" class="form-control" />

          </div>
          </div>

          <div class="form-group pull-right">
            <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $button_text; ?>"/>
			&nbsp;
            <input type="reset" onClick="javascript:window.location.href='<?php echo WEB_URL; ?>setting/facility_setup.php';" name="btnReset" id="btnReset" value="<?php echo $_data['reset'];?>" class="btn btn-primary"/>
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
		$sqlx= "DELETE FROM `tbl_book_facility` WHERE id = ".$_GET['delid'];
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
                    <th><?php echo $_data['text_21'];?></th>
                    <th><?php echo $_data['text_20'];?></th>
                    <th><?php echo $_data['text_18'];?></th>
                    <th><?php echo $_data['text_19'];?></th>
                    <th><?php echo $_data['action_text'];?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                 $queryAllFacility = "SELECT tf.*,concat(o.firstName,' ',o.middleName,' ',o.lastName) as ownerName,mf.facilityName FROM tbl_book_facility tf left join tbl_add_owner o on tf.memberId = o.memberId left join master_facility mf on mf.facilityId = tf.facilityId ";
				$result = mysql_query($queryAllFacility,$link);
				while($row = mysql_fetch_assoc($result)){
//                                    echo '<pre>';
//                    print_r($row);
//                    echo '<pre>';
                    //die;
                                    ?>
                  <tr>
                    <td><?php echo $row['ownerName']; ?></td>
                    
                    <td><?php echo $row['facilityName']; ?></td>
                    <td><?php echo $row['totalCharge']; ?></td>
                    
                    <td><?php echo $row['startDate']; ?></td>
                    <td><?php echo $row['endDate']; ?></td>
                    <td><a class="btn btn-success" data-toggle="tooltip" href="javascript:;" onclick="$('#employee_view_<?php echo $row['id']; ?>').modal('show');" data-original-title="<?php echo $_data['view_text'];?>"><i class="fa fa-eye"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL;?>setting/facility_setup.php?spid=<?php echo $row['id']; ?>" data-original-title="<?php echo $_data['edit_text'];?>"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger" data-toggle="tooltip" onclick="deleteEmployeeSalary(<?php echo $row['id']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i class="fa fa-trash-o"></i></a>
                      <div id="employee_view_<?php echo $row['id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                <div class="col-xs-12"> <b><?php echo $_data['text_13'];?> :</b> <?php echo $row['ownerName']; ?><br/>
<!--                                <b><?php echo $_data['text_14'];?> :</b> <?php echo $row['ownerName']; ?><br/>-->
                                <b><?php echo $_data['text_6'];?> :</b> <?php echo $row['facilityName']; ?><br/>
                                <b><?php echo $_data['text_16'];?> :</b> <?php echo $row['totalCharge']; ?><br/>
                                <b><?php echo $_data['text_18'];?> :</b> <?php echo $row['startDate']; ?><br/>
                                <b><?php echo $_data['text_19'];?> :</b> <?php echo $row['endDate']; ?><br/>
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
		window.location = '<?php echo WEB_URL;?>setting/facility_setup.php?delid=' + Id;
	}
  }
  </script>

<?php include('../footer.php'); ?>
