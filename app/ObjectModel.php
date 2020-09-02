<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectModel extends Model
{
    //
    protected $table = 'object';

    protected $fillable = [
        'flowchart_id',
        'name',
        'type',
        'parent',
        'action_type',
        'action'
    ];

    public function master()
    {
        return $this->belongsTo(FlowchartModel::class, 'flowchart_id', 'id');
    }
}
