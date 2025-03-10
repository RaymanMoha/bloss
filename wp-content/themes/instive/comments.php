<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */
?>
<?php
// If the current post is protected by a password and the visitor has not yet 
// entered the password we will return early without loading the comments.
// ----------------------------------------------------------------------------------------
if ( post_password_required() ) {
	return;
}
?>

<?php if ( have_comments() || comments_open()) : ?>
<div id="comments" class="blog-post-comment">

	<?php if ( have_comments()) : ?>

        <h3 class="comment-num">
			<?php
			if(get_comments_number()>1){
				printf( '%1$s ' . esc_html__( 'Comments ', 'instive' ), get_comments_number() );
			}else{
				printf( '%1$s ' . esc_html__( 'Comment ', 'instive' ), get_comments_number() );

			}
			?>
		</h3>


		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">

				<h1 class="screen-reader-text">
					<?php esc_html_e( 'Comment navigation', 'instive' ); ?>
				</h1>
				<div class="nav-previous">
					<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'instive' ) ); ?>
				</div>
				<div class="nav-next">
					<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'instive' ) ); ?>
				</div>
			
			</nav><!-- #comment-nav-above -->
		<?php endif; //check for comment navigation ?>

		<ul class="comments-list">
			<?php
			wp_list_comments( array(
			       'reply_text'        => '<i class="fas fa-reply-all"></i> Reply',
				    'callback'          => 'instive_comment_style',
				    'style'			 => 'ul',
				    'short_ping'	 => false,
				    'type'              => 'all',
                    'format'            => current_theme_supports( 'html5', 'comment-list' ) ? 'html5' : 'xhtml',
				    'avatar_size'	 => 60,
			) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-bellow" class="navigation comment-navigation" role="navigation">

				<h1 class="screen-reader-text">
					<?php esc_html_e( 'Comment navigation', 'instive' ); ?>
				</h1>
				<div class="nav-previous">
					<?php previous_comments_link( esc_html__( '&larr; Older Comments', 'instive' ) ); ?>
				</div>
				<div class="nav-next">
					<?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'instive' ) ); ?>
				</div>
			
			</nav><!-- #comment-nav-bellow -->
		<?php endif; //check for comment navigation ?>

		<?php if ( !comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'instive' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php
	$post_id = '';
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id		 = $post_id;

	$commenter		 = wp_get_current_commenter();
	$user			 = wp_get_current_user();
	$user_identity	 = $user->exists() ? $user->display_name : '';


	$req		 = get_option( 'require_name_email' );
	$aria_req	 = ( $req ? " aria-required='true'" : '' );

	$fields = array(
		'author' => '<div class="comment-info row"><div class="col-md-6"><input placeholder="'.  esc_attr__('Enter Name', 'instive').'" id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" size="30"' . $aria_req . ' /></div><div class="col-md-6">',
		'email'	 => '<input placeholder="'.  esc_attr__('Enter Email', 'instive').'" id="email" name="email" class="form-control" type="email" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" size="30"' . $aria_req . ' /></div>',
		'url'	 => '<div class="col-md-12"><input placeholder="'.  esc_attr__('Enter Website', 'instive').'" id="url" name="url" class="form-control" type="url" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" size="30" /></div></div>',
	);

	if ( is_user_logged_in() ) {
		$cl = 'loginformuser';
	} else {
		$cl = '';
	}
	$defaults = [
		'fields'			 => $fields,
		'comment_field'		 => '
			<div class="row">
				<div class="col-md-12 ' . $cl . '">
					<textarea 
						class="form-control msg-box" 
						placeholder="'.  esc_attr__('Enter Comments', 'instive').'" 
						id="comment" 
						name="comment" 
						cols="45" rows="8" 
						aria-required="true">
					</textarea>
				</div>
				<div class="clearfix"></div>
			</div>
		',
		/** This filter is documented in wp-includes/link-template.php */
		'must_log_in'		 => '
			<p class="must-log-in">
			'.esc_html__('You must be','instive').' <a href="'.esc_url(wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )).'">'.esc_html__('logged in','instive').'</a> '.esc_html__('to post a comment.','instive').'
			</p>',
		/** This filter is documented in wp-includes/link-template.php */
		'logged_in_as'		 => '
			<p class="logged-in-as">
			'.esc_html__('Logged in as','instive').' <a href="'.esc_url(get_edit_user_link()).'">'.esc_html($user_identity).'</a>. <a href="'.esc_url(wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )).'" title="'.esc_attr__('Log out of this account','instive').'">'.esc_html__('Log out?','instive').'</a>
			</p>',
		'id_form'			 => 'commentform',
		'id_submit'			 => 'submit',
		'class_submit'		 => 'btn-comments btn btn-primary',
		'title_reply'		 => esc_html__( 'Leave a Reply', 'instive' ),
		'title_reply_to'	 => esc_html__( 'Leave a Reply to %s', 'instive' ),
		'cancel_reply_link'	 => esc_html__( 'Cancel reply', 'instive' ),
		'label_submit'		 => esc_html__( 'Post Comment', 'instive' ),
		'format'			 => 'xhtml',
	];

	comment_form( $defaults );
	?>

</div><!-- #comments -->
<?php endif;