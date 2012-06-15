<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @Author: Lars Willrich
 */
class main extends CI_Controller {
	
	private $layout_data;
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->load->library('encrypt');
		$this->load->library('session');
	}
	
	private function isSessionValid(){
		if ((now() - $this->session->userdata('last_activity')) < 60 ) return 1;
		return 0;
	}
	
	
	//Funktion, welche zur nächsten Seite wechselt
	function changeWebsite($nextWebsite){
		
		//Anzeigen, die unabhängig vom Login angezeigt werden
		$this->layout_data['pageTitle'] = "JRK - Mitgliederverwaldung";
		$this->layout_data['header'] = $this->load->view('header',NULL,true);
		
		//Abfrage, ob Session gültig
		if ($this->isSessionValid() == 1){
			//Change Website
			$this->layout_data['navigation'] = $this->load->view('navigation',NULL,true);
			
			$this->session->set_userdata('last_activity', now());
			
			//Helper und Libraries laden
			$this->load->helper(array('form', 'url'));
			$this->load->helper('MY_user_helper');
			$this->load->library('form_validation');
			
			$userdaten['userform']=getuserformarray();

			$site = "";
			switch ($nextWebsite){
				case 'formular_user':
					
					//Mitglieder Forumlar
					//****************************************************
					$site = "form/user";
					$this->formularUser_ValidationRules();
					break;
					//****************************************************
					
					
				case 'formular_veranstaltungen':
					
					//Veranstaltung Forumlar
					//****************************************************
					$site = "form/veranstaltung";
					$userdaten['VeranstaltungID'] = "new";
					$this->load->model('vera_model');
					$this->form_validation->set_message('required', 'Das Feld %s ist erforderlich.');
					$this->formularVeranstaltung_ValidationRules();
					break;
					//****************************************************
					
					
				case 'formular_kreisverband':
					
					//Kreisverband Forumlar
					//****************************************************
					$site = "form/kreisverband";
					break;
					//****************************************************
					
					
				default:
					
					//Begrüßung Site
					//****************************************************
					$site = "overview";
					$this->load->model('model');
					break;
					//****************************************************
					
			}
			
			if ($this->form_validation->run() == FALSE){
				//load the content variables
				$this->layout_data['content'] = $this->load->view($site, $userdaten, true); 
			}
			else{
				//load the content variables
				$this->layout_data['content'] = $this->load->view('form/erfolg', NULL, true);
			}
			
			//Aufruf der Seite
			$this->load->view('main', $this->layout_data);
			
		}else{
			//Session ungültig
			//****************************************************
			
			//Überprüfung des Passwortes
			if ($this->input->post('username_pw') == "test"){
				$this->session->set_userdata('last_activity', now());
				$this->changeWebsite($nextWebsite);
				return;
			}
			
			//Login
			$this->layout_data['navigation'] = $this->load->view('clean',NULL,true);
			$this->layout_data['content'] = $this->load->view('/form/login', NULL, true); //Welches Content File geladen werden soll
			$this->load->view('main', $this->layout_data);
		}
	}
	
	function index()
	{
		$this->changeWebsite("overview");
	}

	private function formularUser_ValidationRules(){
		$this->form_validation->set_rules('Name', 'Name', 'required');
		$this->form_validation->set_rules('Vorname', 'Vorname', 'required');
	}
	private function formularVeranstaltung_ValidationRules(){
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
	private function formularKreisverband_ValidationRules(){
	
	}
	
	private function testdb()
	{
		$this->load->model('User_model');
		$this->load->model('Dbuser_model');
		$this->layout_data['content'] = $this->load->view('test_db', NULL, true); //Welches Content File geladen werden soll 
		$this->load->view('main', $this->layout_data);
	}
	
	
	private function datenErfolg()
	{
		$this->layout_data['content'] = $this->load->view('form/erfolg', NULL, true); //Welches Content File geladen werden soll
		$this->load->view('main', $this->layout_data);
	
	}
}

function base_url($uri = '')
{
	$CI =& get_instance();
	return $CI->config->base_url($uri);
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */