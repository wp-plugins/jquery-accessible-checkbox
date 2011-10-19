$(function() {

    // $("#accordion_withCheckbox").accordion({
        // collapsible: false,
        // autoHeight: false
    // });

        $(":checkbox").checkbox();	
	    $(':checkbox').change(function() {
        var isChecked = $(this).is(':checked');
        var checkbox = $(this).val();
        var phpAjax = "";
        var classToModify = "";
        var title = "";
        if(checkbox == "posts") {
            phpAjax = "wp-content/plugins/jquery-accessible-checkbox/getRecentPostsAjax.php";
            //classToModify = ".postsCheckbox";
			classToModify = ".areaBCheckbox_recentPosts";
            title = ".postsA";
        } else if(checkbox == "comments") {
            phpAjax = "wp-content/plugins/jquery-accessible-checkbox/getRecentCommentsAjax.php";
            //classToModify = ".commentsCheckbox";
			classToModify = ".areaBCheckbox_recentComments";
            title = ".commentsA";
        } else if(checkbox == "archives") {
            phpAjax = "wp-content/plugins/jquery-accessible-checkbox/getArchivesAjax.php";
            //classToModify = ".archivesCheckbox";
			classToModify = ".areaBCheckbox_archives";
            title = ".archivesA";
        }
        if (isChecked) {
            $.ajax({
                type: "GET",
                url: phpAjax,
                dataType: "json",
                success: function(msg){
                    $(classToModify).empty();
					if(title==".commentsA"){
						$(classToModify).append('<ul><li>' + 'Recent Comments' + '</li></ul>');
					}else if(title==".postsA"){
						$(classToModify).append('<ul><li>' + 'Recent Posts' + '</li></ul>');
					}else if(title==".archivesA"){
						$(classToModify).append('<ul><li>' + 'Archives' + '</li></ul>');
					}
					
                    $(classToModify).append('<ul>' + msg["list"] + '</ul>');					
                }
            });
        } else {
            $.ajax({
                type: "GET",
                url: "wp-content/plugins/jquery-accessible-checkbox/getTextTranslationAjax.php",
                dataType: "json",
                success: function(msg){
                    $(classToModify).empty();
                    //$(classToModify).append('<ul><li>' + msg["text"] + '</li></ul>');
                }
            });
        }
        return false;
    });

});
