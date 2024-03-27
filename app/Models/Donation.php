<?php

namespace App\Models;

use App\Models\Scopes\DonationsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donation';

    protected $guarded = [];

    protected $hidden = ['type', 'show_name'];

    protected $with = ['donationType'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new DonationsScope());
    }

    public function donationType() {
        return $this->hasOne(DonationType::class, 'id', 'type')->select(['id', 'title']);
    }

}
