<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class App
 *
 * @package App\Models
 *
 * @property int    $id
 * @property string name
 * @property string category
 * @property double rating
 * @property int    reviews
 * @property string size
 * @property string installs
 * @property string type
 * @property string price
 * @property string content_rating
 * @property string genres
 * @property string last_updated
 * @property string current_version
 * @property string android_version
 */
class App extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'category',
        'rating',
        'reviews',
        'size',
        'installs',
        'type',
        'price',
        'content_rating',
        'genres',
        'last_updated',
        'current_version',
        'android_version',
    ];

    // Scopes
    public function scopeAppName( Builder $query, $name ) {
        return $query->where( "name", $name );
    }

}
