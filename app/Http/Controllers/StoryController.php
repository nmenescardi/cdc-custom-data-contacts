<?php

namespace App\Http\Controllers;

use App\Story;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $perPage = 15;

        $stories = Story::paginate($perPage);

        $currentPage = request()->get('page', 1);

        $paginationOffset = $perPage * ($currentPage - 1);

        return View::make('stories.index', compact('stories', 'paginationOffset'));
    }

    public function create()
    {
        $story = new Story();

        return View::make('stories.create', compact('story'));
    }

    public function store(Request $request)
    {
        $story = Story::create($this->validateRequest());

        $story->addTags($request->get('tag_list'));

        return redirect()->back();
    }

    public function show(Story $story)
    {
        //
    }

    public function edit(Story $story)
    {

        return View::make('stories.edit', $story);
    }

    public function update(Request $request, Story $story)
    {
        $story->update($this->validateRequest());

        $story->addTags($request->get('tag_list'));

        return redirect()->back();
    }

    public function destroy(Story $story)
    {
        $story->delete();

        return redirect()->back();
    }

    public function validateRequest()
    {
        return request()->validate([
            'title'             => 'required',
            'description'       => '',
            'days_to_expire'    => 'integer',
        ]);
    }
}
