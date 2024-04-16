<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;

class ConfigurationController extends Controller
{
    public function showConfigurationPage()
    {
        return view('configure');        
    }

    public function showDocPage()
    {
        return view('doc');        
    }

    public function saveConfiguration(Request $request)
    {
        if ($request != null){
            $envData = [
                'APP_NAME' => $request->input('app_name') == 'null' ? null : '"' . $request->input('app_name') . '"',
                'APP_ENV' => $request->input('app_env') == 'null' ? null : $request->input('app_env'),
                'APP_KEY' => 'base64:I40sCfNTfxMKCHcSNO9uQx/FWCwsZ+bg1SgPbJ8Pd4g=' == 'null' ? null : 'base64:I40sCfNTfxMKCHcSNO9uQx/FWCwsZ+bg1SgPbJ8Pd4g=',
                'APP_DEBUG' => $request->input('app_debug') ? 'true' : 'false',
                'APP_INSTALL' => 'false',
                'APP_URL' => $request->input('app_url') == 'null' ? null : '"' . $request->input('app_url') . '"' . "\n",
        
                'LOG_CHANNEL' => 'stack',
                'LOG_DEPRECATIONS_CHANNEL' => 'null',
                'LOG_LEVEL' => 'debug' . "\n" . "\n",

                'DB_CONNECTION' => $request->input('db_connection') == 'null' ? null : $request->input('db_connection'),
                'DB_HOST' => $request->input('db_host') == 'null' ? null : $request->input('db_host'),
                'DB_PORT' => $request->input('db_port') == 'null' ? null : $request->input('db_port'),
                'DB_DATABASE' => $request->input('db_database') == 'null' ? null : $request->input('db_database'),
                'DB_USERNAME' => $request->input('db_username') == 'null' ? null : $request->input('db_username'),
                'DB_PASSWORD' => $request->input('db_password') == 'null' ? null . "\n" . "\n" : $request->input('db_password') . "\n" . "\n",                
           
                'BROADCAST_DRIVER' => 'log',
                'CACHE_DRIVER' => 'file',
                'FILESYSTEM_DISK' => 'local',
                'QUEUE_CONNECTION' => 'sync',
                'SESSION_DRIVER' => 'file',
                'SESSION_LIFETIME' => '120' . "\n",                
           
                'MEMCACHED_HOST' => '127.0.0.1' . "\n",
                                
                'REDIS_HOST' => '127.0.0.1',
                'REDIS_PASSWORD' => env(key: 'REDIS_PASSWORD') == null ? null : '"' . env(key: 'REDIS_PASSWORD') . '"',
                'REDIS_PORT' => '6379' . "\n" . "\n",

                
                'MAIL_MAILER' => $request->input('mail_protocol') == 'null' ? null : $request->input('mail_protocol'),
                'MAIL_HOST' => $request->input('mail_host') == 'null' ? null : $request->input('mail_host'),
                'MAIL_PORT' => $request->input('mail_port') == 'null' ? null : $request->input('mail_port'),
                'MAIL_USERNAME' => $request->input('mail_username') == 'null' ? null : '"' . $request->input('mail_username') . '"',
                'MAIL_PASSWORD' => $request->input('mail_password') == 'null' ? null : '"' . $request->input('mail_password') . '"',
                'MAIL_ENCRYPTION' => $request->input('mail_encryption') == 'null' ? null : $request->input('mail_encryption'),
                'MAIL_FROM_ADDRESS' => $request->input('mail_from_address') == 'null' ? null : '"' . $request->input('mail_from_address') . '"',
                'MAIL_FROM_NAME' => '"${APP_NAME}"' . "\n" . "\n",

                
                'AWS_ACCESS_KEY_ID' => env(key: 'AWS_ACCESS_KEY_ID') == null ? null : env(key: 'AWS_ACCESS_KEY_ID'),
                'AWS_SECRET_ACCESS_KEY' => env(key: 'AWS_SECRET_ACCESS_KEY') == null ? null : env(key: 'AWS_SECRET_ACCESS_KEY'),
                'AWS_DEFAULT_REGION' => env(key: 'AWS_BUCKET') == null ? 'us-east-1' : env(key: 'AWS_BUCKET'),
                'AWS_BUCKET' => env(key: 'AWS_BUCKET') == null ? null : env(key: 'AWS_BUCKET'),
                'AWS_USE_PATH_STYLE_ENDPOINT' => 'false' . "\n" . "\n",

                
                'PUSHER_APP_ID' => null,
                'PUSHER_APP_KEY' => '""',
                'PUSHER_APP_SECRET' => '""',
                'PUSHER_HOST' => '',
                'PUSHER_PORT' => '443',
                'PUSHER_SCHEME' => 'https',
                'PUSHER_APP_CLUSTER' => 'mt1' . "\n" . "\n",

                
                'VITE_APP_NAME' => '"${APP_NAME}"',

                

                'VITE_PUSHER_APP_KEY' => '"${PUSHER_APP_KEY}"',
                'VITE_PUSHER_HOST' => '"${PUSHER_HOST}"',
                'VITE_PUSHER_PORT' => '"${PUSHER_PORT}"',
                'VITE_PUSHER_SCHEME' => '"${PUSHER_SCHEME}"',
                'VITE_PUSHER_APP_CLUSTER' => '"${PUSHER_APP_CLUSTER}"', 

            ];
    


            



            // Generate the new .env file
            $envFile = base_path('.env');
            $contents = "";
            foreach ($envData as $key => $value) {
                $contents .= "$key=$value\n";
            }
            file_put_contents($envFile, $contents);
    
            // Clear the configuration cache
            Artisan::call('config:clear');
    
            return Redirect::to('/');

        }else{
            return redirect('/configure');
           
        }
    }
}