<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable =['campaign_id','counter_register','data'];

    public function campaigs(){
        return $this->belongsTo(Campaign::class);
    }

}
