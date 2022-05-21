<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "id",
        'email',
        'first_name',
        'last_name',
        'gender',
        'city',
        'company',
        'title',
    ];

    /**
     * Get the geolocation associated with this customer
     */
    public function geoLocation()
    {
        return $this->hasOne(Geolocation::class);
    }

    /**
     * Scope a query to search
     *
     * @param Builder $query
     * @return void
     */
    public function scopeSearch(Builder $query, Request $request)
    {
        $searchFields = [
            'first_name',
            'last_name',
            'title',
            'company',
            'city',
            'gender',
            'email',
        ];

        foreach ($searchFields as $fieldName) {
            if ($request->has($fieldName)) {
                $query->where($fieldName, $request->input($fieldName));
            }
        }
    }

}
