<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Calendar Class
 *
 * This class enables the creation of calendars
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/calendar.html
 */
class CI_Calendar {

	var $CI;
	var $lang;
	var $local_time;
	var $template		= '';
	var $start_day		= 'sunday';
	var $month_type		= 'long';
	var $day_type		= 'abr';
	var $show_next_prev	= FALSE;
	var $next_prev_url	= '';

	/**
	 * Constructor
	 *
	 * Loads the calendar language file and sets the default time reference
	 */
	public function __construct($config = array())
	{
		$this->CI =& get_instance();

		if ( ! in_array('calendar_lang'.EXT, $this->CI->lang->is_loaded, TRUE))
		{
			$this->CI->lang->load('calendar');
		}

		$this->local_time = time();

		if (count($config) > 0)
		{
			$this->initialize($config);
		}

		log_message('debug', "Calendar Class Initialized");
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize the user preferences
	 *
	 * Accepts an associative array as input, containing display preferences
	 *
	 * @access	public
	 * @param	array	config preferences
	 * @return	void
	 */
	function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Generate the calendar
	 *
	 * @access	public
	 * @param	integer	the year
	 * @param	integer	the month
	 * @param	array	the data to be shown in the calendar cells
	 * @return	string
	 */
	function generate($langtype = '_ch', $year = '', $month = '', $data = array(), $arr_paused_arr = array(), $arr_cancelled_arr = array(), $holiday_arr = array())
	{
		// Set and validate the supplied month/year
		if ($year == '')
			$year  = date("Y", $this->local_time);

		if ($month == '')
			$month = date("m", $this->local_time);

		if (strlen($year) == 1)
			$year = '200'.$year;

		if (strlen($year) == 2)
			$year = '20'.$year;

		if (strlen($month) == 1)
			$month = '0'.$month;

		$adjusted_date = $this->adjust_date($month, $year);

		$month	= $adjusted_date['month'];
		$year	= $adjusted_date['year'];

		// Determine the total days in the month
		$total_days = $this->get_total_days($month, $year);

		// Set the starting day of the week
		$start_days	= array('sunday' => 0, 'monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6);
		$start_day = ( ! isset($start_days[$this->start_day])) ? 0 : $start_days[$this->start_day];

		// Set the starting day number
		$local_date = mktime(12, 0, 0, $month, 1, $year);
		
		
		$date = getdate($local_date);
		$day  = $start_day + 1 - $date["wday"];

		while ($day > 1)
		{
			$day -= 7;
		}

		// Set the current month/year/day
		// We use this to determine the "today" date
		$cur_year	= date("Y", $this->local_time);
		$cur_month	= date("m", $this->local_time);
		$cur_day	= date("j", $this->local_time);

		$is_current_month = ($cur_year == $year AND $cur_month == $month) ? TRUE : FALSE;

		// Generate the template data array
		$this->parse_template();

		// Begin building the calendar output
		$out = $this->temp['table_open'];
		$out .= "\n";

		$out .= "\n";
		$out .= $this->temp['heading_row_start'];
		$out .= "\n";

		// "previous" month link
		if ($this->show_next_prev == TRUE)
		{
			// Add a trailing slash to the  URL if needed
			$this->next_prev_url = preg_replace("/(.+?)\/*$/", "\\1/",  $this->next_prev_url);

			$adjusted_date = $this->adjust_date($month - 1, $year);
//			$out .= str_replace('{previous_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'], $this->temp['heading_previous_cell']);
//			$out .= str_replace('{previous_url}', 'javascript:togetcalendar_month('.$adjusted_date['year'].',\''.$adjusted_date['month'].'\');', $this->temp['heading_previous_cell']);
			$out .= str_replace('{previous_url}', $adjusted_date['year'].',\''.$adjusted_date['month'].'\'', $this->temp['heading_previous_cell']);
			$out .= "\n";
		}

		// Heading containing the month/year
		$colspan = ($this->show_next_prev == TRUE) ? 5 : 7;

		$this->temp['heading_title_cell'] = str_replace('{colspan}', $colspan, $this->temp['heading_title_cell']);
// 		$this->temp['heading_title_cell'] = str_replace('{heading}', $this->get_month_name($langtype, $month)."&nbsp;".$year, $this->temp['heading_title_cell']);
		$this->temp['heading_title_cell'] = str_replace('{heading}', $this->get_month_name($langtype, $month), $this->temp['heading_title_cell']);
		
		$out .= $this->temp['heading_title_cell'];
		$out .= "\n";

		// "next" month link
		if ($this->show_next_prev == TRUE)
		{
			$adjusted_date = $this->adjust_date($month + 1, $year);
//			$out .= str_replace('{next_url}', $this->next_prev_url.$adjusted_date['year'].'/'.$adjusted_date['month'], $this->temp['heading_next_cell']);
//			$out .= str_replace('{next_url}', 'javascript:togetcalendar_month('.$adjusted_date['year'].',\''.$adjusted_date['month'].'\');', $this->temp['heading_next_cell']);
			$out .= str_replace('{next_url}', $adjusted_date['year'].',\''.$adjusted_date['month'].'\'', $this->temp['heading_next_cell']);
		}

		$out .= "\n";
		$out .= $this->temp['heading_row_end'];
		$out .= "\n";

		// Write the cells containing the days of the week
		$out .= "\n";
		$out .= $this->temp['week_row_start'];
		$out .= "\n";

		$day_names = $this->get_day_names($langtype);

		for ($i = 0; $i < 7; $i ++)
		{
			$out .= str_replace('{week_day}', $day_names[($start_day + $i) %7], $this->temp['week_day_cell']);
		}

		$out .= "\n";
		$out .= $this->temp['week_row_end'];
		$out .= "\n";

		// Build the main body of the calendar
		while ($day <= $total_days)
		{
			$out .= "\n";
			$out .= $this->temp['cal_row_start'];
			$out .= "\n";

			for ($i = 0; $i < 7; $i++)
			{
				$out .= ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_start_today'] : $this->temp['cal_cell_start'];

				if ($day > 0 AND $day <= $total_days){
					if (isset($data[$day])){
						// Cells with content
						$temp = ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_content_today'] : $this->temp['cal_cell_content'];
						
						
						if (isset($data['shiwu'][$day])){
							$temp =str_replace('{showthings}', '\''.$year.'\',\''.$month.'\',\''.$day.'\',\''.$data['shiwu'][$day].'\'', $temp);
						}else{
							$temp =str_replace('{showthings}', '\''.$year.'\',\''.$month.'\',\''.$day.'\'', $temp);
						}
						if (isset($data['things_num'][$day])){
							$temp =str_replace('{things_num}', '('.$data['things_num'][$day].')', $temp);
						}
						$temp =str_replace('{day_id}', $year.'_'.$month.'_'.$day, $temp);
						
						
						
						$CI =& get_instance();
						$temp = str_replace('{background}', '#EFEFEF;color:red;', $temp);
						
						//判断有没有暂停的天数
						$is_cancelled = 0;
						if (!empty($arr_cancelled_arr)) {
							for ($ac = 0; $ac < count($arr_cancelled_arr); $ac++) {
								if($arr_cancelled_arr[$ac] == $day){
									$is_cancelled = 1;
								}
							}
						}
						//判断有没有暂停的天数
						$is_paused = 0;
						if (!empty($arr_paused_arr)) {
							for ($ac = 0; $ac < count($arr_paused_arr); $ac++) {
								if($arr_paused_arr[$ac] == $day){
									$is_paused = 1;
								}
							}
						}
						
						
						if($is_cancelled == 1){//已经取消掉了
							$temp = str_replace('background:#ffffff;color:#000000;', 'background:#ac8a8b;color:#000000;', $temp);
							if($month < 10){
								$month_show = '0'.$month;
							}else{
								$month_show = $month;
							}
							if($day < 10){
								$day_show = '0'.$day;
							}else{
								$day_show = $day;
							}
						
							$temp = str_replace('{content}', 'javascript:;', $temp);
							$temp = str_replace('{day}', $day, $temp);
						}else if($is_paused == 1){//已经暂停掉了
							$temp = str_replace('background:#ffffff;color:#000000;', 'background:#9175d9;color:#000000;', $temp);
							if($month < 10){
								$month_show = '0'.$month;
							}else{
								$month_show = $month;
							}
							if($day < 10){
								$day_show = '0'.$day;
							}else{
								$day_show = $day;
							}
								
							$temp = str_replace('{content}', 'javascript:;', $temp);
							$temp = str_replace('{day}', $day, $temp);
						}else{
							$temp = str_replace('{content}', $data[$day], $temp);
							$temp = str_replace('{day}', $day, $temp);
						}
						
						
						$out .= $temp;
						
//						$out .= str_replace(str_replace('{showthings}', $data[$day], $temp));
					}else{
						// Cells with no content
						$temp = ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_no_content_today'] : $this->temp['cal_cell_no_content'];
						
						//判断是否是假期
						$is_holiday = 0;
						if (!empty($holiday_arr)) {
							for ($ac = 0; $ac < count($holiday_arr); $ac++) {
								if($holiday_arr[$ac] == $day){
									$is_holiday = 1;
								}
							}
						}
						
						
						if($is_holiday == 1){
// 							$temp = str_replace('background:#f7d9d9;color:#999999;', 'background:red;color:#000000;', $temp);
							if($month < 10){
								$month_show = '0'.$month;
							}else{
								$month_show = $month;
							}
							if($day < 10){
								$day_show = '0'.$day;
							}else{
								$day_show = $day;
							}
							
							$temp =str_replace('{showthings}', '\''.$year.'\',\''.$month.'\',\''.$day.'\',\'\'', $temp);
							$temp =str_replace('{day_id}', $year.'_'.$month.'_'.$day, $temp);
							$out .= str_replace('{day}', $day.'<span style="float:right;width:1px;line-height:15px;margin-top:0px;"><span style="float:left;width:15px;margin-left:-15px;color:red;font-size:12px;">休</span></span>', $temp);
						}else{
							$temp =str_replace('{showthings}', '\''.$year.'\',\''.$month.'\',\''.$day.'\',\'\'', $temp);
							$temp =str_replace('{day_id}', $year.'_'.$month.'_'.$day, $temp);
							$out .= str_replace('{day}', $day, $temp);
						}
						
						
					}
					
					
					
				}else{
					// Blank cells
					$out .= $this->temp['cal_cell_blank'];
				}

				$out .= ($is_current_month == TRUE AND $day == $cur_day) ? $this->temp['cal_cell_end_today'] : $this->temp['cal_cell_end'];					
				$day++;
			}

			$out .= "\n";
			$out .= $this->temp['cal_row_end'];
			$out .= "\n";
		}

		$out .= "\n";
		$out .= $this->temp['table_close'];

		return $out;
	}

	// --------------------------------------------------------------------

	/**
	 * Get Month Name
	 *
	 * Generates a textual month name based on the numeric
	 * month provided.
	 *
	 * @access	public
	 * @param	integer	the month
	 * @return	string
	 */
	function get_month_name($langtype, $month){
		if ($langtype == '_ch'){
			$month_names = array('01' => 'cal_1月', '02' => 'cal_2月', '03' => 'cal_3月', '04' => 'cal_4月', '05' => 'cal_5月', '06' => 'cal_6月', '07' => 'cal_7月', '08' => 'cal_8月', '09' => 'cal_9月', '10' => 'cal_10月', '11' => 'cal_11月', '12' => 'cal_12月');
		}else{
			$month_names = array('01' => 'cal_January', '02' => 'cal_February', '03' => 'cal_March', '04' => 'cal_April', '05' => 'cal_May', '06' => 'cal_June', '07' => 'cal_July', '08' => 'cal_August', '09' => 'cal_September', '10' => 'cal_October', '11' => 'cal_November', '12' => 'cal_December');
		}

		$month = $month_names[$month];

		if ($this->CI->lang->line($month) === FALSE)
		{
			return ucfirst(str_replace('cal_', '', $month));
		}

		return $this->CI->lang->line($month);
	}

	// --------------------------------------------------------------------

	/**
	 * Get Day Names
	 *
	 * Returns an array of day names (Sunday, Monday, etc.) based
	 * on the type.  Options: long, short, abrev
	 *
	 * @access	public
	 * @param	string
	 * @return	array
	 */
	function get_day_names($langtype = ''){
		if ($langtype == '_ch'){
			$day_names = array('日', '一', '二', '三', '四', '五', '六');
		}else {
			$day_names = array('S', 'M', 'T', 'W', 'T', 'F', 'S');
		}

		$days = array();
		foreach ($day_names as $val)
		{
			$days[] = ($this->CI->lang->line('cal_'.$val) === FALSE) ? ucfirst($val) : $this->CI->lang->line('cal_'.$val);
		}

		return $days;
	}

	// --------------------------------------------------------------------

	/**
	 * Adjust Date
	 *
	 * This function makes sure that we have a valid month/year.
	 * For example, if you submit 13 as the month, the year will
	 * increment and the month will become January.
	 *
	 * @access	public
	 * @param	integer	the month
	 * @param	integer	the year
	 * @return	array
	 */
	function adjust_date($month, $year)
	{
		$date = array();

		$date['month']	= $month;
		$date['year']	= $year;

		while ($date['month'] > 12)
		{
			$date['month'] -= 12;
			$date['year']++;
		}

		while ($date['month'] <= 0)
		{
			$date['month'] += 12;
			$date['year']--;
		}

		if (strlen($date['month']) == 1)
		{
			$date['month'] = '0'.$date['month'];
		}

		return $date;
	}

	// --------------------------------------------------------------------

	/**
	 * Total days in a given month
	 *
	 * @access	public
	 * @param	integer	the month
	 * @param	integer	the year
	 * @return	integer
	 */
	function get_total_days($month, $year)
	{
		$days_in_month	= array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

		if ($month < 1 OR $month > 12)
		{
			return 0;
		}

		// Is the year a leap year?
		if ($month == 2)
		{
			if ($year % 400 == 0 OR ($year % 4 == 0 AND $year % 100 != 0))
			{
				return 29;
			}
		}

		return $days_in_month[$month - 1];
	}

	// --------------------------------------------------------------------

	/**
	 * Set Default Template Data
	 *
	 * This is used in the event that the user has not created their own template
	 *
	 * @access	public
	 * @return array
	 */
	function default_template()
	{
		return  array (
						'table_open'				=> '<table border="0" cellpadding="4" cellspacing="0">',
						'heading_row_start'			=> '<tr>',
						'heading_previous_cell'		=> '<th><a href="{previous_url}">&lt;&lt;</a></th>',
						'heading_title_cell'		=> '<th colspan="{colspan}">{heading}</th>',
						'heading_next_cell'			=> '<th><a href="{next_url}">&gt;&gt;</a></th>',
						'heading_row_end'			=> '</tr>',
						'week_row_start'			=> '<tr>',
						'week_day_cell'				=> '<td>{week_day}</td>',
						'week_row_end'				=> '</tr>',
						'cal_row_start'				=> '<tr>',
						'cal_cell_start'			=> '<td>',
						'cal_cell_start_today'		=> '<td>',
						'cal_cell_content'			=> '<a href="{content}">{day}</a>',
						'cal_cell_content_today'	=> '<a href="{content}"><strong>{day}</strong></a>',
						'cal_cell_no_content'		=> '{day}',
						'cal_cell_no_content_today'	=> '<strong>{day}</strong>',
						'cal_cell_blank'			=> '&nbsp;',
						'cal_cell_end'				=> '</td>',
						'cal_cell_end_today'		=> '</td>',
						'cal_row_end'				=> '</tr>',
						'table_close'				=> '</table>'
					);
	}

	// --------------------------------------------------------------------

	/**
	 * Parse Template
	 *
	 * Harvests the data within the template {pseudo-variables}
	 * used to display the calendar
	 *
	 * @access	public
	 * @return	void
	 */
	function parse_template()
	{
		$this->temp = $this->default_template();

		if ($this->template == '')
		{
			return;
		}

		$today = array('cal_cell_start_today', 'cal_cell_content_today', 'cal_cell_no_content_today', 'cal_cell_end_today');

		foreach (array('table_open', 'table_close', 'heading_row_start', 'heading_previous_cell', 'heading_title_cell', 'heading_next_cell', 'heading_row_end', 'week_row_start', 'week_day_cell', 'week_row_end', 'cal_row_start', 'cal_cell_start', 'cal_cell_content', 'cal_cell_no_content',  'cal_cell_blank', 'cal_cell_end', 'cal_row_end', 'cal_cell_start_today', 'cal_cell_content_today', 'cal_cell_no_content_today', 'cal_cell_end_today') as $val)
		{
			if (preg_match("/\{".$val."\}(.*?)\{\/".$val."\}/si", $this->template, $match))
			{
				$this->temp[$val] = $match['1'];
			}
			else
			{
				if (in_array($val, $today, TRUE))
				{
					$this->temp[$val] = $this->temp[str_replace('_today', '', $val)];
				}
			}
		}
	}

}

// END CI_Calendar class

/* End of file Calendar.php */
/* Location: ./system/libraries/Calendar.php */