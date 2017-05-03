<?php 
include('../header.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_unit_setup.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}

                        $flatType = '';
		 	$block = '';
			$floorNo = '';
			$unitNo = '';
                        
                        
                        
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
	$form_url = WEB_URL . "setting/unit_setup.php";

	$hval = 0;
	
	$station_logo = WEB_URL . 'img/no_image.jpg';
	$img_track = '';

if(isset($_POST['block'])){
//    echo '<pre>';
//    print_r($_POST);
//    echo '<pre>';
    //die;
                    date_default_timezone_set("Asia/Kolkata");
                    $date=date('Y-m-d H:i:s');
                    if($_POST['hdnSpid'] == '0'){
                    $year = date('Y');
                    $sql="INSERT INTO `tbl_add_unit`(`block`,`floor_no`,`flat_type`,unit_no,`added_date`,c_userid,branch_id) VALUES ('$_POST[block]','$_POST[floor]','$_POST[flatArea]','$_POST[unit]','".$date."','".(int)$_SESSION['objLogin']['user_id']."','" . $_SESSION['objLogin']['branch_id'] . "')";	
                    //die;
                    mysql_query($sql, $link);
                    echo $last_id = mysql_insert_id($link);//die;
                    
                   if($last_id){ 
                    echo $sql="INSERT INTO `tbl_unit_member`(`uid`,`insertDate`,`updateDate`) VALUES ('$last_id','".$date."','".$date."')";	
                    //die;
                    mysql_query($sql, $link);
                   } 
                    mysql_close($link);
		    $url = WEB_URL . 'setting/unit_setup.php?m=add';
		    header("Location: $url");
		}
else{
	date_default_timezone_set("Asia/Kolkata");
        $date=date('Y-m-d H:i:s');
        //print_r($_GET); 
	 $sql_update="UPDATE `tbl_add_unit` set "
                    . "block ='".$_POST['block']."',"
                    . "`unit_no`='".$_POST['unit']."',"
                    . "`floor_no`='".$_POST['floor']."',"
                    . "`flat_type`='".$_POST['flatArea']."',"
                    . "`added_date`='".$date."' where uid = '".$_GET['id']."'";	
                    mysql_query($sql_update, $link);
                    mysql_close($link);
		    $url = WEB_URL . 'setting/unit_setup.php?m=up';
		    header("Location: $url");
			/*echo "<script>alert('Update Successfully');</script>";*/
		}

$success = "block";
}

if(isset($_GET['spid']) && $_GET['spid'] != ''){
		$result_location = mysql_query("SELECT * FROM tbl_add_unit where uid= '" . (int)$_GET['spid'] . "' ",$link);
		if($row = mysql_fetch_assoc($result_location)){
//                    echo '<pre>';
//                    print_r($row);
//                    echo '<pre>';
//                    die;
                        $flatType = $row['flat_type'];
		 	$block = $row['block'];
			$floorNo = $row['floor_no'];
			$unitNo = $row['unit_no'];
			
			$button_text = $_data['update_button_text'];
			$form_url = WEB_URL . "setting/unit_setup.php?id=".$_GET['spid'];
			$hval = $row['uid'];
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
            <label for="ddlEmpMonth"><?php echo 'Block';?> :</label>
            <select onchange="getFloorByBlock(this.value);" name="block" id="block" class="form-control">
              <option value="">--<?php echo $_data['text_6'];?>--</option>
              <?php 
			  $result_month = mysql_query("SELECT * FROM tbl_add_block group by blockNumber order by blockId ASC ",$link);
					while($row_month = mysql_fetch_array($result_month)){?>
              <option <?php if($block == $row_month['blockId']){echo 'selected';}?> value="<?php echo $row_month['blockId'];?>"><?php echo $row_month['blockNumber'];?></option>
              <?php } ?>
            </select>
          </div> 
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpDesignation"><?php echo 'Floor';?> :</label>
<!--            <input  type="text" name="txtEmpDesignation" value="<?php echo $designation;?>" id="txtEmpDesignation" class="form-control" />-->
            <select  name="floor" id="floor" class="form-control">
<!--              <option value="">--<?php echo "Select Facility Charge";?>--</option>
              
              <option <?php if($month_id == "500 / hour"){echo 'selected';}?> value="500 / hour"><?php echo "500 / hour";?></option>
              <option <?php if($month_id == "2000 / day"){echo 'selected';}?> value="2000 / day"><?php echo "2000 / day";?></option>-->
<!--              <option <?php if($c_nature == "Request"){echo 'selected';}?> value="Request"><?php echo "Request";?></option>-->
            </select>
<!--              <input type="hidden" id="hdnDesg" name="hdnDesg" value="<?php echo $designation;?>" />-->
          </div>

          <div class="form-group col-md-4 col-xs-12">
            <label for="ddlEmpMonth"><?php echo 'Flat Type';?> :</label>
            <select onchange="getFloorAreaByFloor(this.value);" name="flatType" id="flatType" class="form-control">
              <option value="">--<?php echo $_data['text_6'];?>--</option>
              <?php 
			  $result_month = mysql_query("SELECT * FROM flat_type_master group by flatType order by flatId ASC ",$link);
					while($row_month = mysql_fetch_array($result_month)){?>
              <option <?php if($flatType == $row_month['flatId']){echo 'selected';}?> value="<?php echo $row_month['flatId'];?>"><?php echo $row_month['flatType'];?></option>
              <?php } ?>
            </select>
          </div> 
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpDesignation"><?php echo 'Flat Area';?> :</label>
<!--            <input  type="text" name="txtEmpDesignation" value="<?php echo $designation;?>" id="txtEmpDesignation" class="form-control" />-->
            <select  name="flatArea" id="ddlFloorArea" class="form-control">
<!--              <option value="">--<?php echo "Select Facility Charge";?>--</option>
              
              <option <?php if($month_id == "500 / hour"){echo 'selected';}?> value="500 / hour"><?php echo "500 / hour";?></option>
              <option <?php if($month_id == "2000 / day"){echo 'selected';}?> value="2000 / day"><?php echo "2000 / day";?></option>-->
<!--              <option <?php if($c_nature == "Request"){echo 'selected';}?> value="Request"><?php echo "Request";?></option>-->
            </select>
<!--              <input type="hidden" id="hdnDesg" name="hdnDesg" value="<?php echo $designation;?>" />-->
          </div>

          </div>
		  
<!--		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpDesignation"><?php echo $_data['text_5'];?> :</label>
            <input  type="text" name="txtEmpDesignation" value="<?php echo $designation;?>" id="txtEmpDesignation" class="form-control" />
            <select disabled="" name="txtEmpDesignation" id="txtEmpDesignation" class="form-control">
              
            </select>
              <input type="hidden" id="hdnDesg" name="hdnDesg" value="<?php echo $designation;?>" />
          </div>
            
            <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpAmount"><?php echo $_data['text_18'];?> :</label>
             <input type="text" name="txtEnentStart" value="<?php echo $startDate;?>" id="txtEnentStart" class="form-control datepicker" />

            </div>
            
            <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpAmount"><?php echo $_data['text_19'];?> :</label>
             <input  type="text" name="txtEnentEnd" value="<?php echo $endDate;?>" id="txtEnentEnd" class="form-control datepicker" />

            </div>
            </div>-->
          
		  <div class="row">
          <div class="form-group col-md-4 col-xs-12">
            <label for="txtEmpAmount"><?php echo 'Unit';?> :</label>
             <input  type="text" name="unit" value="<?php echo $unitNo;?>" id="unit" class="form-control" />

          </div>
            
          </div>

          <div class="form-group pull-right">
            <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $button_text; ?>"/>
			&nbsp;
            <input type="reset" onClick="javascript:window.location.href='<?php echo WEB_URL; ?>setting/unit_setup.php';" name="btnReset" id="btnReset" value="<?php echo $_data['reset'];?>" class="btn btn-primary"/>
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
		$sqlx= "DELETE FROM `tbl_add_unit` WHERE uid = ".$_GET['delid'];
		mysql_query($sqlx,$link); 
                
                $sqlx= "DELETE FROM `tbl_unit_member` WHERE uid = ".$_GET['delid'];
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
                    <th><?php echo 'Block No';?></th>
                    <th><?php echo 'Flat Type';?></th>
                    <th><?php echo 'Floor No';?></th>
                    <th><?php echo 'Unit ';?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                 $queryAllFacility = "SELECT ab.blockNumber,af.floor_no,mf.flatType,au.uid,au.unit_no  FROM tbl_add_unit au left join tbl_add_block ab on au.block = ab.blockId left join flat_type_master mf on mf.flatId = au.flat_type left join tbl_add_floor af on af.fid = au.floor_no ";
				$result = mysql_query($queryAllFacility,$link);
				while($row = mysql_fetch_assoc($result)){
//                                    echo '<pre>';
//                    print_r($row);
//                    echo '<pre>';
                    //die;
                                    ?>
                  <tr>
                    <td><?php echo $row['blockNumber']; ?></td>
                    
                    <td><?php echo $row['flatType']; ?></td>
                    <td><?php echo $row['floor_no']; ?></td>
                    
                    <td><?php echo $row['unit_no']; ?></td>
                    <td><a class="btn btn-success" data-toggle="tooltip" href="javascript:;" onclick="$('#employee_view_<?php echo $row['uid']; ?>').modal('show');" data-original-title="<?php echo $_data['view_text'];?>"><i class="fa fa-eye"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL;?>setting/unit_setup.php?spid=<?php echo $row['uid']; ?>" data-original-title="<?php echo $_data['edit_text'];?>"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger" data-toggle="tooltip" onclick="deleteEmployeeSalary(<?php echo $row['uid']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i class="fa fa-trash-o"></i></a>
                      <div id="employee_view_<?php echo $row['uid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header orange_header">
                              <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                              <h3 class="modal-title"><?php echo 'Unit Details';?></h3>
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
<!--                                <b><?php echo $_data['text_14'];?> :</b> <?php echo $row['ownerName']; ?><br/>-->
                                <b><?php echo 'Block No';?> :</b> <?php echo $row['blockNumber']; ?><br/>
                                <b><?php echo 'Flat Type';?> :</b> <?php echo $row['flatType']; ?><br/>
                                <b><?php echo 'Floor No';?> :</b> <?php echo $row['floor_no']; ?><br/>
                                <b><?php echo 'Unit No';?> :</b> <?php echo $row['unit_no']; ?><br/>
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
  	var iAnswer = confirm("Are you sure you want to delete this Unit ?");
	if(iAnswer){
		window.location = '<?php echo WEB_URL;?>setting/unit_setup.php?delid=' + Id;
	}
  }
  </script>

<?php include('../footer.php'); ?>
