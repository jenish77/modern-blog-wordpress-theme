<?php
/**
 * The main template file
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container grid-layout">
        
        <div class="content-area">
            <?php
            if ( have_posts() ) :

                while ( have_posts() ) :
                    the_post();
                    ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-thumbnail">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'large' ); ?>
									</a>
								</div>
							<?php endif; ?>

                            <div class="post-content-wrapper">
                                <header class="entry-header">
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            <?php echo get_the_date(); ?>
                                        </span>
                                        <span class="reading-time">
                                            <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                            <?php echo modern_blog_reading_time(); ?>
                                        </span>
                                    </div>
                                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                                </header>

                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="read-more">Read More &rarr;</a>
                            </div>
                        </article>
                    <?php
                endwhile;

                the_posts_navigation();

            else :

                echo '<p>' . esc_html__( 'Sorry, no posts matched your criteria.', 'modern-blog-theme' ) . '</p>';

            endif;
            ?>
        </div>

        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        </aside>

    </div>
</main>

<?php
get_footer();
