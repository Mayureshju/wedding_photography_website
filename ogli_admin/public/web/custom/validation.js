$(document).ready(function(){

		var city = $("#city");
		city.blur(chkcity);
		function chkcity()
		{ 
				
				if(city != '')
				{	
					return true;
				}
				 
				else{
						$("#e_city").html('Please enter city');
						
						return false;
				}
				
				
		}
		
		$("#account_btn").click(function(){
	if(chkcity())
	{
		$.ajax({
				url : CI_ROOT+'index.php/Nav/chkcity',
				type : 'POST',
				data : {
					city : city.val()
				},
				success : function(result)
				{
					//alert(result);
					if(result == 'Yes')
					{
						$("#e_city").html('This city id already use!');
						return false;
					}
					else {
						$("#e_city").html('');
						$("#reg").submit();
						
					}
				
				}
		}); 
		
		
	}
	else	
	{
		//alert('checkmailelse');
	}
});
	
});	



