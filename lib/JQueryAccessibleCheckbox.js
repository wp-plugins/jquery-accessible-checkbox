$(function() {

    $("#accordion_withCheckbox").accordion({
        collapsible: false,
        autoHeight: false
    });

    $(":checkbox").checkbox();
    $(':checkbox').change(function() {
        var isChecked = $(this).is(':checked');
        var checkbox = $(this).val();
        var phpAjax = "";
        var classToModify = "";
        var title = "";
        if(checkbox == "posts") {
            phpAjax = "wp-content/plugins/JQueryAccessibleCheckbox/getRecentPostsAjax.php";
            classToModify = ".postsCheckbox";
            title = ".postsA";
        } else if(checkbox == "comments") {
            phpAjax = "wp-content/plugins/JQueryAccessibleCheckbox/getRecentCommentsAjax.php";
            classToModify = ".commentsCheckbox";
            title = ".commentsA";
        } else if(checkbox == "archives") {
            phpAjax = "wp-content/plugins/JQueryAccessibleCheckbox/getArchivesAjax.php";
            classToModify = ".archivesCheckbox";
            title = ".archivesA";
        }
        if (isChecked) {
            $.ajax({
                type: "GET",
                url: phpAjax,
                dataType: "json",
                success: function(msg){
                    $(classToModify).empty();
                    $(classToModify).append('<ul>' + msg["list"] + '</ul>');
                }
            });
        } else {
            $.ajax({
                type: "GET",
                url: "wp-content/plugins/JQueryAccessibleCheckbox/getTextTranslationAjax.php",
                dataType: "json",
                success: function(msg){
                    $(classToModify).empty();
                    $(classToModify).append('<ul><li>' + msg["text"] + '</li></ul>');
                }
            });
        }
        return false;
    });

});
