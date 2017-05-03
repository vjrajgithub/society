<?php 
//mysql_connect("localhost","root","");
//mysql_select_db("ams_final");
include('../config.php');
?>

 <select class="form-control" name="stateId" id="stateId" onchange="cityAjax(this.value)">
                     <option value="" >Select State Name</option>
                     <?php 
					  $state=mysql_query("select * from master_state where countryId='".$_REQUEST['q']."'  order by stateId asc");
 		
			while($row=mysql_fetch_assoc($state)){ ?>
            <option value="<?php echo $row['stateId'];  ?>"><?php echo $row['stateName'];?></option>
            
            <?php	}		 
					 ?>
                     
                     
                     </select>