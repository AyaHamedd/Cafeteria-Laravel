<?php

namespace App\Http\Controllers;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Room; 
use Illuminate\Support\Facades\Hash;
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
       $users=User::where('is_admin','=',0)->with('room')->paginate(2);
    //    dd($users);
    //    $users = User::where('is_admin', '=', 0)->paginate(3);
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
        $request->validate([
            'name' => ['required'], 
            'email' => ['required', 'email', 'unique:users'],
            'password'=>['required', 'min:8'],
            'confirm_password'=>'required|same:password',
            'avatar' => ['required'],
            'room_id' => ['required']
        ]);
             User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>Hash::make($request->password),
            'avatar' => $request->avatar,
            'room_id' => $request->room_id
        ]);
      
        // $user = new User();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password =Hash::make($request->password);
        // $user->avatar = $request->avatar;
        // $user->room_id=$request->room_id;
        // $user->save();
// $input = $request->all();  
// if ($image = $request->file('avatar')) {
//     $destinationPath = 'storage/avatars/';
//     $profileImage = 'storage/avatars/'.$request->file('avatar')->getClientOriginalName(); 
//     $image->move($destinationPath, $profileImage);
//     $input['avatar'] = "$profileImage";
// }

// $add = User::create($input);
// dd($add);
//   if ($add){
//     return response()->json(["is_done"=>true]);
//   }else{
//     return response()->json(["is_done"=>false]);

    
//     }
}

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

 $req->validate([
            'name' => ['required'], 
            'email' => ['required' ,'email'], 
            'avatar' => ['required'],
            'room_id' => ['required']
        ]);
      
        $user = User::find($id);
 
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = $req->password;
        $user->avatar = $req->avatar;
        $user->room_id = $req->room_id;
        $user->save();
        // return response()->json('user updated');
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
