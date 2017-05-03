<?php 
include('../header.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
?>
<?php
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_m_committee_list.php');
$delinfo = 'none';
$addinfo = 'none';
$msg = "";
if(isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0){
	$sqlx= "DELETE FROM `tbl_add_management_committee` WHERE mc_id = ".$_GET['id'];
	mysql_query($sqlx,$link); 
	$delinfo = 'block';
}
if(isset($_GET['m']) && $_GET['m'] == 'add'){
	$addinfo = 'block';
	$msg = $_data['added_m_committee_successfully'] ;
}
if(isset($_GET['m']) && $_GET['m'] == 'up'){
	$addinfo = 'block';
	$msg = $_data['update_m_committee_successfully'];
}
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $_data['add_new_m_committee'];?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li>
		<li class="active"><?php echo $_data['m_committee'];?></li>
        <li class="active"><?php echo $_data['add_new_m_committee'];?></li>
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
          <?php echo $_data['delete_m_committee_information'];?> </div>
        <div id="you" class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
          <h4><i class="icon fa fa-check"></i> <?php echo $_data['success'];?> !</h4>
          <?php echo $msg; ?> </div>
        <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL; ?>management/add_m_committee.php" data-original-title="<?php echo $_data['add_new_m_committee_breadcam'];?>"><i class="fa fa-plus"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL; ?>dashboard.php" data-original-title="<?php echo $_data['home_breadcam'];?>"><i class="fa fa-dashboard"></i></a> </div>
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title"><?php echo $_data['add_new_m_committee'];?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table sakotable table-bordered table-striped dt-responsive">
              <thead>
                <tr>
                  <th><?php echo $_data['image'];?></th>
                  <th><?php echo $_data['add_new_form_field_text_1'];?></th>
                  <th><?php echo $_data['add_new_form_field_text_2'];?></th>
                  <th><?php echo $_data['add_new_form_field_text_4'];?></th>
                  <th><?php echo $_data['add_new_form_field_text_5'];?></th>
                  <th><?php echo $_data['add_new_form_field_text_8'];?></th>
                  <th><?php echo $_data['add_new_form_field_text_11'];?></th>
                  <th><?php echo $_data['action_text'];?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                                $queryAllCommitteeMem = "Select mc.*,mtt.member_type as mt_member_type,concat(mt.firstName,' ',mt.middleName,' ',mt.lastName) as mc_name,mt.username,mt.correspondenceAddress,mt.imageUrl,mt.mobileNumber from tbl_add_management_committee mc left join tbl_add_owner mt on mc.mc_name = mt.memberId left join tbl_add_member_type mtt on mc.member_type = mtt.member_id where mc.branch_id = " . (int)$_SESSION['objLogin']['branch_id'] . " order by mc.mc_id desc";
				//die;
                                $result = mysql_query($queryAllCommitteeMem,$link);
				while($row = mysql_fetch_assoc($result)){
//                                    echo '<pre>';
//                                        print_r($row); 
//                                    
//                                    echo '<pre>';
                                    
                                    
					$image = WEB_URL . 'img/nmc_image.jpg';	
					if(file_exists(ROOT_PATH . '/upload/' . $row['imageUrl']) && $row['imageUrl'] != ''){
						$image = WEB_URL . '/upload/' . $row['imageUrl'];
					}
				
				?>
                <tr>
                  <td><img class="photmc_img_round" style="width:50px;height:50px;" src="<?php echo $image;  ?>" /></td>
                  <td><?php echo $row['mc_name']; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['mobileNumber']; ?></td>
                  <td><?php echo $row['correspondenceAddress']; ?></td>
                  <td><?php echo $row['mt_member_type']; ?>
                  <td><?php if($row['mc_status'] == '1'){echo $_data['add_new_form_field_text_12'];} else{echo $_data['add_new_form_field_text_13'];}?>
                  </td>
                  <td><a class="btn btn-success" data-toggle="tooltip" href="javascript:;" onClick="$('#nurse_view_<?php echo $row['mc_id']; ?>').modal('show');" data-original-title="<?php echo $_data['view_text'];?>"><i class="fa fa-eye"></i></a> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL;?>management/add_m_committee.php?id=<?php echo $row['mc_id']; ?>" data-original-title="<?php echo $_data['edit_text'];?>"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger" data-toggle="tooltip" onClick="deleteManagementMember(<?php echo $row['mc_id']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text'];?>"><i class="fa fa-trash-o"></i></a>
                    <div id="nurse_view_<?php echo $row['mc_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header orange_header">
                            <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                            <h3 class="modal-title"><?php echo $_data['m_committee_details'];?></h3>
                          </div>
                          <div class="modal-body model_view" align="center">&nbsp;
                            <div>
                              <img class="photmc_img_round" style="width:100px;height:100px;" src="<?php echo $image;;  ?>" />
                            </div>
                            <div class="model_title"><?php echo $row['mc_name']; ?></div>
                          </div>
                          <div class="modal-body">
                            <h3 style="text-decoration:underline;"><?php echo $_data['details_information'];?></h3>
                            <div class="row">
                              <div class="col-xs-12"> <b><?php echo $_data['add_new_form_field_text_1'];?> :</b> <?php echo $row['mc_name']; ?><br/>
                                <b><?php echo $_data['add_new_form_field_text_2'];?> :</b> <?php echo $row['mc_email']; ?><br/>
                                <b><?php echo $_data['add_new_form_field_text_4'];?> :</b> <?php echo $row['mc_contact']; ?><br/>
                                <b><?php echo $_data['add_new_form_field_text_5'];?> :</b> <?php echo $row['mc_pre_address']; ?><br/>
                                <b><?php echo $_data['add_new_form_field_text_6'];?> :</b> <?php echo $row['mc_per_address']; ?><br/>
                                <b><?php echo $_data['add_new_form_field_text_7'];?> :</b> <?php echo $row['mc_nid']; ?><br/>
                                <b><?php echo $_data['add_new_form_field_text_8'];?> :</b> <?php echo $row['mt_member_type']; ?><br/>
                                <b><?php echo $_data['add_new_form_field_text_9'];?> :</b> <?php echo $row['mc_joining_date']; ?><br/>
                                <b><?php echo $_data['add_new_form_field_text_10'];?> :</b> <?php echo $row['mc_ending_date']; ?><br/>
                                <b><?php echo $_data['add_new_form_field_text_11'];?> :</b> <?php if($row['mc_status'] == '1'){echo $_data['add_new_form_field_text_12'];} else{echo $_data['add_new_form_field_text_13'];}?><br/>
                                <br/>
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
function deleteManagementMember(Id){
  	var iAnswer = confirm("Are you sure you want to delete this Management Member ?");
	if(iAnswer){
		window.location = '<?php echo WEB_URL; ?>management/m_committee_list.php?id=' + Id;
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
