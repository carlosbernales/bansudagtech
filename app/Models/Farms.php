<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farms extends Model
{
    use HasFactory;

    protected $table = 'farms';

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
                            'fullname',
                            'commodity', 
                            'farm_type',
                            'location',
                            'forms_farm',
                            'livestock_type',
                            'email',
                            'region',
                            'municipality',
                            'province',
                            'barangay',
                            'farm_area',
                            'area_planted',
                            'firstname',
                            'middlename',
                            'lastname',
                            'suffix',
                            'sex',
                            'contact',
                            'fourps',
                            'indigenous',
                            'pwd',
                            'birthdate',
                        ];
    // Define the guarded attributes (not mass assignable)
    // protected $guarded = ['id']

    public function farmImages()
    {
        return $this->hasMany(FarmsImages::class, 'farms_fk_id', 'id');
    }
}