<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
  use HasFactory;

  protected $fillable = ['tenant_name', 'cpf_cnpj', 'phone', 'contact', 'active', 'token'];

  public function users()
  {
    return $this->hasMany(User::class);
  }

  public function profiles()
  {
    return $this->belongsToMany(Profile::class);
  }

  public function profilesAvailable()
  {
    $profiles = Profile::whereNotIn('id', function ($query) {
      $query->select('profile_tenant.profile_id');
      $query->from('profile_tenant');
      $query->whereRaw("profile_tenant.tenant_id={$this->id}");
    })
      ->get();

    return $profiles;
  }

  public function compaigns()
  {
    return $this->belongsToMany(Campaign::class);
  }

  public function datasys()
  {
    return $this->hasMany(Datasys::class);
  }
}
