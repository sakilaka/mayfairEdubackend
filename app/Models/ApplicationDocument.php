<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDocument extends Model
{
    use HasFactory; 

    protected $fillable = [
        'application_id',
        'user_id',
        'document_name',
        'document_type',
        'document_file',
        'extensions',
        
    ];

    
    public function getDocumentFileShowAttribute(){
        $id = $this->application_id;
        return $this->document_file != "" ? asset("upload/application/{$id}/".$this->document_file) : asset("frontend/images/no-profile.jpg");
    }
}