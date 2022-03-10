<?php namespace custumbox\models;

class categorie extends \Illuminate\Database\Eloquent\Models {
    protected $table = 'categorie';
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function categories(){
        return $this->belongsToMany('custumbox\models\produit', 'id');
    }
}