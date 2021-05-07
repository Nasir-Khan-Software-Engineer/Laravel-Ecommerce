<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\User;
class CustomUserController extends Controller
{
    public function index(){


        $admins = User::where('type','=','admin')->where('permissions','!=','all')->get();


    	return view('admin.user.index',compact('admins'));
    }

    public function show($id){
        $user = User::find($id);

       

        $permission_str = $user->permissions;
        $permissions =  explode(",",$permission_str);
        
    	return view('admin.user.show',compact('user','permissions'));
    }

    public function add(){
    	return view('admin.user.add');
    }

    public function edit($id){

        $user = User::find($id);
        $permission_str = $user->permissions;
        $permissions =  explode(",",$permission_str);

    	return view('admin.user.edit',compact('user','permissions'));
    }

    public function store(Request $r){
        $default_permission = "admin.home,admin.dashboard,admin.profile,admin.profile.update,admin.profile.password_change";


        $r->validate([
            'name'          => 'required',
            'image'         => 'required',
            'phone'         => 'required',
            'address'       => 'required',
            'about'         => 'required',
            'name'          => 'required',
            'email'         => 'required|unique:users',
            'password'      => 'required|min:8',
            'permission'    => 'required',
            'description'   => 'required'
        ]);

        $user = new User;

        $user->name                     = $r->name;
        $user->phone                    = $r->phone;
        $user->about                    = $r->about;
        $user->address                  = $r->address;
        $user->email                    = $r->email;
        $user->un_hash_password         = $r->password;
        $user->password                 = Hash::make($r->password);
        $user->permission_description   = $r->description;
        $user->designation              = $r->designation;
        $user->type                     = 'admin'; // default

        $image = time().'.'.$r->image->getClientOriginalExtension();
        $path = $this->upload_path().'\user';
        $r->image->move($path, $image);
        $user->image = $image;

        // make a string of all permission route name 
        $all_premission = $default_permission;
        foreach ($r->permission as  $permission) {
           $all_premission .=','.$permission;
        }
        
       
        $user->permissions = $all_premission; 
        $user->save();

    
    	return back()->with('success','Success');
    }

    public function delete(Request $r){
    	$user = User::find($r->id);

        // $path = $this->upload_path().'\user';
        // if (File::exists($path.'/'.$user->image)){
        //       File::delete($path.'/'.$user->image);
        // }

        //$user->delete();

        return response()->json([
           'message' => "Not deleted"
        ]);

    }

    public function update(Request $r){

        $default_permission = "admin.home,admin.dashboard,admin.profile,admin.profile.update,admin.profile.password_change";


            $user  = User::find($r->id);
    	    
            $r->validate([
                'name'          => 'required',
                'phone'         => 'required',
                'address'       => 'required',
                'about'         => 'required',
                'name'          => 'required',
                'email'         => 'required|unique:users,email,'.$r->id,
                'password'      => 'required|min:8',
                'permission'    => 'required',
                'description'   => 'required'
            ]);


            if ($r->hasFile('image')) {

                
            
                $path = $this->upload_path().'\user';
                if (File::exists($path.'/'.$user->image)){
                      File::delete($path.'/'.$user->image);
                }

                $image = time().'.'.$r->image->getClientOriginalExtension();
                $r->image->move($path, $image);
                $user->image = $image;

            }


           
            $user->name                     = $r->name;
            $user->phone                    = $r->phone;
            $user->about                    = $r->about;
            $user->address                  = $r->address;
            $user->email                    = $r->email;
            $user->un_hash_password         = $r->password;
            $user->password                 = Hash::make($r->password);
            $user->permission_description   = $r->description;
            $user->designation              = $r->designation;



            // make a string of all permission route name 
            $all_premission = $default_permission;

            foreach ($r->permission as  $permission) {
               $all_premission .=','.$permission;
            }
            

        
            $user->permissions = $all_premission; 

           

            $user->save();

        
            return back()->with('success','Success');
    }
    public function deactivated(){
    	return back()->with('success','user Deactivated');
    }
}
