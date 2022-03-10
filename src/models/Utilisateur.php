<?php

namespace custumbox\src\models;

class Utilisateur extends \Illuminate\Database\Eloquent\Model
{
    protected $table = "utilisateur";
    protected $primaryKey = "id";
    public $timestamps = false;

}
