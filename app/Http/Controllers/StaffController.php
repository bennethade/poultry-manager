<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class StaffController extends Controller
{
    
    public function list(Request $request)
    {
        $data['header_title'] = "Staff List";

        $data['getRecord'] = User::getStaff($request)->paginate(100);
        return view('admin.staff.list', $data);
    }


    public function ajaxSearch(Request $request)
    {
        $staff = User::getStaff($request)->take(100)->get(); // Get without pagination for AJAX

        return response()->json([
            'html' => view('admin.staff.partials.staff_rows', ['getRecord' => $staff])->render()
        ]);
    }



    public function add()
    {
        $data['header_title'] = "Add New Staff";

        return view('admin.staff.add', $data);
    }


    public function insert(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'email' => 'email|unique:users',
        ]); 

        $staff = new User();

        $staff->user_type = 2;
        
        $staff->name = $request->name;
        $staff->last_name = $request->last_name;
        $staff->other_name = $request->other_name;
        $staff->gender = $request->gender;

        if(!empty($request->date_of_birth))
        {
            $staff->date_of_birth = $request->date_of_birth;
        }

        if(!empty($request->admission_date))
        {
            $staff->admission_date = $request->admission_date;
        }

        if(!empty($request->file('profile_picture')))
        {
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('profile_picture'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/profile/'.$filename); 


            $staff->profile_picture = $filename;  //For the DB Fields
        }


        // if ($request->file('profile_picture')) {
        //     $file = $request->file('profile_picture');
        //     $filename = date('YmdHi').$file->getClientOriginalName();
        //     $file->move(public_path('upload/profile'),$filename);
        //     $staff['profile_picture'] = $filename;
        // }

        
        $staff->marital_status = $request->marital_status;
        $staff->mobile_number = $request->mobile_number;
        $staff->address = $request->address;
        $staff->permanent_address = $request->permanent_address;
        $staff->qualification = $request->qualification;
        $staff->work_experience = $request->work_experience;
        $staff->note = $request->note;
        $staff->status = $request->status;
        
        


        //AUTOGENERATING OF EMAIL
        if(!empty($request->name) || !empty($request->last_name) || !empty($request->other_name))
        {
            $otherNameInitial = !empty($request->other_name) ? $request->other_name[0] : ''; // Check if other_name is entered

            $staffEmail = $request->name . $request->last_name . $otherNameInitial . '@farmer.com';
        }

        $staff->email = isset($staffEmail) ? $staffEmail : null;

        // Set default password
        $defaultPassword = 'PASSWORD';
        $staff->password = Hash::make($defaultPassword);
        $staff->keep_track = $defaultPassword;

        
        $staff->save();

        return redirect()->route('staff.list')->with('success', 'Staff Created Successfully!');

    }


    public function edit($id)
    {
        $data['header_title'] = "Edit Staff";

        $data['getRecord'] = User::getSingle($id);
        return view('admin.staff.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            // 'mobile_number' => 'max:15|min:8',
            // 'marital_status' => 'max:50',
        ]); 

        $staff = User::getSingle($id);
        
        $staff->name = $request->name;
        $staff->last_name = $request->last_name;
        $staff->other_name = $request->other_name;
        $staff->gender = $request->gender;

        if(!empty($request->date_of_birth))
        {
            $staff->date_of_birth = $request->date_of_birth;
        }

        if(!empty($request->admission_date))
        {
            $staff->admission_date = $request->admission_date;
        }

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($staff->getProfile()))
            {
                unlink('upload/profile/'.$staff->profile_picture);
            }

            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            // $file->move('upload/profile/', $filename);       //Tutor's Line

            $file = Image::read($request->file('profile_picture'));     //Image Intervention Lines
            $file->resize(200, 200);
            $file->save('upload/profile/'.$filename); 


            $staff->profile_picture = $filename;  //For the DB Fields
        }
        
        $staff->marital_status = $request->marital_status;
        $staff->mobile_number = $request->mobile_number;
        $staff->address = $request->address;
        $staff->mobile_number = $request->mobile_number;
        $staff->permanent_address = $request->permanent_address;
        $staff->qualification = $request->qualification;
        $staff->work_experience = $request->work_experience;
        $staff->note = $request->note;
        $staff->status = $request->status;
        
        $staff->email = $request->email;

        if(!empty($request->password))
        {
            $staff->keep_track = $request->password;
            
            $staff->password = Hash::make($request->password);
        }
        
        $staff->save();

        return redirect()->route('staff.list')->with('success', 'Staff Updated Successfully!');

    }


    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('staff.list')->with('warning', 'Staff Deleted Successfully!');
    }
    





}
