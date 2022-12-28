$( document ).ready(function() {

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
	$(".dataTables_filter").addClass("pull-right");
	$(".pagination").addClass("pull-right");
	
	 
	
	
	$(".activeenable").click(function(){
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
				url : CI_ROOT+'Managewebsite/chkuser',
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
	

	
	
	$("#emailist").change(function(){
		var emaillist = $("#emailist").val();
		var emailwebid = $("#emailwebid").val();
		$("#emailbody").html('');
		$("#email_description").val('');
		$.ajax({
			type : "POST",
			url : CI_ROOT+'Managewebsite/emailvalue',
			data : {
				emaillist : emaillist,
				emailwebid : emailwebid
				
			},
			success : function(result)
			{
			//alert(result);
				if(result != 'no')
				{
					$("#email_description").val(result);
					$("#emailbody").html(result);
				}
				
			}
		});
	});
	
	
	//  $('#assigncontry').multiselect({
	// 	selectAllValue: 'multiselect-all',
	// 	maxHeight: '300',
	// 	buttonWidth: '235',			
	// });  
	
	
	$("#assigncontry").change(function(){
		var assigncnt = $(this).val();
		var country = $("#cntry").val();
		var cnt = country.split(',');
		var removed = '';
		for(var i=0;i<cnt.length;i++)
		{
			if(cnt[i] != '' && cnt[i] != 0)
			{
				if($.inArray(cnt[i],assigncnt) == -1)
				{
					alert('Warning!   If you remove the Assigned country, website will not function properly.');
					removed = cnt[i];
				}
				
			}	
			
		}
		
		if(removed != '')
		{
			cnt = $.grep(cnt, function(value) {
				return value != removed;
			});
			var finalcnt = cnt.toString(); 
			$("#cntry").val(finalcnt);
		}
		
		
		
	});


});


function editdata(id){
		window.location.href = CI_ROOT+"Managewebsite/edit_website/"+id;
};
	
	
	
function emaildata()
{
	
		var emaillist = $("#emailist").val();
		var email_description = $("#email_description").val();
		var emailwebid = $("#emailwebid").val();
		
		$.ajax({
			type : 'POST',
			url : CI_ROOT+'Managewebsite/emailformat',
			data : {
				emaillist : emaillist,
				email_description : email_description,
				emailwebid : emailwebid
			},
			async : false,
			success : function(result)
			{
				//alert(result);
				if(result == 1)
				{
					//$("#success").html('<p>Content Update Successfully!</p>');
					alert('Content Update Successfully!');
				}
				else{
					//$("#error").html('<p>Problem With Content Update!</p>');
					alert('Problem With Content Update!');
				}
			}
		});
}	


function analiticdata()
{
		var analitics = $("#analitics").val();
		var emailwebid = $("#emailwebid").val();
		
		$.ajax({
			type : 'POST',
			url : CI_ROOT+'Managewebsite/analiticformat',
			data : {
				analitics : analitics,
				emailwebid : emailwebid
			},
			async : false,
			success : function(result)
			{
				//alert(result);
				
				if(result == 1)
				{
					//$("#success").html('<p>Content Update Successfully!</p>');
					alert('Content Update Successfully!');
				}
				else{
					//$("#error").html('<p>Problem With Content Update!</p>');
					alert('Problem With Content Update!');
				}
			}
		});
}	

function smsconfig()
{
	var smslist = $("#smslist option:selected").val();
	var smstext = $("#smstext").val();
	var emailwebid = $("#emailwebid").val();
	// var smsactive = 0;
	// if($('#smsactive').is(':checked'))
	// {
		// smsactive = 1;
	// }
	
	$.ajax({
			type : 'POST',
			url : CI_ROOT+'Managewebsite/smsconfig',
			data : {
				smslist : smslist,
				smstext : smstext,
				emailwebid : emailwebid,
				//smsactive : smsactive
			},
			async : false,
			success : function(result)
			{
				
				if(result == 1)
				{
					alert('Sms Configuration Update Successfully!');
				}
				else{
					alert('Problem With Sms Configuration Update!');
				}
			}
		});
	
}

$("#smslist").change(function(){
	var smslist = $("#smslist option:selected").val();
	var emailwebid = $("#emailwebid").val();
	$("#smstext").val('');
	$.ajax({
			type : 'POST',
			url : CI_ROOT+'Managewebsite/smsval',
			data : {
				smslist : smslist,
				emailwebid : emailwebid,
			},
			async : false,
			success : function(result)
			{
				
				if(result != 'no')
				{
					$("#smstext").val(result);
				}
			}
		});
});


function fbconfig()
{
	var fblist = $("#fblist option:selected").val();
	var fbactive = 0;
	if($('#fbactive').is(':checked'))
	{
		fbactive = 1;
	}
	var fbdesc = $("#fbdesc").val();
	var emailwebid = $("#emailwebid").val();
	
	$.ajax({
			type : 'POST',
			url : CI_ROOT+'Managewebsite/fbconfig',
			data : {
				fblist : fblist,
				fbactive : fbactive,
				fbdesc : fbdesc,
				emailwebid : emailwebid
			},
			async : false,
			success : function(result)
			{
				//alert(result);
				if(result == 1)
				{
					alert('FB Configuration Update Successfully!');
				}
				else{
					alert('Problem With FB Configuration Update!');
				}
			}
		});
}

$("#fblist").change(function(){
		var fblist = $("#fblist").val();
		var emailwebid = $("#emailwebid").val();
		$("#fbdesc").val('');
		$('#fbactive').prop('checked',false);
		$.ajax({
			type : "POST",
			url : CI_ROOT+'Managewebsite/fbvalue',
			data : {
				fblist : fblist,
				emailwebid : emailwebid
				
			},
			async : false,
			success : function(result)
			{
			//alert(result);
				if(result != 'no')
				{
					var data = result.split(',');
					$("#fbdesc").val(data[0]);
					
					if(data[1] == 1)
					{
						$('#fbactive').prop('checked',true);
					}
					else{
						$('#fbactive').prop('checked',false);
					}
				}
				
			}
		});
	});
	
	
function googleconfig()
{
	var googlelist = $("#googlelist option:selected").val();
	var googleactive = 0;
	if($('#googleactive').is(':checked'))
	{
		googleactive = 1;
	}
	var googledesc = $("#googledesc").val();
	var emailwebid = $("#emailwebid").val();
	
	$.ajax({
			type : 'POST',
			url : CI_ROOT+'Managewebsite/googleconfig',
			data : {
				googlelist : googlelist,
				googleactive : googleactive,
				googledesc : googledesc,
				emailwebid : emailwebid
			},
			async : false,
			success : function(result)
			{
				//alert(result);
				if(result == 1)
				{
					alert('Google Configuration Update Successfully!');
				}
				else{
					alert('Problem With Google Configuration Update!');
				}
			}
		});
}

$("#googlelist").change(function(){
		var googlelist = $("#googlelist").val();
		var emailwebid = $("#emailwebid").val();
		$("#googledesc").val('');
		$('#googleactive').prop('checked',false);
		$.ajax({
			type : "POST",
			url : CI_ROOT+'Managewebsite/fbvalue',
			data : {
				fblist : googlelist,
				emailwebid : emailwebid
			},
			async : false,
			success : function(result)
			{
			//alert(result);
				if(result != 'no')
				{
					var data = result.split(',');
					$("#googledesc").val(data[0]);
					
					if(data[1] == 1)
					{
						$('#googleactive').prop('checked',true);
					}
					else{
						$('#googleactive').prop('checked',false);
					}
				}
				
			}
		});
	});

	function linkconfig()
	{
		var linklist = $("#linklist option:selected").val();
		var linkactive = 0;
		if($('#linkactive').is(':checked'))
		{
			linkactive = 1;
		}
		var linkdesc = $("#linkdesc").val();
		var emailwebid = $("#emailwebid").val();
		
		$.ajax({
				type : 'POST',
				url : CI_ROOT+'Managewebsite/linkconfig',
				data : {
					linklist : linklist,
					linkactive : linkactive,
					linkdesc : linkdesc,
					emailwebid : emailwebid
				},
				async : false,
				success : function(result)
				{
					//alert(result);
					if(result == 1)
					{
						alert('Linkedin Configuration Update Successfully!');
					}
					else{
						alert('Problem With Linkedin Configuration Update!');
					}
				}
			});
	}

	$("#linklist").change(function(){
		var linklist = $("#linklist").val();
		var emailwebid = $("#emailwebid").val();
		$("#linkdesc").val('');
		$('#linkactive').prop('checked',false);
		$.ajax({
			type : "POST",
			url : CI_ROOT+'Managewebsite/fbvalue',
			data : {
				fblist : linklist,
				emailwebid : emailwebid
			},
			async : false,
			success : function(result)
			{
			//alert(result);
				if(result != 'no')
				{
					var data = result.split(',');
					$("#linkdesc").val(data[0]);
					
					if(data[1] == 1)
					{
						$('#linkactive').prop('checked',true);
					}
					else{
						$('#linkactive').prop('checked',false);
					}
				}
				
			}
		});
	});

	
	function twitterconfig()
	{
		var twitterlist = $("#twitterlist option:selected").val();
		var twitteractive = 0;
		if($('#twitteractive').is(':checked'))
		{
			twitteractive = 1;
		}
		var twitterdesc = $("#twitterdesc").val();
		var emailwebid = $("#emailwebid").val();
		
		$.ajax({
				type : 'POST',
				url : CI_ROOT+'Managewebsite/twitterconfig',
				data : {
					twitterlist : twitterlist,
					twitterdesc : twitterdesc,
					twitteractive : twitteractive,
					emailwebid : emailwebid
				},
				async : false,
				success : function(result)
				{
					//alert(result);
					if(result == 1)
					{
						alert('Twitter Configuration Update Successfully!');
					}
					else{
						alert('Problem With Twitter Configuration Update!');
					}
				}
			});
	}
	
	
	$("#twitterlist").change(function(){
		var twitterlist = $("#twitterlist").val();
		var emailwebid = $("#emailwebid").val();
		$("#twitterdesc").val('');
		$('#twitteractive').prop('checked',false);
		$.ajax({
			type : "POST",
			url : CI_ROOT+'Managewebsite/fbvalue',
			data : {
				fblist : twitterlist,
				emailwebid : emailwebid
			},
			async : false,
			success : function(result)
			{
			//alert(result);
				if(result != 'no')
				{
					var data = result.split(',');
					$("#twitterdesc").val(data[0]);
					
					if(data[1] == 1)
					{
						$('#twitteractive').prop('checked',true);
					}
					else{
						$('#twitteractive').prop('checked',false);
					}
				}
				
			}
		});
	});
	
	
	function checkdata()
	{
		var checkeddata=[];
		
		$(".returncheck").each(function(){
			if($(this).is(':checked'))
			{
				checkeddata.push(1);
			}
			else{
				checkeddata.push(0);
			}
			
			
		});
			$("#checkarray").val(checkeddata);
			return true;
	}
	
	function display_template()
	{
		var emailist = $("#emailist option:selected").val();
		var emailwebid = $("#emailwebid").val();
		$.ajax({
			type : "POST",
			url : CI_ROOT+'Managewebsite/display_email_html',
			data : {
				emailist : emailist,
				emailwebid : emailwebid
			},
			async : false,
			success : function(result)
			{
			//alert(result);
				if(result != 'no')
				{
					var data = result.split(',');
					$("#twitterdesc").val(data[0]);
					
					if(data[1] == 1)
					{
						$('#twitteractive').prop('checked',true);
					}
					else{
						$('#twitteractive').prop('checked',false);
					}
				}
				
			}
		});
	}
	
	$(function(){
		$('#libOpen').on('click',function(){
				if($('#webofferimages').css('display')=='none')
				{
					$('#webofferimages').show();
				}
				else if($('#webofferimages').css('display')=='block')
				{
					$('#webofferimages').hide();
				}
			});
	})