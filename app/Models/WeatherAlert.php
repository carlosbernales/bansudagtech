<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherAlert extends Model
{
    use HasFactory;

    protected $table = 'weather_alert';

    protected $primaryKey = 'id';

    public $incrementing = true;

    // Specify if the primary key is not an integer
    // protected $keyType = 'string';

    // If you don't want Laravel to manage timestamps, set this to false
    public $timestamps = false;

    // Define the fillable attributes (mass assignable)
    protected $fillable = [
                            'email',
                            'commodity', 
                            'farm_type', 
                            'livestock_type', 
                            'temperature', 
                            'user_id', 
                            'date_checked',
                            'farm_fk_id'
                            ];
    // Define the guarded attributes (not mass assignable)
    // protected $guarded = ['id']
}