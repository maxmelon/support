<?php

namespace App\Listeners;

use App\Category;
use App\Events\CategoryWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteAssociatedQuestions
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CategoryWasDeleted  $event
     * @return void
     */
    public function handle(CategoryWasDeleted $event)
    {
        $event->category->questions()->delete();
    }
}
