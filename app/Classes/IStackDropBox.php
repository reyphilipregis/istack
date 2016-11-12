<?php

namespace App\Classes;

use Dropbox\Client;

use Dropbox\WriteMode;

use Illuminate\Http\Request;

use League\Flysystem\Dropbox\DropboxAdapter;

use League\Flysystem\Filesystem;

/**
 * Contains the business logic for DropBox.
 */
class IStackDropBox 
{
	/**
     * Constructor of the class.
     *
     * @return void
     */
	public function __construct() 
	{
		//
	}

    /**
     * Static method that generates a PDF file.
     *
     * @param array $filenameArray
     * @return array
     */
    public static function upload($filenameArray)
    {
        $Client          = new Client(env('DROPBOX_TOKEN'), env('DROPBOX_SECRET'));
        $file            = fopen($filenameArray['full_path_filename'], 'rb');
        $size            = filesize($filenameArray['full_path_filename']);
        $dropboxFileName = '/istack/'.$filenameArray['filename'];
        $Client->uploadFile($dropboxFileName, WriteMode::add(),$file, $size);
        $links['share']  = $Client->createShareableLink($dropboxFileName);
        $links['view']   = $Client->createTemporaryDirectLink($dropboxFileName);

        return $links;
    }
}
