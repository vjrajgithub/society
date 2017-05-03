<?php 
include('../header.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
?>
<?php
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_serviceprovider_list.php');
$delinfo = 'none';
$addinfo = 'none';
$msg = "";
if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx= "DELETE FROM `tbl_serviceform` WHERE serviceId = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$delinfo = 'block';
}
if(isset($_GET['m']) && $_GET['m'] == 'add'){
	$addinfo = 'block';
	$msg = $_data['added_employee_successfully'];
}
if(isset($_GET['m']) && $_GET['m'] == 'up'){
	$addinfo = 'block';
	$msg = $_data['update_employee_successfully'];
}
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1><?php echo $_data['employee_list'];?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><?php echo $_data['add_new_employee_information_breadcam'];?></li>
    <li class="active"><?php echo $_data['employee_list'];?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Full Width boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div id="me" class="alert alert-danger alert-dismissable" style="display:<?php echo $delinfo; ?>">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
      <h4><i class="icon fa fa-ban"></i> <?php echo $_data['delete_text'];?> !</h4>
      <?php echo $_data['delete_employee_information'];?> </div>
    <div id="you" class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
      <h4><i class="icon fa fa-check"></i><?php echo $_data['success'];?> !</h4>
      <?php echo $msg; ?> </div>
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL; ?>service/addserviceprovider.php" data-original-title="<?php echo $_data['add_new_employee_breadcam'];?>"><i class="fa fa-plus"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL; ?>dashboard.php" data-original-title="<?php echo $_data['home_breadcam'];?>"><i class="fa fa-dashboard"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['employee_list'];?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table sakotable table-bordered table-striped dt-responsive">
          <thead>
            <tr>
<!--              <th><?php echo $_data['imgage'];?></th>-->
              <th><?php echo $_data['add_new_form_field_text_1'];?></th>
              <th><?php echo $_data['add_new_form_field_text_2'];?></th>
              <th><?php echo $_data['add_new_form_field_text_4'];?></th>
              <th><?php echo $_data['add_new_form_field_text_8'];?></th>
              <th><?php echo $_data['add_new_form_field_text_9'];?></th>
              <th><?php echo $_data['action_text'];?></th>
            </tr>
          </thead>
          <tbody>
            <?php
                                 $queryAllEmployee = "SELECT sf.*,ms.serviceName as s_name FROM tbl_serviceform sf left join master_servicelist ms on sf.serviceName = ms.serviceId where sf.c_userid = " . (int)$_SESSION['objLogin']['user_id'] . " and sf.branch_id = " . (int)$_SESSION['objLogin']['branch_id'] . "";
				//die;
                                $result = mysql_query($queryAllEmployee,$link);
				while($row = mysql_fetch_assoc($result)){
//					$image = WEB_URL . 'img/no_image.jpg';	
//					if(file_exists(ROOT_PATH . '/img/upload/' . $row['image']) && $row['image'] != ''){
//						$image = WEB_URL . 'img/upload/' . $row['image'];
//					}
//    echo '<pre>';
//    print_r($row);
//    echo '<pre>';
//    die;
				?>
            <tr>
<!--              <td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php echo $image;  ?>" /></td>-->
              <td><?php echo $row['s_name']; ?></td>
              <td><?php echo $row['serviceProvider']; ?></td>
              <td><?php echo $row['mobileNumber']; ?></td>
              <td><?php echo $row['amc_Amount']; ?></td>
              <td><?php echo $row['cDate']; ?></td>
              <td><a class="btn btn-success" data-toggle="tooltip" href="javascript:;" onClick="$('#nurse_view_<?php echo $row['serviceId']; ?>').modal('show');" data-original-title="<?php echo $_data['view_text'];?>"><i class="fa fa-eye"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL;?>service/addserviceprovider.php?id=<?php echo $row['serviceId']; ?>" data-original-title="<?php echo $_data['edit_text'];?>"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger" data-toggle="tooltip" onClick="deleteEmployee(<?php echo $row['serviceId']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i class="fa fa-trash-o"></i></a>
                <div id="nurse_view_<?php echo $row['serviceId']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header orange_header">
                        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                        <h3 class="modal-title"><?php echo $_data['employee_details'];?></h3>
                      </div>
                      <div class="modal-body model_view" align="center">&nbsp;
<!--                        <div><img class="photo_img_round" style="width:100px;height:100px;" src="<?php echo $image;  ?>" /></div>-->
<!--                        <div class="model_title"><?php echo $row['e_name']; ?></div>-->
                      </div>
                      <div class="modal-body">
                        <h3 style="text-decoration:underline;"><?php echo $_data['details_information'];?></h3>
                        <div class="row">
                          <div class="col-xs-12"> 
                            <b><?php echo $_data['add_new_form_field_text_1'];?> :</b> <?php echo $row['s_name']; ?><br/>
                            <b><?php echo $_data['add_new_form_field_text_2'];?> :</b> <?php echo $row['serviceProvider']; ?><br/>
                            <b><?php echo $_data['add_new_form_field_text_3'];?> :</b> <?php echo $row['mobileNumber']; ?><br/>
                            <b><?php echo $_data['add_new_form_field_text_4'];?> :</b> <?php echo $row['amc_Amount']; ?><br/>
                            <b><?php echo $_data['add_new_form_field_text_5'];?> :</b> <?php echo $row['cDate']; ?><br/>
<!--                            <b><?php echo $_data['add_new_form_field_text_6'];?> :</b> <?php echo $row['e_per_address']; ?><br/>
                            <b><?php echo $_data['add_new_form_field_text_7'];?> :</b> <?php echo $row['e_nid']; ?><br/>
                            <b><?php echo $_data['add_new_form_field_text_8'];?> :</b> <?php echo $row['member_type']; ?><br/>
                            <b><?php echo $_data['add_new_form_field_text_9'];?> :</b> <?php echo $row['e_date']; ?><br/>-->
                          </div>
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
<script type="text/javascript">
function deleteEmployee(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Employee ?");
	if(iAnswer){
		window.location = '<?php echo WEB_URL; ?>service/addserviceproviderlist.php?id=' + Id;
	}
  }
  
  $( document ).ready(function() {
	setTimeout(function() {
		  $("#me").hide(300);
		  $("#you").hide(300);
	}, 3000);
});
</script>
<?php include('../footer.php'); ?>
