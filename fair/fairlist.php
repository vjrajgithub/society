<?php 
include('../header.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
?>
<?php
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_fare_list.php');
$delinfo = 'none';
$addinfo = 'none';
$msg = "";
if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx= "DELETE FROM `tbl_add_fair` WHERE f_id = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$delinfo = 'block';
}
if(isset($_GET['m']) && $_GET['m'] == 'add'){
	$addinfo = 'block';
	$msg = $_data['added_rent_successfully'];
}
if(isset($_GET['m']) && $_GET['m'] == 'up'){
	$addinfo = 'block';
	$msg = $_data['update_rent_successfully'] ;
}
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1><?php echo $_data['rent_list'];?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><?php echo $_data['add_new_rent_information_breadcam'];?></li>
	<li class="active"><?php echo $_data['rent_list'];?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Full Width boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div id="me" class="alert alert-danger alert-dismissable" style="display:<?php echo $delinfo; ?>">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
      <h4><i class="icon fa fa-ban"></i><?php echo $_data['delete_text'];?> !</h4>
      <?php echo $_data['delete_rent_information'];?> </div>
    <div id="you" class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
      <h4><i class="icon fa fa-check"></i><?php echo $_data['success'];?> !</h4>
      <?php echo $msg; ?> </div>
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL; ?>fair/addfair.php" data-original-title="<?php echo $_data['add_new_rent_breadcam'];?>"><i class="fa fa-plus"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL; ?>dashboard.php" data-original-title="<?php echo $_data['home_breadcam'];?>"><i class="fa fa-dashboard"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['rent_list'];?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table sakotable table-bordered table-striped dt-responsive">
          <thead>
            <tr>
              <th><?php echo $_data['image'];?></th>
              <th><?php echo $_data['add_new_form_field_text_6'];?></th>
              <th><?php echo $_data['add_new_form_field_text_16'];?></th>
              <th><?php echo $_data['add_new_form_field_text_1'];?></th>
              <th><?php echo $_data['add_new_form_field_text_3'];?></th>
              <th><?php echo $_data['add_new_form_field_text_17'];?></th>
              <th><?php echo $_data['add_new_form_field_text_18'];?></th>
              <th><?php echo $_data['add_new_form_field_text_7'];?></th>
              <th><?php echo $_data['add_new_form_field_text_14'];?></th>
              <th><?php echo $_data['action_text'];?></th>
            </tr>
          </thead>
          <tbody>
        <?php
		$result = mysql_query("Select *,ar.image as r_image,ar.r_name,fl.floor_no as fl_floor,u.unit_no as u_unit,m.month_name from tbl_add_fair f inner join tbl_add_floor fl on fl.fid = f.floor_no inner join tbl_add_unit u on u.uid = f.unit_no inner join tbl_add_month_setup m on m.m_id = f.month_id inner join tbl_add_rent ar on ar.rid = f.rid where f.type = 'Rented' and f.branch_id = " . (int)$_SESSION['objLogin']['branch_id'] . " order by f.f_id desc",$link);
				while($row = mysql_fetch_array($result)){
					$r_image = WEB_URL . 'img/no_image.jpg';	
					if(file_exists(ROOT_PATH . '/img/upload/' . $row['r_image']) && $row['r_image'] != ''){
						$r_image = WEB_URL . 'img/upload/' . $row['r_image'];
					}
				?>
            <tr>
            <td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php echo $r_image;  ?>" /></td>
            <td><?php echo $row['r_name']; ?></td>
            <td><?php echo $row['type']; ?></td>
            <td><?php echo $row['fl_floor']; ?></td>
            <td><?php echo $row['u_unit']; ?></td>
            <td><?php echo $row['month_name']; ?></td>
            <td><?php echo $row['xyear']; ?></td>
            <?php if($currency_position == 'left') { ?>
          	<td><?php echo $global_currency.$row['rent']; ?></td>
          	<?php } else { ?>
          	<td><?php echo $row['rent'].$global_currency; ?></h3>
          	<?php } ?>
            <?php if($currency_position == 'left') { ?>
          	<td><?php echo $global_currency.$row['total_rent']; ?></td>
          	<?php } else { ?>
          	<td><?php echo $row['total_rent'].$global_currency; ?></h3>
          	<?php } ?>
            <td>
            <a class="btn btn-success" data-toggle="tooltip" href="javascript:;" onClick="$('#nurse_view_<?php echo $row['f_id']; ?>').modal('show');" data-original-title="<?php echo $_data['view_text'];?>"><i class="fa fa-eye"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL;?>fair/addfair.php?id=<?php echo $row['f_id']; ?>" data-original-title="<?php echo $_data['edit_text'];?>"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger" data-toggle="tooltip" onClick="deleteFair(<?php echo $row['f_id']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i class="fa fa-trash-o"></i></a>
            <div id="nurse_view_<?php echo $row['f_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header orange_header">
                    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h3 class="modal-title"><?php echo $_data['fare_details'];?></h3>
                  </div>
                  <div class="modal-body model_view" align="center">&nbsp;
                    <div><img class="photo_img_round" style="width:100px;height:100px;" src="<?php echo $r_image;  ?>" /></div>
                    <div class="model_title"><?php echo $row['r_name']; ?></div>
                  </div>
				  <div class="modal-body">
                    <h3 style="text-decoration:underline;text-align:left"><?php echo $_data['details_information'];?></h3><br/>
                    <div class="row">
                      <div class="col-xs-6"> 
					    <b><?php echo $_data['add_new_form_field_text_6'];?> :</b> <?php echo $row['r_name']; ?><br/>
                        <b><?php echo $_data['add_new_form_field_text_1'];?> :</b> <?php echo $row['fl_floor']; ?><br/>
                        <b><?php echo $_data['add_new_form_field_text_3'];?> :</b> <?php echo $row['u_unit']; ?><br/>
                        <b><?php echo $_data['add_new_form_field_text_17'];?> :</b> <?php echo $row['month_name'];?><br/>
                        <b><?php echo $_data['add_new_form_field_text_7'];?> :</b> <?php if($currency_position == 'left') {echo $global_currency.$row['rent'];}else { echo $row['rent'].$global_currency;}?><br/>
                        <b><?php echo $_data['add_new_form_field_text_8'];?> :</b> <?php if($currency_position == 'left') {echo $global_currency.$row['water_bill'];}else { echo $row['water_bill'].$global_currency;}?><br/>
                        <b><?php echo $_data['add_new_form_field_text_9'];?> :</b> <?php if($currency_position == 'left') {echo $global_currency.$row['electric_bill'];}else { echo $row['electric_bill'].$global_currency;}?>
                      </div>
                      
                      <div class="col-xs-6"> 
                        <b><?php echo $_data['add_new_form_field_text_10'];?> :</b> <?php if($currency_position == 'left') {echo $global_currency.$row['gas_bill'];}else { echo $row['gas_bill'].$global_currency;}?><br/>
                        <b><?php echo $_data['add_new_form_field_text_11'];?> :</b> <?php if($currency_position == 'left') {echo $global_currency.$row['security_bill'];}else { echo $row['security_bill'].$global_currency;}?><br/>
                        <b><?php echo $_data['add_new_form_field_text_12'];?> :</b> <?php if($currency_position == 'left') {echo $global_currency.$row['utility_bill'];}else { echo $row['utility_bill'].$global_currency;}?><br/>
                        <b><?php echo $_data['add_new_form_field_text_13'];?> :</b> <?php if($currency_position == 'left') {echo $global_currency.$row['other_bill'];}else { echo $row['other_bill'].$global_currency;}?><br/>
                        <b><?php echo $_data['add_new_form_field_text_14'];?> :</b> <?php if($currency_position == 'left') {echo $global_currency.$row['total_rent'];}else { echo $row['total_rent'].$global_currency;}?><br/>
                        <b><?php echo $_data['add_new_form_field_text_15'];?> :</b> <?php echo $row['issue_date']; ?>
                      </div>
                      
                    </div>
                  </div>
				  
                </div>
                <!-- /.modal-content -->
              </div>
            </div>
            </td>
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
function deleteFair(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Fair ?");
	if(iAnswer){
		window.location = '<?php echo WEB_URL; ?>fair/fairlist.php?id=' + Id;
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
