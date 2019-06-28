<?php include locate_template("includes/slugs.php");

$post_id_main      = (isset($post_id_main)?$post_id_main:"");
$ask_question_box  = discy_post_meta("ask_question_box",$post_id_main);
$discy_home_tabs   = discy_post_meta("home_tabs",$post_id_main);
$categories_filter = discy_post_meta("categories_filter",$post_id_main);
$active_points     = discy_options("active_points");
$question_bump     = discy_options("question_bump");
$tabs_menu         = get_option("tabs_menu");

if ($categories_filter == "on") {
	$args = array(
		'child_of'     => 0,
		'orderby'      => 'name',
		'order'        => 'ASC',
		'hide_empty'   => 1,
		'hierarchical' => 1,
		'taxonomy'     => 'question-category'
	);
	$options_categories = get_categories($args);
}

$first_one = discy_home_setting($discy_home_tabs);

if ($ask_question_box == "on") {?>
	<div class="ask-box-question wpqa-question">
		<?php $user_id = get_current_user_id();
		echo wpqa_get_user_avatar(array("user_id" => $user_id,"size" => 29));?>
		<div class="box-question">
			<i class="icon-chat"></i><?php esc_html_e("What’s your question?","discy")?>
			<a href="<?php echo (class_exists("WPQA")?wpqa_add_question_permalink():"#")?>" class="wpqa-question<?php echo apply_filters('wpqa_pop_up_class','').apply_filters('wpqa_pop_up_class_question','')?>"></a>
		</div>
		<div class="clearfix"></div>
	</div>
<?php }?>
<div class="row row-tabs">
	<?php if ($tabs_menu != "on") {
		if (isset($discy_home_tabs) && is_array($discy_home_tabs)) {
			if (isset($first_one)) {?>
				<div class="col <?php echo (isset($options_categories) && is_array($options_categories) && $categories_filter == "on"?"col9":"col12")?>">
					<div class="wrap-tabs">
						<div class="menu-tabs">
							<ul class="menu flex">
								<?php discy_home_tabs($discy_home_tabs,$first_one);?>
							</ul>
						</div><!-- End menu-tabs -->
					</div><!-- End wrap-tabs -->
				</div><!-- End col9 -->
			<?php }
		}
		
		if (isset($options_categories) && is_array($options_categories) && $categories_filter == "on") {
			if (isset($_POST['home_categories'])) {
				wp_safe_redirect(esc_url($_POST['home_categories']));
			    exit;
			}?>
			<div class="col col3">
				<div class="categories-home">
					<div class="search-form">
						<div class="search-filter-form">
							<span class="styled-select cat-filter">
								<select class="home_categories">
									<option value="<?php echo get_post_type_archive_link("question")?>"><?php esc_html_e('All Categories','discy')?></option>
									<?php foreach ($options_categories as $category) {?>
										<option value="<?php echo get_term_link($category->slug,'question-category')?>"><?php echo esc_html($category->name)?></option>
									<?php }?>
								</select>
							</span>
						</div>
					</div><!-- End search-form -->
				</div><!-- End categories-home -->
			</div><!-- End col3 -->
		<?php }
	}?>
</div><!-- End row -->

