$(document).ready(function() {
    $('#example').DataTable();
});

function list_of_value(id,title,val,name,st) 
    {
		$("#edit_id").val(id);
		$("#title").val(title);
		$("#value").val(val);
		$("#name").val(name);
		if(st == 0)
		{
			if($("#status").prop('checked') == true){
				$('#status').trigger('click');
			}
			else{
				
			}
		}
		else{
			
			if($("#status").prop('checked') == true){
				
			}
			else{
				$('#status').trigger('click');
			}
			
		}
		//$("#status").val(st);	
	}
		
	function seo_cat(id,catname,status) 
    {
		$("#edit_id").val(id);
		$("#catname").val(catname);	
		if(status == 0)
		{
			if($("#status").prop('checked') == true){
				$('#status').trigger('click');
			}
			else{
				
			}
		}
		else{
			
			if($("#status").prop('checked') == true){
				
			}
			else{
				$('#status').trigger('click');
			}
			
		}		
	}
	
	function niche_cat(id,ncatname,status)
	{
		$("#edit_id").val(id);
		$("#ncatname").val(ncatname);	
		if(status == 0)
		{
			if($("#status").prop('checked') == true){
				$('#status').trigger('click');
			}
			else{
				
			}
		}
		else{
			
			if($("#status").prop('checked') == true){
				
			}
			else{
				$('#status').trigger('click');
			}
			
		}
	}

	
	function taxable_value(id,website,year,invoicepre) 
    {
		$("#edit_id").val(id);
		$("#website").val(website);
		$("#year").val(year);
		$("#invoiceprefix").val(invoicepre);
	}
	
	function display_schedule()
	{
		var type = $("#billtype").val();
		if(type == 3)
		{
			$("#schedule").css("display","block");
		}
		if(type == 2)
		{
			$("#schedule").css("display","none");
		}
		if(type == 1)
		{
			$("#schedule").css("display","none");
		}
	}
	
	function occasionmaster(id,title,val,st) 
    {
		$("#edit_id").val(id);
		$("#title").val(title);
		$("#value").val(val);	
		$("#status").val(st);	
	}
	
	function color(id,title,val,st) 
    {
		$("#edit_id").val(id);
		$("#title").val(title);
		$("#value").val(val);	
		$("#status").val(st);	
	}
	
	function fwvariety(id,title,val,st) 
    {
		$("#edit_id").val(id);
		$("#title").val(title);
		$("#value").val(val);	
		$("#status").val(st);	
	}
	
	function varient(id,title,st) 
    {
		$("#edit_id").val(id);
		$("#title").val(title);		
		$("#status").val(st);	
	}
	
	function category(id,title) 
    {
		$("#edit_id").val(id);
		$("#title").val(title);		
	}
	
	function manage_curr(id,title,code,sign,decimal,val,postion,st) 
	{
		
		$("#edit_id").val(id);
		$("#title").val(title);
		$("#code").val(code);
		$("#sign").val(sign);
		$("#decimal").val(decimal);
		$("#value").val(val);	
		$("#position").val(position);
		$("#status").val(st);		
	}
	
	 function manage_payment(id,name,st) 
    {
		$("#edit_id").val(id);
		$("#pname").val(name);
		
		if(st == 0)
		{
			if($("#status").prop('checked') == true){
				$('#status').trigger('click');
			}
			else{
				
			}
		}
		else{
			
			if($("#status").prop('checked') == true){
				
			}
			else{
				$('#status').trigger('click');
			}
			
		}
		
	}
	 function manage_payment_map(id,name,pg,merchant,secret,formurl,chnl,web,industry,rtnurl,respurl,ntfyurl,st) 
    {
		$("#edit_id").val(id);
		$("#pname").val(pg);
		$("#website").val(name);
		$("#merchantid").val(merchant);$("#secret").val(secret);
		$("#formurl").val(formurl);$("#channel").val(chnl);
		$("#websitetype").val(web);$("#industrytype").val(industry);
		$("#returnurl").val(rtnurl);$("#responceurl").val(respurl);
		$("#notifyurl").val(ntfyurl);
		
		
		if(st == 0)
		{
			if($("#status").prop('checked') == true){
				$('#status').trigger('click');
			}
			else{
				
			}
		}
		else{
			
			if($("#status").prop('checked') == true){
				
			}
			else{
				$('#status').trigger('click');
			}
			
		}
		
	}
	
	$("#payclear").click(function(){
		$("#edit_id").val('');
		$("#pname").val('');
	});
		
	$(".scatstatus").click(function(){
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
				url : CI_ROOT+'Master/changeseocatstatus',
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

	
	$(".ncatstatus").click(function(){
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
				url : CI_ROOT+'Master/changenichecatstatus',
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