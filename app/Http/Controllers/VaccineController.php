<?php

namespace App\Http\Controllers;

use App\Models\Pig;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\VaccineLog;
use App\Models\VaccineLogMoreRecord;
use App\Models\VaccineSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccineController extends Controller
{
    public function scheduleList()
    {
        $data['header_title'] = "Vaccine Schedule";
        $data['getRecord'] = VaccineSchedule::with(['pig', 'staff', 'editor'])->latest()->paginate(10);

        if(Auth::user()->user_type == 2)
        {
            return view('staff.vaccine_record.vaccine_schedule.list', $data);
        }
        else{
            return view('admin.vaccine_record.vaccine_schedule.list', $data);
        }
    }


     
    public function scheduleAjaxSearch(Request $request)
    {
        $query = $request->query('query');

        $records = VaccineSchedule::with(['pig', 'staff', 'editor'])
            ->where(function ($q) use ($query) {
                $q->where('pig_id', 'like', "%{$query}%")
                ->orWhere('vaccine_name', 'like', "%{$query}%")
                ->orWhere('age_given', 'like', "%{$query}%")
                ->orWhere('date_given', 'like', "%{$query}%")
                ->orWhere('next_due_date', 'like', "%{$query}%")
                ->orWhere('administered_by', 'like', "%{$query}%")
                ->orWhere('remarks', 'like', "%{$query}%");
            })->latest()->get();

        if(Auth::user()->user_type == 2)
        {
            return view('staff.vaccine_record.vaccine_schedule.partials.table_rows',compact('records'));
        }
        else{
            return view('admin.vaccine_record.vaccine_schedule.partials.table_rows',compact('records'));
        }
    }



    

    public function scheduleAdd()
    {
        $data['header_title'] = "Add Vaccine Schedule";
        $data['pigs']   = Pig::orderBy('tag_id')->where('status', true)->get();

        if(Auth::user()->user_type == 2)
        {
            return view('staff.vaccine_record.vaccine_schedule.add',$data);
        }
        else{
            return view('admin.vaccine_record.vaccine_schedule.add',$data);
        }
    }

    
    

    public function scheduleStore(Request $request)
    {
        // dd($request->all());
        
        $request->validate([
            'pig_id'                => 'required|exists:pigs,id',
            'vaccine_name'          => 'required',
            'age_given'             => 'nullable|string',
            'date_given'            => 'nullable|date',
            'next_due_date'         => 'nullable|date',
            'administered_by'       => 'nullable|string|max:255',
            'remarks'               => 'nullable|string|max:255',
        ]);

        VaccineSchedule::create([
            'pig_id'                => $request->pig_id,
            'vaccine_name'          => $request->vaccine_name,
            'age_given'             => $request->age_given,
            'date_given'            => $request->date_given,
            'next_due_date'         => $request->next_due_date,
            'administered_by'       => $request->administered_by,
            'remarks'               => $request->remarks,
            'staff_id'              => Auth::id(),
        ]);

        
        if(!empty($request->next_due_date)){
            
            $category_id = TaskCategory::where('name', 'Vaccine Schedules')->value('id');

            Task::create([
                'title'         => $request->vaccine_name,
                'description'   => $request->remarks,
                'category_id'   => $category_id,
                'assigned_to'   => Auth::id(),
                'priority'      => 'medium',
                'due_date'      => $request->next_due_date,
                'status'        => 'pending',
                'staff_id'      => Auth::id(),
            ]);

        }

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.vaccine_schedule.list')->with('success', 'Record added successfully.');
        }
        else{
            return redirect()->route('vaccine_schedule.list')->with('success', 'Record added successfully.');
        }
    }


    

    // public function scheduleView($id)
    // {
    //     $record = VaccineSchedule::with(['pig', 'staff'])->findOrFail($id);
    //     return view('admin.vaccine_record.disease_schedule.view', compact('record'));
    // }

    
    

    public function scheduleEdit($id)
    {
        $data['header_title'] = "Edit schedule";
        $data['record'] = VaccineSchedule::findOrFail($id);
        $data['pigs']   = Pig::orderBy('tag_id')->where('status', true)->get();

        if(Auth::user()->user_type == 2)
        {
            return view('staff.vaccine_record.vaccine_schedule.edit', $data);
        }
        else{
            return view('admin.vaccine_record.vaccine_schedule.edit', $data);
        }
    }

   

    public function scheduleUpdate(Request $request, $id)
    {
        $record = VaccineSchedule::findOrFail($id);

        $request->validate([
            'pig_id'                => 'required|exists:pigs,id',
            'vaccine_name'          => 'required',
            'age_given'             => 'nullable|string',
            'date_given'            => 'nullable|date',
            'next_due_date'         => 'nullable|date',
            'administered_by'       => 'nullable|string|max:255',
            'remarks'               => 'nullable|string|max:255',
        ]);

        $record->update([
            'pig_id'                => $request->pig_id,
            'vaccine_name'          => $request->vaccine_name,
            'age_given'             => $request->age_given,
            'date_given'            => $request->date_given,
            'next_due_date'         => $request->next_due_date,
            'administered_by'       => $request->administered_by,
            'remarks'               => $request->remarks,
            'updated_by'            => Auth::id(),
        ]);

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.vaccine_schedule.list')->with('success', 'Record updated successfully.');
        }
        else{
            return redirect()->route('vaccine_schedule.list')->with('success', 'Record updated successfully.');
        }
    }

   
    

    public function scheduleDelete($id)
    {
        VaccineSchedule::findOrFail($id)->delete();

        return redirect()->back()->with('warning', 'Record deleted successfully.');
    }




    //VACCINE LOG METHODS
    public function logList()
    {
        $data['header_title'] = "Vaccine Log";
        $data['getRecord'] = VaccineLog::with(['staff', 'editor'])->latest()->paginate(10);

        if(Auth::user()->user_type == 2)
        {
            return view('staff.vaccine_record.vaccine_log.list', $data);
        }
        else{
            return view('admin.vaccine_record.vaccine_log.list', $data);
        }
    }



    public function logAjaxSearch(Request $request)
    {
        $query = $request->query('query');

        $records = VaccineLog::with(['staff', 'editor'])
            ->where(function ($q) use ($query) {
                $q->where('vaccine_name', 'like', "%{$query}%")
                ->orWhere('date', 'like', "%{$query}%")
                ->orWhere('no_of_pigs_vaccinated', 'like', "%{$query}%")
                ->orWhere('batch_no', 'like', "%{$query}%")
                ->orWhere('expiry_date', 'like', "%{$query}%")
                ->orWhere('vet_name', 'like', "%{$query}%")
                ->orWhere('remarks', 'like', "%{$query}%")
                ->orWhereHas('staff', function ($q2) use ($query) {
                    $q2->where('name', 'like', "%{$query}%");
                });
                // ->orWhereHas('editor', function ($q2) use ($query) {
                //     $q2->where('name', 'like', "%{$query}%");
                //     $q2->where('last_name', 'like', "%{$query}%");
                // });
            })
            ->latest()
            ->get();

        if(Auth::user()->user_type == 2)
        {
            return view('staff.vaccine_record.vaccine_log.partials.table_rows',compact('records'));
        }
        else{
            return view('admin.vaccine_record.vaccine_log.partials.table_rows',compact('records'));
        }
    }

    
    

    public function logAdd()
    {
        $data['header_title'] = "Add Vaccine Log";

        $data['pigs'] = Pig::orderBy('tag_id')->where('status', true)->get();
        if(Auth::user()->user_type == 2)
        {
            return view('staff.vaccine_record.vaccine_log.add', $data);
        }
        else{
            return view('admin.vaccine_record.vaccine_log.add', $data);
        }
    }

    
    

    public function logStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'date'                  => 'required|date',
            'vaccine_name'          => 'required|string',
            'no_of_pigs_vaccinated' => 'nullable|integer',
            'batch_no'              => 'nullable|string',
            'expiry_date'           => 'nullable|date',
            'vet_name'              => 'nullable|string',
            'remarks'               => 'nullable|string',
        ]);

        VaccineLog::create([
            'date'                      => $request->date,
            'vaccine_name'              => $request->vaccine_name,
            'no_of_pigs_vaccinated'     => $request->no_of_pigs_vaccinated,
            'batch_no'                  => $request->batch_no,
            'expiry_date'               => $request->expiry_date,
            'vet_name'                  => $request->vet_name,
            'remarks'                   => $request->remarks,
            'staff_id'                  => Auth::id(),
        ]);

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.vaccine_log.list')->with('success', 'Record added successfully');
        }
        else{
            return redirect()->route('vaccine_log.list')->with('success', 'Record added successfully');
        }
    }

    
    

    public function logView($id)
    {
        $data['header_title'] = "View Vaccine Log";

        $data['record'] = VaccineLog::with(['pig', 'staff'])->findOrFail($id);
        
        if(Auth::user()->user_type == 2)
        {
            return view('staff.vaccine_record.vaccine_log.view', $data);
        }
        else{
            return view('admin.vaccine_record.vaccine_log.view', $data);
        }
    }

    
    

    public function logEdit($id)
    {
        $data['header_title'] = "Edit Vaccine Log";

        $data['record'] = VaccineLog::findOrFail($id);

        if(Auth::user()->user_type == 2)
        {
            return view('staff.vaccine_record.vaccine_log.edit', $data);
        }
        else{
            return view('admin.vaccine_record.vaccine_log.edit', $data);
        }
    }



   
    

    public function logUpdate(Request $request, $id)
    {
        $record = VaccineLog::findOrFail($id);

        $request->validate([
            'date'                  => 'required|date',
            'vaccine_name'          => 'required|string',
            'no_of_pigs_vaccinated' => 'nullable|integer',
            'batch_no'              => 'nullable|string',
            'expiry_date'           => 'nullable|date',
            'vet_name'              => 'nullable|string',
            'remarks'               => 'nullable|string',
        ]);

        $record->update([
            'date'                      => $request->date,
            'vaccine_name'              => $request->vaccine_name,
            'no_of_pigs_vaccinated'     => $request->no_of_pigs_vaccinated,
            'batch_no'                  => $request->batch_no,
            'expiry_date'               => $request->expiry_date,
            'vet_name'                  => $request->vet_name,
            'remarks'                   => $request->remarks,
            'updated_by'                => Auth::id(),
        ]);

        if(Auth::user()->user_type == 2)
        {
            return redirect()->route('staff.vaccine_log.list')->with('success', 'Record updated successfully');
        }
        else{
            return redirect()->route('vaccine_log.list')->with('success', 'Record updated successfully');
        }
    }

    
    

    public function logDelete($id)
    {
        VaccineLog::findOrFail($id)->delete();

        return back()->with('warning', 'Record deleted successfully');
    }




    public function logMoreRecord($id)
    {
        $data['header_title'] = "More Record";

        $data['getVaccineLog'] = VaccineLog::where('id', $id)->first();

        $data['getRecord'] = VaccineLogMoreRecord::with(['creator', 'editor'])->where('vaccine_log_id', $id)->latest()->paginate(100);


        if(Auth::user()->user_type == 2)
        {
            return view('staff.vaccine_record.vaccine_log.more_record', $data);
        }
        else{
            return view('admin.vaccine_record.vaccine_log.more_record', $data);
        }
    }



    public function logMoreRecordStore(Request $request, $id)
    {

        $request->validate([
            'date'          => 'required|date',
            'quantity'      => 'nullable',
            'remarks'       => 'nullable|string',
        ]);


        VaccineLogMoreRecord::create([
            'vaccine_log_id'    => $id,
            'date'              => $request->date,
            'quantity'          => $request->quantity,
            'remarks'           => $request->remarks,
            'staff_id'          => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Record added successfully');
    }





    public function logMoreRecordEdit($id)
    {
        $data['header_title'] = "Edit Record";

        $data['getRecord'] = VaccineLogMoreRecord::findOrFail($id);

        if(Auth::user()->user_type == 2)
        {
            // return view('staff.vaccine_record.vaccine_log.more_record_edit', $data);
        }
        else{
            return view('admin.vaccine_record.vaccine_log.more_record_edit', $data);
        }
    }



    public function logMoreRecordUpdate(Request $request, $id)
    {

        $request->validate([
            'date'          => 'required|date',
            'quantity'      => 'nullable',
            'remarks'       => 'nullable|string',
        ]);

        VaccineLogMoreRecord::findOrFail($id)->update([
                    'date'              => $request->date,
                    'quantity'          => $request->quantity,
                    'remarks'           => $request->remarks,
                    'updated_by'            => Auth::id(),
                ]);

        return redirect()->back()->with('success', 'Updated successfully');
    }



    public function logMoreRecordDelete($id)
    {
        VaccineLogMoreRecord::findOrFail($id)->delete();

        return redirect()->back()->with('warning', 'Record Deleted Successfully!');
    }




    
    



}
