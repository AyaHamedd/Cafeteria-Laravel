<?php

namespace App\Http\Controllers;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Str;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $users=User::all();
        // return response()->json( $rooms);
         return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    //     $users= User::all();
    //     return response()->json('user created');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */

  
    public function store(Request $request)
    {
        
      
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->avatar = $request->avatar;
        // $user->room_id=$request->room_id;
        // $user->save();
$input = $request->all();  
if ($image = $request->file('avatar')) {
    $destinationPath = 'storage/avatars/';
    $profileImage = 'storage/avatars/'.$request->file('avatar')->getClientOriginalName(); 
    $image->move($destinationPath, $profileImage);
    $input['avatar'] = "$profileImage";
}

$add = User::create($input);
dd($add);
  if ($add){
    return response()->json(["is_done"=>true]);
  }else{
    return response()->json(["is_done"=>false]);

    
    }}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function update($id, Request $req)
    {


      
        $user = User::find($id);
    $input = $user->all();  
if ($image = $user->file('avatar')) {
    $destinationPath = 'storage/avatars/';
    $profileImage = 'storage/avatars/'.$user->file('avatar')->getClientOriginalName(); 
    $image->move($destinationPath, $profileImage);
    $input['avatar'] = "$profileImage";
}
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = $req->password;
        $user->avatar = $input['avatar'];
        $user->room_id = $req->room_id;
        $user->save();
        return response()->json('user updated');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $user=User::find($id);
        $user->delete();
        return response()->json('User deleted');
    }

  
}
