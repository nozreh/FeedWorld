<?php
/**
 * FeedWorld
 *
 * E-commerce site with content management system for feedworld
 * Built on CodeIgniter - http://codeigniter.com
 */

// ------------------------------------------------------------------------

class Community_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		
		// get siteID, if available
		if (defined('SITEID'))
		{
			$this->siteID = SITEID;
		}
	}

	function get_users()
	{
		// default wheres
		$this->db->where('siteID', $this->siteID);
		$this->db->where('active', 1);

		// order
		$this->db->order_by('firstName');

		// grab
		$query = $this->db->get('users');

		if ($query->num_rows())
		{
			$result = $query->result_array();
			
			return $result;
		}
		else
		{
			return FALSE;
		}		
	}

	function lookup_user($userID, $display = FALSE)
	{
		// default wheres
		$this->db->where('userID', $userID);

		// grab
		$query = $this->db->get('users', 1);

		if ($query->num_rows())
		{
			$row = $query->row_array();
			
			if ($display !== FALSE)
			{
				return $row['firstName'].' '.$row['lastName'];
			}
			else
			{
				return $row;
			}
		}
		else
		{
			return FALSE;
		}		
	}
	
}