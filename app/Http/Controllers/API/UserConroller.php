<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserConroller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('isAdmin');

        if(\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
            return User::latest()->paginate(5);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6'
        ]);
        //return ['massage'=>'I got your data'];
        //return $request->all();
        return User::create([
            'name' =>$request['name'],
            'email' =>$request['email'],
            'password' =>Hash::make($request['password']),
            'type' =>$request['type'],
            'bio' =>$request['bio'],
            'photo' =>$request['photo']
        ]);
    }

    public function profileInfo(){
        return auth('api')->user();
        //return Auth::User();
    }

    public function UpdateProInfo(Request $req){
        $user = auth('api')->user();
       // return ['message','datasend for updataing'];
       //return $req->photo;
       $this->validate($req,[
        'name' => 'required|string|max:191',
        'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
        'password' => 'sometimes|string|min:6'
    ]);
       $currentPhoto = $user->photo;

       if($req->photo != $currentPhoto){
                $name = time().'.' . explode('/', explode(':', substr($req->photo, 0, strpos($req->photo, ';')))[1])[1];
    
               \Image::make($req->photo)->save(public_path('img/profile_img/').$name);
               $req->merge(['photo' => $name]);

               //delete old picture whene new upload
            $img_loc = public_path('img/profile_img/').$currentPhoto;
            if(file_exists($img_loc)){
                @unlink($img_loc);
            }
           
       }
       if(!empty($req->password)){
            $req->merge(['password' => Hash::make($req['password'])]);
       }
       $user->update($req->all());
       return ['massage' => 'successfull'];
    }
    public function search(){

        if($search = \Request::get('q')){
            $users = User::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")
                        ->orWhere('email','LIKE',"%$search%")
                        ->orWhere('id','LIKE',"%$search%");
                    })->paginate(5);  
        }else{
            $users = User::latest()->paginate(5);
        }
        return $users;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = User::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|string|min:6'
        ]);

        $user->update($request->all());


        
        return ['message'=>'update user'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        
        $user->delete();

        return ['message' => 'User deleted'];
    }
}
