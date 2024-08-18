<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LokasiModel extends CI_Model {
    private $apiUrl = 'https://seibackend-tygxutnacq-et.a.run.app/lokasi';

    public function getLocations() {
        $this->load->library('curl');
        $response = $this->curl->simple_get($this->apiUrl);
        return json_decode($response, true);
    }

    public function insertLocation($data) {
        $this->load->library('curl');
        $this->curl->simple_post($this->apiUrl, json_encode($data), array(CURLOPT_HTTPHEADER => array('Content-Type: application/json')));
    }

    public function updateLocation($id, $data) {
		$this->load->library('curl');
		$url = $this->apiUrl . '/' . $id;
		$this->curl->simple_put($url, json_encode($data), array(CURLOPT_HTTPHEADER => array('Content-Type: application/json')));
	}	

    public function deleteLocation($id) {
        $this->load->library('curl');
        $this->curl->simple_delete($this->apiUrl.'/'.$id);
    }

    public function getLocationById($id) {
        $this->load->library('curl');
        $response = $this->curl->simple_get($this->apiUrl);
        $locations = json_decode($response, true);
        $filteredLocations = array_filter($locations, function($location) use ($id) {
            return $location['id'] == $id;
        });
        return !empty($filteredLocations) ? array_shift($filteredLocations) : null;
    }
}
