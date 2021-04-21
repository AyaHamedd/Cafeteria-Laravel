<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
class ImageController extends Controller
{
    //
public function upload(Request $request){
            
            $request->validate([
               'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
            ]);
    
            $fileUpload = new User;
    
            if($request->file()) {
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
    
                // $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
                $fileUpload->avatar = '/storage/' . $file_path;
                $fileUpload->save();
    
                return response()->json(['success'=>'File uploaded successfully.']);
            }
       }
}