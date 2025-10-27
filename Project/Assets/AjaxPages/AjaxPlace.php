<option value="">--Select Place--</option>

<?php
include('../connection/Connection.php');
        $SelQry="select * from tbl_place where district_id = '".$_GET['disId']."'";
		$res = $con->query($SelQry);
		while($row=$res->fetch_assoc())
		{
			?>
            <option value="<?php echo $row['place_id']?>"><?php echo $row['place_name']?></option>
            <?php
		}
		
		?>