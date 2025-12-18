<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class SalesController extends Controller
{
    public function list(Request $request)
    {        
        $data['getRecord'] = Sales::getRecord($request)->paginate(100);

        $data['header_title'] = "Sales Records";

        if(Auth::user()->user_type == 2)
        {
            return view('staff.sales.list', $data);
        }
        else{
            return view('admin.sales.list', $data);
        }
    }

    


    public function ajaxSearch(Request $request)
    {
        $record = sales::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                'html' => view('staff.sales.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{
            return response()->json([
                'html' => view('admin.sales.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
    }


    public function add()
    {
        $data['header_title'] = "Add New Sales";

        if(Auth::user()->user_type == 2)
        {
            return view('staff.sales.add', $data);
        }
        else{   
            return view('admin.sales.add', $data);
        }
    }   


    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([
            'item_type'         => 'required|string|max:255',
            'quantity'          => 'nullable|string|max:255',
            'price'             => 'required|string|max:255',
            'sold_on_discount'  => 'nullable|string|max:255',
            'discounted_price'  => 'nullable|string|max:255',
            'buyer_name'        => 'nullable|string|max:255',
            'buyer_phone'       => 'nullable|string|max:255',
            'date'              => 'required|date',
            'notes'             => 'required|string',
            'picture'           => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $record = new Sales();

        $record->item_type              = $request->item_type;
        $record->quantity               = $request->quantity;
        $record->price                  = $request->price;
        $record->sold_on_discount       = $request->sold_on_discount;
        $record->discounted_price       = $request->discounted_price;
        $record->buyer_name             = $request->buyer_name;
        $record->buyer_phone            = $request->buyer_phone;
        $record->date                   = $request->date;
        $record->notes                  = $request->notes;
        $record->staff_id               = Auth::user()->id;


        if(!empty($request->file('picture')))
        {
            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/sales/'.$filename); 


            $record->picture = $filename;  //For the DB Fields
        }


        $record->save();

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.sales.list')->with('success', 'Sales added successfully.');
        }
        else{ 
            return redirect()->route('sales.list')->with('success', 'Sales added successfully.');
        }
    }



    public function view($id)
    {
        $data['header_title'] = "View Sales";

        $data['getRecord'] = Sales::findOrFail($id);
        $data['getStaff'] = User::where('id', $data['getRecord']->staff_id)->first();

        if(Auth::user()->user_type == 2)
        {
            return view('staff.sales.view', $data);
        }
        else{
            return view('admin.sales.view', $data);
        }
    }


    public function edit($id)
    {
        $data['header_title'] = "Edit Sales";

        $data['getRecord'] = Sales::findOrFail($id);
        return view('admin.sales.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'item_type'         => 'required|string|max:255',
            'quantity'          => 'nullable|string|max:255',
            'price'             => 'required|string|max:255',
            'sold_on_discount'  => 'nullable|string|max:255',
            'discounted_price'  => 'nullable|string|max:255',
            'buyer_name'        => 'nullable|string|max:255',
            'buyer_phone'       => 'nullable|string|max:255',
            'date'              => 'required|date',
            'notes'             => 'required|string',
            'picture'           => 'nullable|image|mimes:jpg,jpeg,png,webp',
            
        ]); 

        $record = Sales::findOrFail($id);

        $record->item_type              = $request->item_type;
        $record->quantity               = $request->quantity;
        $record->price                  = $request->price;
        $record->sold_on_discount       = $request->sold_on_discount;
        $record->discounted_price       = $request->discounted_price;
        $record->buyer_name             = $request->buyer_name;
        $record->buyer_phone            = $request->buyer_phone;
        $record->date                   = $request->date;
        $record->notes                  = $request->notes;
        $record->updated_by             = Auth::user()->id;

        if(!empty($request->file('picture')))
        {
            if(!empty($record->picture))
            {
                unlink('upload/sales/'.$record->picture);
            }

            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/sales/'.$filename); 


            $record->picture = $filename;   //For the DB Fields
        }

       
        $record->save();

        return redirect()->route('sales.list')->with('success', 'Sales Updated Successfully!');

    }


  


    public function delete($id)
    {
        $record = Sales::findOrFail($id);

        if(!empty($record->picture))
        {
            unlink('upload/sales/'.$record->picture);
        }

        $record->delete();

        return redirect()->route('sales.list')->with('warning', 'Sales Deleted Successfully!');
    }

}
