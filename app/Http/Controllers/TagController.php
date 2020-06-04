<?php

namespace App\Http\Controllers;

use App\Enums\TagColor;
use App\Tag;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use BenSampo\Enum\Rules\EnumValue;

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
    public function store(Request $request)
    {
        Tag::addTags($request->get('tag_list'));

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
        $colors = TagColor::toSelectArray();

        return view('tags.edit', compact('tag', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update($this->validateRequest($tag->id));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

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
            'color' => new EnumValue(TagColor::class),
        ]);
    }
}
