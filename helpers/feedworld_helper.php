<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FeedWorld
 *
 * E-commerce site with content management system for feedworld
 * Built on CodeIgniter - http://codeigniter.com
 */


// ------------------------------------------------------------------------

// orderby helper (will be extended in time)
function order_link($link, $orderby, $text, $segment = 4)
{
	$CI =& get_instance();
	
	if (!$CI->uri->segment($segment) || $CI->uri->segment($segment) == 'orderdesc')
	{
		$order = 'orderasc';
	}
	else
	{
		$order = 'orderdesc';
	}

	if ($CI->uri->segment(($segment+1)) == $orderby)
	{
		$class = 'class="'.$order.'"';
	}
	else
	{
		$class = '';
	}
	
	echo anchor($link.'/'.$order.'/'.$orderby, $text, $class); 

}

// get country codes
function get_country_codes($country = '')
{
	$countries = array('PH'=>'PHILIPPINES');

	return $countries;
}

// get country
function lookup_country($country)
{
	$countries = get_country_codes();

	return ucwords(strtolower(@$countries[$country]));
}

// helper for displaying countries (no ID)
function display_countries($name = 'country', $selected = '', $extras = '')
{
	$output = '';

	$countries = get_country_codes();

	$output .= '<input type="text" name="'.$name.'" '.$extras.' value="PHILIPPINES">';

	$output .= '</input>'."\n";

	return $output;
}

// get state codes
function get_state_codes($state = '')
{
	$states = array(
		''=>'',
                'NCR'=>'Metro Manila',
                'AB'=>'Abra',
                'AD'=>'Agusan del Norte',
                'AS'=>'Agusan del Sur',
                'AK'=>'Aklan',
                'AY'=>'Albay',
                'AQ'=>'Antique',
                'AP'=>'Apayao',
                'AU'=>'Aurora',
                'BS'=>'Basilan',
                'BA'=>'Bataan',
                'BE'=>'Batanes',
                'BG'=>'Batangas',
                'BU'=>'Benguet',
                'BI'=>'Biliran',
                'BO'=>'Bohol',
                'BN'=>'Bukidnon',
                'BC'=>'Bulacan',
                'CA'=>'Cagayan',
                'CN'=>'Camarines Norte',
                'CS'=>'Camarines Sur',
                'CG'=>'Camiguin',
                'CZ'=>'Capiz',
                'CU'=>'Catanduanes',
                'CT'=>'Cavite',
                'CE'=>'Cebu',
                'CV'=>'Compostela Valley',
                'CO'=>'Cotabato',
                'DN'=>'Davao del Norte',
                'DO'=>'Davao Oriental',
                'DS'=>'Davao del Sur',
                'DI'=>'Dinagat Islands',
                'ES'=>'Eastern Samar',
                'GU'=>'Guimaras',
                'IF'=>'Ifugao',
                'IN'=>'Ilocos Norte',
                'IS'=>'Ilocos Sur',
                'IL'=>'Iloilo',
                'IB'=>'Isabela',
                'KA'=>'Kalinga',
                'LU'=>'La Union',
                'LG'=>'Laguna',
                'LN'=>'Lanao del Norte',
                'LS'=>'Lanao del Sur',
                'LY'=>'Leyte',
                'MG'=>'Maguindanao',
                'MQ'=>'Marinduque',
                'MB'=>'Masbate',
                'MC'=>'Misamis Occidental',
                'MR'=>'Misamis Oriental',
                'MP'=>'Mountain Province',
                'NC'=>'Negros Occidental',
                'NR'=>'Negros Oriental',
                'NS'=>'Northern Samar',
                'NE'=>'Nueva Ecija',
                'NV'=>'Nueva Vizcaya',
                'OC'=>'Occidental Mindoro',
                'OR'=>'Oriental Mindoro',
                'PA'=>'Palawan',
                'PM'=>'Pampanga',
                'PG'=>'Pangasinan',
                'QZ'=>'Quezon',
                'QU'=>'Quirino',
                'RZ'=>'Rizal',
                'RO'=>'Romblon',
                'SA'=>'Samar',
                'SG'=>'Sarangani',
                'SQ'=>'Siquijor',
                'SO'=>'Sorsogon',
                'SC'=>'South Cotabato',
                'SL'=>'Southern Leyte',
                'SK'=>'Sultan Kudarat',
                'SU'=>'Sulu',
                'SN'=>'Surigao del Norte',
                'SS'=>'Surigao del Sur',
                'TA'=>'Tarlac',
                'TW'=>'Tawi-Tawi',
                'ZA'=>'Zambales',
                'ZN'=>'Zamboanga del Norte',
                'ZS'=>'Zamboanga del Sur',
                'ZB'=>'Zamboanga Sibugay'
	);

	return $states;
}

