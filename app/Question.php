<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Question extends Model
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'status', 'author', 'authors_email', 'question', 'answer'
    ];

    /**
     * The attributes that get logged.
     *
     * @var array
     */
    protected static $logAttributes = [
        'category_id', 'status', 'author', 'authors_email', 'question', 'answer'
    ];

    /**
     * The relation to the Category model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
