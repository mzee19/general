<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = [
        'type',
        'label_name',
        'min_value',
        'max_value',
        'length',
        'option',
        'mandatory',
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute() {
        $nameAttribute = str_replace(' ', '_', $this->attributes['label_name']);
        return $nameAttribute;
    }

}
