<?php 
if(!defined('BASEPATH')) exit('NO ACCESS');
Class Calendar_model1 extends CI_Model
{
    var $conf;
	
	function generate_hike($year,$month,$web)
	{	
		$ymdchk = $year.'-'.$month;
		$this->conf = array(
		'show_next_prev' => true,
		'next_prev_url'  => base_url().'Appointment/add_appointment',
		'day_type'     => 'short'
		);
		
		$this->conf['template'] = '
				 
		{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

        {heading_row_start}<tr class="week" >{/heading_row_start}

        {heading_previous_cell}<th class="center"><a href="{previous_url}/'.$web.'" class="pull-left mon-change"><i class="fa fa-angle-left" aria-hidden="true"></a></th>{/heading_previous_cell}
        {heading_title_cell}<th class="month" colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th class="center"><a href="{next_url}/'.$web.'" class="pull-right mon-change"><i class="fa fa-angle-right" aria-hidden="true"></a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr style="border:1px solid #efefef;background: #eee;text-align: center">{/week_row_start}
        {week_day_cell}<td style="border-right: 1px solid #efefef;">{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr class="days">{/cal_row_start}
        {cal_cell_start}<td class="day a1" >{/cal_cell_start}
		
        {cal_cell_start_today}<td class="day highlight a1">{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}
		<div class="day_num">{day}</div>
		<div class="ymd">'.$ymdchk.'</div>
		<div class="content">{content}</div>
		{/cal_cell_content}

		{cal_cell_no_content}
		<div class="day_num">{day}</div>
		<div class="ymd">'.$ymdchk.'</div>
		{/cal_cell_no_content}		        
		
		{cal_cell_content_today}
		<div class="day_num highlight">{day}</div>
		<div class="ymd">'.$ymdchk.'</div>
		<div class="content">{content}</div>
		{/cal_cell_content_today}
        
        {cal_cell_no_content_today}
		<div class="day_num highlight">{day}</div>	
		<div class="ymd">'.$ymdchk.'</div>
		{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
		';
		$ym = array(
            'year' => $this->uri->segment(3),
            'month' => $this->uri->segment(4)
        );
        $this->load->library('calendar', $this->conf);
		//$cal_data = $this->get_calendar_data_hike($year, $month,$web);
		$cal_data = $this->get_past_dates($year,$month,$web);
		

		//$lev_data = $this->get_calendar_leavedata_hike($year, $month,$web);
		
		// for($i = 0;$i < count($lev_data);$i++){
		// 	//print_r($lev_data[0]);exit;
		// 	array_push($cal_data,$lev_data);
		// }	
		// foreach($lev_data as $key => $value){
		// 	$cal_data[$key] = $value;
			
		// }
		//print_r($cal_data);exit;
	return $this->calendar->generate($year, $month, $cal_data);
		//return $this->calendar->generate($year, $month, $web);
	}
	// function add_calendar_data_hike($date,$web)
	// {
	// 	$adminid = $this->session->userdata('id');
	// 	$fnf = array('MLV_DATE' => $date, 'MUM_ID' => $web);
	// 	if($this->db->select('MLV_DATE')->from('mov_leaves')->where($fnf)->count_all_results())
	// 	{
	// 		$this->db->delete('mov_leaves', array( 'MLV_DATE' =>$date,'MUM_ID'=>$web));
	// 	}
	// 	else 
	// 	{
	// 		$this->db->insert('mov_leaves', array( 'MLV_DATE' => $date, 'MUM_ID' =>$web , 'MLV_STATUS' => 0));
	// 	}
	// }	
	function get_calendar_data_hike($year, $month,$web)
	{
		// $query = $this->db->select('MLV_DATE,MLV_STATUS')->from('mov_leaves')->like('MLV_DATE',"$year-$month",'after')->where(['MUM_ID'=>$web])->get();
		 $cal_data = array ();		
		// foreach($query->result() as $row)
		// {
		// 	$MLV_STATUS = $row->MLV_STATUS;
		// 	$colour = 'red';
		// 	$MLV_STATUS_name = 'Pending';
		// 	if($MLV_STATUS == 1){
		// 		$colour = 'green';
		// 		$MLV_STATUS_name = 'Approved';
		// 	}
			
		// 	$index = ltrim(substr($row->MLV_DATE,8,2), '0'); 
			
        //     $cal_data[$index] = '<p style="background:'.$colour.' !important;">'.$MLV_STATUS_name.'</p>';
		// } 	
		return $cal_data;
	}
	// function get_calendar_leavedata_hike($year, $month,$web)
	// {
	// 	$status = 1;
	// 	$query = $this->db->select('MCLV_DATE,MCLV_STATUS,MCLV_TEXT')->from('mov_company_leaves')->like('MCLV_DATE',"$year-$month",'after')->where(['MCLV_STATUS'=>$status])->get();
	// 	$lev_data = array ();		
	// 	foreach($query->result() as $row)
	// 	{
	// 		$MCLV_STATUS = $row->MCLV_STATUS;
	// 		$colour = 'red';
	// 		$MCLV_STATUS_name = 'Pending';
	// 		if($MCLV_STATUS == 1){
	// 			$colour = 'green';
	// 			if($row->MCLV_TEXT != ''){			
	// 				$MCLV_STATUS_name = $row->MCLV_TEXT;
	// 			}else{
	// 				$MCLV_STATUS_name = 'Holiday';
	// 			}
	// 		}
			
	// 		$index = ltrim(substr($row->MCLV_DATE,8,2), '0'); 
			
    //         $lev_data[$index] = '<p style="background:'.$colour.' !important;">'.$MCLV_STATUS_name.'</p>';
	// 	} 	return $lev_data;
	// }

	function get_past_dates($year, $month,$web){
		$cal_data = array ();	
		$start = $month1 =  $year.'-'.$month.'-'.'01';
		//$end = strtotime('2021-01-31');
		// $date = date("Y-m-d");
		//$month1 = date('Y-m-d',strtotime($month1));
		//$month1 = date("Y-m-d",strtotime($month1));
		$sdate = $month1;
		$month1 =date('Y-m-d', strtotime(str_replace('-','/', $month1)));
		
		$today = date("Y-m-d");
		//print_r($month1.'-'.$today); exit;

		while($month1 < $today)
		{
			$index = ltrim(substr($month1,8,2), '0'); 
			//$cal_data[$index] = $month1;
			$colour = 'gray';
			$cal_data[$index] = '<p id="pastdate" style="background:'.$colour.' !important;">'.date('Y-m-d', strtotime(str_replace('-','/',$month1))).'</p>';
			//$cal_data[$index] = 'style="background:'.$colour.' !important;"';
			$month1 = date('Y-m-d', strtotime("+1 days",strtotime(str_replace('-','/', $month1))));
			//$month1->modify('+1 day');
			//echo date('Y-m-d', strtotime(str_replace('-','/',$month1)));
		}	
		return $cal_data;
	}
		 
}


?>