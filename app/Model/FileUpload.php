<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    public function file_type(){
        return $this->belongsTo(FileType::class, 'fileTypeId');
    }
}
