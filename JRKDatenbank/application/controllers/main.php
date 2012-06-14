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

		$this->form_validation->set_rules('Name', 'Name', 'required');
		$this->form_validation->set_rules('Vorname', 'Vorname', 'required');
		
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
	
	function formularVeranstaltung($parameter)
	{
		$data['VeranstaltungID'] = $parameter;

		$this->load->helper(array('form', 'url'));
		$this->load->helper('MY_user_helper');
		$this->load->library('form_validation');
		$this->load->model('vera_model');
		if (isset($this->input->post('Speichern')))
		{			
			$this->form_validation->set_message('required', 'Das Feld %s ist erforderlich.');
			$this->form_validation->set_rules('Name', 'Name', 'required');
		    $this->form_validation->set_rules('Traeger', 'Traeger', 'required');
		    $this->form_validation->set_rules('Thema', 'Thema', 'required');
		    $this->form_validation->set_rules('ArtMassnahme', 'ArtMassnahme', 'required');
		    $this->form_validation->set_rules('Strasse', 'Strasse', 'required');
		    $this->form_validation->set_rules('HausNr', 'HausNr', 'required');
		    $this->form_validation->set_rules('Plz', 'Plz', 'required');
		    $this->form_validation->set_rules('Ort', 'Ort', 'required');
		    $this->form_validation->set_rules('DatumBegintag', 'DatumBegintag', 'required');
		    $this->form_validation->set_rules('DatumBeginmonat', 'DatumBeginmonat', 'required');
		    $this->form_validation->set_rules('DatumBeginjahr', 'DatumBeginjahr', 'required');
		    $this->form_validation->set_rules('DatumEndetag', 'DatumEndetag', 'required');
		    $this->form_validation->set_rules('DatumEndemonat', 'DatumEndemonat', 'required');
		    $this->form_validation->set_rules('DatumEndejahr', 'DatumEndejahr', 'required');
		    $this->form_validation->set_rules('MaxTeilnehmer', 'MaxTeilnehmer', 'required');
		    $this->form_validation->set_rules('Leistung', 'Leistung');
		    $this->form_validation->set_rules('TeilnehmerBeitrag', 'TeilnehmerBeitrag', 'required');
		    $this->form_validation->set_rules('Besonderheiten', 'Besonderheiten');
	    }
		if ($this->form_validation->run() == FALSE)
		{
			//load the content variables
	 		$this->layout_data['content'] = $this->load->view('form/veranstaltung', $data, true); //Welches Content File geladen werden soll 
			$this->load->view('main', $this->layout_data);
		}
		else
		{
			//load the content variables
 			$this->layout_data['content'] = $this->load->view('form/erfolg', NULL, true); //Welches Content File geladen werden soll 
			$this->load->view('main', $this->layout_data);
		}
	}
	
	function datenErfolg()
	{
		$this->layout_data['content'] = $this->load->view('form/erfolg', NULL, true); //Welches Content File geladen werden soll 
		$this->load->view('main', $this->layout_data);
	
	} 
	
	function formularKreisverband()
	{//load the content variables
		$this->layout_data['content'] = $this->load->view('form/veranstaltung', $data, true); //Welches Content File geladen werden soll 
			
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