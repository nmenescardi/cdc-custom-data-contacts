$(document).ready(function() {
    const tagField = $(".add-tags #tags");
    const addNewTags = true === $(".add-tags #tags").data("new-tags");

    tagField.select2({
        placeholder: "Add Tags",
        tags: addNewTags
    });
});
