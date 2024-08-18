<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curl {
    
    public function simple_get($url, $params = array()) {
        $ch = curl_init();
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);

        $output = curl_exec($ch);
        
        if(curl_errno($ch)) {
            $output = 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);
        return $output;
    }

    public function simple_post($url, $data = '', $headers = array()) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $output = curl_exec($ch);
        
        if(curl_errno($ch)) {
            $output = 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);
        return $output;
    }

    public function simple_put($url, $data = '', $headers = array()) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		
		// Ensure $data is JSON encoded
		if (is_array($data)) {
			$data = json_encode($data);
		}
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	
		// Set headers if provided
		if (!empty($headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		} else {
			// Default to JSON content type if no headers are provided
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		}
	
		$output = curl_exec($ch);
	
		// Check for curl errors
		if (curl_errno($ch)) {
			$output = 'Curl error: ' . curl_error($ch);
		}
	
		curl_close($ch);
		return $output;
	}

    public function simple_delete($url, $headers = array()) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $output = curl_exec($ch);
        
        if(curl_errno($ch)) {
            $output = 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);
        return $output;
    }
}
