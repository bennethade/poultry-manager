<?php

namespace App\Http\Controllers;

use App\Models\DiseaseIncidence;
use App\Models\MedicationTreatment;
use App\Models\Pig;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiseaseTreatmentController extends Controller
{
    
    public function incidenceList()
    {
        $data['header_title'] = "Disease Incidence";
        $data['getRecord'] = DiseaseIncidence::with(['pig', 'staff', 'editor'])->latest()->paginate(10);

        return view('admin.disease_treatment.disease_incidence.list', $data);
    }


     
    public function incidenceAjaxSearch(Request $request)
    {
        $query = $request->query('query');

        $records = DiseaseIncidence::with(['pig', 'staff', 'editor'])
            ->where(function ($q) use ($query) {
                $q->where('date', 'like', "%{$query}%")
                ->orWhere('pig_id', 'like', "%{$query}%")
                ->orWhere('symptoms_observed', 'like', "%{$query}%")
                ->orWhere('suspected_disease', 'like', "%{$query}%")
                ->orWhere('action_taken', 'like', "%{$query}%")
                ->orWhere('vet_name', 'like', "%{$query}%")
                ->orWhere('outcome', 'like', "%{$query}%");
            })
            ->latest()
            ->get();

        return view('admin.disease_treatment.disease_incidence.partials.table_rows',compact('records'));
    }



    

    public function incidenceAdd()
    {
        $data['header_title'] = "Add Incidence";
        $data['pigs']   = Pig::orderBy('tag_id')->get();
        // $staffs = User::orderBy('name')->get();

        return view('admin.disease_treatment.disease_incidence.add',$data);
    }

    
    

    public function incidenceStore(Request $request)
    {
        $request->validate([
            'date'               => 'required|date',
            'pig_id'             => 'required|exists:pigs,id',
            'symptoms_observed'  => 'required|string',
            'suspected_disease'  => 'required|string|max:255',
            'action_taken'       => 'required|string|max:255',
            'vet_name'           => 'nullable|string|max:255',
            'outcome'            => 'nullable|string|max:255',
        ]);

        DiseaseIncidence::create([
            'date'              => $request->date,
            'pig_id'            => $request->pig_id,
            'symptoms_observed' => $request->symptoms_observed,
            'suspected_disease' => $request->suspected_disease,
            'action_taken'      => $request->action_taken,
            'vet_name'          => $request->vet_name,
            'outcome'           => $request->outcome,
            'staff_id'          => Auth::id(),
        ]);

        return redirect()->route('disease_incidence.list')->with('success', 'Record added successfully.');
    }

    
    

    // public function incidenceView($id)
    // {
    //     $record = DiseaseIncidence::with(['pig', 'staff'])->findOrFail($id);
    //     return view('admin.disease_treatment.disease_incidence.view', compact('record'));
    // }

    
    

    public function incidenceEdit($id)
    {
        $data['header_title'] = "Edit Incidence";
        $data['record'] = DiseaseIncidence::findOrFail($id);
        $data['pigs']   = Pig::orderBy('tag_id')->get();

        return view('admin.disease_treatment.disease_incidence.edit', $data);
    }

   

    public function incidenceUpdate(Request $request, $id)
    {
        $record = DiseaseIncidence::findOrFail($id);

        $request->validate([
            'date'               => 'required|date',
            'pig_id'             => 'required|exists:pigs,id',
            'symptoms_observed'  => 'required|string',
            'suspected_disease'  => 'required|string|max:255',
            'action_taken'       => 'required|string|max:255',
            'vet_name'           => 'nullable|string|max:255',
            'outcome'            => 'nullable|string|max:255',
        ]);

        $record->update([
            'date'              => $request->date,
            'pig_id'            => $request->pig_id,
            'symptoms_observed' => $request->symptoms_observed,
            'suspected_disease' => $request->suspected_disease,
            'action_taken'      => $request->action_taken,
            'vet_name'          => $request->vet_name,
            'outcome'           => $request->outcome,
            'updated_by'        => Auth::id(),
        ]);

        return redirect()->route('disease_incidence.list')->with('success', 'Record updated successfully.');
    }

   
    

    public function incidenceDelete($id)
    {
        DiseaseIncidence::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }




    //MEDICATION TREATMENT METHODS
    public function medicationList()
    {
        $data['header_title'] = "Medication & Treatment";
        $data['getRecord'] = MedicationTreatment::with(['pig', 'staff', 'editor'])->latest()->paginate(10);

        return view('admin.disease_treatment.medication_treatment.list', $data);
    }



    public function medicationAjaxSearch(Request $request)
    {
        $query = $request->query('query');

        $records = MedicationTreatment::with(['pig','staff'])
            ->where(function ($q) use ($query) {
                $q->where('drug_name', 'like', "%{$query}%")
                ->orWhere('date', 'like', "%{$query}%")
                ->orWhere('dosage', 'like', "%{$query}%")
                ->orWhere('duration', 'like', "%{$query}%")
                ->orWhere('administered_by', 'like', "%{$query}%")
                ->orWhere('remarks', 'like', "%{$query}%")
                ->orWhereHas('pig', function ($q2) use ($query) {
                    $q2->where('tag_id', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->get();

        return view('admin.disease_treatment.medication_treatment.partials.table_rows',compact('records'));
    }

    
    

    public function medicationAdd()
    {
        $data['pigs'] = Pig::orderBy('tag_id')->get();
        return view('admin.disease_treatment.medication_treatment.add', $data);
    }

    
    

    public function medicationStore(Request $request)
    {
        $request->validate([
            'pig_id'   => 'required|exists:pigs,id',
            'date'     => 'required|date',
            'drug_name'=> 'required|string',
            'dosage'   => 'required|string',
            'duration' => 'required|string',
        ]);

        MedicationTreatment::create([
            'pig_id'          => $request->pig_id,
            'date'            => $request->date,
            'drug_name'       => $request->drug_name,
            'dosage'          => $request->dosage,
            'duration'        => $request->duration,
            'administered_by' => $request->administered_by,
            'remarks'         => $request->remarks,
            'staff_id'        => Auth::id(),
        ]);

        return redirect()->route('medication_treatment.list')->with('success', 'Record added successfully');
    }

    
    

    public function medicationView($id)
    {
        $record = MedicationTreatment::with(['pig', 'staff'])->findOrFail($id);
        return view('admin.disease_treatment.medication_treatment.view', compact('record'));
    }

    
    

    public function medicationEdit($id)
    {
        $record = MedicationTreatment::findOrFail($id);
        $pigs   = Pig::orderBy('tag_id')->get();

        return view('admin.disease_treatment.medication_treatment.edit', compact('record','pigs'));
    }

   
    

    public function medicationUpdate(Request $request, $id)
    {
        $record = MedicationTreatment::findOrFail($id);

        $request->validate([
            'pig_id'   => 'required|exists:pigs,id',
            'date'     => 'required|date',
            'drug_name'=> 'required|string',
            'dosage'   => 'required|string',
            'duration' => 'required|string',
        ]);

        $record->update([
            'pig_id'          => $request->pig_id,
            'date'            => $request->date,
            'drug_name'       => $request->drug_name,
            'dosage'          => $request->dosage,
            'duration'        => $request->duration,
            'administered_by' => $request->administered_by,
            'remarks'         => $request->remarks,
            'updated_by'      => Auth::id(),
        ]);

        return redirect()->route('medication_treatment.list')
            ->with('success', 'Medication record updated successfully');
    }

    
    

    public function medicationDelete($id)
    {
        MedicationTreatment::findOrFail($id)->delete();

        return back()->with('success', 'Record deleted successfully');
    }

    
    

    











   
}
