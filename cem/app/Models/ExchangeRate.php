<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    use HasFactory;
    protected $fillable = ['currency_id', 'rate', 'date'];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}