<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Associado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome', 
        'email', 
        'cpf', 
        'data_filiacao'
    ];

    public function pagamentos()
    {
        return $this->hasMany(Pagamento::class);
    }
}
