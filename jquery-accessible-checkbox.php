<?php
/*
Plugin Name: JQuery Accessible Checkbox
Plugin URI: http://wordpress.org/extend/plugins/jquery-accessible-checkbox/
Description: WAI-ARIA Enabled Checkbox Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 3.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "JQueryAccessibleCheckbox_init");
function JQueryAccessibleCheckbox_init() {
    register_sidebar_widget(__('JQuery Accessible Checkbox'), 'widget_JQueryAccessibleCheckbox');
    register_widget_control(   'JQuery Accessible Checkbox', 'JQueryAccessibleCheckbox_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_JQueryAccessibleCheckbox') ) {
        wp_register_style('jquery.ui.all', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-checkbox/lib/jquery-ui/themes/base/jquery.ui.all.css'));
        wp_enqueue_style('jquery.ui.all');

        wp_deregister_script('jquery');

        // add your own script
        wp_register_script('jquery-1.6.4', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-checkbox/lib/jquery-ui/jquery-1.6.4.js'));
        wp_enqueue_script('jquery-1.6.4');

        wp_register_script('jquery.ui.core.js', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-checkbox/lib/jquery-ui/ui/jquery.ui.core.js'));
        wp_enqueue_script('jquery.ui.core.js');

        wp_register_script('jquery.ui.widget', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-checkbox/lib/jquery-ui/ui/jquery.ui.widget.js'));
        wp_enqueue_script('jquery.ui.widget');

        wp_register_script('jquery.ui.accordion', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-checkbox/lib/jquery-ui/ui/jquery.ui.accordion.js'));
        wp_enqueue_script('jquery.ui.accordion');

        wp_register_script('jquery.ui.checkbox', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-checkbox/lib/jquery-ui/ui/jquery.ui.checkbox.js'));
        wp_enqueue_script('jquery.ui.checkbox');

        wp_register_style('demos', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-checkbox/lib/jquery-ui/demos.css'));
        wp_enqueue_style('demos');

        wp_register_script('JQueryAccessibleCheckbox', ( get_bloginfo('wpurl') . '/wp-content/plugins/jquery-accessible-checkbox/lib/JQueryAccessibleCheckbox.js'));
        wp_enqueue_script('JQueryAccessibleCheckbox');
    }
}

function widget_JQueryAccessibleCheckbox($args) {
    extract($args);

    $options = get_option("widget_JQueryAccessibleCheckbox");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'JQuery Accessible Checkbox',
            'archives' => 'Archives',
            'posts' => 'Posts',
            'comments' => 'Comments',
            'recent' => 'Recent',
            'show' => 'Show',
            'text' => 'Select the appropriate checkbox'
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

	
    //Our Widget Content
    JQueryAccessibleCheckboxContent();	
    echo $after_widget;
}

function JQueryAccessibleCheckboxContent() {
    $options = get_option("widget_JQueryAccessibleCheckbox");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'JQuery Accessible Checkbox',
            'archives' => 'Archives',
            'posts' => 'Posts',
            'comments' => 'Comments',
            'recent' => 'Recent',
            'show' => 'Show',
            'text' => 'Select the appropriate checkbox'
        );
    }
    
    echo '<div class="demo" role="application">
    <form>
		<input type="checkbox" id="check1" name="archivesButton" value="archives" /><label for="check1">' . $options['show'] . ' ' . $options['archives'] . '</label>
		<input type="checkbox" id="check2" name="postsButton" value="posts" /><label for="check2">' . $options['show'] . ' ' . $options['recent'] . ' ' . $options['posts'] . '</label>
		<input type="checkbox" id="check3" name="commentsButton" value="comments" /><label for="check3">' . $options['show'] . ' ' . $options['recent'] . ' ' . $options['comments'] . '</label>

		<div class="areaBCheckbox_archives"></div>
		<div class="areaBCheckbox_recentPosts"></div>
		<div class="areaBCheckbox_recentComments"></div>
		
	</form>';
}

function JQueryAccessibleCheckbox_control() {
    $options = get_option("widget_JQueryAccessibleCheckbox");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'JQuery Accessible Checkbox',
            'archives' => 'Archives',
            'posts' => 'Posts',
            'comments' => 'Comments',
            'recent' => 'Recent',
            'show' => 'Show',
            'text' => 'Select the appropriate checkbox'
        );
    }

    if ($_POST['JQueryAccessibleCheckbox-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['JQueryAccessibleCheckbox-WidgetTitle']);
        update_option("widget_JQueryAccessibleCheckbox", $options);
    }
    if ($_POST['JQueryAccessibleCheckbox-SubmitArchives']) {
        $options['archives'] = htmlspecialchars($_POST['JQueryAccessibleCheckbox-WidgetArchives']);
        update_option("widget_JQueryAccessibleCheckbox", $options);
    }
    if ($_POST['JQueryAccessibleCheckbox-SubmitRecent']) {
        $options['recent'] = htmlspecialchars($_POST['JQueryAccessibleCheckbox-WidgetRecent']);
        update_option("widget_JQueryAccessibleCheckbox", $options);
    }
    if ($_POST['JQueryAccessibleCheckbox-SubmitPosts']) {
        $options['posts'] = htmlspecialchars($_POST['JQueryAccessibleCheckbox-WidgetPosts']);
        update_option("widget_JQueryAccessibleCheckbox", $options);
    }
    if ($_POST['JQueryAccessibleCheckbox-SubmitComments']) {
        $options['comments'] = htmlspecialchars($_POST['JQueryAccessibleCheckbox-WidgetComments']);
        update_option("widget_JQueryAccessibleCheckbox", $options);
    }
    if ($_POST['JQueryAccessibleCheckbox-SubmitShow']) {
        $options['show'] = htmlspecialchars($_POST['JQueryAccessibleCheckbox-WidgetShow']);
        update_option("widget_JQueryAccessibleCheckbox", $options);
    }
    if ($_POST['JQueryAccessibleCheckbox-SubmitText']) {
        $options['text'] = htmlspecialchars($_POST['JQueryAccessibleCheckbox-WidgetText']);
        update_option("widget_JQueryAccessibleCheckbox", $options);
    }
    ?>
    <p>
        <label for="JQueryAccessibleCheckbox-WidgetTitle">Widget Title: </label>
        <input type="text" id="JQueryAccessibleCheckbox-WidgetTitle" name="JQueryAccessibleCheckbox-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="JQueryAccessibleCheckbox-SubmitTitle" name="JQueryAccessibleCheckbox-SubmitTitle" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleCheckbox-WidgetArchives">Translation for "Archives": </label>
        <input type="text" id="JQueryAccessibleCheckbox-WidgetArchives" name="JQueryAccessibleCheckbox-WidgetArchives" value="<?php echo $options['archives'];?>" />
        <input type="hidden" id="JQueryAccessibleCheckbox-SubmitArchives" name="JQueryAccessibleCheckbox-SubmitArchives" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleCheckbox-WidgetPosts">Translation for "Posts": </label>
        <input type="text" id="JQueryAccessibleCheckbox-WidgetPosts" name="JQueryAccessibleCheckbox-WidgetPosts" value="<?php echo $options['posts'];?>" />
        <input type="hidden" id="JQueryAccessibleCheckbox-SubmitPosts" name="JQueryAccessibleCheckbox-SubmitPosts" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleCheckbox-WidgetComments">Translation for "Comments": </label>
        <input type="text" id="JQueryAccessibleCheckbox-WidgetComments" name="JQueryAccessibleCheckbox-WidgetComments" value="<?php echo $options['comments'];?>" />
        <input type="hidden" id="JQueryAccessibleCheckbox-SubmitComments" name="JQueryAccessibleCheckbox-SubmitComments" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleCheckbox-WidgetRecent">Translation for "Recent": </label>
        <input type="text" id="JQueryAccessibleCheckbox-WidgetRecent" name="JQueryAccessibleCheckbox-WidgetRecent" value="<?php echo $options['recent'];?>" />
        <input type="hidden" id="JQueryAccessibleCheckbox-SubmitRecent" name="JQueryAccessibleCheckbox-SubmitRecent" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleCheckbox-WidgetShow">Translation for "Show": </label>
        <input type="text" id="JQueryAccessibleCheckbox-WidgetShow" name="JQueryAccessibleCheckbox-WidgetShow" value="<?php echo $options['show'];?>" />
        <input type="hidden" id="JQueryAccessibleCheckbox-SubmitShow" name="JQueryAccessibleCheckbox-SubmitShow" value="1" />
    </p>
    <p>
        <label for="JQueryAccessibleCheckbox-WidgetText">Translation for "Select the appropriate checkbox": </label>
        <input type="text" id="JQueryAccessibleCheckbox-WidgetText" name="JQueryAccessibleCheckbox-WidgetText" value="<?php echo $options['text'];?>" />
        <input type="hidden" id="JQueryAccessibleCheckbox-SubmitText" name="JQueryAccessibleCheckbox-SubmitText" value="1" />
    </p>
    
    <?php
}

?>
