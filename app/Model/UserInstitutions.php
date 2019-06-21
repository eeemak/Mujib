<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserInstitutions extends Model
{
    public function profession_type(){
        return $this->belongsTo(ProfessionType::class, 'ProfessionTypeId');
    }
}
