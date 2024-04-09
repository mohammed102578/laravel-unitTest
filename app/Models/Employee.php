<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Employee extends Model
{
    use HasFactory , HasTranslations;
    public $translatable = ['first_name','last_name'];

    protected $fillable=['first_name', 'last_name', 'company_id', 'email', 'phone'];
    public $timestamps = true;

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

}
