<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    //lenta priklauso useriams
    public function user(){
        return $this->belongsTo(User::class);
    }

    //lenta turi daug tasku
    public function task(){
        return $this->hasMany(Task::class);
    }

    //ieskos pagal lentos url pavadinima vietoje id
//    public function getRouteKeyName()
//    {
//        //lentos pavadinimas, kuris draugiskas url, ty be jokiu tarpu spec simb. ir tt
//        return 'name';
//    }

    //jei norime praleisti visus siunciamus laukus
    //protected $guarded = [];

    //filtruojame kokius laukus mums siuncia
    protected $guarded = ['user_id', 'sharewithuser', 'name', 'description'];
}
