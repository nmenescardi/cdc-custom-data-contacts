<?php

namespace App\Http\Controllers;

use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class StoryController extends Controller
{

    public function index()
    {
        $allStories = Story::paginate(15);

        View::make('stories.index', compact('stories'));
    }

    public function create()
    {
        $story = new Story();

        View::make('stories.create', compact('story'));
    }

    public function store(Request $request)
    {
        Story::create($this->validateRequest());

        return redirect()->back();
    }

    public function show(Story $story)
    {
        //
    }

    public function edit(Story $story)
    {

        View::make('stories.edit', $story);
    }

    public function update(Request $request, Story $story)
    {
        $story->update($this->validateRequest());

        return redirect()->back();
    }

    public function destroy(Story $story)
    {
        $story->delete();

        return redirect()->back();
    }

    public function validateRequest()
    {
        return [
            'title'             => 'required',
            'description'       => '',
            'days_to_expire'    => 'integer',
        ];
    }
}
