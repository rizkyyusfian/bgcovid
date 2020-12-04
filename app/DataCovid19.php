<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataCovid19 extends Model
{
    protected $table = 'master_covid19';
    public $timestamps = false;

    public function kabupaten()
    {
    	return $this->belongsTo('App\Kabupaten', 'id_kabupaten');
    }
}
