<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowchartModel extends Model
{
    //
    protected $table = 'flowchart';

    protected $fillable = [
        'name'
    ];

    public function obyek()
    {
        return $this->hasMany(ObjectModel::class, 'flowchart_id', 'id');
    }
}
