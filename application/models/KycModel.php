<?php defined('BASEPATH') OR exit('No direct script access allowed');
class KycModel extends CI_Model{

	private $_table = "kyc";

	public $no_ktp;
	public $foto_selfie;
	public $user_id;
	public $foto_ktp;
	public $id;

	public function rules()
	{
		return [
			['field' => 'no_ktp',
				'label' => 'Nomor Ktp',
				'rules' => 'required'],
		];
	}

	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["id" => $id])->row();
	}

	public function save()
	{
		$post = $this->input->post();
		$this->no_ktp = $post["no_ktp"];
		$this->user_id = $post["user_id"];
//		$this->product_id = uniqid();
		$this->foto_ktp = $this->_uploadImage('foto_ktp',$this->user_id);
		$this->foto_selfie = $this->_uploadImage('foto_selfie',$this->user_id);

		return $this->db->insert($this->_table, $this);
	}

//	public function update()
//	{
//		$post = $this->input->post();
////		$this->product_id = uniqid();
//		$this->foto_ktp = $post["foto_ktp"];
//		$this->foto_selfie = $post["foto_selfie"];
//		$this->no_ktp = $post["no_ktp"];
//		$this->user_id = $post["user_id"];
//		return $this->db->update($this->_table, $this, array('id' => $post['id']));
//	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array("id" => $id));
	}

	private function _uploadImage($param,$user_id)
	{
		$this->load->library('upload');
		if (!is_dir('uploads/kyc/'.$user_id)) {
			mkdir('./uploads/kyc/' . $user_id, 0777, TRUE);
		}

		$config['upload_path']          = './uploads/kyc/'.$user_id;
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['file_name']            = date("Y-m-d-H-i-s").'-'.md5($this->upload->data()['file_name']);
		$config['overwrite']			= true;
		$config['max_size']             = 1024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->upload->initialize($config);

		if ($this->upload->do_upload($param)) {
			return $this->upload->data("file_name");
		}

		echo $this->upload->display_errors().'<div>
<p><a href="'.base_url('/').'">back to upload kyc</p>
</div>';die();
		return "error";
	}
}

