<?php

namespace App\Models;

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
 * @property double sentiment_polarity
 * @property double sentiment_subjectivity
 */
class Review extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'app',
        'sentiment',
        'sentiment_polarity',
        'sentiment_subjectivity',
    ];
}
