<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donation';

    protected $guarded = [];

    protected $hidden = ['type'];

    protected $with = ['donationType'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function donationType() {
        return $this->hasOne(DonationType::class, 'id', 'type')->select(['id', 'title']);
    }

}
