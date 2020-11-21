<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 *
 * @package App\Models
 *
 * @property int    $id
 * @property string app
 * @property string sentiment
 * @property string translated_review
 * @property double sentiment_polarity
 * @property double sentiment_subjectivity
 */
class Review extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'app',
        'translated_review',
        'sentiment',
        'sentiment_polarity',
        'sentiment_subjectivity',
    ];

    //Scopes
    public function scopeAppName( Builder $query, $name ) {
        return $query->where( "app", $name );
    }
}
