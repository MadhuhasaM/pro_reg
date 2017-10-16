<html>
<body>
City:
   <select type='text' name='city' id="city">
   <option>--Select City--</option>
<?php foreach($query as $cityrow) {  ?>                  
	<option value="<?php echo $cityrow['id']; ?>" >
	<?php echo $cityrow['city'] ;?>  
	</option>          	
<?php }  ?>
  </select>

</body>
</html>
