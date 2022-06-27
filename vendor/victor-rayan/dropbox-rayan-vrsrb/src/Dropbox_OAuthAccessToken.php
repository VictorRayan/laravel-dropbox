<?php

namespace VictorRayan\DropboxRayanVrsrb;

class Dropbox_OAuthAccessToken{

    public function getToken(){

        $app_key = (new getEnvDropboxTokens)->app_key();
        $app_secret = (new getEnvDropboxTokens)->app_secret();
        $app_refresh_token = (new getEnvDropboxTokens)->app_refresh_token();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.dropbox.com/oauth2/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=refresh_token&refresh_token=$app_refresh_token");
        curl_setopt($ch, CURLOPT_USERPWD, "$app_key" . ':' . "$app_secret");

        $headers = array();
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $results_json = json_decode($result, true);
    
        $access_token = $results_json['access_token'];

        return $access_token;


    }

}






?>