<?php

namespace App\Http\Controllers;

use App\Enums\TagColor;
use App\Tag;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Feedback\FeedbackInterface as Feedback;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Feedback $feedback)
    {
        Tag::addTags($request->get('tag_list'));

        $feedback->success('The tag has been created');

        return redirect('contacts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $colors = [];

        return view('tags.edit', compact('tag', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag, Feedback $feedback)
    {
        $tag->update($this->validateRequest($tag->id));

        $feedback->success('The tag has been updated');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag, Feedback $feedback)
    {
        $tag->delete();

        $feedback->success('The tag has been deleted');

        return redirect()->back();
    }

    protected function validateRequest($tagId = 0)
    {
        // Ignore current tagID to validate unique name on update action
        $uniqueNameRule =
            ($tagId) ?
            Rule::unique('tags')->ignore($tagId) :
            'unique:tags';

        return request()->validate([
            'name' => [
                'required',
                $uniqueNameRule
            ],
            'color' => 'sometimes',
        ]);
    }
}
