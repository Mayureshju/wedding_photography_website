$(document).ready(function() {
   $("#example").DataTable();
   $(".dataTables_filter").addClass("pull-right");
	$(".pagination").addClass("pull-right");
	
	$("#menutype").change(function(){
		var menutype = $("#menutype").val();		
		var website = $("#website").val();		
		//alert(website);
		
		$("#menuresult").html('');
		
		$.ajax({
				type : "POST",
				url : CI_ROOT+'Menu/search_menu',
				data : {
					menutype : menutype	,			 
					website : website				 
				},
				success : function(result)
				{
					if(result != 'no')
					{
						$("#menuresult").html(result);					
					}					
				}
			});
	});
	
}); 

function edit_menu_cms(id)
{
	$("#editid").val(id);
	$("#editmenucms").submit();
	
	if(id != '')	
	window.location.href = CI_ROOT+"Menu/edit_menu_cms/"+id;
	else
	alert("Problem with update");	
} 
	
	
	


	
	
	
	