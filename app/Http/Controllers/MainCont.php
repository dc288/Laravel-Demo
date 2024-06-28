<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MainCont extends Controller
{
    public function log(){
        $url=url('/')."/";
        $data=compact("url");
        return view("layout.log",$data);
    }
    public function val(Request $request){
        session()->put("submit","yes");
        if($request['username']=="user" && $request['password']=='123'){
            session()->put('username', 'user');
            session()->put('password', '123');
            return redirect()->route('home');
        }
        else{
            return back()->with('error','Invalid username or password');
        }
    }
    public function logout(){
        session()->flush();
        return redirect()->route('log');
    }
     public function index(){
        $x="val2";
        $m=Customer::all();
        $data=compact("m",'x');
        return view("layout.details", $data);
    }

    public function form(){
        $url=url('/')."/form";
        $fi=null;
        $title="Add Details";
        $data=compact("title",'fi','url');
        return view("layout.form", $data);
    }
    public function sub(Request $request){
        $request->validate(
            [
                "firstname"=> ["required",'regex:/^[a-zA-Z\s]+$/'],
                "lastname"=> ["required",'regex:/^[a-zA-Z\s]+$/'],
                "email"=>["required","email"],
                "address"=> ["required",'regex:/^[a-zA-Z\s]+$/'],
                'phoneno'=> ['required','numeric','digits:10'],
                'dob'=> ['required'],
                'gender'=> ['required'],
                'fileToUpload'=> 'required|mimes:pdf'
            ]
        );
        if ($request->file('fileToUpload')->isValid()) {
            $file = $request->file('fileToUpload');
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('pdfs', $fileName, 'public');
        $f=new Customer();
        $f->firstname = $request['firstname'];
        $f->lastname = $request['lastname'];
        $f->email = $request['email'];
        $f->phoneno = $request['phoneno'];
        $f->address = $request['address'];
        $f->dob = $request['dob'];
       $f->age = Carbon::parse($request['dob'])->age;

        $f->Gender = $request['gender'];
        $f->pdf = $filePath;
        $f->save();
        }
return redirect()->route('home');   }
public function show($id)
    {
        $file = Customer::findOrFail($id);

        // Ensure file exists
        if (Storage::exists('public/'.$file->pdf)) {
            $filePath = storage_path('app/public/' . $file->pdf);

            // Set headers for PDF file
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
                'Content-Transfer-Encoding' => 'binary',
                'Accept-Ranges' => 'bytes',
            ];

            // Output the PDF file
            return response()->file($filePath, $headers);
        } else {
            abort(404, 'File not found.');
        }
    }
    public function delete($id){
        $file = Customer::find($id);
        if(!is_null($file)){
            Storage::delete('public/'.$file->pdf);
            $file->delete();
        }
        return redirect()->route('home');
    }
    public function edit($id) {
        $url = url('/form/update/'.$id);
        $fi = Customer::find($id);
        $title = "Update Details";
        $data = compact('fi', 'title', 'url');
        return view('layout.form', $data);
    }

    public function update(Request $request, $id){
        $f = Customer::find($id);
        $request->validate(
            [
                "firstname"=> ["required",'regex:/^[a-zA-Z\s]+$/'],
                "lastname"=> ["required",'regex:/^[a-zA-Z\s]+$/'],
                "email"=>["required","email"],
                "address"=> ["required",'regex:/^[a-zA-Z\s]+$/'],
                'phoneno'=> ['required','numeric','digits:10'],
                'dob'=> ['required','date'],
                'gender'=> ['required'],
                'fileToUpload'=> 'mimes:pdf'
            ]
        );
        if($request->file('fileToUpload')){if ($request->file('fileToUpload')->isValid()) {
            $file = $request->file('fileToUpload');
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $file->storeAs('pdfs', $fileName, 'public');
            Storage::delete('public/'.$f->pdf);
            $f->pdf = $filePath;}}
        $f->firstname = $request['firstname'];
        $f->lastname = $request['lastname'];
        $f->email = $request['email'];
        $f->phoneno = $request['phoneno'];
        $f->address = $request['address'];
        $f->age = Carbon::parse($request['dob'])->age;
        $f->dob = $request['dob'];
        $f->Gender = $request['gender'];
        $f->save();
        return redirect()->route('home');
    }
}
