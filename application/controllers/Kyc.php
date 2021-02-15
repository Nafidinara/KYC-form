<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kyc extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("kycmodel");
		$this->load->library('form_validation');
		$this->load->helper(array('url','form','file'));
	}

	public function index()
	{
		$this->load->view("kycs/create");
	}

	public function store()
	{
		$kyc = $this->kycmodel;
		$validation = $this->form_validation;
		$validation->set_rules($kyc->rules());

		if ($validation->run()){
			$kyc->save();
			$this->session->set_flashdata('success', 'Berhasil disimpan');
		}else{
			$this->session->set_flashdata('error', "error");
		}

		redirect(site_url('/'));
	}

//	public function edit($id = null)
//	{
//		if (!isset($id)) redirect('kycs');
//
//		$kyc = $this->kycmodel;
//		$validation = $this->form_validation;
//		$validation->set_rules($kyc->rules());
//
//		if ($validation->run()) {
//			$kyc->update();
//			$this->session->set_flashdata('success', 'Berhasil disimpan');
//		}
//
//		$data["kyc"] = $kyc->getById($id);
//		if (!$data["kyc"]) show_404();
//
//		$this->load->view("kycs/edit", $data);
//	}
//
//	public function delete($id=null)
//	{
//		if (!isset($id)) show_404();
//
//		if ($this->kycmodel->delete($id)) {
//			redirect(site_url('kycs'));
//		}
//	}
}
