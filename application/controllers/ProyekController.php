<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProyekController extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('ProyekModel');
        $this->load->model('LokasiModel');
		$this->load->helper('url');
    }

    public function index() {
        $data['projects'] = $this->ProyekModel->getProjects();
		$data['lokasi'] = $this->LokasiModel->getLocations();
        $this->load->view('home', $data);
    }

	public function add() {
        $namaProyek = $this->input->post('namaProyek');
        $client = $this->input->post('client');
        $tglMulai = $this->input->post('tglMulai');
        $tglSelesai = $this->input->post('tglSelesai');
        $pimpinanProyek = $this->input->post('pimpinanProyek');
        $keterangan = $this->input->post('keterangan');
        $lokasiList = $this->input->post('lokasiList'); // Array of selected location IDs
        
        // Process the data and interact with your API
        // Example of interacting with your API
        $apiData = array(
            'namaProyek' => $namaProyek,
            'client' => $client,
            'tglMulai' => $tglMulai,
            'tglSelesai' => $tglSelesai,
            'pimpinanProyek' => $pimpinanProyek,
            'keterangan' => $keterangan,
        );
        
        // You might have a method in your model or service to handle API interaction
        $this->ProyekModel->insertProject($apiData, $lokasiList);
        
        // Redirect or load a view as needed
        redirect('/');
    }

    public function edit() {
        $id = $this->input->post('id');
        $data = $this->input->post();
        unset($data['id']);
        $this->ProyekModel->updateProject($id, $data);
        redirect('/');
    }

    public function delete() {
        $id = $this->input->post('id');
        $this->ProyekModel->deleteProject($id);
        redirect('/');
    }

    // public function create() {
    //     if ($this->input->post()) {
    //         $data = array(
    //             'name' => $this->input->post('name'),
    //             'location_id' => $this->input->post('location_id'),
    //             'description' => $this->input->post('description')
    //         );
    //         $this->ProyekModel->insertProject($data);
    //         redirect('ProyekController');
    //     } else {
    //         $this->load->view('proyek/create');
    //     }
    // }

    // public function edit($id) {
    //     $data['project'] = $this->ProyekModel->getProjectById($id);
    //     if ($this->input->post()) {
    //         $data = array(
    //             'name' => $this->input->post('name'),
    //             'location_id' => $this->input->post('location_id'),
    //             'description' => $this->input->post('description')
    //         );
    //         $this->ProyekModel->updateProject($id, $data);
    //         redirect('ProyekController');
    //     } else {
    //         $this->load->view('proyek/edit', $data);
    //     }
    // }

    // public function delete($id) {
    //     $this->ProyekModel->deleteProject($id);
    //     redirect('ProyekController');
    // }
}
