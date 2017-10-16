<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>	
<script>
$(document).ready(function() {
	$("input").focus(function(){
    	$(this).css("background-color", "lightgreen");
    });
    $("input").blur(function(){
    $(this).css("background-color", "grey");
    });
});
</script>	

<script>
 function showUser()
 {
	var country = $("#country").val();
     //alert(country); exit;
       $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>index.php/formc/ajax", 
        data: {id:country},
        cache: false,
        success: function(res)
            {
                 //alert(res);return false;
                 console.log(res); 
                $("#city").html(res);
            }
            });
}
</script>
</head>
   <body>
        
         <?php echo form_open_multipart('formc/update/'.$result->id); ?>  
         
         <h5>Username:</h5>                          
         <input type = "text" name = "name" size = "20" value="<?php echo $result->name; ?>" > 
         <h5>Email-id:</h5>  
         <input type = "text" name = "email" size = "30" value="<?php echo $result->email; ?>"> 
         <h5>Mobile-no:</h5> 
         <input type = "number" name = "number" size = "20" value="<?php echo $result->number; ?>">  
            
         <h5>Country:</h5>        
   		<select type="text" name="country" id="country" onchange="showUser();" >
		 <?php foreach($query as $countryrow){ ?>
		 <option value="<?php echo $countryrow['id']; ?>" <?php if($result->country == $countryrow['id']) echo "selected"; ?>>
		 <?php echo $countryrow['name'] ;?>
		 </option>          	
         <?php } ?>
    	</select>
    	
		 <h5>City:</h5>
		<select type="text" name="city" id="city" >
		 <?php foreach($query1 as $cityrow){ ?>
		 <option value="<?php echo $cityrow['id']; ?>" <?php if($result->country == $cityrow['city']) echo "selected"; ?>">
 			<?php echo $cityrow['city']; ?>
		 </option>
		 <?php } ?>
		</select>
		
		<h5>Upload:</h5><span>Last_Uploaded=> <?php echo $result->upload ;?></span><br>
		<input type="file" name="upload1" size="10" >
         <h5></h5> 
         <input type = "submit" value = "submit" >        
       
   </body>
	
</html>