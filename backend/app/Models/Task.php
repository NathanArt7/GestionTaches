<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    //
    protected $fillable = [
        'titre',
        'description',
        'priorite',
        'statut',
        'date_limite',
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