// get state
function lookup_state($state)
{
	$states = get_state_codes();

	return ucwords(strtolower(@$states[$state]));
}

// helper for displaying countries (no ID)
function display_states($name = 'state', $selected = '', $extras = '')
{
	$output = '';

	$states = get_state_codes();

	$output .= '<select name="'.$name.'" '.$extras.'>'."\n";

	foreach($states as $state => $name)
	{
		$name = ucwords(strtolower($name));
		
		$output .= '<option value="'.$state.'"';
		if ($state == $selected || ($selected == '' && $state == 'US'))
		{
			$output .= ' selected="selected"';
		}
		$output .= '>'.$name.'</option>'."\n";
	}
	$output .= '</select>'."\n";

	return $output;
}

// image loader (requires images model/lib)
function load_image($image, $thumb = false, $product = false)
{
	$CI =& get_instance();

	$imagePath = $CI->uploads->load_image($image, $thumb, $product);

	return $imagePath['src'];
	
}

function display_image($path, $alt, $size = '', $extras = '', $nopic = FALSE)
{
	if (!$imageSize = @getimagesize('.'.$path))
	{
		if ($nopic !== FALSE)
		{
			$imageHTML = '<img src="'.$nopic.'" alt="No Picture" ';
		}
		else
		{
			return FALSE;
		}
	}
	else
	{
		$imageHTML = '<img src="'.$path.'" alt="'.$alt.'" ';
	}

	if ($size)
	{
		if (is_array($size))
		{
			$widthfactor = (isset($size['width'])) ? $imageSize[0] / $size['width'] : 0;
			$heightfactor = (isset($size['height'])) ? $imageSize[1] / $size['height'] : 0;
			
			if ($imageSize[0] > $size['width'] && ($widthfactor > $heightfactor || $widthfactor == $heightfactor))
			{
				$factor = $imageSize[0] / $size['width'];
				$imageHTML .= 'width="'.$size['width'].'" ';
			}
			elseif ($imageSize[1] > $size['height'] && $heightfactor > $widthfactor)
			{
				$imageHTML .= 'height="'.$size['height'].'" ';
			}
		}
		elseif (intval($size) && $size > 0 && (($imageSize[0] > $size || $imageSize[1] > $size) || $nopic))
		{
			if (($imageSize[0] > $imageSize[1]) || $imageSize[0] == $imageSize[1])
			{
				$imageHTML .= 'width="'.$size.'" ';
			}
			elseif ($imageSize[1] > $imageSize[0])
			{
				$imageHTML .= 'height="'.$size.'" ';
			}
		}
	}

	if ($extras != '')
	{
		$imageHTML .= $extras.' ';
	}

	$imageHTML .= '/>';

	return $imageHTML;
}

