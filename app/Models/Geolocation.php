<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'longitude',
        'latitude',
    ];

    /**
     * Get the customer that owns the location
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
