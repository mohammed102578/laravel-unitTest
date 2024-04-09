<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Company extends Model
{
    use HasFactory , HasTranslations;


    protected $fillable=['name', 'email', 'logo', 'website'];
    public $timestamps = true;
    public $translatable = ['name'];


    public function employees()
    {
        return $this->hasMany('App\Models\Employee', 'company_id');
    }




}

