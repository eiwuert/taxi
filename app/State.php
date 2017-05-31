<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name', 'active'];
    public $timestamps = false;

    public function status()
    {
        if ($this->active){
            return '<span class="label label-success">'.__('admin/general.Active').'</span>';
        }else{
            return '<span class="label label-danger">'.__('admin/general.Inactive').'</span>';
        }
    }

    public function setActiveAttribute($value)
    {
        if($value){
            $this->attributes['active'] = true;
        }else{
            $this->attributes['active'] = false;
        }
    }
}
