$(document).ready(function() {
   
	$('#example').DataTable(); 	
	$(".dataTables_filter").addClass("pull-right");
	$(".pagination").addClass("pull-right");
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
	elems.forEach(function(html) {
	var switchery = new Switchery(html,{size: 'small'});
	});

	
});

//$("#datatable-responsive").on('click', 'tr', function () {
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
				url : CI_ROOT+'Promotion/chkuser',
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
		
		
		
	});
	
	
function edit_promotion(id,search,page)
{
	
	if(id != '')	
	window.location.href = CI_ROOT+"Promotion/edit_promotion/"+id+"/"+search+"/"+page;
	else
	alert("Problem with update");
	
}

function searchsubmit()
{
	var city = $("#city").val();

	$("#mainform").submit(); 
}	


	function readURLbanr(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {			
			$('#blahbanr') .attr('src', e.target.result) .width(100) .height(100);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
	
	