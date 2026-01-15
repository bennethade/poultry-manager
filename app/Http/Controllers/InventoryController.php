<?php

namespace App\Http\Controllers;

use App\Models\FarmInventory;
use App\Models\FarmInventoryMoreRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;


class InventoryController extends Controller
{
    public function inventoryList(Request $request)
    {
        $data['getRecord'] = FarmInventory::getRecord($request)->paginate(100);

        $data['header_title'] = "Farm Inventory";

        if(Auth::user()->user_type == 2)
        {
            return view('staff.inventory.farm_inventory.list', $data);
        }
        else{
            return view('admin.inventory.farm_inventory.list', $data);
        }
    }



    public function inventoryAjaxSearch(Request $request)
    {
        $record = FarmInventory::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                'html' => view('staff.inventory.farm_inventory.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{
            return response()->json([
                'html' => view('admin.inventory.farm_inventory.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
    }



    public function inventoryAdd()
    {
        $data['header_title'] = "Add New Record";

        if(Auth::user()->user_type == 2)
        {
            return view('staff.inventory.farm_inventory.add', $data);
        }
        else{
            return view('admin.inventory.farm_inventory.add', $data);
        }
    }   


    public function inventoryStore(Request $request)
    {
        $request->validate([
            'date'             => 'nullable|date',
            'item_name'        => 'nullable|string',
        ]);

        $record = new FarmInventory();

        $record->date          = $request->date;
        $record->item_name     = $request->item_name;
        $record->category      = $request->category;
        $record->quantity      = $request->quantity;
        $record->cost          = $request->cost;
        $record->remarks       = $request->remarks;
        $record->source       = $request->source;
        $record->status       = $request->status;
        $record->staff_id      = Auth::user()->id;


        if(!empty($request->file('picture')))
        {
            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/farm_inventory/'.$filename); 

            $record->picture = $filename;  //For the DB Fields
        }


        $record->save();

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.farm_inventory.list')->with('success', 'Record added successfully.');
        }
        else{
            return redirect()->route('farm_inventory.list')->with('success', 'Record added successfully.');
        }
    }



    public function inventoryEdit($id)
    {
        $data['header_title'] = "Edit Record";

        $data['getRecord'] = FarmInventory::findOrFail($id);
        if(Auth::user()->user_type == 2)
        {
            return view('staff.inventory.farm_inventory.edit', $data);
        }
        else{
            return view('admin.inventory.farm_inventory.edit', $data);
        }
    }
    


    public function inventoryUpdate(Request $request, $id)
    {
        $request->validate([
            'date'  => 'nullable|date',
            'item_name'          => 'nullable|string',
            // 'picture'        => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $record = FarmInventory::findOrFail($id);

        $record->date          = $request->date;
        $record->item_name     = $request->item_name;
        $record->category      = $request->category;
        $record->quantity      = $request->quantity;
        $record->cost          = $request->cost;
        $record->remarks       = $request->remarks;
        $record->source       = $request->source;
        $record->status       = $request->status;
        $record->updated_by       = Auth::user()->id;

        if(!empty($request->file('picture')))
        {
            if(!empty($record->picture))
            {
                unlink('upload/farm_inventory/'.$record->picture);
            }

            $file = $request->file('picture');
            $fname = time() . '_' . $file->getClientOriginalName();
            $filename = strtolower($fname);

            $file = Image::read($request->file('picture'));     //Image Intervention Lines
            $file->resize(500, 500);
            $file->save('upload/farm_inventory/'.$filename); 


            $record->picture = $filename;   //For the DB Fields
        }

       
        $record->save();

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.farm_inventory.list')->with('success', 'Record Updated Successfully!');
        }
        else{
            return redirect()->route('farm_inventory.list')->with('success', 'Record Updated Successfully!');
        }

    }


  


    public function inventoryDelete($id)
    {
        $record = FarmInventory::findOrFail($id);

        if(!empty($record->picture))
        {
            unlink('upload/farm_inventory/'.$record->picture);
        }
        
        $record->delete();

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.farm_inventory.list')->with('warning', 'Record Deleted Successfully!');
        }
        else{
            return redirect()->route('farm_inventory.list')->with('warning', 'Record Deleted Successfully!');
        }
    }




    public function inventoryMoreRecord($id)
    {
        $data['header_title'] = "More Record";

        $data['getFarmInventory'] = FarmInventory::findOrFail($id);

        $data['getRecord'] = FarmInventoryMoreRecord::with(['creator', 'editor'])->where('farm_inventory_id', $id)->orderBy('created_at', 'desc')->paginate(100);

        if(Auth::user()->user_type == 2)
        {
            return view('staff.inventory.farm_inventory.more_record', $data);
        }
        else{
            return view('admin.inventory.farm_inventory.more_record', $data);
        }
    }


    public function inventoryMoreRecordStore(Request $request, $id)
    {
        
        $request->validate([
            'date'                  => 'required|date',
            'quantity_used'         => 'nullable|string',
            'quantity_remaining'    => 'nullable|string',
            'current_state'         => 'nullable|string',
            'remarks'               => 'nullable|string',
        ]);


        FarmInventoryMoreRecord::create([
            'farm_inventory_id'     => $id,
            'date'                  => $request->date,
            'quantity_used'         => $request->quantity_used,
            'quantity_remaining'    => $request->quantity_remaining,
            'current_state'         => $request->current_state,
            'remarks'               => $request->remarks,
            'staff_id'              => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Record added successfully');
    }





    public function inventoryMoreRecordEdit($id)
    {
        $data['header_title'] = "Edit Record";

        $data['getRecord'] = FarmInventoryMoreRecord::findOrFail($id);

        if(Auth::user()->user_type == 2)
        {
            return view('staff.inventory.farm_inventory.more_record_edit', $data);
        }
        else{
            return view('admin.inventory.farm_inventory.more_record_edit', $data);
        }
    }



    public function inventoryMoreRecordUpdate(Request $request, $id)
    {
        // dd($request->date);


        $request->validate([
            'date'                  => 'required|date',
            'quantity_used'         => 'nullable',
            'quantity_remaining'    => 'nullable|string',
            'current_state'         => 'nullable|string',
            'remarks'               => 'nullable|string',
        ]);

        FarmInventoryMoreRecord::findOrFail($id)->update([
                    'date'                  => $request->date,
                    'quantity_used'         => $request->quantity_used,
                    'quantity_remaining'    => $request->quantity_remaining,
                    'current_state'         => $request->current_state,
                    'remarks'               => $request->remarks,
                    'updated_by'            => Auth::id(),
                ]);

        return redirect()->back()->with('success', 'Updated successfully');
    }



    public function inventoryMoreRecordDelete($id)
    {
        FarmInventoryMoreRecord::findOrFail($id)->delete();

        return redirect()->back()->with('warning', 'Record Deleted Successfully!');
    }








}
