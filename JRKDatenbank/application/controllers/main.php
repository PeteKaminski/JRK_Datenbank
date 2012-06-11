<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main extends CI_Controller {
	
	private $layout_data;
	
	function __construct()
	{
		
		parent::__construct();
		//$this->layout_data = $this->viewHeadandNavi();
		$this->layout_data['pageTitle'] = "JRK - Mitgliederverwaldung";
		$this->layout_data['header'] = $this->load->view('header',NULL,true);	//Welches Header File geladen werden soll
		$this->layout_data['navigation'] = $this->load->view('navigation',NULL,true); //Welches Navi File geladen werden soll
	}
	
	
	
	function index()
	{
		$this->load->model('model');
	 	
		//load the content variables
 		$this->layout_data['content'] = $this->load->view('overview', NULL, true); //Welches Content File geladen werden soll 
		$this->load->view('main', $this->layout_data);
	}

	function testdb()
	{
		$this->load->model('User_model');
		$this->layout_data['content'] = $this->load->view('test_db', NULL, true); //Welches Content File geladen werden soll 
		$this->load->view('main', $this->layout_data);
	}
	
	
	// Ruf das UserFormular zum anlegen von Mitgliedern oder zum Ändern von Mitglieder Daten auf
	function formularUser()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->helper('MY_user_helper');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('vorname', 'Vorname', 'required');
		
		$userdaten['userform']=getuserformarray();
		
		if ($this->form_validation->run() == FALSE)
		{
			//load the content variables
 			$this->layout_data['content'] = $this->load->view('form/user', $userdaten, true); //Welches Content File geladen werden soll 
			$this->load->view('main', $this->layout_data);
		}
		else
		{
			//load the content variables
 			$this->layout_data['content'] = $this->load->view('form/erfolg', NULL, true); //Welches Content File geladen werden soll 
			$this->load->view('main', $this->layout_data);
		}	
	}
	
	function formularVeranstaltung()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->helper('MY_user_helper');
		
		$this->load->library('form_validation');
		
		$data['userform']=getuserformarray();
		
		if ($this->form_validation->run() == FALSE)
		{
			//load the content variables
 			$this->layout_data['content'] = $this->load->view('form/veranstaltung', NULL, true); //Welches Content File geladen werden soll 
			$this->load->view('main', $this->layout_data);
		}
		else
		{
			//load the content variables
 			$this->layout_data['content'] = $this->load->view('form/erfolg', NULL, true); //Welches Content File geladen werden soll 
			$this->load->view('main', $this->layout_data);
		}
		
	}
	
	function formularKreisverband()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->helper('MY_user_helper');
		
		$this->load->library('form_validation');
		
		$data['userform']=getuserformarray();
		
		if ($this->form_validation->run() == FALSE)
		{
			//load the content variables
 			$this->layout_data['content'] = $this->load->view('form/kreisverband', NULL, true); //Welches Content File geladen werden soll 
			$this->load->view('main', $this->layout_data);
		}
		else
		{
			//load the content variables
 			$this->layout_data['content'] = $this->load->view('form/erfolg', NULL, true); //Welches Content File geladen werden soll 
			$this->load->view('main', $this->layout_data);
		}
		
	}
}

function base_url($uri = '')
{
	$CI =& get_instance();
	return $CI->config->base_url($uri);
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */