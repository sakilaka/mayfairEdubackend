<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedEbook extends Model
{
    use HasFactory;

    public function ebook(){
        return $this->belongsTo(Ebook::class,"relatedebook_id",'id');
    }
}
