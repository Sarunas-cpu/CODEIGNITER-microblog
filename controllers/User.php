<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	/*
		allows to view user posts depending on the user name
	*/
	public function view($name = null)
	{
		if($name == null) {
			echo "Name not specified"; return;
		}
		/*
			Checks if the user is fallowing other user
			if the user is not fallowed the user data is set up
			and sent to the messages view to be viewed
		*/
		$currName = $this->session->userdata('login_id');
		$this->load->model('users_model');
		$isFollowing = $this->users_model->isFollowing($currName, $name);
		
		if(!$isFollowing) {
			$nameData = array($name);
		} else {
			$nameData = NULL;
		}
		/*
			all the messages are retrieved by poseter $name
		*/
		$this->load->model('messages_model');
		$data = $this->messages_model->getMessagesByPoster($name);
		/*
			combining data both messages to be posted and the user that is available to be followed
		*/
		$viewData = array("posts" => $data,
						  "notFollowedName" => $nameData);
		$this->load->view('ViewMessages', $viewData);
	}
	/*
		calls fallow function to insert the user into the fallower table for the 
		specified user and redirects the user to now followed user/view
	*/
	public function follow($followed)
	{
		$this->load->model('users_model');
		$this->users_model->follow($followed);
		redirect('user/view/'.$followed, 'refresh');
	}
	/*
		retrieves all the messages that are followed by the user
	*/
	public function feed($name)
	{
		$this->load->model('messages_model');
		$data= $this->messages_model->getFollowedMessages($name);
		
		if(count($data) == 0) {
			echo "Enter valid name"; 
			return;
		}
		
		$viewData = array("posts" => $data);
		$this->load->view('ViewMessages', $viewData);
	}
	/*
		loads login view
	*/
	public function login()
	{
		$this->load->view('Login');
	}
	/*
		checks if the data matches in the database and sets session
		if the match is found, in case of wrong details entered error message is given
		and the user is allowed to try again
	*/
	public function doLogin()
	{
		$this->load->model('users_model');
		$username = $this->input->post('username');
		$pass = $this->input->post('pass');
		$loginStatus = $this->users_model->checkLogin($username, $pass);
		
		if($loginStatus) {		
			$sessionData = array(
						'login_id' => $username,
						'loggedIn' => TRUE);
			$this->session->set_userdata($sessionData);
			redirect('user/view/'.$username, 'refresh');
		} else {
			$errorMsg['errorMsg'] = 'Username or password is incorrecet. Try again.';
			$this->load->view('Login', $errorMsg);
		}
	}
	/*
		current session data is cleared and the user is redirected to Login view
	*/
	public function logout()
	{
			$this->session->sess_destroy();
			redirect('user/login', 'refresh');
	}
}
?>