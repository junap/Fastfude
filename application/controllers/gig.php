<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gig extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// $this->output->enable_profiler(TRUE);
		$this->load->model('Gig_model');
	}

	function upcoming()
	{
		$this->load->model('Forum_model');
		$this->load->helper('date');

		$data['forums'] = $this->Forum_model->getForums();
		$data['title'] = $data['forums'][8];
		$data['calendar'] = $this->Gig_model->getUpcomingGigs();

		$this->load->view('gig/upcoming', $data);
	}

	/**
	 * Gigs happening on a given date
	 *
	 * @param string $date 
	 * @return void
	 * @author Roger Herbert
	 */
	public function on($date)
	{
		// topics by date created
		if (!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $date)) {
			show_error('Bad gig date');
		}

		$this->load->model('Forum_model');

		$data['title'] = 'Gigs on '. $date;
		$data['forums'] = $this->Forum_model->getForums();
		$data['gigs'] = $this->Gig_model->getGigsByDate($date);

		$this->load->view('gig/on', $data);
	}

	public function create()
	{
		if (!$this->session->userdata('user_id')) 
		{
			redirect('user/sign_in');
		}
	
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('start_time_1', 'Date', 'trim|required|callback_valid_date');
		$this->form_validation->set_rules('start_time_2', 'Time', 'trim|required|callback_valid_time');
		$this->form_validation->set_rules('location', 'Venue', 'trim|required');
		$this->form_validation->set_rules('lineup', 'Lineup', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('subject', 'Topic Subject', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('post_text', 'Post Text', 'trim|required|min_length[30]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['title'] = 'Create A Gig';
			$this->load->view('gig/create', $data);
		}
		else
		{
			$topic_id = $this->Topic_model->addTopic(8, $this->session->userdata('user_id'), $this->input->post('subject'), $this->input->post('post_text'));
			$start_time = $this->input->post('start_time_1') . " " . $this->input->post('start_time_2') . ":00";

			$this->Gig_model->addGig($topic_id, $start_time, $title, $this->input->post('location'), '', $lineup);

			redirect('/');
		}
	}
	
	public function valid_date($str)
	{
		if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $str)) {

			$segments = explode('-', $str);

			if (checkdate($segments[1], $segments[2], $segments[0]) && 
				strtotime('midnight') <= strtotime($str)) {
				return TRUE;
			}
		}

		$this->form_validation->set_message('valid_date', 'The %s field should be a near-future date in the format yyyy-mm-dd');
		return FALSE;
	}

	public function valid_time($str)
	{
		if (!preg_match('/^[0-9]{1,2}:[0-9]{2}$/', $str)) {
			$this->form_validation->set_message('valid_time', 'The %s field should be a time in the format hh:mm');
			return FALSE;
		}

		return TRUE;
	}
}

/* End of file gig.php */
/* Location: ./application/controllers/gig.php */