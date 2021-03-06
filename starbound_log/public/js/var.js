{
    var onResize = function () {
        var center = $(".grid_vertical_center");
        var wrapperHeight = $("#mws-wrapper").height() - 200;
        if (center.length == 1) {
            if (center.height() < wrapperHeight) {
                center.css("margin-top", (wrapperHeight - center.height()) / 2);
            }
        }
        $(".model-login, #mws-navigation .key-2").bind("click", function (event) {
            $("#mws-login-ui").dialog("option", {
                modal: true
            }).dialog("open");
            event.preventDefault();
        });
    };


    $(function () {
        $(window).resize(onResize);
        onResize();
        $('.ibutton').iButton({
            /*duration: 200                          // the speed of the animation
            , easing: "swing"                      // the easing animation to use
            , labelOn: "ON"                        // the text to show when toggled on
            , labelOff: "OFF"                      // the text to show when toggled off
            , resizeHandle: "auto"                 // determines if handle should be resized
            , resizeContainer: "auto"              // determines if container should be resized*/
            enableDrag: false                    // determines if we allow dragging
            , enableFx: true                       // determines if we show animation
            , allowRadioUncheck: true             // determine if a radio button should be able to be unchecked
            /*, clickOffset: 120                     // if millseconds between a mousedown & mouseup event this value, then considered a mouse click});*/
        });

        $('.dataTables_filter select').change(function(){
            $(this).parents('form').submit();
        });

        // Checkable Tables
        $('table tbody td.single-checkbox-column :checkbox').on('change', function () {
            var that = this;
            $(this).parents('table').children('tbody').each(function (i, tbody) {
                $(tbody).find('.single-checkbox-column').each(function (j, cb) {
                    var checkbox = $(':checkbox', $(cb));
                    if (checkbox.get(0) != that) {
                        checkbox.prop("checked", false);//.trigger('change');
                    }
                });
            });
        });
        $('.mws-table tbody tr').click(function () {
            if ($(this).find('td.single-checkbox-column')) {
                var checkbox = $(this).find('td.single-checkbox-column :checkbox');
                checkbox.prop("checked", !checkbox.prop("checked"));
                checkbox.change();
            }
        });
    });
}