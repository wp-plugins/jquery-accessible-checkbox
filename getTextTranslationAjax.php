<?php

/** Define ABSPATH as this files directory */
define('ABSPATH', dirname(__FILE__) . '/../../../');
include_once(ABSPATH . "wp-config.php");

$options = get_option("widget_JQueryAccessibleCheckbox");
if (!is_array($options)) {
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
$stuffToReturn["text"] = $options['text'];
echo json_encode($stuffToReturn);
?>
