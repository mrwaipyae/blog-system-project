<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Messages;

class PagesController extends Controller
{
    //
    public function index()
    {
        return view('pageIndex');
    }

    // Upload CkEditor file
    public function uploadFile(Request $request)
    {

        $data = array();

        $validator = Validator::make($request->all(), [
            'upload' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {

            $data['uploaded'] = 0;
            $data['error']['message'] = $validator->errors()->first('upload'); // Error response

        } else {
            if ($request->file('upload')) {

                $file = $request->file('upload');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // File path
                $filepath = url('uploads/' . $filename);

                // Response
                $data['fileName'] = $filename;
                $data['uploaded'] = 1;
                $data['url'] = $filepath;
            } else {
                // Response
                $data['uploaded'] = 0;
                $data['error']['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);
    }

    // Submit form
    public function submitform(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        } else {
            // Insert record
            Messages::create([
                'subject' => $request->subject,
                'message' => $request->message
            ]);

            Session::flash('message', 'Form submit Successfully.');
        }

        return redirect('/');
    }
}
