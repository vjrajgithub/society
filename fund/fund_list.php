<?php 
include('../header.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
?>
<?php
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_fund_list.php');
$delinfo = 'none';
$addinfo = 'none';
$msg = "";
if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx= "DELETE FROM `tbl_add_fund` WHERE fund_id = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$delinfo = 'block';
}
if(isset($_GET['m']) && $_GET['m'] == 'add'){
	$addinfo = 'block';
	$msg = $_data['added_fund_successfully'];
}
if(isset($_GET['m']) && $_GET['m'] == 'up'){
	$addinfo = 'block';
	$msg = $_data['update_fund_successfully'];
}
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1><?php echo $_data['add_new_fund'];?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><?php echo $_data['fund'];?></li>
	<li class="active"><?php echo $_data['add_new_fund'];?></li>
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
      <?php echo $_data['delete_fund_information'];?> </div>
    <div id="you" class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
      <h4><i class="icon fa fa-check"></i> <?php echo $_data['success'];?> !</h4>
      <?php echo $msg; ?> </div>
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL; ?>fund/add_fund.php" data-original-title="<?php echo $_data['add_new_fund_breadcam'];?>"><i class="fa fa-plus"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL; ?>dashboard.php" data-original-title="<?php echo $_data['home_breadcam'];?>"><i class="fa fa-dashboard"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['add_new_fund'];?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table sakotable table-bordered table-striped dt-responsive">
          <thead>
            <tr>
              <th><?php echo $_data['image'];?></th>
              <th><?php echo $_data['add_new_form_field_text_1'];?></th>
              <th><?php echo $_data['add_new_form_field_text_3'];?></th>
              <th><?php echo $_data['add_new_form_field_text_5'];?></th>
              <th><?php echo $_data['add_new_form_field_text_6'];?></th>
              <th><?php echo $_data['add_new_form_field_text_7'];?></th>
              <th><?php echo $_data['add_new_form_field_text_8'];?></th>
              <th><?php echo $_data['action_text'];?></th>
            </tr>
          </thead>
          <tbody>
        <?php
		$result = mysql_query("Select *,ow.o_name,ow.image,m.month_name,y.xyear as y_xyear from tbl_add_fund fu inner join tbl_add_owner ow on ow.ownid = fu.owner_id inner join tbl_add_month_setup m on m.m_id = fu.month_id inner join tbl_add_year_setup y on y.y_id = fu.xyear where fu.branch_id = " . (int)$_SESSION['objLogin']['branch_id'] . " order by fu.fund_id desc",$link);
				while($row = mysql_fetch_array($result)){
					$image = WEB_URL . 'img/no_image.jpg';	
					if(file_exists(ROOT_PATH . '/img/upload/' . $row['image']) && $row['image'] != ''){
						$image = WEB_URL . 'img/upload/' . $row['image'];
					}
				?>
            <tr>
            <td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php echo $image;  ?>" /></td>
            <td><?php echo $row['o_name']; ?></td>
            <td><?php echo $row['month_name']; ?></td>
            <td><?php echo $row['y_xyear']; ?></td>
            <td><?php echo $row['f_date']; ?></td>
            <?php if($currency_position == 'left') { ?>
          	<td><?php echo $global_currency.$row['total_amount']; ?></td>
          	<?php } else { ?>
          	<td><?php echo $row['total_amount'].$global_currency; ?></h3>
          	<?php } ?>
            <td><?php echo $row['purpose']; ?></td>
            <td>
            <a class="btn btn-success" data-toggle="tooltip" href="javascript:;" onclick="$('#nurse_view_<?php echo $row['fund_id']; ?>').modal('show');" data-original-title="<?php echo $_data['view_text'];?>"><i class="fa fa-eye"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL;?>fund/add_fund.php?id=<?php echo $row['fund_id']; ?>" data-original-title="<?php echo $_data['edit_text'];?>"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger" data-toggle="tooltip" onclick="deleteFund(<?php echo $row['fund_id']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i class="fa fa-trash-o"></i></a>
            <div id="nurse_view_<?php echo $row['fund_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header orange_header">
                    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h3 class="modal-title"><?php echo $_data['fund_details'];?></h3>
                  </div>
                  <div class="modal-body model_view" align="center">&nbsp;
                    <div><img class="photo_img_round" style="width:100px;height:100px;" src="<?php echo $image;  ?>" /></div>
                    <div class="model_title"><?php echo $row['o_name']; ?></div>
                  </div>
				  <div class="modal-body">
                    <h3 style="text-decoration:underline;"><?php echo $_data['details_information'];?></h3>
                    <div class="row">
                      <div class="col-xs-6"> 
					    <b><?php echo $_data['add_new_form_field_text_1'];?> :</b> <?php echo $row['o_name']; ?><br/>
                        <b><?php echo $_data['add_new_form_field_text_3'];?> :</b> <?php echo $row['month_name'];?><br/>
                      </div>
                      
                      <div class="col-xs-6"> 
                        <b><?php echo $_data['add_new_form_field_text_7'];?> :</b> <?php if($currency_position == 'left') {echo $global_currency.$row['total_amount'];}else { echo $row['total_amount'].$global_currency;}?><br/>
                        <b><?php echo $_data['add_new_form_field_text_6'];?> :</b> <?php echo $row['f_date']; ?><br/>
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
function deleteFund(Id){
  	var iAnswer = confirm("Are you sure you want to delete this delete fund ?");
	if(iAnswer){
		window.location = '<?php echo WEB_URL; ?>fund/fund_list.php?id=' + Id;
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
