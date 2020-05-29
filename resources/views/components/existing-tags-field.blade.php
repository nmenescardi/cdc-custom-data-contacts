@props(['allTags'])

<div class="form-group">
    <div class="add-tags">
        <label for="tags">Add Tags:</label>
        <select name="tag_list[]" id="tags" class="form-control" multiple="multiple">
            @foreach ($allTags as $key => $tag)
            <option value="{{$key}}">{{$tag}}</option>
            @endforeach
        </select>
    </div>
</div>
