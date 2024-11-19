<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDocument extends Model
{
    use HasFactory;
    public function getDocumentFileShowAttribute(){
        $id = $this->application_id;
        return $this->document_file != "" ? asset("upload/application/{$id}/".$this->document_file) : asset("frontend/images/no-profile.jpg");
    }
}
