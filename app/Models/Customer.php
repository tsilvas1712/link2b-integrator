<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;

  class Customer extends Model
  {
    use HasFactory;

    protected $fillable = [
      'name',
      'email',
      'endpoint_link2b',
      'token_link2b',
      'endpoint_customer',
      'token_customer',
      'active'
    ];
  }
