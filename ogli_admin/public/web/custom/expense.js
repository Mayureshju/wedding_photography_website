$(document).ready(function(){
	/* $("#from_date").datepicker({ dateFormat: "yyyy-mm-dd"});
	$("#to_date").datepicker({ dateFormat: "yyyy-mm-dd"});

	$("#filter").change(function(){
		var from_date = $("#from_date").val();
		var to_date = $("#to_date").val();
		
		//alert(filter);
		if(from_date !='' && to_date !='')
		{
			$.ajax({
				type : "POST",
				url : CI_ROOT+'Expense/searchexp',
				data : {
					from_date : from_date,
					to_date : to_date						
				},
				success : function(data)
				{				
					$('#order_table').html(data);
				}
			});
		}
		else{
			alert("Please Select Date");
		}
	}); */
	
	function custom()
	{
		//alert('Called function yesterday');
		$('#from_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#from_date').datepicker('setDate', 'today');
		$('#to_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#to_date').datepicker('setDate', 'today');		
	}
	
	function today()
	{
		//alert('Called function yesterday');
		$('#from_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#from_date').datepicker('setDate', 'today');
		$('#to_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#to_date').datepicker('setDate', 'today');		
	}
	
	function yesterday()
	{
		//alert('Called function yesterday');
		$('#from_date').datepicker({autoclose: true,dateFormat: "yy-mm-dd"});
		$('#from_date').datepicker('setDate',"-1d");
		 //alert($('#from_date').datepicker('setDate','-1d'));
		
		$('#to_date').datepicker({autoclose: true,dateFormat: 'yy-mm-dd'});
		$('#to_date').datepicker('setDate', "-1d");
		
	}
	
	function thisweek()
	{
		
		var curr = new Date; // get current date
		var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
		var last = first + 6; // last day is the first day + 6

		var firstday = new Date(curr.setDate(first)).toUTCString();
		var lastday = new Date(curr.setDate(last)).toUTCString();
		var weeklast = new Date (lastday);
		var weekfirst = new Date (firstday);
		
		
		
		//alert('Called function yesterday');
		$('#from_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		//$('#from_date').datepicker('setDate', 'w-1');
		$('#from_date').datepicker('setDate', weekfirst);
		$('#to_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		//$('#to_date').datepicker('setDate', 'today');		
		$('#to_date').datepicker('setDate', weeklast);		
	}
	
	function lastweek()
	{
		
		
		var d = new Date();
        var to = d.setTime(d.getTime() - (d.getDay() ? d.getDay() : 7) * 24 * 60 * 60 * 1000);
        var from = d.setTime(d.getTime() - 6 * 24 * 60 * 60 * 1000);
		var weeklast = new Date (to);
		var weekfirst = new Date (from);
		
		$('#from_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#from_date').datepicker('setDate', weekfirst);
		//$('#from_date').datepicker('setDate', 'c-1w');
		$('#to_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#to_date').datepicker('setDate', weeklast);		
	}
	
	function thismonth()
	{
		var date = new Date();
		var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
		//alert('Called function thismonth');
		$('#from_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#from_date').datepicker('setDate', firstDay);
		$('#to_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#to_date').datepicker('setDate', 'today');
		
	}
	
	function lastmonth()
	{
		var date = new Date();
		var firstDay = new Date(date.getFullYear(), date.getMonth()-1, 1);
		var lastDay = new Date(date.getFullYear(), date.getMonth(), 0);
		//alert('Called function yesterday');
		$('#from_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#from_date').datepicker('setDate',  firstDay);
		$('#to_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#to_date').datepicker('setDate', lastDay);		
	}
	
	function thisyear()
	{
		var date = new Date();
		var firstDay = new Date(date.getFullYear(),0, 1);
		
		//alert('Called function yesterday');
		$('#from_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#from_date').datepicker('setDate',  firstDay);
		$('#to_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#to_date').datepicker('setDate', 'today');		
	}
	
	function lastyear()
	{
		var date = new Date();
		var firstDay = new Date(date.getFullYear()-1,0, 1);
		var lastDay = new Date(date.getFullYear()-1,12, 0);
		$('#from_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#from_date').datepicker('setDate', firstDay);
		$('#to_date').datepicker({autoclose: true,format: 'mm/dd/yy',});
		$('#to_date').datepicker('setDate', lastDay);
		
	}
	
	$('#selectdate').on('change', function() {
    //alert($('#selectdate').val()); //return false;
      if ( $('#selectdate').val() == 'custom' ) custom();
      else if ( $('#selectdate').val() == 'today' ) today();
      else if ( $('#selectdate').val() == 'yesterday' ) yesterday();
	  else if ( $('#selectdate').val() == 'thisweek' ) thisweek();
      else if ( $('#selectdate').val() == 'lastweek' ) lastweek();
	  else if ( $('#selectdate').val() == 'thismonth' ) thismonth();
      else if ( $('#selectdate').val() == 'lastmonth' ) lastmonth();
	  else if ( $('#selectdate').val() == 'thisyear' ) thisyear();
      else if ( $('#selectdate').val() == 'lastyear' ) lastyear();
    });
	
	
	
	
});

