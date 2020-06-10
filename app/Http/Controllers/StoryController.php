<?php

namespace App\Http\Controllers;

use App\Story;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Feedback\FeedbackInterface as Feedback;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stories = Story::paginate();

        return View::make('stories.index', compact('stories'));
    }

    public function create()
    {
        $story = new Story();

        $allTags = Tag::pluck('name', 'id')->toArray();

        return View::make('stories.create', compact('story', 'allTags'));
    }

    public function store(Request $request, Feedback $feedback)
    {
        $story = Story::create($this->validateRequest());

        $story->addTags($request->get('tag_list'));

        $feedback->success('The story has been created');

        return redirect()->back();
    }

    public function show(Story $story)
    {
        //
    }

    public function edit(Story $story)
    {
        $allTags = Tag::pluck('name', 'id')->toArray();

        return View::make('stories.edit', compact('story', 'allTags'));
    }

    public function update(Request $request, Story $story, Feedback $feedback)
    {
        $story->update($this->validateRequest());

        $story->addTags($request->get('tag_list'));

        $feedback->success('The story has been updated');

        return redirect()->back();
    }

    public function destroy(Story $story, Feedback $feedback)
    {
        $story->delete();

        $feedback->success('The story has been deleted');

        return redirect()->back();
    }

    public function validateRequest()
    {
        return request()->validate([
            'title'             => 'required',
            'description'       => '',
            'days_to_expire'    => 'integer|min:0',
        ]);
    }
}
