<?php namespace custumbox\models;

class boite extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'boite';
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function boites(){
        return $this->hasMany('custumbox\models\produit', 'id');
    }
}