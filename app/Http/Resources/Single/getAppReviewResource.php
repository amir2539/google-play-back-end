<?php

namespace App\Http\Resources\Single;

use App\Models\Review;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class getAppReviewResource
 *
 * @package App\Http\Resources\Single
 *
 * @mixin Review
 */
class getAppReviewResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray( $request ) {

        $content                = $this->translated_review != "nan" ? $this->translated_review : "نامشخص";
        $sentiment              = $this->sentiment != "nan" ? $this->sentiment : "نامشخص";
        $sentiment_polarity     = $this->sentiment_polarity != "nan" ? $this->sentiment_polarity : "نامشخص";
        $sentiment_subjectivity = $this->sentiment_subjectivity != "nan" ? $this->sentiment_subjectivity : "نامشخص";

        return [
            'content'                => $content,
            'sentiment'              => $sentiment,
            'sentiment_polarity'     => $sentiment_polarity,
            'sentiment_subjectivity' => $sentiment_subjectivity,
        ];
    }
}
