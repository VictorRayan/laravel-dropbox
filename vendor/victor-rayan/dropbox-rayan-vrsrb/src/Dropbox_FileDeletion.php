<?php

namespace VictorRayan\DropboxRayanVrsrb;

class Dropbox_FileDeletion{



    public function delete($filepath){

        $access_token = (new Dropbox_OAuthAccessToken)->getToken();

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://api.dropboxapi.com/2/files/delete_v2');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"path\":\"$filepath\"}");

		$headers = array();
		$headers[] = "Authorization: Bearer $access_token";
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);

        if(!$result==null && json_decode($result)){
            return true;
        }
        else{
            return false;
        }


        
    }
}


?>