<?php
namespace App\Models;
class Listing{
    public static function all(){
        return [
            [
                'id' => 1,
                'title' => 'Listing One',
                'description' => 'Risotto made from nigeria, i think they call it jollof'
            ],
            [
                'id' => 2,
                'title' => 'Listing Two',
                'description' => 'some stuff from England, probably not food'
            ],
            [
                'id' => 3,
                'title' => 'Listing Three',
                'description' => 'this is leftover chinese food, still good tho'
            ],
        ];
    }

    public static function find($id){
        $listings = self::all();
        foreach($listings as $listing){
            if($listing['id'] == $id){
                return $listing;
            }
        }
    }
}
