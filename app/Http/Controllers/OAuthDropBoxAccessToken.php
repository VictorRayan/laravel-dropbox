<?php

    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Storage;

    class OAuthDropBoxAccessToken extends Controller{


        public function requestToken(){

            $app_key = env('DROPBOX_APP_KEY');
            $app_secret = env('DROPBOX_APP_SECRET');
            $auth_token = env('DROPBOX_AUTH_TOKEN');


            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.dropbox.com/oauth2/token');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=refresh_token&refresh_token=$auth_token");
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

            $_ENV["DROPBOX_ACCESS_TOKEN"]=$access_token;
            
        }
    }

?>