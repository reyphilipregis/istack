<?php

namespace App\Classes;

use Illuminate\Http\Request;

use Mail;

/**
 * Contains the business logic for Mail.
 */
class IStackMail
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
     * Static method that sends a an email with attachment.
     *
     * @param Request $request
     * @param string  $fullpath_filename
     * @return boolean
     */
    public static function sendMail(Request $request, $fullpath_filename)
    {
        try {
            Mail::send('email', [], function ($m) use ($request, $fullpath_filename) {
                $m->to($request->input('email'), $request->input('email'));
                $m->subject(env('APP_NAME').': Template attachment');
                $m->attach($fullpath_filename);
            });

            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
