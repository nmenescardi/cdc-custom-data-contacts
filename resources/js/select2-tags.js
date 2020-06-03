$(document).ready(function() {
    const tagField = $(".add-tags #tags");
    const addNewTags = true === $(".add-tags #tags").data("new-tags");
    tagField.select2({
        placeholder: "Add Tags",
        tags: addNewTags
    });

    /**
     * Color Selector:
     */
    const colorField = $(".select-colors #color");
    colorField.select2({
        placeholder: "Select a Color",
        escapeMarkup: function(m) {
            return m;
        },
        templateResult: color => {
            return $(`
                <div class="select-colors__option">
                    <span class="select-colors__color-rectangle select-colors__color-rectangle--${color.id}"></span>
                    <span class="select-colors__text">${color.text}</span>
                </div>
            `);
        }
    });
    if (colorField.data("select2"))
        colorField.data("select2").$selection.css("height", "38px");
});
