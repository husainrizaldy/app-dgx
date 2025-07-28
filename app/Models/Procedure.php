<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_type_id', 'doc_type_id', 'files'
    ];

    public function researchType()
    {
        return $this->belongsTo(ResearchType::class);
    }

    public function docType()
    {
        return $this->belongsTo(DocType::class);
    }
}
