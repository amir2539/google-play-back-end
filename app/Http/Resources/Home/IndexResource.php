<?php

namespace App\Http\Resources\Home;

use App\Models\App;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\CalendarUtils;

/**
 * Class IndexResource
 *
 * @package App\Http\Resources\Home
 *
 * @mixin App
 */
class IndexResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray( $request ) {

        if ( $this->current_version == "Varies with device" ) {
            $current_version = "متغیر";
        } else {
            $current_version = str_replace( "and up", "به بالا", $this->current_version );
        }

        if ( $this->android_version == "Varies with device" ) {
            $android_version = "متغیر";
        } else {
            $android_version = str_replace( "and up", "به بالا", $this->android_version );
        }

        $last_updated = jdate( strtotime( $this->last_updated ) )->format("Y-m-d");

        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'category'        => $this->category,
            'rating'          => $this->rating,
            'reviews'         => $this->reviews,
            'size'            => $this->size,
            'installs'        => $this->size,
            'type'            => $this->type == "Free" ? "رایگان" : "پولی",
            'price'           => $this->price,
            'content_rating'  => $this->content_rating,
            'genres'          => $this->genres,
            'last_updated'    => $last_updated,
            'current_version' => $current_version,
            'android_version' => $android_version,
        ];
    }
}
