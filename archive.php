<?php
/**
 * The template for displaying archive pages
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container grid-layout">

        <div class="content-area">
            <?php if ( have_posts() ) : ?>

                <header class="page-header" style="margin-bottom: 2rem;">
                    <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description">', '</div>' );
                    ?>
                </header>

                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                       <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php
                                if ( has_post_thumbnail() ) :
                                    ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail( 'large' ); ?>
                                        </a>
                                    </div>
                                    <?php
                                endif;

                                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                ?>
                                <div class="entry-meta">
                                    <?php echo get_the_date(); ?> by <?php the_author(); ?>
                                </div>
                            </header>

                            <div class="entry-content">
                                <?php the_excerpt(); ?>
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
