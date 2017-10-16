<html>    
<head>
	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function()
	{
		$(".editbox").hide();
		$(".send").hide();
		
		$(".tr").click(function()
		{
			var ID=$(this).attr('id');
			
			$("#span_"+ID).hide();
			$("#input_"+ID).show();
			$("#but_"+ID).show();

		}).change(function()   // on changing text in the field and clicking "send" then function exists  
			{
				var ID=$(this).attr('id');
				var email=$("#input_"+ID).val();
				//var dataString = ID+email;
			    //alert(email); exit;
				if(email.length>0)
				{				
					$.ajax({
						type: "POST",
						url: "http://localhost/ci4/index.php/formc/get_email_id",
						data: {ID:ID,email:email},
						cache: false,
						success: function(html)
						{
							//alert(); exit;
							$("#span_"+ID).html(email);
						}
					});
				}
				else
				{
					alert('Enter something.');
				}
			
			});

		
		$(document).mouseup(function()    // Outside click action
		{
			$(".editbox").hide();
			$(".text").show();
			$(".send").hide();
		});
		
		$(".send").mouseup(function()    // Edit input box click action
		{
			alert("not updated");
			return false;
		});
		
	});
</script>

</head>
 <body>
    <h4 style='color:lightgrey;'>Display Records From Database Using Codeigniter</h4>
    <a href='formc/adduser'><button style="background-color:lightyellow;" >ADD-USER</button></a> 
    <table width='1280' cellpadding='5' cellspacing='5' border='6' bordercolor='lightgrey' >
    <tr bgcolor='lightyellow' bordercolor='red'><td> Id </td>
     	<td> Name </td>
     	<td> Email </td>
     	<td> Number </td>
     	<td> Country </td>
     	<td> City </td>
     	<td> Upload </td>
     	<td> Action </td></tr>
     <?php foreach($USER as $users){?> 
     <tr bgcolor='lightcyan' class="tr" id="<?php echo $users->id; ?>" ><td><?=$users->id;?></td>
     	<td><?=$users->rname;?></td>
     	
<td class="td">
<span class="text" id="span_<?php echo $users->id; ?>" ><?php echo $users->email; ?>  <img src='http://localhost/click.jpg' height='15' width='35' ></span>
<input class="editbox" id="input_<?php echo $users->id; ?>" type="text" size="25" value="<?php echo $users->email; ?>" > 
<button class="send" id="but_<?php echo $users->id; ?>">send</button>
</td>
     	
     	<td><?=$users->number;?></td>
     	<td><?=$users->name;?></td>
     	<td><?=$users->city;?></td>
		<td><img src='http://localhost/uploads/<?php echo $users->upload; ?>' height='50' width='100'></td>
     
     	<?php echo "<td><a style='text-decoration:none' href='".base_url()."index.php/formc/upview/".$users->id."'><button style='background-color:lightyellow;'>UPDATE</button</a>"; ?> 
     	<?php //echo "|";?>
        <?php echo "<a onClick=\"javascript: return confirm('Do you want to delete');\" href='".base_url()."index.php/formc/delete/".$users->id."'><button style='background-color:lightyellow;'>DELETE</button></a>";  ?>
		<?php echo "<a href='".base_url()."index.php/formc/plaintext/".$users->id."'><button style='background-color:lightyellow;'>DOWNLOAD</button></a></td></tr>"; ?>
		<?php } ?>  
        
    </table>
 </body>
</html>