<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	/*
	Session is loaded
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	/*
		default page if the index is not specified
	*/
	public function index()
	{
		$this->load->view('Search');
	}
	/*
		Matches the user input with a database
		if the input is nothing then all off the posts are returned into
		messages view
	*/
	public function dosearch()
	{
		$this->load->model('messages_model');
		$string = $this->input->get('searchString');
		$data = $this ->messages_model ->searchMessages($string);
		/*
			error message is sent to the view if there are no results found
		*/
		if(count($data) == 0) {
			$errorMsg['errorMsg'] = 'No results were found.';
			$this->load->view('Search', $errorMsg);
		}
		
		$viewData = array("posts" => $data);
		$this->load->view('ViewMessages', $viewData);		
	}
}
?>