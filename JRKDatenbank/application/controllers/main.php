<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class main extends CI_Controller {

	function index()
	 {
	 $base_url = base_url();
	 
	//what the nav needs
	 $navigation_data['navTab'] = "home";

	 
	 $this->load->model('model');

	 
 	 $body_data['1'] = "1asdasdasdads";
	 
	//load the content variables
	 $layout_data['content_navigation'] = $this->load->view('navigation', $navigation_data, true);
 	 $layout_data['content_body'] = $this->load->view('homePage', $body_data, true);
	 
	$this->load->view('main', $layout_data);
	 }
}
function base_url($uri = '')
{
	$CI =& get_instance();
	return $CI->config->base_url($uri);
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */