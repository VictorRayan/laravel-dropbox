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
<p>According with oficial <a href="https://laravel.com/docs/9.x/filesystem#custom-filesystems"> Laravel Filesystem Documentation </a> to do a Custom filesystem we need to retrieve with PHP Composer dropbox dependecies maintained by community. In this Custom Filesystem article has the half of work to do. But to make this completelly you will follow the follwing steps:</p>

 <ul>
  <li>Create a laravel project with Composer.</li>
  <li>Get needed Dropbox dependencies and libraries with Composer.</li>
  <li>Configure the Service Provider to runs Dropbox service (paste te AppServiceProvider source code from Custom Filesystem article from Laravel Documentation).</li>
  <li>Create a driver in framework filesystem: <strong>config>filesystems.php</strong>.
  At same time define a new attribute named "authorization_token" to get the env var talked about ahead.</li>
  <li>Create an app in <a href="https://www.dropbox.com/developers/apps">Dropbox Developers</a> and generate an Access Token, afet set all permissions of <strong>Files and Folders</strong> in "Permissions" tab.</li>
  <li>Set up the Dropbox Access Token envinroment variavel in <strong>.env</strong> file with gotten token.</li>
  <li>Create a test Route in <strong>routes>web.php</strong> to do any operation inside Dropbox through Laravel.</li>
 </ul>
  
  ### If you prefer you can just to clone this repository and adapt to your needs.
##
##
## Step by Step
  ### 1 - Create a laravel project:
  ```
    composer create-project --prefer-dist laravel/laravel laravel-dropbox
  ```
  
  ### 2 - Getting needed Dropbox dependencies with Composer
  ```
    composer require spatie/flysystem-dropbox
  ```
  
  ### 3 - Take sure of leave your AppServiceProvider in app>Providers>AppServiceProvider.php in this way:
  ```
    <?php
 
namespace App\Providers;
 
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;
 
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
 
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('dropbox', function ($app, $config) {
            $adapter = new DropboxAdapter(new DropboxClient(
                $config['authorization_token']
            ));
 
            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
    }
}
  ```
    
    
### 4 - Add the following Dropbox driver to filesystems (config>filesystems.php):
  ```
    'dropbox' =>[
            'driver' => 'dropbox',
            'authorization_token' => env('DROPBOX_ACCESS_TOKEN'),
        ]

  ```
  <p>Notice that already has added the line to get the Dropbox Access Token from environment variables (authorization_toekn).
This will be used to AppServiceProvider retrieve this value and make a POST request to Dropbox domain with operations paramters.</p>


### 5 - Follow to Dropbox Developers, create your app (the API), set up the permissions and Generate an Acccess Token:
<p  align="center"><a href="https://www.dropbox.com/developers/apps/">https://www.dropbox.com/developers/apps/<a></p>
  

### 6 - Set the DROPBOX_ACCESS_TOKEN environment variable in .env:
    
        DROPBOX_ACCESS_TOKEN=Your_gotten_token_here_without_quotes
    

### 7 - Creating a test Route that does a "make directory" or mkdir command through Storage API using the dropbox driver to perform a folder creation request fro Dropbox in POST, but the Route don't need to be of type POST, because se Dropbox request submittion is made internally by framework, and that is why don't need to put a CSRF pretection.
  
  ```
  use Illuminate\Support\Facades\Storage;
  
  /*
  *
  *
  *
  */
  
  Route::get('/dropbox-mkdir', 'function(){
      if(Storage::disk('dropbox')->makeDirectory("MY_DIR_NAME")){
          dd("Directory created sucessfully in Dropbox!!!");
      }
      else{
          dd("Oh Fuck! More Problems!!! :^(");
      }
  }');
  ```
  <p>Notice that this route will invoke the Storage class, invoke the disk() method to tell what driver from filesystems.php will be used, in our case the 'dropbox'. And after sequentially invoking a method to make a directory, ie, its will get the all needed atributes through these methods to build a POST request inside framework and sent it to Dropbox with Authentication token joinned to grant the permission for request be answered.</p>
  
  ### 8 - Run the application and test it!
  ```
  php arisan serve

  https://localhost:8000/dropbox-mkdir
  ```
##
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
