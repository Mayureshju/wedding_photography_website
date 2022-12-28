$(document).ready(function() {
	$('#example').DataTable();
	$(".dataTables_filter").addClass("pull-right");
	$(".pagination").addClass("pull-right");
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
	elems.forEach(function(html) {
	var switchery = new Switchery(html,{size: 'small'});
	});
});
	
	

	function edit_product(id,search,page)
	{
	
		if(id != '')	
		window.location.href = CI_ROOT+"Product/edit_product/"+id+"/"+search+"/"+page;
		else
		alert("Problem with update");
	
	}


	$(".prostatus").click(function(){
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
				url : CI_ROOT+'Product/changeprostatus',
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


function readURLbanr1(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {			
			$('#blahbanr1') .attr('src', e.target.result) .width(100) .height(100);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

function readURLbanr2(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {			
			$('#blahbanr2') .attr('src', e.target.result) .width(100) .height(100);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

function readURLbanr3(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {			
			$('#blahbanr3') .attr('src', e.target.result) .width(100) .height(100);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

// $("#invoicedisplay").click(function(){
// 	var oid = $("#oid").val();
// 	//var webid = $("#webcontryid").val();
// 	//var web = $("#websiteid").val();
// 	//$("#invoice_msg").html("");	
// 	$("#policyform").html('');
// 	$.ajax({
// 		type : "POST",
// 		url : CI_ROOT+"Order/displayinvoice",
// 		data:{
// 		oid : oid
// 		// webid : webid,
// 		// web : web
// 		},
// 		success : function(result){
// 			// $("#invoice_msg").html(result);	
// 			// $('#print_invoice').modal('show');
// 			$("#policyform").html(result); 
// 		}
// 	})
// });
function invoicedisplay(order_id){
		var actual_link  = btoa(CI_actual_link);
		//alert(pro_id); return false;
		//$("#policyform").html('');
		$.ajax({
		type : "POST",
		url : CI_ROOT+'Order/displayinvoice',
		data : {
			order_id : order_id, actual_link : actual_link
		},
		success :function(result)
		
		{ //alert(result);
			//$("#policyform").html(result); 
			// $('#myModal').modal('show');
		}
	});
}