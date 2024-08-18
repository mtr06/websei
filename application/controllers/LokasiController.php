<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LokasiController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LokasiModel');
		$this->load->helper('url');
    }

    public function index() {
        $data['lokasi'] = $this->LokasiModel->getLocations();
        $this->load->view('home', $data);
    }

	public function add() {
        $data = $this->input->post();
		$data = array(
			'namaLokasi' => $this->input->post('namaLokasi'),
			'negara' => $this->input->post('negara'),
			'provinsi' => $this->input->post('provinsi'),
			'kota' => $this->input->post('kota')
		);
        $this->LokasiModel->insertLocation($data);
        redirect('/');
    }

    // public function edit() {
    //     $id = $this->input->post('id');
    //     $data = $this->input->post();
    //     unset($data['id']);
    //     $this->LokasiModel->updateLocation($id, $data);
    //     redirect('/');
    // }

    // public function delete() {
    //     $id = $this->input->post('id');
    //     $this->LokasiModel->deleteLocation($id);
    //     redirect('/');
    // }
    // public function create() {
    //     $this->load->view('lokasi/create');
    // }

    // public function store() {
    //     $data = $this->input->post();
    //     $this->LokasiModel->addLokasi($data);
    //     redirect('lokasi');
    // }

    // // public function edit($id) {
    // //     $data['lokasi'] = $this->LokasiModel->getLokasiById($id);
    // //     $this->load->view('lokasi/edit', $data);
    // // }

    // public function edit($id) {
    //     $data = $this->input->post();
    //     $this->LokasiModel->updateLokasi($id, $data);
    //     redirect('lokasi');
    // }

	public function edit() {
		$id = $this->input->post('id');
		$date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
		$data = array(
			'id' => $this->input->post('id'),
			'namaLokasi' => $this->input->post('namaLokasi'),
			'negara' => $this->input->post('negara'),
			'provinsi' => $this->input->post('provinsi'),
			'kota' => $this->input->post('kota'),
			'createAt' => $date->getTimestamp(),
		);
		$this->LokasiModel->updateLocation($id, $data);
		redirect('/');
	}

    // public function delete($id) {
    //     $this->LokasiModel->deleteLokasi($id);
    //     redirect('lokasi');
    // }
	public function delete() {
        $id = $this->input->post('id');
        $this->LokasiModel->deleteLocation($id);
        redirect('/');
    }
}
