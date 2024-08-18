<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProyekModel extends CI_Model {
	private $apiUrl = 'https://seibackend-tygxutnacq-et.a.run.app/proyek';

    public function getProjects() {
        $this->load->library('curl');
        $response = $this->curl->simple_get($this->apiUrl);
        return json_decode($response, true);
    }

    public function insertProject($data, $lokasiIds) {
        $this->load->library('curl');
        $response = $this->curl->simple_post($this->apiUrl.'?lokasiIds='.$lokasiIds, json_encode($data), array(CURLOPT_HTTPHEADER => array('Content-Type: application/json')));
        return $response;
    }

    public function updateProject($id, $data) {
        $this->load->library('curl');
		$jsondata = array(
			'namaProyek' => $data['namaProyek'],
            'client' => $data['client'],
            'tglMulai' => $data['tglMulai'],
            'tglSelesai' => $data['tglSelesai'],
            'pimpinanProyek' => $data['pimpinanProyek'],
            'keterangan' => $data['keterangan'],
		);
        $this->curl->simple_put($this->apiUrl.'/'.$id.'?lokasiIds='.$data['lokasiList'], json_encode($jsondata), array(CURLOPT_HTTPHEADER => array('Content-Type: application/json')));
    }

    public function deleteProject($id) {
        $this->load->library('curl');
        $this->curl->simple_delete($this->apiUrl.'/'.$id);
    }

    public function getProjectById($id) {
        $this->load->library('curl');
        $response = $this->curl->simple_get($this->apiUrl);
        $projects = json_decode($response, true);
        $filteredProjects = array_filter($projects, function($project) use ($id) {
            return $project['id'] == $id;
        });
        return !empty($filteredProjects) ? array_shift($filteredProjects) : null;
    }
}
