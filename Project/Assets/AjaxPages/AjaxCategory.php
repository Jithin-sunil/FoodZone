<option value="">--Select Category--</option>

<?php
include('../connection/Connection.php');
        $SelQry="select * from tbl_foodcategory where foodtype_id = '".$_GET['typeId']."'";
		$res = $con->query($SelQry);
		while($row=$res->fetch_assoc())
		{
			?>
            <option value="<?php echo $row['foodcategory_id']?>"><?php echo $row['foodcategory_name']?></option>
            <?php
		}
		
		?>