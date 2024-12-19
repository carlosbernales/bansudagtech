<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmsImages extends Model
{
    use HasFactory;

    protected $table = 'farms_images';

    protected $primaryKey = 'id';

    public $incrementing = true;

    // Specify if the primary key is not an integer
    // protected $keyType = 'string';

    // If you don't want Laravel to manage timestamps, set this to false
    public $timestamps = false;

    // Define the fillable attributes (mass assignable)
    protected $fillable = [
                            'farms_fk_id',
                            'image', 
                            ];
    // Define the guarded attributes (not mass assignable)
    // protected $guarded = ['id']
}