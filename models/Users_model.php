<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
	/*
		connects to the database
	*/
	public function __construct()
	{
		$this->load->library('session');
		$this ->load ->database();
	}
	/*
		checks for the password and username match in the database
	*/
	public function checkLogin($username, $pass)
	{
		$sql = 'SELECT password FROM Users WHERE username = ? AND password = ? LIMIT 1;';
		$query = $this->db->query($sql, array($username, sha1($pass)));
		
		if(!empty($query->result_array())) {
			return true;
		} else {
			return false;
		}
	}
	/*
		checks if specific user fallows a specific other user
		return TRUE if fallower is fallowed by the user othervise FALSE
		or if fallower is the same as the user FALSE is returned
	*/
	public function isFollowing($follower, $followed)
	{
		$sql = 'SELECT * FROM User_Follows WHERE follower_username = ? AND followed_username = ?';
		$query = $this->db->query($sql, array($follower, $followed));
		$data = $query->result_array();
		
		if(!count($data) == 0 || $follower == $followed) {
				return true;
		}
		return false;		
	}
	/*
		The user is added to the fallower list of specific user
	*/
	public function follow($followed)
	{
		$sql = "INSERT INTO User_Follows (follower_username, followed_username) VALUES (?, ?);";
		$follower = $this->session->userdata('login_id');
		$this->db->query($sql, array($follower, $followed));
	}
}
?>