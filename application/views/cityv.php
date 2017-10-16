<html>
<body>
	
<?php echo form_open('formc/cityinsert'); ?>

<h5>Country:</h5>
<select type='text' name='country' id="country" >
<option value="">-select country-</option>
<?php	
foreach($query as $row){ ?>
<option value="<?php echo $row['id']; ?>">
<?php echo $row['name'] ; ?> 			
</option> <?php } ?>
</select>
  
 <h5>City Name:</h5>
 <input type="text" name="cityname" size="20"> <div style="color:red;" ><?php echo form_error('cityname'); ?></div>
 <h5></h5>
 <input type="submit" value="submit" >

</body>
</html>