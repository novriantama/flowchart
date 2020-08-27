<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowchartTypeModel extends Model
{
    //
    protected $table = 'flowchart_type';

    protected $fillable = [
        'name'
    ];

    public function chart()
    {
        return $this->hasMany(FlowchartModel::class);
    }
}
