<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Nascimentos;


class Estagios extends Model
{
    protected $table = 'estagios';
    protected $id;

    public function getAllEstagios() {

    	return $this->where('ativo', '=', 1)->get();
    }

    public function nascimento()
    {
       return $this->hasMany(Nascimentos::class);
    }
    
}
