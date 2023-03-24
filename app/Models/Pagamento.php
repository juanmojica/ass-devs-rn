<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'associado_id', 
        'anuidade_id', 
        'data_pagamento', 
        'pago'
    ];

    public function associado()
    {
        return $this->belongsTo(Associado::class, 'associado_id');
    }

    public function anuidade()
    {
        return $this->belongsTo(Anuidade::class, 'anuidade_id');
    }
}
