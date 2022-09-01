<?php

namespace LdTalent\Pwa\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class PublishPwaAssets extends Command
{
	
	/**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'pwa-laravel:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Service Worker|Offline HTMl|manifest file for PWA application.';

    public $composer;
	
    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        /**Get the composer instance from the application container.
         * Set it to the composer public property of this class
         */
        $this->composer = app()['composer'];
    }
	
    public function handle()
    {

        /** Get the public directory of a laravel application*/
        $publicDir = public_path();
        
        /** Get the manifest template from manifest.stub file*/
        $manifestTemplate = file_get_contents(__DIR__.'/../Stubs/manifest.stub');

        /** Create a manifest.json file in the application's public directory*/
        $this->createFile($publicDir. DIRECTORY_SEPARATOR, 'manifest.json', $manifestTemplate);

        /** Notify the user with the results of the operation.*/
        $this->info('manifest.json file is published.');
        
        /** Get the offline template from offline.stub file*/
        $offlineHtmlTemplate = file_get_contents(__DIR__.'/../Stubs/offline.stub');

        /** Create a offline.html file in the application's public directory*/
        $this->createFile($publicDir. DIRECTORY_SEPARATOR, 'offline.html', $offlineHtmlTemplate);

        /** Notify the user with the results of the operation.*/
        $this->info('offline.html file is published.');     
        
        /** Get the sw template from sw.stub file*/
        $swTemplate = file_get_contents(__DIR__.'/../Stubs/sw.stub');

        /** Create a sw.js file in the application's public directory*/
        $this->createFile($publicDir. DIRECTORY_SEPARATOR, 'sw.js', $swTemplate);

        /** Notify the user with the results of the operation.*/
        $this->info('sw.js (Service Worker) file is published.');     

        /**Run the composer method below to regenerate the list of all classes 
         * that need to be included in the project
         * */
        $this->info('Generating autoload files');
        $this->composer->dumpOptimized();

        $this->info('Greeting!.. Enjoy your pwa laravel app...');

    }

    
    public static function createFile($path, $fileName, $contents)
    {

        /**Check if a file exists in the public directory,
         * If not create that file and give is a public access permission.
         * Else, get the file existing and replace the contents with the new one.
         */
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }


        $path = $path.$fileName;

        file_put_contents($path, $contents);
        
    }

}