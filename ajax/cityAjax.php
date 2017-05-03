<?php 
include('../config.php');
?>




<select class="form-control" name="cityId" id="cityId">
                     <option value="" >Select City Name</option>
                     <?php 
					  $state=mysql_query("select * from master_city where stateId='".$_REQUEST['q']."'  order by cityId asc");
 		
			while($row=mysql_fetch_assoc($state)){ ?>
            <option value="<?php echo $row['cityId'];  ?>"><?php echo $row['cityName'];?></option>
            
            <?php	}		 
					 ?>
                     
                     
                     </select>