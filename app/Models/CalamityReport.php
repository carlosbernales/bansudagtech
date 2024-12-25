<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalamityReport extends Model
{
    use HasFactory;

    protected $table = 'calamity_report';

    protected $primaryKey = 'id';

    public $incrementing = true;

    // Specify if the primary key is not an integer
    // protected $keyType = 'string';

    // If you don't want Laravel to manage timestamps, set this to false
    public $timestamps = false;

    // Define the fillable attributes (mass assignable)
    protected $fillable = [
                            'user_id',
                            'rsbsa',
                            'calamity_type',
                            'farmer_type', 
                            'birthdate',
                            'region',
                            'province',
                            'municipality',
                            'barangay',
                            'org_name',
                            'tot_male',
                            'tot_female',
                            'sex',
                            'indigenous',
                            'tribe_name',
                            'pwd',
                            'arb',
                            'fourps',
                            'crop_type',
                            'partially_damage',
                            'totally_damage',
                            'total_area',
                            'livestock_type',
                            'animal_type',
                            'age_class',
                            'no_heads',
                            'remarks',
                            'lastname',
                            'firstname',
                            'middlename',
                            'suffix',
                            'fullname',
                            'location',
                            'assistance_type',
                            'date_provided',
                            'status',
                            'email',
                            'date_reported,'
                        ];
    // Define the guarded attributes (not mass assignable)
    // protected $guarded = ['id']

    public function calamityImages()
    {
        return $this->hasMany(CalamityImages::class, 'cal_fk_id', 'id');
    }
}