$(document).ready(function() {
    $('#example').DataTable({
			initComplete : function() {
			   this.api().rows().every( function ( rowIdx, tableLoop, rowLoop ) {
				 this.nodes().to$().find('.js-switch').each(function(i, e) {
				   var switchery = new Switchery(e, {
					 size: 'small'
				   })
				 })
			   })  
			}
	});
	// $(".dataTables_filter").addClass("pull-right");
	// $(".pagination").addClass("pull-right");
	
	$(".loginstatus").click(function(){
		var isok = 0;
		var pass = confirm("Do you want to update the status?");
		if(pass != '')
		{
			var statuscl = 0;
			
			if($(this).hasClass('active_status'))
			{
				statuscl = 0;
			}
			else{
				statuscl = 1;
			}
			
			var cntid = $(this).attr('alt');
			
			$.ajax({
				type : "POST",
				url : CI_ROOT+'User/chkuser_login',
				async: false,
				data :{
					statuscl : statuscl,
					cntid : cntid
				},
				success : function(result)
				{
					if(result == 3)
					{
						alert("Status Updated!");
						isok = 1;
					}
					else if(result == 4)
					{
						alert("Problem with status updated!");
						isok = 0;
					}
				}
			}); 
		
		}
	else{
		alert("Some thing wrong!");
		isok = 0;
	}
	
	if(isok == 0)
	{
		return false;
	}
	else{
		return true;
	}
	});
	
	$(".status").click(function(){
		var isok = 0;
		var pass = confirm("Do you want to update the status?");
		if(pass != '')
		{
			var statuscl = 0;
			
			if($(this).hasClass('active_status'))
			{
				statuscl = 0;
			}
			else{
				statuscl = 1;
			}
			
			var cntid = $(this).attr('alt');
			
			$.ajax({
				type : "POST",
				url : CI_ROOT+'User/chkuser',
				async: false,
				data :{
					statuscl : statuscl,
					cntid : cntid
				},
				success : function(result)
				{
					if(result == 3)
					{
						alert("Status Updated!");
						isok = 1;
					}
					else if(result == 4)
					{
						alert("Problem with status updated!");
						isok = 0;
					}
				}
			}); 
		
		}
	else{
		alert("Some thing wrong!");
		isok = 0;
	}
	
	if(isok == 0)
	{
		return false;
	}
	else{
		return true;
	}
	});
	
	
	
	
});	

function readURLbanr(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {			
			$('#blahbanr') .attr('src', e.target.result) .width(100) .height(100);
		};

		reader.readAsDataURL(input.files[0]);
	}
}


function edit_user(id)
{
	window.location.href=CI_ROOT+"User/edit_user/"+id;
}
function edit_customers(id)
{
	window.location.href=CI_ROOT+"User/edit_customers/"+id;
}

function edit_vendor(id,search,page){
	window.location.href=CI_ROOT+"User/edit_vendor/"+id+"/"+search+"/"+page;
}	

