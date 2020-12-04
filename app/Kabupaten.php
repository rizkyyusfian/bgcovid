<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'master_kabupaten';
    public $timestamps = false;

    public function datacovid19()
    {
    	return $this->hasMany('App\DataCovid19', 'id_kabupaten', 'id');
    }
}
