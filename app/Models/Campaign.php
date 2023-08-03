<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;

  class Campaign extends Model
  {
    use HasFactory;

    protected $fillable = [
      'name',
      'sales_modalities',
      'tenant_id',
      'endpoint_link2b',
      'token_link2b',
      'endpoint_customer',
      'token_customer',
      'active'
    ];

    public function tenant()
    {
      return $this->hasOne(Tenant::class);
    }

    public function sales()
    {
      return $this->belongsToMany(Sale::class);
    }

    public function histories(){
        return $this->hasMany(History::class);
    }
  }
