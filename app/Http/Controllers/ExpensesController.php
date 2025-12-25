<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\MonthlyExpense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class ExpensesController extends Controller
{
    public function list(Request $request)
    {        
        $data['getRecord'] = Expenses::getRecord($request)->paginate(100);

        $data['header_title'] = "Expenses";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.expense_record.daily_expense.list', $data);
        }
        else{
            return view('admin.expense_record.daily_expense.list', $data);
        }
    }

    


    public function ajaxSearch(Request $request)
    {
        $record = Expenses::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                // 'html' => view('staff.expense_record.daily_expense.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{

            return response()->json([
                'html' => view('admin.expense_record.daily_expense.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }

    }


    public function add()
    {
        $data['header_title'] = "Add New Record";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.expense_record.daily_expense.add', $data);
        }
        else{
            return view('admin.expense_record.daily_expense.add', $data);
        }
    }   


    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([
            'category'       => 'required|string|max:255',
            'amount'         => 'required|string|max:255',
            'payment_method'  => 'nullable|string|max:255',
            'date'           => 'required|date',
            'description'    => 'required|string',
            'picture'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $record = new Expenses();

        $record->category           = $request->category;
        $record->amount             = $request->amount;
        $record->payment_method     = $request->payment_method;
        $record->date               = $request->date;
        $record->description        = $request->description;
        $record->purpose            = $request->purpose;
        $record->staff_id           = Auth::user()->id;


        if(!empty($request->file('picture')))
        {
            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/expenses/'.$filename); 


            $record->picture = $filename;  //For the DB Fields
        }


        $record->save();

        if(Auth::user()->user_type == 2)
        {
            // return redirect()->route('staff.expenses.list')->with('success', 'Expenses added successfully.');
        }
        else{
            return redirect()->route('expenses.list')->with('success', 'Expenses added successfully.');
        }
    }



    public function view($id)
    {
        $data['header_title'] = "View Expense";

        $data['getRecord'] = Expenses::findOrFail($id);
        $data['getStaff'] = User::where('id', $data['getRecord']->staff_id)->first();

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.expense_record.daily_expense.view', $data);
        }
        else{
            return view('admin.expense_record.daily_expense.view', $data);
        }
    }


    public function edit($id)
    {
        $data['header_title'] = "Edit Expense";

        $data['getRecord'] = Expenses::findOrFail($id);
        return view('admin.expense_record.daily_expense.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category'       => 'required|string|max:255',
            'amount'         => 'required|string|max:255',
            'payment_method'  => 'nullable|string|max:255',
            'date'           => 'required|date',
            'description'    => 'required|string',
            'picture'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
            
        ]); 

        $record = Expenses::findOrFail($id);

        $record->category           = $request->category;
        $record->amount             = $request->amount;
        $record->payment_method     = $request->payment_method;
        $record->date               = $request->date;
        $record->description        = $request->description;
        $record->updated_by         = Auth::user()->id;

        if(!empty($request->file('picture')))
        {
            if(!empty($record->picture))
            {
                unlink('upload/expenses/'.$record->picture);
            }

            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/expenses/'.$filename); 


            $record->picture = $filename;   //For the DB Fields
        }

       
        $record->save();

        return redirect()->route('expenses.list')->with('success', 'Expense Updated Successfully!');

    }


  


    public function delete($id)
    {
        $record = Expenses::findOrFail($id);

        if(!empty($record->picture))
        {
            unlink('upload/expenses/'.$record->picture);
        }

        $record->delete();

        return redirect()->route('expenses.list')->with('warning', 'Expense Deleted Successfully!');
    }


    


    // MONTHLY EXPENSE CODES
    public function monthlyList(Request $request)
    {        
        $data['getRecord'] = MonthlyExpense::getRecord($request)->paginate(100);

        $data['header_title'] = "Monthly Expenses";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.expense_record.monthly_expense.list', $data);
        }
        else{
            return view('admin.expense_record.monthly_expense.list', $data);
        }
    }

    


    public function monthlyAjaxSearch(Request $request)
    {
        $record = MonthlyExpense::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                // 'html' => view('staff.expense_record.monthly_expense.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{

            return response()->json([
                'html' => view('admin.expense_record.monthly_expense.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }

    }


    public function monthlyAdd()
    {
        $data['header_title'] = "Add Monthly Expense";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.expense_record.monthly_expense.add', $data);
        }
        else{
            return view('admin.expense_record.monthly_expense.add', $data);
        }
    }   


    public function monthlyStore(Request $request)
    {
        // VALIDATION
        $request->validate([
            
        ]);

        $record = new MonthlyExpense();

        $record->year               = $request->year;
        $record->month              = $request->month;
        $record->opening_balance    = $request->opening_balance;
        $record->total_spent        = $request->total_spent;
        $record->closing_balance    = $request->closing_balance;
        $record->remarks            = $request->remarks;
        $record->staff_id           = Auth::user()->id;

        $record->save();

        if(Auth::user()->user_type == 2)
        {
            // return redirect()->route('staff.monthly_expenses.list')->with('success', 'Record added successfully.');
        }
        else{
            return redirect()->route('monthly_expenses.list')->with('success', 'Record added successfully.');
        }
    }



    public function monthlyView($id)
    {
        $data['header_title'] = "View Expense";

        $data['getRecord'] = MonthlyExpense::findOrFail($id);
        $data['getStaff'] = User::where('id', $data['getRecord']->staff_id)->first();

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.expense_record.monthly_expense.view', $data);
        }
        else{
            return view('admin.expense_record.monthly_expense.view', $data);
        }
    }


    public function monthlyEdit($id)
    {
        $data['header_title'] = "Edit Expense";

        $data['getRecord'] = MonthlyExpense::findOrFail($id);

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.expense_record.monthly_expense.edit', $data);
        }
        else{
            return view('admin.expense_record.monthly_expense.edit', $data);
        }
    }


    public function monthlyUpdate(Request $request, $id)
    {
        $request->validate([
            
            
        ]); 

        $record = MonthlyExpense::findOrFail($id);

        $record->year               = $request->year;
        $record->month              = $request->month;
        $record->opening_balance    = $request->opening_balance;
        $record->total_spent        = $request->total_spent;
        $record->closing_balance    = $request->closing_balance;
        $record->remarks            = $request->remarks;
        $record->updated_by         = Auth::user()->id;
       
        $record->save();

        return redirect()->route('monthly_expenses.list')->with('success', 'Record Updated Successfully!');

    }


  


    public function monthlyDelete($id)
    {
        $record = MonthlyExpense::findOrFail($id);

        $record->delete();

        return redirect()->route('monthly_expenses.list')->with('warning', 'Record Deleted Successfully!');
    }




}
