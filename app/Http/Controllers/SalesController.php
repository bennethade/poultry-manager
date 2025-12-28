<?php

namespace App\Http\Controllers;

use App\Models\MonthlySales;
use App\Models\Pig;
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
            // return view('staff.sales_record.daily_sales.list', $data);
        }
        else{
            return view('admin.sales_record.daily_sales.list', $data);
        }
    }

    


    public function ajaxSearch(Request $request)
    {
        $record = sales::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                // 'html' => view('staff.sales_record.daily_sales.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{
            return response()->json([
                'html' => view('admin.sales_record.daily_sales.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
    }


    public function add()
    {
        $data['header_title'] = "Add New Sales";

        $data['pigs'] = Pig::orderBy('tag_id')->get();

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.sales_record.daily_sales.add', $data);
        }
        else{   
            return view('admin.sales_record.daily_sales.add', $data);
        }
    }   


    public function store(Request $request)
    {
        // dd($request->all());
        // VALIDATION
        $request->validate([
            'pig_id'            => 'required|integer',
            // 'item_type'         => 'required|string|max:255',
            'reason'            => 'nullable|string|max:255',
            'quantity'          => 'nullable|string|max:255',
            'price'             => 'nullable|string|max:255',
            'sold_on_discount'  => 'nullable|string|max:255',
            'discounted_price'  => 'nullable|string|max:255',
            'buyer_name'        => 'nullable|string|max:255',
            'buyer_phone'       => 'nullable|string|max:255',
            'date'              => 'required|date',
            'notes'             => 'nullable|string',
            'picture'           => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $record = new Sales();

        $record->pig_id                 = $request->pig_id;
        // // $record->item_type              = $request->item_type;
        $record->reason                 = $request->reason;
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
            // return view('staff.sales_record.daily_sales.view', $data);
        }
        else{
            return view('admin.sales_record.daily_sales.view', $data);
        }
    }


    public function edit($id)
    {
        $data['header_title'] = "Edit Sales";

        $data['pigs'] = Pig::orderBy('tag_id')->get();

        $data['getRecord'] = Sales::findOrFail($id);
        return view('admin.sales_record.daily_sales.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'pig_id'            => 'required|string|max:255',
            // 'item_type'         => 'required|string|max:255',
            'reason'            => 'nullable|string|max:255',
            'quantity'          => 'nullable|string|max:255',
            'price'             => 'nullable|string|max:255',
            'sold_on_discount'  => 'nullable|string|max:255',
            'discounted_price'  => 'nullable|string|max:255',
            'buyer_name'        => 'nullable|string|max:255',
            'buyer_phone'       => 'nullable|string|max:255',
            'date'              => 'required|date',
            'notes'             => 'nullable|string',
            'picture'           => 'nullable|image|mimes:jpg,jpeg,png,webp',
            
        ]); 

        $record = Sales::findOrFail($id);

        $record->pig_id                 = $request->pig_id;
        // // $record->item_type              = $request->item_type;
        $record->reason                 = $request->reason;
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




    // MONTHLY SALES CODES
    public function monthlyList(Request $request)
    {        
        $data['getRecord'] = MonthlySales::getRecord($request)->paginate(100);

        $data['header_title'] = "Monthly Sales";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.sale_record.monthly_sales.list', $data);
        }
        else{
            return view('admin.sales_record.monthly_sales.list', $data);
        }
    }

    


    public function monthlyAjaxSearch(Request $request)
    {
        $record = MonthlySales::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                // 'html' => view('staff.sales_record.monthly_sales.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{

            return response()->json([
                'html' => view('admin.sales_record.monthly_sales.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }

    }


    public function monthlyAdd()
    {
        $data['header_title'] = "Add Monthly Sales";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.sale_record.monthly_sale.add', $data);
        }
        else{
            return view('admin.sales_record.monthly_sales.add', $data);
        }
    }   


    public function monthlyStore(Request $request)
    {
        // VALIDATION
        $request->validate([
            
        ]);

        $record = new MonthlySales();

        $record->year               = $request->year;
        $record->month              = $request->month;
        $record->total_sales        = $request->total_sales;
        $record->total_expense      = $request->total_expense;
        $record->gross_profit       = $request->gross_profit;
        $record->remarks            = $request->remarks;
        $record->staff_id           = Auth::user()->id;

        $record->save();

        if(Auth::user()->user_type == 2)
        {
            // return redirect()->route('staff.monthly_sales.list')->with('success', 'Record added successfully.');
        }
        else{
            return redirect()->route('monthly_sales.list')->with('success', 'Record added successfully.');
        }
    }



    public function monthlyEdit($id)
    {
        $data['header_title'] = "Edit sale";

        $data['getRecord'] = MonthlySales::findOrFail($id);

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.sales_record.monthly_sales.edit', $data);
        }
        else{
            return view('admin.sales_record.monthly_sales.edit', $data);
        }
    }


    public function monthlyUpdate(Request $request, $id)
    {
        $request->validate([
            
            
        ]); 

        $record = MonthlySales::findOrFail($id);

        $record->year               = $request->year;
        $record->month              = $request->month;
        $record->total_sales        = $request->total_sales;
        $record->total_expense      = $request->total_expense;
        $record->gross_profit       = $request->gross_profit;
        $record->remarks            = $request->remarks;
        $record->updated_by         = Auth::user()->id;
       
        $record->save();

        return redirect()->route('monthly_sales.list')->with('success', 'Record Updated Successfully!');

    }


  


    public function monthlyDelete($id)
    {
        $record = MonthlySales::findOrFail($id);

        $record->delete();

        return redirect()->route('monthly_sales.list')->with('warning', 'Record Deleted Successfully!');
    }









}
