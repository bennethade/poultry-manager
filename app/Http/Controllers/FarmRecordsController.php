<?php

namespace App\Http\Controllers;

use App\Models\FarmRecords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class FarmRecordsController extends Controller
{
    public function list(Request $request)
    {        
        $data['getRecord'] = FarmRecords::getRecord($request)->paginate(100);

        $data['header_title'] = "Farm Records";

        if(Auth::user()->user_type == 2)
        {
            return view('staff.farm_records.list', $data);
        }
        else{
            return view('admin.farm_records.list', $data);
        }
    }

    


    public function ajaxSearch(Request $request)
    {
        $record = FarmRecords::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                'html' => view('staff.farm_records.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{
            return response()->json([
                'html' => view('admin.farm_records.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
    }


    public function add()
    {
        $data['header_title'] = "Add New Farm Record";

        if(Auth::user()->user_type == 2)
        {
            return view('staff.farm_records.add', $data);
        }
        else{
            return view('admin.farm_records.add', $data);
        }
    }   


    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([
            'activity_title' => 'required|string|max:255',
            'activity_type'  => 'required|string|max:255',
            'date'           => 'required|date',
            'notes'          => 'nullable|string',
            'picture'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $record = new FarmRecords();

        $record->activity_title = $request->activity_title;
        $record->activity_type  = $request->activity_type;
        $record->date           = $request->date;
        $record->notes          = $request->notes;
        $record->staff_id       = Auth::user()->id;

        // HANDLE FILE UPLOAD
        // if ($request->hasFile('picture')) {
        //     $file     = $request->file('picture');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('uploads/farm_records'), $filename);
        //     $record->picture = $filename;
        // }


        if(!empty($request->file('picture')))
        {
            // $ext = $request->file('picture')->getClientOriginalExtension();
            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            // $filename = strtolower($fname).'.'.$ext;
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/farm_records/'.$filename); 


            $record->picture = $filename;  //For the DB Fields
        }


        $record->save();

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.farm_record.list')->with('success', 'Farm record added successfully.');
        }
        else{
            return redirect()->route('farm_record.list')->with('success', 'Farm record added successfully.');
        }
    }



    public function edit($id)
    {
        $data['header_title'] = "Edit Record";

        $data['getRecord'] = FarmRecords::findOrFail($id);
        return view('admin.farm_records.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'picture'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
            
        ]); 

        $record = FarmRecords::findOrFail($id);
        
        $record->activity_title = $request->activity_title;
        $record->activity_type  = $request->activity_type;
        $record->date           = $request->date;
        $record->notes          = $request->notes;
        $record->updated_by       = Auth::user()->id;

        if(!empty($request->file('picture')))
        {
            if(!empty($record->picture))
            {
                unlink('upload/farm_records/'.$record->picture);
            }

            // $ext = $request->file('picture')->getClientOriginalExtension();
            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            // $filename = strtolower($fname).'.'.$ext;
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/farm_records/'.$filename); 


            $record->picture = $filename;   //For the DB Fields
        }

       
        $record->save();

        return redirect()->route('farm_record.list')->with('success', 'Record Updated Successfully!');

    }


  


    public function delete($id)
    {
        $record = FarmRecords::findOrFail($id);

        if(!empty($record->picture))
        {
            unlink('upload/farm_records/'.$record->picture);
        }
        
        $record->delete();

        return redirect()->route('farm_record.list')->with('warning', 'Record Deleted Successfully!');
    }







}
