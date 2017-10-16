<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
<script>
$(document).ready(function() {
	$("input").focus(function(){
    	$(this).css("background-color", "lightyellow");
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
        
         <?php echo form_open_multipart('formc/addform');?>  
         
         <h5>Username:</h5>                          
         <input type = "text" name = "name" size = "20" > <div style="color:red;" ><?php echo form_error('name'); ?></div> 
         <h5>Email-id:</h5>  
         <input type = "text" name = "email" size = "30" > <div style="color:red;" ><?php echo form_error('email'); ?></div>
         <h5>Mobile-no:</h5> 
         <input type = "number" name = "number" size = "20" > <div style="color:red;" ><?php echo form_error('number'); ?></div>     
         <h5>Country:</h5>
         <a style='text-decoration:none' href='<?php echo base_url();?>index.php/formc/country'>+country</a>
         
   		<select type="text" name="country" id="country" onchange="showUser();">
   	  	 <option>--Select Country--</option>
		 <?php foreach($query as $countryrow){ ?>
		 <option value="<?php echo $countryrow['id']; ?>" >
		 <?php echo $countryrow['name'] ;?>
		 </option>          	
         <?php } ?>
    	</select>
    	
		 <h5>City:</h5>
		 <a style='text-decoration:none' href='<?php echo base_url();?>index.php/formc/city'>+city</a>
		 
		<select type="text" name="city" id="city" >
		 <option >--Select City--</option>
		</select>
		
		<h5>Upload:</h5>
		<input type="file" name="upload" size="20" >
         <h5></h5>
         <input type = "submit" value = "submit" >        
       
   </body>
	
</html>