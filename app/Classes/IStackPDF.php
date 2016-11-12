<?php

namespace App\Classes;

use App\Template;

use Illuminate\Http\Request;

use PDF;

/**
 * Contains the business logic for PDF.
 */
class IStackPDF 
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
     * @param integer $templateId
     * @return array
     */
    public static function generatePDF($templateId)
    {
        $templateInfo      = Template::where('id', $templateId)->first();
        $filename          = $templateInfo->name.'.pdf';
        $fullpath_filename = env('DOWNLOADS_PATH').$filename;
        $pdf               = PDF::loadView('template', ['message' => $templateInfo->message])->setPaper('a4', 'landscape');
        $pdf->save($fullpath_filename);

        return [
            'full_path_filename' => $fullpath_filename,
            'filename'           => $filename
        ];
    }
}
