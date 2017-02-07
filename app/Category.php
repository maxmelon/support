<?php

namespace App;

use App\Events\CategoryWasDeleted;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that get logged.
     *
     * @var array
     */
    protected static $logAttributes = [
        'name',
    ];

    /**
     * The event that is launched when a category is deleted in order to delete all the associated questions as well
     *
     * @var array
     */
    protected $events = [
        'deleting' => CategoryWasDeleted::class
    ];

    /**
     * The relation to the Question model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }


}
