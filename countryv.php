<html>
<body>
	
<?php echo form_open('formc/countryinsert'); ?>

 <h5>Country Name:</h5>
 <input type="text" name="countryname" size="20"> <div style="color:red;" ><?php echo form_error('countryname'); ?></div>
 <h5></h5>
 <input type="submit" value="submit" >

</body>
</html>