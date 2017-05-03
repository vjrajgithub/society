<?php include('../header_ten.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_rented_tenant_details.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_common.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $_data['text_1'];?> </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>t_dashboard.php"><i class="fa fa-dashboard"></i> <?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><?php echo $_data['text_1'];?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Full Width boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL; ?>t_dashboard.php" data-original-title="<?php echo $_data['text_19'];?>"><i class="fa fa-dashboard"></i></a> </div>
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['text_1'];?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table sakotable table-bordered table-striped dt-responsive">
          <thead>
            <tr>
              <th><?php echo $_data['text_2'];?></th>
              <th><?php echo $_data['text_11'];?></th>
              <th><?php echo $_data['text_3'];?></th>
              <th><?php echo $_data['text_4'];?></th>
              <th><?php echo $_data['action_text'];?></th>
            </tr>
          </thead>
          <tbody>
        	<?php
				$result = mysql_query("Select *,fl.floor_no as fl_floor,u.unit_no as u_unit,r.r_name,m.month_name from tbl_add_fair f inner join tbl_add_floor fl on fl.fid = f.floor_no inner join tbl_add_unit u on u.uid = f.unit_no inner join tbl_add_rent r on r.r_unit_no = f.unit_no inner join tbl_add_month_setup m on m.m_id = f.month_id where f.unit_no = '". (int)$_SESSION['objLogin']['r_unit_no'] . "' order by f.f_id desc",$link);
				while($row = mysql_fetch_array($result)){
					$image = WEB_URL . 'img/no_image.jpg';	
			if(file_exists(ROOT_PATH . '/img/upload/' . $_SESSION['objLogin']['image']) && $_SESSION['objLogin']['image'] != ''){
				$image = WEB_URL . 'img/upload/' . $_SESSION['objLogin']['image'];
			}
			?>
            <tr>
            <td><?php echo $row['month_name']; ?></td>
            <td><?php echo $_SESSION['objLogin']['r_rent_pm'].' '.CURRENCY; ?></td>
            <td><?php echo $row['total_rent'].' '.CURRENCY; ?></td>
            <td><?php echo $row['issue_date']; ?></td>
            <td>
            <a class="btn btn-success" data-toggle="tooltip" href="javascript:;" onclick="$('#nurse_view_<?php echo $row['f_id']; ?>').modal('show');" data-original-title="Details <?php echo $_data['view_text'];?>"><i class="fa fa-eye"></i></a>
            <div id="nurse_view_<?php echo $row['f_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header orange_header">
                    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h3 class="modal-title"><?php echo $_data['text_1'];?></h3>
                  </div>
                  <div class="modal-body model_view" align="center">&nbsp;
                    <div><img class="photo_img_round" style="width:100px;height:100px;" src="<?php echo $image;  ?>" /></div>
                    <div class="model_title"><?php echo $_SESSION['objLogin']['r_name']; ?></div>
                  </div>
				  <div class="modal-body">
                    <h3 style="text-decoration:underline;"><?php echo $_data['details_information'];?></h3>
                    <div class="row">
                      <div class="col-xs-6"> 
					    <b><?php echo $_data['text_5'];?> :</b> <?php echo $_SESSION['objLogin']['r_name']; ?><br/>
                        <b><?php echo $_data['text_6'];?> :</b> <?php echo $_SESSION['objLogin']['r_email']; ?><br/>
                        <b><?php echo $_data['text_7'];?> :</b> <?php echo $_SESSION['objLogin']['r_contact']; ?><br/>
                        <b><?php echo $_data['text_8'];?> :</b> <?php echo $_SESSION['objLogin']['r_address']; ?><br/>
                        <b><?php echo $_data['text_9'];?> :</b> <?php echo $row['fl_floor']; ?><br/>
                        <b><?php echo $_data['text_10'];?> :</b> <?php echo $row['u_unit']; ?><br/>
                        <b><?php echo $_data['text_2'];?> :</b> <?php echo $row['month_name']; ?><br/>
                        <b><?php echo $_data['text_11'];?> :</b> <?php echo $row['rent'].' '.CURRENCY; ?><br/>
                        </div>
                        <div class="col-xs-6"> 
                        <b><?php echo $_data['text_12'];?> :</b> <?php echo $row['water_bill'].' '.CURRENCY; ?><br/>
                        <b><?php echo $_data['text_13'];?> :</b> <?php echo $row['electric_bill'].' '.CURRENCY; ?><br/>
                        <b><?php echo $_data['text_14'];?> :</b> <?php echo $row['gas_bill'].' '.CURRENCY; ?><br/>
                        <b><?php echo $_data['text_15'];?> :</b> <?php echo $row['security_bill'].' '.CURRENCY; ?><br/>
                        <b><?php echo $_data['text_16'];?> :</b> <?php echo $row['utility_bill'].' '.CURRENCY; ?><br/>
                        <b><?php echo $_data['text_17'];?> :</b> <?php echo $row['other_bill'].' '.CURRENCY; ?><br/>
                        <b><?php echo $_data['text_18'];?> :</b> <?php echo $row['total_rent'].' '.CURRENCY; ?><br/>
                        <b><?php echo $_data['text_4'];?> :</b> <?php echo $row['issue_date']; ?><br/>
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
<?php include('../footer.php'); ?>
