<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    //
    protected $guarded = [];

    /*public static function boot(){
    	parent::boot();
    	static::creating(function($flight){
    		$flight->slug=\Str::slug($flight->name);

    	});
    }*/

    public function createUniqueSlug($request_name){
        $slug = \Str::slug($request_name);
        // $related_slugs = $this->select('slug')->where("slug","like",$slug.'%')->get();
        // $related_slugs = $this->select('slug')->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->get();
        $related_slugs = $this->relatedSlugs($slug);
        $unique_slug = $slug;
        $counter = 1;
        while($related_slugs->contains('slug',$unique_slug)){
            $unique_slug = $slug."-".$counter;
            $counter+=1;
        }
        return $unique_slug;
    }

    public function relatedSlugs($slug){
    	return $this->select('slug')->where("slug","like",$slug.'%')->get();
    }

}
