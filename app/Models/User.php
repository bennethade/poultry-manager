<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Request;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    static public function getSingle($id)
    {
        return self::findOrFail($id);
    }


    


    static public function getTotalAdmin()
    {
        return self::select('users.id')
                        ->where('user_type', '=', 1)
                        ->orWhere('user_type', '=', 'Super Admin')
                        ->orWhere('user_type', '=', 'School Admin')
                        ->where('is_delete', '=', 0)
                        ->count();

    }


    static public function getTotalUser($user_type)
    {
        return self::select('users.id')
                        ->where('user_type', '=', $user_type)
                        ->where('is_delete', '=', 0)
                        ->count();

    }




    static public function getAdmin()
    {
        $return = self::select('users.*')
                        ->where('user_type', '=', 1)->orWhere('user_type', '=', 'School Admin')->orWhere('user_type', '=', 'Super Admin')
                        ->where('is_delete', '=', 0);


                        //SEARCH FEATURE STARTS
                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('name', 'like', '%' . Request::get('name'). '%');
                        }
                        
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('email', 'like', '%' . Request::get('email'). '%');
                        }

                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('created_at', '=', Request::get('date'));
                        }
                        //SEARCH FEATURE ENDS
                        

        $return = $return->orderBy('name', 'asc')
                        ->paginate(20);

        return $return;
    }


    static public function getStaff($request = null)
    {
        $return = self::select('users.*')
            ->where('users.user_type', '=', 2);

        if ($request !== null) {
            $searchQuery = trim($request->get('name'));

            if (!empty($searchQuery)) {
                $words = preg_split('/\s+/', $searchQuery); // Split by space

                $return = $return->where(function ($query) use ($words) {
                    foreach ($words as $word) {
                        $query->where(function ($q) use ($word) {
                            $q->where('users.name', 'like', '%' . $word . '%')
                            ->orWhere('users.last_name', 'like', '%' . $word . '%')
                            ->orWhere('users.other_name', 'like', '%' . $word . '%')
                            ->orWhere('users.email', 'like', '%' . $word . '%');
                        });
                    }
                });
            }

        }

        return $return->orderBy('users.last_name', 'asc');
    }

    
    

    static public function getUser($user_type)
    {
        return User::select('users.*')
                    ->where('user_type', '=', $user_type)
                    ->where('is_delete',0)
                    ->get();
    }

    


    static public function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }



    public function getProfile()
    {
        if(!empty($this->profile_picture) && file_exists('upload/profile/'.$this->profile_picture))
        {
            return url('upload/profile/'.$this->profile_picture);
        }
        else
        {
            return '';
        }

    }

    public function getProfileDirect()
    {
        if(!empty($this->profile_picture) && file_exists('upload/profile/'.$this->profile_picture))
        {
            return url('upload/profile/'.$this->profile_picture);
        }
        else
        {
            return url('upload/profile/user.jpg');
        }

    }



    ///CALCULTATE BIRTHDAY

    public static function ageCalculator($student_id){
        $user = User::find($student_id);
        if ($user) {
            $dateOfBirth = $user->date_of_birth; 

            $diff = strtotime('now') - strtotime($dateOfBirth);
            
            $age = floor($diff / (60 * 60 * 24 * 365.25));
            $integerAge  = (int)$age;

        } 
        else 
        {
            '';
        }

        return $integerAge;

    
    }

    
// JUST A DUPLICATE OF AGE CALCULATOR
    public static function birthdayCalculation($student_id)
    {
        $user = User::find($student_id);
        if ($user) {
            $dateOfBirth = $user->date_of_birth; 

            $diff = strtotime('now') - strtotime($dateOfBirth);
            
            $age = floor($diff / (60 * 60 * 24 * 365.25));
            $integerAge  = (int)$age;

        } 
        else 
        {
            '';
        }

        return $integerAge;

    }
    


    public function breedingRecords()
    {
        return $this->hasMany(BreedingRecord::class, 'staff_id');
    }

    public function updatedBreedingRecords()
    {
        return $this->hasMany(BreedingRecord::class, 'updated_by');
    }


   








}
