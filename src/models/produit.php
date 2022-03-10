<?php namespace custumbox\models;

class produit extends \Illuminate\Database\Eloquent\Models {
    protected $table = 'produit';
    protected $primaryKey = 'id' ;
    public $timestamps = false ;

    public function produits(){
        return $this->belongsToMany('custumbox\models\boite', 'id');
    }

    public function produitCateg(){
        return $this->hasOne('custumbox\models\categorie', 'id');
    }
}