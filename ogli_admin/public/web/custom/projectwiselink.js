$(document).ready(function() {
	$('#example').DataTable();
	$(".dataTables_filter").addClass("pull-right");
	$(".pagination").addClass("pull-right");
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
	elems.forEach(function(html) {
	var switchery = new Switchery(html,{size: 'small'});
	});
});
	
	

	function edit_link(pro_id)
	{
		var actual_link  = btoa(CI_actual_link);
		//alert(pro_id); return false;
		$("#prolinkform").html('');
		$.ajax({
		type : "POST",
		url : CI_ROOT+'Projectwiselink/edit_projectwiselink',
		data : {
		pro_id : pro_id, actual_link : actual_link
		},
		success :function(result)
		
		{//alert(result);
			$("#prolinkform").html(result); 
			$('#myModal').modal('show');
		}
	});
	}

	function edit_prolink(pro_id)
	{
		var actual_link  = btoa(CI_actual_link);
		//alert(pro_id); return false;
		$("#prolinkform").html('');
		$.ajax({
		type : "POST",
		url : CI_ROOT+'Projectlink/edit_projectlink',
		data : {
		pro_id : pro_id, actual_link : actual_link
		},
		success :function(result)
		
		{//alert(result);
			$("#prolinkform").html(result); 
			$('#myModal').modal('show');
		}
	});
	}


	$(".cwstatus").click(function(){
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
				url : CI_ROOT+'Guestpost/changecwstatus',
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


$("#del_link").on('click', function() {
	var valuedel = [];
	
	$('input[name="deletelink"]:checked').each(function() {
		valuedel.push($(this).val());
	});
	var conf = confirm("Do you want to delete link?");
	if (conf) {
		//alert(valuedel); return false;
		$.ajax({
			type: "POST",
			url: CI_ROOT + 'Projectlink/deletelink',
			data: {
				delid: valuedel
			},
			success: function(result) {
				//alert(result);
				if (result == 'yes') {
					alert('Link deleted');
					window.location.reload();
				}
			}
		});
	}

});