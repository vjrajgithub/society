<?php 
include('../header.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_month_setup.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}

	$month_name ='';
	$button_text = $_data['save_button_text'];
	$form_url = WEB_URL . "setting/month_setup.php";

	$hval = 0;

if(isset($_POST['txtMonthName'])){
		if($_POST['hdnSpid'] == '0'){
		
	$sql="INSERT INTO `tbl_add_month_setup`(`month_name`) VALUES ('$_POST[txtMonthName]')";	
			//echo $sql;
			//die();
			mysql_query($sql, $link);
			mysql_close($link);
		    $url = WEB_URL . 'setting/month_setup.php?m=add';
		    header("Location: $url");
		}
else{
	
	$sql_update="UPDATE `tbl_add_month_setup` set month_name = '$_POST[txtMonthName]' where m_id= '" . (int)$_POST['hdnSpid'] . "'";	
			mysql_query($sql_update, $link);
			mysql_close($link);
		    $url = WEB_URL . 'setting/month_setup.php?m=up';
		    header("Location: $url");
			/*echo "<script>alert('Update Successfully');</script>";*/
		}

$success = "block";
}

if(isset($_GET['spid']) && $_GET['spid'] != ''){
		$result_location = mysql_query("SELECT * FROM tbl_add_month_setup where m_id= '" . (int)$_GET['spid'] . "'",$link);
		if($row = mysql_fetch_array($result_location)){
		 	$month_name = $row['month_name'];
			$button_text = $_data['update_button_text'];
			$form_url = WEB_URL . "setting/month_setup.php?id=".$_GET['spid'];
			$hval = $row['m_id'];
		}
			
	}
	
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1><?php echo $_data['text_1'];?> </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i> <?php echo $_data['home_breadcam'];?></a></li>
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
          <div class="form-group">
            <label for="txtMonthName"><?php echo $_data['text_3'];?> :</label>
            <input type="text" name="txtMonthName" value="<?php echo $month_name;?>" id="txtMonthName" class="form-control" />
          </div>
          <div class="form-group pull-right">
            <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $button_text; ?>"/>
			&nbsp;
            <input type="reset" onClick="javascript:window.location.href='<?php echo WEB_URL; ?>setting/month_setup.php';" name="btnReset" id="btnReset" value="<?php echo $_data['reset'];?>" class="btn btn-primary"/>
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
		$sqlx= "DELETE FROM `tbl_add_month_setup` WHERE m_id = ".$_GET['delid'];
		mysql_query($sqlx,$link); 
		$delinfo = 'block';
	}
if(isset($_GET['m']) && $_GET['m'] == 'add'){
	$addinfo = 'block';
	$msg = $_data['text_5'];
}
if(isset($_GET['m']) && $_GET['m'] == 'up'){
	$addinfo = 'block';
	$msg = $_data['text_6'];
}
?>      
      <!-- Main content -->
      <section class="content">
      <!-- Full Width boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
          <div class="alert alert-danger alert-dismissable" style="display:<?php echo $delinfo; ?>">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
            <h4><i class="icon fa fa-ban"></i> <?php echo $_data['delete_text'];?>!</h4>
            <?php echo $_data['text_7'];?> </div>
          <div class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
            <h4><i class="icon fa fa-check"></i> <?php echo $_data['success'];?> !</h4>
            <?php echo $msg; ?> </div>
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><?php echo $_data['text_4'];?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table sakotable table-bordered table-striped dt-responsive">
                <thead>
                  <tr>
                    <th><?php echo $_data['text_3'];?></th>
                    <th><?php echo $_data['action_text'];?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
				$result = mysql_query("SELECT * FROM tbl_add_month_setup order by m_id ASC ",$link);
				while($row = mysql_fetch_array($result)){?>
                  <tr>
					<td><?php echo $row['month_name']; ?></td>
                    <td><a class="btn btn-success" data-toggle="tooltip" href="javascript:;" onclick="$('#employee_view_<?php echo $row['m_id']; ?>').modal('show');" data-original-title="<?php echo $_data['view_text'];?>"><i class="fa fa-eye"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL;?>setting/month_setup.php?spid=<?php echo $row['m_id']; ?>" data-original-title="<?php echo $_data['edit_text'];?>"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger" data-toggle="tooltip" onclick="deleteMonth(<?php echo $row['m_id']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i class="fa fa-trash-o"></i></a>
                      <div id="employee_view_<?php echo $row['m_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header orange_header">
                              <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                              <h3 class="modal-title"><?php echo $_data['text_8'];?></h3>
                            </div>
                            <div class="modal-body model_view" align="center">&nbsp;
                              <div><!--<img class="photo_img_round" style="width:100px;height:100px;" src="<?php //echo $station_logo;  ?>" />--></div>
                              <div class="model_title"><?php //echo $row['station_name']; ?></div>
                            </div>
                            <div class="modal-body">
                              <h3 style="text-decoration:underline;"><?php echo $_data['details_information'];?></h3>
                              <div class="row">
                                <div class="col-xs-12"> <b><?php echo $_data['text_3'];?> :</b> <?php echo $row['month_name']; ?><br/>
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
  function deleteMonth(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Month ?");
	if(iAnswer){
		window.location = '<?php echo WEB_URL;?>setting/month_setup.php?delid=' + Id;
	}
  }
  </script>

<?php include('../footer.php'); ?>
