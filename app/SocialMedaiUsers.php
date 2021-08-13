<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class socialMedaiUsers extends Model {

    public $table = "social_media_users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'token','type'
    ];

}
