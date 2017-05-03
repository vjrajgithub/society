<?php 
include('../config.php');
?>
<select name="" class="form-control">
	<option value="">Select Member Name</option>
	<?php 
	$q=mysql_query("select * from tbl_add_owner where unit_no='".$_REQUEST['q']."' order by memberId asc");
		while($rec=mysql_fetch_assoc($q)) {
	?>
	<option value="<?php echo $rec['memberId'];?>"><?php echo $rec['firstName'].$rec['middleName'].$rec['lastName'];?></option>
	<?php } ?>
</select>