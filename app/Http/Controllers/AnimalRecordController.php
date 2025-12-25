<?php

namespace App\Http\Controllers;

use App\Models\BreedingRecord;
use App\Models\GrowthRecord;
use App\Models\Pig;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalRecordController extends Controller
{
    public function list(Request $request)
    {        
        $data['getRecord'] = Pig::getRecord($request)->paginate(100);
        $data['header_title'] = "Animal Records";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.farm_daily_cares.list', $data);
        }
        else{
            return view('admin.animal_record.animal_identification.list', $data);
        }
        
    }

    


    public function ajaxSearch(Request $request)
    {
        $record = Pig::getRecord($request)->take(100)->get(); // Get without pagination for AJAX

        if(Auth::user()->user_type == 2)
        {
            return response()->json([
                // 'html' => view('staff.farm_daily_cares.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
        else{
            return response()->json([
                'html' => view('admin.animal_record.animal_identification.partials.record_rows', ['getRecord' => $record])->render()
            ]);
        }
    }


    public function add()
    {
        $data['header_title'] = "Add New Farm Record";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.farm_daily_cares.add', $data);
        }
        else{
            return view('admin.animal_record.animal_identification.add', $data);
        }            
    }   


    public function store(Request $request)
    {
        // VALIDATION
        $request->validate([
            'dob'               => 'nullable|date',
            'sex'               => 'required|string',
            'source'            => 'required|string',
            'date_entry'        => 'nullable|date',
            'initial_weight'    => 'nullable|string',
            'current_weight'    => 'nullable|string',
            'status'            => 'required|string',
            'remarks'           => 'nullable|string',
        ]);

        $record = new Pig();

        $record->dob            = $request->dob;
        $record->sex            = $request->sex;
        $record->source         = $request->source;
        $record->date_entry     = $request->date_entry;
        $record->initial_weight = $request->initial_weight;
        $record->current_weight = $request->current_weight;
        $record->status         = $request->status;
        $record->remarks        = $request->remarks;
        $record->staff_id       = Auth::user()->id;


        $record->save();

        if(Auth::user()->user_type == 2)
        {
            // return redirect()->route('staff.farm_daily_care.list')->with('success', 'Farm record added successfully.');
        }
        else{
            return redirect()->route('animal_identification.list')->with('success', 'Record added successfully.');
        }
    }



    public function view($id)
    {
        $data['header_title'] = "View Record";

        $data['getRecord'] = Pig::findOrFail($id);
        
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

        $data['getRecord'] = Pig::findOrFail($id);
        return view('admin.animal_record.animal_identification.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'dob'               => 'nullable|date',
            'sex'               => 'required|string',
            'source'            => 'required|string',
            'date_entry'        => 'nullable|date',
            'initial_weight'    => 'nullable|string',
            'current_weight'    => 'nullable|string',
            'status'            => 'required|string',
            'remarks'           => 'nullable|string',
            
        ]); 

        $record = Pig::findOrFail($id);

        $record->dob            = $request->dob;
        $record->sex            = $request->sex;
        $record->source         = $request->source;
        $record->date_entry     = $request->date_entry;
        $record->initial_weight = $request->initial_weight;
        $record->current_weight = $request->current_weight;
        $record->status         = $request->status;
        $record->remarks        = $request->remarks;
        $record->updated_by       = Auth::user()->id;
       
        $record->save();

        return redirect()->route('animal_identification.list')->with('success', 'Record Updated Successfully!');

    }


  


    public function delete($id)
    {
        $record = Pig::findOrFail($id);

        $record->delete();

        return redirect()->route('animal_identification.list')->with('warning', 'Record Deleted Successfully!');
    }




    // FOR BREEDING RECORDS

    public function breedList(Request $request)
    {
        $data['boars'] = Pig::where('sex','Male')->get();
        $data['sows'] = Pig::where('sex','Female')->get();

        $data['getRecord'] = BreedingRecord::with(['sow', 'boar', 'staff', 'editor'])->orderBy('created_at', 'desc')->paginate(100);

        $data['header_title'] = "Breed Records";

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.animal_record.breeding_record.list', $data);
        }
        else{
            return view('admin.animal_record.breeding_record.list', $data);
        }


    }


    public function breedStore(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'sow_id'                    => 'required|integer',
            'boar_id'                   => 'required|integer',
            'type'                      => 'nullable|string',
            'expected_farrow_date'      => 'nullable|date',
            'actual_farrow_date'        => 'nullable|date',
            'number_of_born_alive'      => 'nullable|integer',
            'number_of_stillborn'       => 'nullable|integer',
            'remarks'                   => 'nullable|string',
        ]);

        $record = new BreedingRecord();

        $record->sow_id                   = $request->sow_id;
        $record->boar_id                  = $request->boar_id;
        $record->type                     = $request->type;
        $record->expected_farrow_date     = $request->expected_farrow_date;
        $record->actual_farrow_date       = $request->actual_farrow_date;
        $record->number_of_born_alive     = $request->number_of_born_alive;
        $record->number_of_stillborn      = $request->number_of_stillborn;
        $record->remarks                  = $request->remarks;
        $record->staff_id                 = Auth::user()->id;

        $record->save();

        return redirect()->route('breeding_record.list')->with('success', 'Record added successfully.');
    }


    public function breedEdit($id)
    {
        $data['header_title'] = "Edit Breeding Record";

        $data['boars'] = Pig::where('sex','Male')->get();
        $data['sows'] = Pig::where('sex','Female')->get();

        $data['getRecord'] = BreedingRecord::findOrFail($id);
        
        if(Auth::user()->user_type == 2)
        {
            // return view('staff.animal_record.breeding_record.edit', $data);
        }
        else{
            return view('admin.animal_record.breeding_record.edit', $data);
        }
        
    }



    public function breedUpdate(Request $request, $id)
    {
        $request->validate([
            'sow_id'                    => 'required|integer',
            'boar_id'                   => 'required|integer',
            'type'                      => 'nullable|string',
            'expected_farrow_date'      => 'nullable|date',
            'actual_farrow_date'        => 'nullable|date',
            'number_of_born_alive'      => 'nullable|integer',
            'number_of_stillborn'       => 'nullable|integer',
            'remarks'                   => 'nullable|string',
        ]);

        $record = BreedingRecord::findOrFail($id);

        $record->sow_id                   = $request->sow_id;
        $record->boar_id                  = $request->boar_id;
        $record->type                     = $request->type;
        $record->expected_farrow_date     = $request->expected_farrow_date;
        $record->actual_farrow_date       = $request->actual_farrow_date;
        $record->number_of_born_alive     = $request->number_of_born_alive;
        $record->number_of_stillborn      = $request->number_of_stillborn;
        $record->remarks                  = $request->remarks;
        $record->updated_by               = Auth::user()->id;

        $record->save();

        return redirect()->route('breeding_record.list')->with('success', 'Record Updated Successfully!');

    }   



    public function breedingAjaxSearch(Request $request)
    {
        $query = $request->get('query');

        $records = BreedingRecord::with(['sow', 'boar', 'staff', 'editor'])

            ->whereHas('sow', function ($q) use ($query) {
                $q->where('tag_id', 'like', "%{$query}%");
            })

            ->orWhereHas('boar', function ($q) use ($query) {
                $q->where('tag_id', 'like', "%{$query}%");
            })

            ->orWhere('id', 'like', "%{$query}%")

            ->orWhere('type', 'like', "%{$query}%")

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
            // return view('staff.animal_record.breeding_record.partials.table_rows',compact('records'))->render();
        }
        else{
            return view('admin.animal_record.breeding_record.partials.table_rows',compact('records'))->render();
        }
    }




    public function breedDelete($id)
    {
        $record = BreedingRecord::findOrFail($id);

        $record->delete();

        if(Auth::user()->user_type == 2)
        {
            // return redirect()->route('staff.breeding_record.list')->with('warning', 'Record Deleted Successfully!');
        }
        else{
            return redirect()->route('breeding_record.list')->with('warning', 'Record Deleted Successfully!');
        }
    }




    // FOR GROWTH AND PERFORMANCE

    public function growthList(Request $request)
    {
        $data['header_title'] = "Growth & Performance";
        
        $data['pigs'] = Pig::orderBy('tag_id')->get();

        // $data['records'] = GrowthRecord::with(['pig', 'staff', 'editor'])
        //     ->latest()
        //     ->limit(100)
        //     ->get();

        $data['records'] = GrowthRecord::with(['pig', 'staff', 'editor'])->latest()->paginate(100); 


        $data['chartDates'] = [];
        $data['chartWeights'] = [];

        if(Auth::user()->user_type == 2)
        {
            // return redirect()->route('staff.breeding_record.list')->with('warning', 'Record Deleted Successfully!');
        }
        else{
            return view('admin.animal_record.growth_performance.list', $data);
        }
    }





    public function growthStore(Request $request)
    {
        $request->validate([
            'pig_id' => 'required',
            'measurement_date' => 'nullable|date',
            'weight' => 'nullable|numeric',
        ]);

        GrowthRecord::create([
            'pig_id'                => $request->pig_id,
            'measurement_date'      => $request->measurement_date,
            'age_in_days'           => $request->age_in_days,
            'age_in_weeks'          => $request->age_in_weeks,
            'weight'                => $request->weight,
            'feed_type'             => $request->feed_type,
            'remarks'               => $request->remarks,
            'staff_id'              => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Growth record saved successfully');
    }



    /**
     * AJAX: Load growth data for selected pig
     */
    public function loadPigGrowth($pig_id)
    {
        $records = GrowthRecord::where('pig_id', $pig_id)
            ->orderBy('measurement_date')
            ->get();

        $chartDates = $records->pluck('measurement_date');
        $chartWeights = $records->pluck('weight');

        $table = view('admin.animal_record.growth_performance.partials.table_rows', compact('records'))->render();

        return response()->json([
            'chartDates' => $chartDates,
            'chartWeights' => $chartWeights,
            'table' => $table
        ]);
    }


    public function growthEdit($id)
    {
        $data['header_title'] = "Edit Growth Record";

        $data['pigs'] = Pig::orderBy('tag_id')->get();

        $data['record'] = GrowthRecord::findOrFail($id);

        $data['getPig'] = Pig::where('id', $data['record']->pig_id)->first();
        
        return view('admin.animal_record.growth_performance.edit', $data);
    }


    public function growthUpdate(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            'pig_id'            => 'required',
            'measurement_date'  => 'nullable|date',
            'weight'            => 'nullable|numeric',
        ]);

        $record = GrowthRecord::findOrFail($id);

        $record->pig_id               = $request->pig_id;
        $record->measurement_date     = $request->measurement_date;
        $record->age_in_days          = $request->age_in_days;
        $record->age_in_weeks         = $request->age_in_weeks;
        $record->weight               = $request->weight;
        $record->feed_type            = $request->feed_type;
        $record->remarks              = $request->remarks;
        $record->updated_by           = Auth::id();

        $record->save();

        return redirect()->route('growth_performance.index')->with('success', 'Record updated successfully');
    }





    public function growthDelete($id)
    {
        $record = GrowthRecord::findOrFail($id);

        $record->delete();

        return redirect()->route('growth_performance.index')->with('warning', 'Record deleted successfully');
    }



}
