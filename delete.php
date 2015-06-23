<?php
function new_excerpt_length($length) 
{
	return 19;
}

function new_excerpt_more($more) 
{
	return '...';
}

function register_my_menus()
{
	register_nav_menus
	(array
		('header-menu1' => 'header-menu1',
		 'header-menu2' => 'header-menu2',
		 'footer-menu1' => 'footer-menu1',
		 'footer-menu2' => 'footer-menu2',
		 'footer-menu3' => 'footer-menu3',
		 'top-mnu1' => 'top-mnu1',
		 'top-mnu2' => 'top-mnu2',
		 'top-mnu3' => 'top-mnu3',
		 'megamenu1' => 'megamenu1',
		 'megamenu2' => 'megamenu2',
		 'megamenu3' => 'megamenu3',
		 'megamenu4' => 'megamenu4',
		 'megamenu5' => 'megamenu5'));
}

function mytheme_comment($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	   
			<div id="comment-<?php comment_ID(); ?>">

		<style>
		.
		</style>	
<div class="post hidden-xs">
	<div class="row">
		<div class="col-sm-1 col-md-1 col-md-offset-1">
			<div class="user_prof">
			<?php echo get_avatar( $comment->comment_author_email, $args['avatar_size']); ?>
			</div>
		</div>
		<div class="col-sm-11 col-md-10">
			<div class="comment_block">
				<div class="user_prop clearfix">
				<p class="user_name pull-left"><?php echo get_comment_author_link() ?>
				<span><?php printf(__('%1$s'), get_comment_date()) ?></span></p>

				<ul class="user_prop_ul pull-right">
				<li><?php comment_reply_link(array_merge( 
					$args, 
				array(
					'depth' => $depth, 
				'max_depth' => $args['max_depth']
				))) ?></li>
				
				</ul>

				<ul class="user_prop_menu">
				<li><a href="#">Reply</a></li>
				<li><a href="#">Complaint</a></li>
				<li><a href="#">Delete</a></li>
				</ul>
				</div>

			<p class="comment_block_p">
			<?php if ($comment->comment_approved == '0'){ ?>
			<?php _e('Your comment is awaiting moderation.') ?>
			 <br />
			<?php }else{ ?>
			<?php comment_text(); } ?>
			</p>
			</div>
		</div>
	</div>
</div>

			</div>
<?php
		break;
	endswitch;
}

if (function_exists('register_nav_menus'))
{
	add_action( 'init', 'register_my_menus' );
}
add_filter('excerpt_length', 'new_excerpt_length');
add_filter('excerpt_more', 'new_excerpt_more');
add_theme_support('post-thumbnails');

include("functions2.php");

?>
