<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;



class UserController extends Controller
{

    public function setting()
    {
        $data['getRecord'] = Setting::getSingle();
        $data['header_title'] = "Setting";
        return view('admin.setting', $data);
    }


    public function updateSetting(Request $request)
    {
        $setting                            = Setting::getSingle();

        
        $setting->business_name             = trim($request->business_name);
        $setting->abbreviation              = trim($request->abbreviation);
        $setting->address                   = trim($request->address);
        $setting->email_1                   = trim($request->email_1);
        $setting->email_2                   = trim($request->email_2);
        $setting->phone_1                   = trim($request->phone_1);
        $setting->phone_2                   = trim($request->phone_2);
        $setting->website                   = trim($request->website);
        

        if(!empty($request->file('qr_code')))
        {
            $ext = $request->file('qr_code')->getClientOriginalExtension();
            $file = $request->file('qr_code');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename); 

            $setting->qr_code = $filename;
        }



        if(!empty($request->file('logo')))
        {
            $ext = $request->file('logo')->getClientOriginalExtension();
            $file = $request->file('logo');
            $randomStr = date('Ymdhis').Str::random(10);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $filename); 

            $setting->logo = $filename;
        }



        if(!empty($request->file('favicon_icon')))
        {
            $ext = $request->file('favicon_icon')->getClientOriginalExtension();
            $file = $request->file('favicon_icon');
            $randomStr = date('Ymdhis').Str::random(10);
            $favicon = strtolower($randomStr).'.'.$ext;
            $file->move('upload/setting/', $favicon); 

            $setting->favicon_icon = $favicon;
        }


        $setting->save();

        return redirect()->back()->with('success', 'Setting Updated Successfully!');
    }


    public function myAccount()
    {
        // $data['getRecord'] = User::findOrFail(Auth::user()->id);
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";

        if(Auth::user()->user_type == 1 || Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'Admin')
        {
            return view('admin.my_account', $data);
        }

        elseif(Auth::user()->user_type == 2)
        {
            return view('staff.my_account', $data);
        }
        

        
    }


    public function updateMyAdminAccount(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        
        $admin = User::getSingle($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->back()->with('success', 'Account Updated Successfully!');

    } 



    public function updateMyAccount(Request $request)
    {   
        $id = Auth::user()->id;

        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            // 'mobile_number' => 'max:15|min:8',
            // 'marital_status' => 'max:50'
        ]); 

        $user = User::getSingle($id);
        
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->other_name = $request->other_name;
        $user->gender = $request->gender;
        $user->email = $request->email;

        if(!empty($request->date_of_birth))
        {
            $user->date_of_birth = $request->date_of_birth;
        }

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($user->getProfile()))
            {
                unlink('upload/profile/'.$user->profile_picture);
            }

            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('profile_picture'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/profile/'.$filename); 

            $user->profile_picture = $filename;     //For the DB Field
        }
        
        $user->marital_status = $request->marital_status;
        $user->mobile_number = $request->mobile_number;
        $user->address = $request->address;
        $user->permanent_address = $request->permanent_address;
        $user->qualification = $request->qualification;
        $user->work_experience = $request->work_experience;
                
        $user->save();

        return redirect()->back()->with('success', 'Account Updated Successfully!');

    }




    public function changePassword()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }


    public function updatePassword(Request $request)
    {
        // dd($request->all());

        $user = User::getSingle(Auth::user()->id);

       $new_password = $request->new_password;
       $confirm_password = $request->confirm_password;


        if(Hash::check($request->old_password, $user->password))
        {
            if($new_password == $confirm_password)
            {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->back()->with('success', "Password Changed Successfully!");
            }
            else{
                return redirect()->back()->with('error', "Passwords do not match");
            }

        }
        else
        {
            return redirect()->back()->with('error', "Old password is not correct");
        }

    }






}
