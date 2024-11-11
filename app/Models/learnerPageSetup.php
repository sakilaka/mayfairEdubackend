<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learnerPageSetup extends Model
{
    use HasFactory;

    public function getImage1ShowAttribute(){
        return $this->image1 != "" ? asset('upload/learner/'. $this?->image1) : asset('frontend/images/No-image.jpg');
    }


    public function learnercontents(){
        return $this->hasMany(learnerPageContent::class,"learner_id",'id');
    }
}
