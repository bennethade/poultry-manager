<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class MonthlyExpense extends Model
{
    use HasFactory;


    public function getMonthNameAttribute()
    {
        return [
            1=>'January', 
            2=>'February', 
            3=>'March', 
            4=>'April',
            5=>'May', 
            6=>'June', 
            7=>'July', 
            8=>'August',
            9=>'September', 
            10=>'October', 
            11=>'November', 
            12=>'December'
        ][$this->month] ?? '-';
    }



    static public function getRecord($request = null)
    {
        $return = self::select('monthly_expenses.*', 'updated_by.name as updated_by_name', 'updated_by.last_name as updated_by_last_name', 'updated_by.other_name as updated_by_other_name')
                        ->leftJoin('users', 'monthly_expenses.staff_id', '=', 'users.id')
                        ->leftJoin('users as updated_by', 'monthly_expenses.updated_by', '=', 'updated_by.id')
                        ->addSelect('users.name as staff_name')
                        ->addSelect('users.last_name as last_name')
                        ->addSelect('users.other_name as other_name');


                        $monthMap = [
                            'january' => 1,
                            'february' => 2,
                            'march' => 3,
                            'april' => 4,
                            'may' => 5,
                            'june' => 6,
                            'july' => 7,
                            'august' => 8,
                            'september' => 9,
                            'october' => 10,
                            'november' => 11,
                            'december' => 12,
                        ];



                        if ($request !== null) {
                            $searchQuery = trim($request->get('name'));

                            if (!empty($searchQuery)) {

                                $words = preg_split('/\s+/', strtolower($searchQuery));

                                $return = $return->where(function ($query) use ($words, $monthMap) {

                                    foreach ($words as $word) {

                                        $query->where(function ($q) use ($word, $monthMap) {

                                            // Normal column search
                                            $q->where('monthly_expenses.year', 'like', "%$word%")
                                            ->orWhere('monthly_expenses.opening_balance', 'like', "%$word%")
                                            ->orWhere('monthly_expenses.total_spent', 'like', "%$word%")
                                            ->orWhere('monthly_expenses.closing_balance', 'like', "%$word%")
                                            ->orWhere('monthly_expenses.remarks', 'like', "%$word%")
                                            ->orWhere('users.name', 'like', "%$word%")
                                            ->orWhere('users.last_name', 'like', "%$word%")
                                            ->orWhere('users.other_name', 'like', "%$word%")
                                            ->orWhere('updated_by.name', 'like', "%$word%")
                                            ->orWhere('updated_by.last_name', 'like', "%$word%")
                                            ->orWhere('updated_by.other_name', 'like', "%$word%");

                                            // Month FULLNAME search
                                            // if (isset($monthMap[$word])) {
                                            //     $q->orWhere('monthly_expenses.month', $monthMap[$word]);
                                            // }


                                            // FOR MONTHLY ANY WORD MARCHING SEARCH
                                            foreach ($monthMap as $monthName => $monthNumber) {
                                                if (str_starts_with($monthName, $word)) {
                                                    $q->orWhere('monthly_expenses.month', $monthNumber);
                                                }
                                            }
                                        });
                                    }
                                });
                            }
                        }



                        

                        if (!empty(Request::get('date'))) {
                            $return = $return->where(function ($query) {
                                $query->whereDate('monthly_expenses.created_at', Request::get('date'))
                                    ->orWhereDate('monthly_expenses.date', Request::get('date'));
                            });
                        }

                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('monthly_expenses.created_at', 'desc');

        return $return;
    }




}
