<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Question;
use League\Csv\Writer;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{
    /**
     * Show last 20 actions
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $users = User::all();
        $categories = Category::all();
        $questions = Question::all();
        $activities = Activity::orderBy('created_at', 'desc')->take(20)->get();
        return view('dashboard.logs', compact('users', 'categories', 'questions', 'activities'));
    }

    public function exportFullLogs()
    {
        $activities = Activity::orderBy('created_at', 'desc')->get();
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Date', 'User', 'Activity']);
        foreach($activities as $activity) {
            $value = [];
            array_push($value, $activity->created_at);
            array_push($value, $activity->causer->name);
            $description = class_basename($activity->subject_type);
            $description .= ' ' . '(' . $activity->subject_id . ')';
            $description .= ' ' . 'has been';
            $description .= ' ' . $activity->description;
            foreach ($activity->changes['attributes'] as $key => $attribute) {
                $description .= ' ' . $key . ': ' . $attribute;
            }
            if(isset($activity->changes['old'])) {
            $description .= ' ' . 'Old properties:';
                foreach ($activity->changes['old'] as $key => $attribute) {
                    $description .= ' ' . $key . ': ' . $attribute;
                }
            }
            array_push($value, $description);
            $csv->insertOne($value);
        }
        $csv->output('users.csv');
    }

}
