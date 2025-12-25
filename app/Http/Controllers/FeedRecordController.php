<?php

namespace App\Http\Controllers;

use App\Models\feedFormulation;
use App\Models\FeedStock;
use App\Models\FeedUsage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class FeedRecordController extends Controller
{
    public function stockList(Request $request)
    {
        $data['getRecord'] = FeedStock::getRecord($request)->paginate(100);

        $data['header_title'] = "Feed Stock";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.feed_records.feed_stock.list', $data);
        }
        else{
            return view('admin.feed_records.feed_stock.list', $data);
        }
    }


    public function stockAjaxSearch(Request $request)
    {
        $record = FeedStock::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                // 'html' => view('staff.feed_records.feed_stock.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{
            return response()->json([
                'html' => view('admin.feed_records.feed_stock.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
    }



    public function stockAdd()
    {
        $data['header_title'] = "Add New Record";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.feed_records.feed_stock.add', $data);
        }
        else{
            return view('admin.feed_records.feed_stock.add', $data);
        }
    }   


    public function stockStore(Request $request)
    {
        // VALIDATION
        $request->validate([
            'received_date'  => 'nullable|date',
            'notes'          => 'nullable|string',
            'picture'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $record = new FeedStock();

        $record->received_date          = $request->received_date;
        $record->feed_type              = $request->feed_type;
        $record->quantity_received      = $request->quantity_received;
        $record->supplier               = $request->supplier;
        $record->cost                   = $request->cost;
        $record->remaining_stock        = $request->remaining_stock;
        $record->notes                  = $request->notes;
        $record->staff_id               = Auth::user()->id;


        if(!empty($request->file('picture')))
        {
            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/feed_stock/'.$filename); 

            $record->picture = $filename;  //For the DB Fields
        }


        $record->save();

        if(Auth::user()->user_type == 2)
        {
            // return redirect()->route('staff.feed_stock.list')->with('success', 'Farm record added successfully.');
        }
        else{
            return redirect()->route('feed_stock.list')->with('success', 'Record added successfully.');
        }
    }



    public function stockEdit($id)
    {
        $data['header_title'] = "Edit Record";

        $data['getRecord'] = FeedStock::findOrFail($id);
        return view('admin.feed_records.feed_stock.edit', $data);
    }


    public function stockUpdate(Request $request, $id)
    {
        $request->validate([
            'received_date'  => 'nullable|date',
            'notes'          => 'nullable|string',
            'picture'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $record = FeedStock::findOrFail($id);

        $record->received_date          = $request->received_date;
        $record->feed_type              = $request->feed_type;
        $record->quantity_received      = $request->quantity_received;
        $record->supplier               = $request->supplier;
        $record->cost                   = $request->cost;
        $record->remaining_stock        = $request->remaining_stock;
        $record->notes                  = $request->notes;
        $record->updated_by       = Auth::user()->id;

        if(!empty($request->file('picture')))
        {
            if(!empty($record->picture))
            {
                unlink('upload/feed_stock/'.$record->picture);
            }

            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/feed_stock/'.$filename); 


            $record->picture = $filename;   //For the DB Fields
        }

       
        $record->save();

        return redirect()->route('feed_stock.list')->with('success', 'Record Updated Successfully!');

    }


  


    public function stockDelete($id)
    {
        $record = FeedStock::findOrFail($id);

        if(!empty($record->picture))
        {
            unlink('upload/feed_stock/'.$record->picture);
        }
        
        $record->delete();

        return redirect()->route('feed_stock.list')->with('warning', 'Record Deleted Successfully!');
    }






    // FOR FEED USAGE RECORDS
    public function feedUsageList(Request $request)
    {
        $data['getRecord'] = FeedUsage::with(['staff', 'editor'])->orderBy('created_at', 'desc')->paginate(100);

        $data['header_title'] = "Feed Usage";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.feed_records.feed_usage.list', $data);
        }
        else{
            return view('admin.feed_records.feed_usage.list', $data);
        }


    }




    public function feedUsageStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'feeding_date'              => 'required|date',
            'feed_type'                 => 'nullable|string',
            'quantity_fed'              => 'nullable|string',
            'time_of_day'               => 'nullable|string',
            'remarks'                   => 'nullable|string',
        ]);

        FeedUsage::create([
            'feeding_date'  => $request->feeding_date,
            'feed_type'     => $request->feed_type,
            'quantity_fed'  => $request->quantity_fed,
            'time_of_day'   => $request->time_of_day,
            'remarks'       => $request->remarks,
            'staff_id'      => Auth::user()->id,
        ]);

        return redirect()->route('daily_feed_usage.list')->with('success', 'Record added successfully.');
    }


    public function feedUsageEdit($id)
    {
        $data['header_title'] = "Edit Feed usage";

        $data['getRecord'] = FeedUsage::findOrFail($id);
        
        if(Auth::user()->user_type == 2)
        {
            // return view('staff.feed_records.feed_usage.edit', $data);
        }
        else{
            return view('admin.feed_records.feed_usage.edit', $data);
        }
        
    }



    public function feedUsageUpdate(Request $request, $id)
    {
        $request->validate([
            'feeding_date'              => 'required|date',
            'feed_type'                 => 'nullable|string',
            'quantity_fed'              => 'nullable|string',
            'time_of_day'               => 'nullable|string',
            'remarks'                   => 'nullable|string',
        ]);

        $record = FeedUsage::findOrFail($id);

        $record->feeding_date           = $request->feeding_date;
        $record->feed_type              = $request->feed_type;
        $record->quantity_fed           = $request->quantity_fed;
        $record->time_of_day            = $request->time_of_day;
        $record->time_of_day            = $request->time_of_day;
        $record->remarks                = $request->remarks;
        $record->updated_by             = Auth::user()->id;

        $record->save();

        return redirect()->route('daily_feed_usage.list')->with('success', 'Record Updated Successfully!');

    }   



    public function feedUsageAjaxSearch(Request $request)
    {
        $query = $request->get('query');

        $records = FeedUsage::with(['staff', 'editor'])

            ->where('id', 'like', "%{$query}%")

            ->orWhere('feeding_date', 'like', "%{$query}%")

            ->orWhere('feed_type', 'like', "%{$query}%")

            ->orWhere('quantity_fed', 'like', "%{$query}%")
            
            ->orWhere('time_of_day', 'like', "%{$query}%")

            ->orWhere('remarks', 'like', "%{$query}%")

            ->orWhereHas('staff', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                ->orWhere('last_name', 'like', "%{$query}%")
                ->orWhere('other_name', 'like', "%{$query}%");
            })
            ->orWhereHas('editor', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                ->orWhere('last_name', 'like', "%{$query}%")
                ->orWhere('other_name', 'like', "%{$query}%");
            })

            ->orderBy('created_at', 'desc')
            ->get();

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.feed_records.feed_usage.partials.table_rows',compact('records'))->render();
        }
        else{
            return view('admin.feed_records.feed_usage.partials.table_rows',compact('records'))->render();
        }
    }




    public function feedUsageDelete($id)
    {
        $record = FeedUsage::findOrFail($id);

        $record->delete();

        if(Auth::user()->user_type == 2)
        {
            // return redirect()->route('staff.daily_feed_usage.list')->with('warning', 'Record Deleted Successfully!');
        }
        else{
            return redirect()->route('daily_feed_usage.list')->with('warning', 'Record Deleted Successfully!');
        }
    }





    // FOR FEED FORMULATION
    public function formulationList(Request $request)
    {
        $data['getRecord'] = feedFormulation::with(['staff', 'editor'])->orderBy('created_at', 'desc')->paginate(100);

        $data['header_title'] = "Feed Formulation";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.feed_records.feed_formulation.list', $data);
        }
        else{
            return view('admin.feed_records.feed_formulation.list', $data);
        }


    }



    public function formulationAjaxSearch(Request $request)
    {
        $record = FeedFormulation::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                // 'html' => view('staff.feed_records.feed_formulation.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{
            return response()->json([
                'html' => view('admin.feed_records.feed_formulation.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
    }



    public function formulationAdd()
    {
        $data['header_title'] = "Add New Record";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.feed_records.feed_formulation.add', $data);
        }
        else{
            return view('admin.feed_records.feed_formulation.add', $data);
        }
    }   


    public function formulationStore(Request $request)
    {
        // dd($request->all());
        // VALIDATION
        $request->validate([
            'formulation_date'  => 'nullable|date',
        ]);

        FeedFormulation::create([
            'formulation_date'      => $request->formulation_date,
            'feed_stage'            => $request->feed_stage,
            'ingredients_used'      => $request->ingredients_used,
            'quantity'              => $request->quantity,
            'cost'                  => $request->cost,
            'total_output'          => $request->total_output,
            'remarks'               => $request->remarks,
            'staff_id'              => Auth::user()->id
        ]);

        if(Auth::user()->user_type == 2)
        {
            // return redirect()->route('staff.feed_stock.list')->with('success', 'Farm record added successfully.');
        }
        else{
            return redirect()->route('feed_formulation.list')->with('success', 'Record added successfully.');
        }
    }



    public function formulationEdit($id)
    {
        $data['header_title'] = "Edit Record";

        $data['getRecord'] = FeedFormulation::findOrFail($id);
        return view('admin.feed_records.feed_formulation.edit', $data);
    }


    public function formulationUpdate(Request $request, $id)
    {
        $request->validate([
            'formulation_date'  => 'nullable|date',
            
        ]);

        FeedFormulation::where('id', $id)->update([
            'formulation_date' => $request->formulation_date,
            'feed_stage'       => $request->feed_stage,
            'ingredients_used' => $request->ingredients_used,
            'quantity'         => $request->quantity,
            'cost'             => $request->cost,
            'total_output'     => $request->total_output,
            'remarks'          => $request->remarks,
            'updated_by'       => Auth::user()->id,
        ]);


        return redirect()->route('feed_formulation.list')->with('success', 'Record Updated Successfully!');

    }


  


    public function formulationDelete($id)
    {
        $record = FeedFormulation::findOrFail($id);
        
        $record->delete();

        return redirect()->route('feed_formulation.list')->with('warning', 'Record Deleted Successfully!');
    }












}
