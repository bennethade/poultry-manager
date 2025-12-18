<?php

namespace App\Http\Controllers;

use App\Models\Miscellaneous;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class MiscellaneousController extends Controller
{
    public function list(Request $request)
    {        
        $data['getRecord'] = Miscellaneous::getRecord($request)->paginate(100);

        $data['header_title'] = "Miscellaneous Records";

        if(Auth::user()->user_type == 2)
        {
            return view('staff.miscellaneous.list', $data);
        }
        else{
            return view('admin.miscellaneous.list', $data);
        }
    }

    


    public function ajaxSearch(Request $request)
    {
        $record = Miscellaneous::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                'html' => view('staff.miscellaneous.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{
            return response()->json([
                'html' => view('admin.miscellaneous.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
    }


    public function add()
    {
        $data['header_title'] = "Add New Miscellaneous";

        if(Auth::user()->user_type == 2)
        {
            return view('staff.miscellaneous.add', $data);
        }
        else{
            return view('admin.miscellaneous.add', $data);
        }
    }   


    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([
            'title'             => 'required|string|max:255',
            'category'          => 'nullable|string|max:255',
            'value'             => 'nullable|string|max:255',
            'date'              => 'nullable|date',
            'description'       => 'nullable|string',
            'picture'           => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $record = new Miscellaneous();

        $record->title                  = $request->title;
        $record->category               = $request->category;
        $record->value                  = $request->value;
        $record->date                   = $request->date;
        $record->description            = $request->description;
        $record->staff_id               = Auth::user()->id;


        if(!empty($request->file('picture')))
        {
            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/miscellaneous/'.$filename); 


            $record->picture = $filename;  //For the DB Fields
        }


        $record->save();

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.miscellaneous.list')->with('success', 'Record added successfully.');
        }
        else{
            return redirect()->route('miscellaneous.list')->with('success', 'Record added successfully.');
        }
    }



    // public function view($id)
    // {
    //     $data['header_title'] = "View miscellaneous";

    //     $data['getRecord'] = miscellaneous::findOrFail($id);
    //     $data['getStaff'] = User::where('id', $data['getRecord']->staff_id)->first();
    //     return view('admin.miscellaneous.view', $data);
    // }


    public function edit($id)
    {
        $data['header_title'] = "Edit Record";

        $data['getRecord'] = Miscellaneous::findOrFail($id);
        return view('admin.miscellaneous.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'category'          => 'nullable|string|max:255',
            'value'             => 'nullable|string|max:255',
            'date'              => 'nullable|date',
            'description'       => 'nullable|string',
            'picture'           => 'nullable|image|mimes:jpg,jpeg,png,webp',
            
        ]); 

        $record = miscellaneous::findOrFail($id);

        $record->title                  = $request->title;
        $record->category               = $request->category;
        $record->value                  = $request->value;
        $record->date                   = $request->date;
        $record->description            = $request->description;
        $record->updated_by             = Auth::user()->id;

        if(!empty($request->file('picture')))
        {
            if(!empty($record->picture))
            {
                unlink('upload/miscellaneous/'.$record->picture);
            }

            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/miscellaneous/'.$filename); 


            $record->picture = $filename;   //For the DB Fields
        }

       
        $record->save();

        return redirect()->route('miscellaneous.list')->with('success', 'Record Updated Successfully!');

    }


  


    public function delete($id)
    {
        $record = Miscellaneous::findOrFail($id);

        if(!empty($record->picture))
        {
            unlink('upload/miscellaneous/'.$record->picture);
        }

        $record->delete();

        return redirect()->route('miscellaneous.list')->with('warning', 'Record Deleted Successfully!');
    }



    

}
