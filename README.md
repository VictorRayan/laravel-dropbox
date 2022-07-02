<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>
<a href="https://dropbox.com" target="_blank"><img src="https://www.logo.wine/a/logo/Dropbox_(service)/Dropbox_(service)-Logo.wine.svg" width="400"></a></p>

# Laravel filesystem integration with Dropbox

  ### Understanding what we want to do:
  <p>
    If you wish to store, change or delete files and folders inside a Dropbox account through a Laravel application automatically, 
    this tutorial will be useful for you.
    Now imagine if your case is that you have to deploy any Laravel application to ephemeral filesystem server, and you don't want to use Cloud such as Amazon S3 / Cloud, you can integrate your app to use Dropbox as your Storage.
  </p>

## How was this project made?
<p>This project has as base, the Composer library / dependencie <a href="https://github.com/VictorRayan/dropbox-rayan"><strong>victor-rayan/dropbox-rayan-vrsrb</strong></a> that is abstracted from Laravel Vendor layer to explore their objects to manage files in Dropbox via HTTP Curl requests. This library provides request methods, being them:</p>
<ul>
  <li>Upload
  <li>Delete
  <li>Get Access Token by Refresh Token</li>
  <li>Get file access (get file temporary link)</li>
</ul>

<li>A method that deserve more attention is Upload. Explining better this method, it will receive two parâmeters, such tal "destination path" in format ("/folder/folder/file.extension") to tell to Dropbox API what is the path to store the new file, and "filepath" that is responsible to carrying the local file path in the Laravel server. Is important to understand that is be necessary to use the Laravel filesystem to store temporary the file into server public storage the get their file path and send the file through Curl request using the file path.</li>
<br>
To See in more details the vendor library abstraction and the Laravel Storage use in Controller class FileManager.php


## Before execute this project, you need to add the following Environment Variables in .env file or in your server:

```
  DROPBOX_APP_KEY=Your app key
  DROPBOX_APP_SECRET=Your app secret
  DROPBOX_REFRESH_TOKEN=Your refresh token
```

## Where do I get these tokens?
<ul>
  <li>In first place, you must to access the your <a href="https://www.dropbox.com/developers/apps?_tk=pilot_lp&_ad=topbar4&_camp=myapps">App Console</a>, and create an app. After created your app, you should to see your <strong>App Key</strong>, and <strong>App Secret</strong>.</li>
  <li>To get the <strong>Refresh Token</strong> you can follow the <a href="https://www.dropbox.com/developers/documentation/http/documentation">Dropbox API HTTP Documentation</a> or execute the following URL into yout Browser. You must to get an Authorization Token that can be used once:<br><strong>https://www.dropbox.com/oauth2/authorize?client_id=<APP_KEY>&token_access_type=offline&response_type=code</strong><br></li>
     
   <li>Execute the following Curl Request into your Terminal, or translate this Curl to any programming language and get the your JSON output. You must to replace the GET paramaters with your correspondent velues, such as the Authoriation Token that you have obtained previously.:
       
         curl https://api.dropbox.com/oauth2/token \     -d grant_type=refresh_token \     -d refresh_token=<REFRESH_TOKEN> \     -u <APP_KEY>:<APP_SECRET>
         
   </li>
   <li>Take the "refresh_token" value from JSON output and put it into your DROPBOX_REFRESH_TOKEN environment variable.</li>
   
   ### Now you're ready to execute this project!
        
       
         
         
##
## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.


## License

The Laravel framework is open-sourced software licensed under the. As well as this project too. [MIT license](https://opensource.org/licenses/MIT).