<?php $get_loop = $orderby_post = "";
if (empty($_GET["show"])) {
	$get_loop = true;
}else {
	if (isset($first_one) && (($first_one == $answers_slug && isset($discy_home_tabs["answers"]["value"]) && $discy_home_tabs["answers"]["value"] != "" && $discy_home_tabs["answers"]["value"] != "0") || ($first_one == $answers_slug_2 && isset($discy_home_tabs["answers-2"]["value"]) && $discy_home_tabs["answers-2"]["value"] != "" && $discy_home_tabs["answers-2"]["value"] != "0"))) {
		$get_loop = true;
	}else if (isset($first_one) && (($first_one == $recent_questions_slug && isset($discy_home_tabs["recent-questions"]["value"]) && $discy_home_tabs["recent-questions"]["value"] != "" && $discy_home_tabs["recent-questions"]["value"] != "0") || ($first_one == $most_answers_slug && isset($discy_home_tabs["most-answers"]["value"]) && $discy_home_tabs["most-answers"]["value"] != "" && $discy_home_tabs["most-answers"]["value"] != "0") || ($first_one == $no_answers_slug && isset($discy_home_tabs["no-answers"]["value"]) && $discy_home_tabs["no-answers"]["value"] != "" && $discy_home_tabs["no-answers"]["value"] != "0") || ($first_one == $most_visit_slug && isset($discy_home_tabs["most-visit"]["value"]) && $discy_home_tabs["most-visit"]["value"] != "" && $discy_home_tabs["most-visit"]["value"] != "0") || ($first_one == $most_vote_slug && isset($discy_home_tabs["most-vote"]["value"]) && $discy_home_tabs["most-vote"]["value"] != "" && $discy_home_tabs["most-vote"]["value"] != "0") || ($first_one == $random_slug && isset($discy_home_tabs["random"]["value"]) && $discy_home_tabs["random"]["value"] != "" && $discy_home_tabs["random"]["value"] != "0") || ($first_one == $question_new_slug && isset($discy_home_tabs["new-questions"]["value"]) && $discy_home_tabs["new-questions"]["value"] != "" && $discy_home_tabs["new-questions"]["value"] != "0") || ($first_one == $question_sticky_slug && isset($discy_home_tabs["sticky-questions"]["value"]) && $discy_home_tabs["sticky-questions"]["value"] != "" && $discy_home_tabs["sticky-questions"]["value"] != "0") || ($first_one == $question_polls_slug && isset($discy_home_tabs["polls"]["value"]) && $discy_home_tabs["polls"]["value"] != "" && $discy_home_tabs["polls"]["value"] != "0") || ($first_one == $recent_posts_slug && isset($discy_home_tabs["recent-posts"]["value"]) && $discy_home_tabs["recent-posts"]["value"] != "" && $discy_home_tabs["recent-posts"]["value"] != "0") || ($question_bump == "on" && $active_points == "on" && $first_one == $question_bump_slug && isset($discy_home_tabs["question-bump"]["value"]) && $discy_home_tabs["question-bump"]["value"] != "" && $discy_home_tabs["question-bump"]["value"] != "0") || ($first_one == $recent_questions_slug_2 && isset($discy_home_tabs["recent-questions-2"]["value"]) && $discy_home_tabs["recent-questions-2"]["value"] != "" && $discy_home_tabs["recent-questions-2"]["value"] != "0") || ($first_one == $most_answers_slug_2 && isset($discy_home_tabs["most-answers-2"]["value"]) && $discy_home_tabs["most-answers-2"]["value"] != "" && $discy_home_tabs["most-answers-2"]["value"] != "0") || ($first_one == $no_answers_slug_2 && isset($discy_home_tabs["no-answers-2"]["value"]) && $discy_home_tabs["no-answers-2"]["value"] != "" && $discy_home_tabs["no-answers-2"]["value"] != "0") || ($first_one == $most_visit_slug_2 && isset($discy_home_tabs["most-visit-2"]["value"]) && $discy_home_tabs["most-visit-2"]["value"] != "" && $discy_home_tabs["most-visit-2"]["value"] != "0") || ($first_one == $most_vote_slug_2 && isset($discy_home_tabs["most-vote-2"]["value"]) && $discy_home_tabs["most-vote-2"]["value"] != "" && $discy_home_tabs["most-vote-2"]["value"] != "0") || ($first_one == $random_slug_2 && isset($discy_home_tabs["random-2"]["value"]) && $discy_home_tabs["random-2"]["value"] != "" && $discy_home_tabs["random-2"]["value"] != "0") || ($first_one == $question_new_slug_2 && isset($discy_home_tabs["new-questions-2"]["value"]) && $discy_home_tabs["new-questions-2"]["value"] != "" && $discy_home_tabs["new-questions-2"]["value"] != "0") || ($first_one == $question_sticky_slug_2 && isset($discy_home_tabs["sticky-questions-2"]["value"]) && $discy_home_tabs["sticky-questions-2"]["value"] != "" && $discy_home_tabs["sticky-questions-2"]["value"] != "0") || ($first_one == $question_polls_slug_2 && isset($discy_home_tabs["polls-2"]["value"]) && $discy_home_tabs["polls-2"]["value"] != "" && $discy_home_tabs["polls-2"]["value"] != "0") || ($first_one == $recent_posts_slug_2 && isset($discy_home_tabs["recent-posts-2"]["value"]) && $discy_home_tabs["recent-posts-2"]["value"] != "" && $discy_home_tabs["recent-posts-2"]["value"] != "0") || ($question_bump == "on" && $active_points == "on" && $first_one == $question_bump_slug_2 && isset($discy_home_tabs["question-bump-2"]["value"]) && $discy_home_tabs["question-bump-2"]["value"] != "" && $discy_home_tabs["question-bump-2"]["value"] != "0"))) {
		$get_loop = true;
	}else if (isset($first_one) && isset($get_tax->term_id) && $get_tax->term_id > 0) {
		$get_loop = true;
		$its_question = "question";
	}else if (isset($first_one) && $first_one == "all" && isset($discy_home_tabs["cat-0"]["value"]) && $discy_home_tabs["cat-0"]["value"] != "" && $discy_home_tabs["cat-0"]["value"] == "0") {
		$get_loop = true;
		$its_question = "question";
	}else {
		echo '<div class="alert-message error"><i class="icon-cancel"></i><p>'.esc_html__("Sorry, this page not found.","discy").'</p></div>';
	}
}

if ($get_loop == true) {
	if (isset($first_one)) {
		if ($first_one == $most_answers_slug || $first_one == $most_answers_slug_2) {
			$orderby_post = "popular";
		}else if ($first_one == $no_answers_slug || $first_one == $no_answers_slug_2) {
			$orderby_post = "no_answer";
		}else if ($first_one == $most_visit_slug || $first_one == $most_visit_slug_2) {
			$orderby_post = "most_visited";
		}else if ($first_one == $most_vote_slug || $first_one == $most_vote_slug_2) {
			$orderby_post = "most_voted";
		}else if ($first_one == $random_slug || $first_one == $random_slug_2) {
			$orderby_post = "random";
		}else if ($question_bump == "on" && $active_points == "on" && ($first_one == $question_bump_slug || $first_one == $question_bump_slug_2)) {
			$orderby_post = "question_bump";
		}
		
		if ($first_one != $recent_posts_slug && $first_one != $recent_posts_slug_2) {
			$its_question = "question";
		}
		
		include locate_template("theme-parts/loop.php");
	}
}