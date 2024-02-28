<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationType extends Model
{
    use HasFactory;

    protected $table = 'donation_types';

    protected $guarded = [];

    protected $appends = ['total_donations'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function getTotalDonationsAttribute() {
        return Donation::where('type', '=', $this->id)->sum('amount');
    }

}
