<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable =[
        "code"
    ];

    public function getWithEng()
    {
        $res   =  Language::select('id','name','icon','type')->orderBy('sort_no','ASC')->get()->toArray();
        $en[]  = ['id' => 0,'name' => 'English','icon' => 'en.png','type' => 0];

        $all = array_merge($en,$res);

        $data = [];

        foreach($all as $a)
        {
            $img    = Asset('upload/language/'.$a['icon']);
            $data[] = ['id' => $a['id'],'name' => $a['name'],'icon' => $a['icon'],'img' => $img,'type' => $a['type']];
        }

        return $data;
    }
}
