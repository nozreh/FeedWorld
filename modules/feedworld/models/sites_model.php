<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FeedWorld
 *
 * E-commerce site with content management system for feedworld
 * Built on CodeIgniter - http://codeigniter.com
 */


// ------------------------------------------------------------------------

class Sites_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		
		// get siteID, if available
		if (defined('SITEID'))
		{
			$this->siteID = SITEID;
		}
	}

	function get_sites($search = '')
	{			
		if ($search)
		{
			$search = $this->db->escape_like_str($search);
			
			$this->db->where('(siteDomain LIKE "%'.$search.'%" OR siteName LIKE "%'.$search.'%")');
		}
			
		$query = $this->db->get('sites');

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	
	function get_quota($siteID)
	{
		// get image quota
		$this->CI->db->where('siteID', $this->config['siteID']);
		$this->CI->db->select('SUM(filesize) as quota');
		$query = $this->CI->db->get('images');
		$row = $query->row_array();
		
		$quota = $row['quota'];

		// get file quota
		$this->CI->db->where('siteID', $this->config['siteID']);
		$this->CI->db->select('SUM(filesize) as quota');
		$query = $this->CI->db->get('files');
		$row = $query->row_array();

		$quota += $row['quota'];

		return $quota;
	}

	function add_templates($siteID, $theme = TRUE)
	{
		// get lib
		$this->load->model('pages/pages_model', 'pages');

		// get default theme and import it
		$this->pages->siteID = $siteID;	
		
		if ($theme)
		{	
			$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>{page:title}</title>

		<meta name="keywords" content="{page:keywords}" />
		<meta name="description" content="{page:description}" />

		<link rel="stylesheet" href="http://static.feedworld.com/css/newsite.css" type="text/css" />
		
	</head>
	<body>
	
		<div class="logo">
			<a href="/">
				<img src="http://static.feedworld.com/images/feedworld_logo.png" id="logo" alt="FeedWorld" />
			</a>			
		</div>

		<div class="main">
			<!--CONTENT-->

			{block1}
			
			<!--ENDCONTENT-->
		</div>
		
		<div class="menu">
			<ul>
				{navigation}
				'.((in_array('shop', $this->permission->permissions)) ? '<li><a href="'.$this->config->item('index_page').'/shop">Shop</a></li>' : '').'				<li><a href="'.$this->config->item('index_page').'/admin">Admin</a></li>
			</ul>
		</div>
		
		<center><p><small>Powered by <a href="http://www.feedworld.com">FeedWorld</a></small></p>		
	
		
	</body>
</html>';
					
			$templateID = $this->pages->import_template('default.html', $body);
		}
		else
		{
			$content = "<html>\n<head><title>{page:title}</title>\n<body>\n\n<br><br><center>\n\n{block1}\n\n</center></body>\n</html>";
			$templateID = $this->pages->add_template('Default', $content);
		}	

		// add home page
		$this->db->set('siteID', $siteID);
		$this->db->set('dateCreated', date("Y-m-d H:i:s"));
		$this->db->set('pageName', 'Home');
		$this->db->set('title', 'Home');
		$this->db->set('uri', 'home');
		$this->db->set('templateID', $templateID);
		$this->db->set('active', 1);		
		$this->db->insert('pages');
		$pageID = $this->db->insert_id();
		
		// add version
		$this->db->set('siteID', $siteID);
		$this->db->set('dateCreated', date("Y-m-d H:i:s"));
		$this->db->set('pageID', $pageID);
		$this->db->set('published', 1);
		$this->db->insert('page_versions');
		$versionID = $this->db->insert_id();
		
		// update page
		$this->db->set('draftID', $versionID);
		$this->db->set('versionID', $versionID);
		$this->db->where('pageID', $pageID);
		$this->db->where('siteID', $siteID);
		$this->db->update('pages');

		// add first block
		$this->db->set('siteID', $siteID);
		$this->db->set('dateCreated', date("Y-m-d H:i:s"));
		$this->db->set('blockRef', 'block1');
		$this->db->set('body', "# Welcome.\n\nYour site is set up and ready to go!");
		$this->db->set('versionID', $versionID);
		$this->db->insert('page_blocks');

		return TRUE;		
	}
	
	function delete_site($siteID)
	{	
		// delete site
		$this->db->where('siteID', $siteID);
		$this->db->delete('sites');
		
		return TRUE;
	}	

}