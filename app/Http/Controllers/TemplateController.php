<?php

namespace App\Http\Controllers;

use App\Classes\IStackDropBox;

use App\Classes\IStackMail;

use App\Classes\IStackPDF;

use App\Http\Requests;

use App\Template;

use File;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    protected $templateObj;

    /**
     * Constructor of the Template.
     *
     * @param  Template $template
     * @return void
     */
    public function __construct(Template $template)
    {
        $this->middleware('auth', []);

        $this->templateObj = $template;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->templateObj->orderBy('id','DESC')->get();
        return view('list',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'message' => 'required',
        ]);

        $this->templateObj->create($request->all());
        return redirect()->route('template.index')
                         ->with('success','Template created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->templateObj->find($id);
        return view('show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->templateObj->find($id);
        return view('edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'    => 'required',
            'message' => 'required',
        ]);

        $this->templateObj->find($id)->update($request->all());
        return redirect()->route('template.index')
                         ->with('success','Template updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->templateObj->find($id)->delete();
        return redirect()->route('template.index')
                         ->with('success','Template deleted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generate($id)
    {
        $item = $this->templateObj->find($id);
        return view('generate', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Request $request)
    {
        // validate inputs
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        try {
            // generate to PDF
            $filenameArray = IStackPDF::generatePDF($request->input('id'));

            // send the template as attachment to the email
            IStackMail::sendMail($request, $filenameArray['full_path_filename']);

            // upload the PDF file to Dropbox
            IStackDropBox::upload($filenameArray);

            // delete the pdf file in downloads directory
            File::delete($filenameArray['full_path_filename']);

            // display success message
            return redirect()->route('template.index')
                             ->with('success', 'Template generated successfully');
        } catch (\Exception $e) {
            return redirect()->route('template.index')
                             ->with('error', $e->getMessage());
        }
    }


}
