<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowchartModel extends Model
{
    //
    protected $table = 'flowchart';

    protected $fillable = [
        'type_id',
        'chart_name',
        'flowline_name',
        'previous_chart',
        'action_type',
        'action'
    ];

    public function tipe()
    {
        return $this->belongsTo(FlowchartTypeModel::class, 'type_id', 'id');
    }
}
