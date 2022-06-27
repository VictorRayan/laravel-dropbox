<?php 

namespace VictorRayan\DropboxRayanVrsrb;

class Dropbox_FileUpload{

    public function upload($filepath_origin, $filepath_dest){

        $access_token = (new Dropbox_OAuthAccessToken)->getToken();
		$fp = fopen($filepath_origin, 'rb');
		$size = filesize($filepath_origin);
        $extension = pathinfo($filepath_origin, PATHINFO_EXTENSION);
        $full_filepath = $filepath_dest.hash('sha256',hash_file('sha256', $filepath_origin).$filepath_origin).".$extension";



		$cheaders = array("Authorization: Bearer $access_token",
						'Content-Type: application/octet-stream',
						'Dropbox-API-Arg: {"path":"'.$full_filepath.'", "mode":"add"}');

		$ch = curl_init('https://content.dropboxapi.com/2/files/upload');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $cheaders);
		curl_setopt($ch, CURLOPT_PUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_INFILE, $fp);
		curl_setopt($ch, CURLOPT_INFILESIZE, $size);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		fclose($fp);

        if(!$response==null && json_decode($response)){
            return $full_filepath;
        }
        else{
            return null;
        }
        
    }



}




?>
