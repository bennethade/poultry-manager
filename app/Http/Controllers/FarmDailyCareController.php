<?php

namespace App\Http\Controllers;

use App\Models\FarmDailyCare;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class FarmDailyCareController extends Controller
{
    public function list(Request $request)
    {        
        $data['getRecord'] = FarmDailyCare::getRecord($request)->paginate(100);
        $data['header_title'] = "Daily Farm Care Records";

        if(Auth::user()->user_type == 2)
        {
            return view('staff.farm_daily_cares.list', $data);
        }
        else{
            return view('admin.farm_daily_cares.list', $data);
        }
        
    }

    


    public function ajaxSearch(Request $request)
    {
        $record = FarmDailyCare::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                'html' => view('staff.farm_daily_cares.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{
            return response()->json([
                'html' => view('admin.farm_daily_cares.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
    }


    public function add()
    {
        $data['header_title'] = "Add New Farm Record";

        if(Auth::user()->user_type == 2)
        {
            return view('staff.farm_daily_cares.add', $data);
        }
        else{
            return view('admin.farm_daily_cares.add', $data);
        }            
    }   


    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([
            'care_type' => 'required|string|max:255',
            'quantity'  => 'nullable|string|max:255',
            'house_or_unit'  => 'nullable|string|max:255',
            'date'           => 'required|date',
            'notes'          => 'required|string',
            'picture'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $record = new FarmDailyCare();

        $record->care_type = $request->care_type;
        $record->quantity  = $request->quantity;
        $record->house_or_unit  = $request->house_or_unit;
        $record->date           = $request->date;
        $record->notes          = $request->notes;
        $record->staff_id       = Auth::user()->id;

        // HANDLE FILE UPLOAD
        // if ($request->hasFile('picture')) {
        //     $file     = $request->file('picture');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('uploads/farm_daily_cares'), $filename);
        //     $record->picture = $filename;
        // }


        if(!empty($request->file('picture')))
        {
            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/farm_daily_cares/'.$filename); 


            $record->picture = $filename;  //For the DB Fields
        }


        $record->save();

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.farm_daily_care.list')->with('success', 'Farm record added successfully.');
        }
        else{
            return redirect()->route('farm_daily_care.list')->with('success', 'Farm record added successfully.');
        }
    }



    public function view($id)
    {
        $data['header_title'] = "View Record";

        $data['getRecord'] = FarmDailyCare::findOrFail($id);
        
        $data['getStaff'] = User::where('id', $data['getRecord']->staff_id)->first();

        if(Auth::user()->user_type == 2)
        {
            return view('staff.farm_daily_cares.view', $data);
        }
        else{
            return view('admin.farm_daily_cares.view', $data);
        }
    }


    public function edit($id)
    {
        $data['header_title'] = "Edit Record";

        $data['getRecord'] = FarmDailyCare::findOrFail($id);
        return view('admin.farm_daily_cares.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'care_type' => 'required|string|max:255',
            'quantity'  => 'nullable|string|max:255',
            'house_or_unit'  => 'nullable|string|max:255',
            'date'           => 'required|date',
            'notes'          => 'required|string',
            'picture'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
            
        ]); 

        $record = FarmDailyCare::findOrFail($id);

        $record->care_type = $request->care_type;
        $record->quantity  = $request->quantity;
        $record->house_or_unit  = $request->house_or_unit;
        $record->date           = $request->date;
        $record->notes          = $request->notes;
        $record->updated_by       = Auth::user()->id;

        if(!empty($request->file('picture')))
        {
            if(!empty($record->picture))
            {
                unlink('upload/farm_daily_cares/'.$record->picture);
            }

            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/farm_daily_cares/'.$filename); 


            $record->picture = $filename;   //For the DB Fields
        }

       
        $record->save();

        return redirect()->route('farm_daily_care.list')->with('success', 'Record Updated Successfully!');

    }


  


    public function delete($id)
    {
        $record = FarmDailyCare::findOrFail($id);

        if(!empty($record->picture))
        {
            unlink('upload/farm_daily_cares/'.$record->picture);
        }

        $record->delete();

        return redirect()->route('farm_daily_care.list')->with('warning', 'Record Deleted Successfully!');
    }

}