// date formatting for mysql dates
function datefmt($date, $fmt = '', $timezone = '', $seconds = FALSE)
{
	$CI =& get_instance();

	if ($CI->site->config['timezone'] && $timezone === '')
	{
		$timezone = $CI->site->config['timezone'];
	}
	
	if (!$fmt)
	{
		if (@$CI->site->config['dateOrder'] == 'MD')
		{
			$fmt = 'M jS Y';
		}
		else
		{
			$fmt = 'jS M Y';
		}
	}
	
	if ($seconds)
	{
		$fmt .= ', H:i';
	}
	
	if ($date && $date > 0)
	{
		$timestamp = strtotime($date);

		if ($timezone)
		{
			$timestamp = gmt_to_local(local_to_gmt($timestamp), $timezone, FALSE);
		}

		return date($fmt, $timestamp);
	}
	else
	{ 
		return false;
	}
}

function currency_symbol($html = TRUE, $currency = '')
{
	$CI =& get_instance();
	
	$currency = (!$currency) ? $CI->site->config['currency'] : $currency;

	if ($currency == 'PHP')
	{
		return '₱';
	}
    elseif ($currency == 'GBP')
	{
		return ($html) ? '&pound;' : '£';
	}
	elseif ($currency == 'JPY')
	{
		return ($html) ? '&yen;' : '¥';
	}
	elseif ($currency == 'EUR')
	{
		return ($html) ? '&euro;' : '€';
	}
	else
	{
		return '₱';
	}
}

function currencies()
{
	$values = array(
        'PHP' => 'Philippine Peso (PHP)',
		'USD' => 'US Dollars (USD)',
		'GBP' => 'UK Pounds (GBP)',	
		'EUR' => 'Euro (EUR)'
	);
	return $values;
}

function languages()
{
	$values = array('english' => 'English');
	return $values;
}

function fraction($int)
{
	$fraction = ($int - floor($int));
	if ($fraction == '0.25')
	{
		return floor($int).' &frac14;';
	}	
	elseif ($fraction == '0.5')
	{
		return floor($int).' &frac12;';
	}
	elseif ($fraction == '0.75')
	{
		return floor($int).' &frac34;';
	}	
	else
	{
		return $int;
	}
}

function order($by, $title, $desc = FALSE, $class = '', $extras = '')
{
	$CI =& get_instance();
	
	$segments = $CI->uri->segment_array();

	if ($key = @array_search('orderby', $segments))
	{
		if ($segments[$key + 1] == $by)
		{
			if ($segments[$key + 2] == 'desc')
			{
				$segments[$key + 2] = 'asc';
				$class = 'orderdesc '.$class;
			}
			else
			{
				$segments[$key + 2] = 'desc';
				$class = 'orderasc '.$class;			
			}
		}
		else
		{
			$segments[$key + 2] = ($desc) ? 'desc' : 'asc';
		}

		$segments[$key + 1] = $by;		
	}
	else
	{
		array_push($segments, 'orderby');
		array_push($segments, $by);
		array_push($segments, (($desc) ? 'desc' : 'asc'));
	}

	$href = '/'.implode('/', str_replace('_ajax', '', $segments));
	
	return anchor($href, $title, 'class="'.trim($class).'" '.$extras);
}

function expiry_months_dropdown($name, $selected = '', $html = '')
{
	return form_dropdown($name, array(
		'01' => 'January',
		'02' => 'February',
		'03' => 'March',
		'04' => 'April',
		'05' => 'May',
		'06' => 'June',
		'07' => 'July',
		'08' => 'August',
		'09' => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December',
	), $selected, $html);
}

function expiry_years_dropdown($name, $selected = '', $html = '')
{
	$options = array();
	
	for ($i=0; $i < 20; $i++) { 
		$options[date('Y', time()+(60*60*24*365)*$i+1)] = date('Y', time()+(60*60*24*365)*$i+1);
	}
	
	return form_dropdown($name, $options, $selected, $html);
}

function mkdn($text)
{
	$CI =& get_instance();

	$CI->load->library('mkdn');
			
	return $CI->mkdn->translate($text);
}	