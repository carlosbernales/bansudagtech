<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $table = 'account';

    protected $primaryKey = 'id';

    public $incrementing = true;

    // Specify if the primary key is not an integer
    // protected $keyType = 'string';

    // If you don't want Laravel to manage timestamps, set this to false
    public $timestamps = false;

    // Define the fillable attributes (mass assignable)
    protected $fillable = [
                            'firstname', 
                            'middlename',
                            'lastname',
                            'suffix', 
                            'fullname',
                            'role', 
                            'contact', 
                            'email', 
                            'password', 
                            'birthdate', 
                            'rsbsa', 
                            'fourps', 
                            'indigenous',
                            'tribe_name', 
                            'pwd', 
                            'sex', 
                            'arb', 
                            'region', 
                            'province', 
                            'municipality', 
                            'barangay', 
                            'org_name', 
                            'tot_male', 
                            'tot_female', 
                        ];

    // Define the guarded attributes (not mass assignable)
    // protected $guarded = ['id']
}