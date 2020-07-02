<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	/*
		retrieves messages from from the database depending on the poseter
		and returns aray of entries
	*/
	public function getMessagesByPoster($name)
	{
		$sql = 'SELECT * FROM Messages WHERE user_username = ? ORDER BY posted_at DESC;';
		$query = $this->db ->query($sql, array($name));
		return $query->result_array();
	}
	/*
		retrieves all the messages taht include given user input
	*/
	public function searchMessages($string)
	{
		$sql = 'SELECT * FROM Messages WHERE text LIKE ? ORDER BY posted_at DESC;';
		$string = "%".$string."%";
		$query = $this->db->query($sql, array($string));
		return $query->result_array();
	}
	/*
		inserts users input text into the database
	*/
	public function insertMessage($poster, $string)
	{
		$sql = "INSERT INTO Messages (user_username, text, posted_at) VALUES (?, ?, now());";
		$this->db->query($sql, array($poster, $string));
	}
	/*
		Returns a list of messages fallowed by a specific user
	*/
	public function getFollowedMessages($name)
	{
		$sql="SELECT * FROM Messages m, User_Follows u WHERE m.user_username = u.followed_username AND u.follower_username = ? ORDER BY m.posted_at DESC;";
		$query = $this->db->query($sql, array($name));
		return $query->result_array();	
	}
}
?>