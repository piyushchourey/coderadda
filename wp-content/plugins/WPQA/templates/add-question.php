<?php

/* @author    2codeThemes
*  @package   WPQA/templates
*  @version   1.0
*/

do_action("wpqa_before_add_question");

echo "<div class='wpqa-add-question-template'>".do_shortcode("[wpqa_question".(wpqa_add_question_user() && wpqa_add_question_user() > 0?" type='user'":"")."]")."</div>";

do_action("wpqa_after_add_question");?>