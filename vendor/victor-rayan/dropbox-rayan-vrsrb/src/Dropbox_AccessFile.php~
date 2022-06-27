<?php

namespace VictorRayan\DropboxRayanVrsrb;

class Dropbox_AccessFile{

    public function getTemporaryLink($filepath){
        $access_token = (new Dropbox_OAuthAccessToken)->getToken();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.dropboxapi.com/2/files/get_temporary_link');
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

        if(!$result==null && json_encode($result)){
            $result_json = json_decode($result, true);
            $link = $result_json["link"];
            return $link;
        }
        else{
            return null;
        }

        
    }
}