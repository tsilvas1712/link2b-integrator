<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_name','cpf_cnpj','phone','contact','active'];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
