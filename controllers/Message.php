<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {
	/*
	Session is loaded
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	/*
	Check if user is logged in and redirects the user accordingli
	
	if user is logged in then it is dirrected to the Post view
	otherwise redirected to Login view
	*/
	public function index()
	{
		if($this->session->has_userdata('loggedIn')) {
			$this->load->view('Post');
			
		} else {
			$this->load->view('Login');
		}
	}
	/*
	This function checks if the user is logged in
	then it checks if there is the input for the message to be posted. 
	if the above are true the messages_model is loaded and the data is inseted in the database.
	user is redirected to his/her homepage afterwards.
	
	if there is no input in the postMsg field the the user is redirected to the post Post view 
	
	if the user is not logged in, the user is redirected to Login view
	*/
	public function doPost()
	{
		if($this->session->has_userdata('loggedIn')) {
			$postMsg = $this->input->post('postMsg');
			if("" !== trim($postMsg)) {
				$currentUser = $this->session->userdata('login_id');	
				$this->load->model('messages_model');
				$this->messages_model->insertMessage($currentUser, $postMsg);
				redirect('user/view/'.$currentUser, 'refresh');
			} else {
				redirect('message/index/', 'refresh');;
			}
		} else {
			$this->load->view('Login');
		}
	}
}
?>