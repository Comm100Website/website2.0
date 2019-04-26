<?php
/**
 * Template Name: Newsroom
 */

use Roots\Sage\Assets;
?>
<?php get_template_part('template-parts/header'); ?>
</header>

<div class="c-layout-page c-layout-page-fixed">
    <div class="c-content-box c-size-lg c-margin-b-30 banner banner--left banner--requestdemo">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xs-12 col-sm-3 col-md-2">
                    <img src="<?= get_field('banner_image'); ?>" alt="<?php the_title(); ?> Hero Image" />
                </div>
                <div class="col-xs-12 col-sm-9 col-md-10">
                    <h1><strong><?php the_title(); ?></strong></h1>
                    <p class="subtitle"><?= get_field('banner_tagline'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="c-content-box">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <nav class="nav--sticky hidden-xs">
                        <ul>
                            <li><a href="#press" class="">Press</a></li>
                            <li><a href="#news" class="">News</a></li>
                            <li><a href="#awards" class="">Awards</a></li>
                            <li><a href="#about" class="">About</a></li>
                            <li><a href="#media" class="">Media</a></li>
                        </ul>
                    </nav>
                    <div class="content--sticky">
                        <section id="press">
                            <div class="articles">
                            <?php
                            $args = [
                                'post_type' => 'releases',
                                'posts_per_page' => 6,
                                'post_status' => 'publish',
                                'paged' => 1,
                            ];

                            $pressQuery = new WP_Query($args);

                            if ($pressQuery->have_posts()):
                                while ($pressQuery->have_posts()):
                                    $pressQuery->the_post();
                                    get_template_part('template-parts/content', 'press');
                                endwhile;

                                wp_reset_postdata();
                            endif;
                            ?>
                            </div>

                            <?php if ($pressQuery->max_num_pages > 1): ?>
                            <div class="post">
                                <a href="#" class="loadmore btn btn-lg c-btn-border-1x c-theme-btn">View more</a>
                            </div>

                            <script type="text/javascript">
                            var pressPage = 2;
                            var pressLoading = false;

                            jQuery(function($) {
                                $('body').on('click', '#press .loadmore', function(e) {
                                    e.preventDefault();

                                    $(this).toggleClass('loading');

                                    if (!pressLoading) {
                                        pressLoading = true;

                                        var data = {
                                            'action': 'press_release_pagination',
                                            'page': pressPage,
                                            'security': '<?php echo wp_create_nonce("press_release_ajax_nonce"); ?>'
                                        };

                                        $.post(commGlobal.ajax_url, data, function(response) {
                                            $('#press .articles').append(response);

                                            if (<?= $pressQuery->max_num_pages; ?> == pressPage) {
                                                $('#press .loadmore').hide();
                                            }

                                            $('#press .loadmore').toggleClass('loading');

                                            pressLoading = false;
                                            pressPage++;
                                        });
                                    }
                                });
                            });
                            </script>
                            <?php endif; ?>
                        </section>

                        <section id="news" class="bg-blue">
                            <h2>News</h2>
                            <div class="articles">
                                <?php
                                $args = [
                                    'post_type' => 'news',
                                    'posts_per_page' => 6,
                                    'post_status' => 'publish',
                                    'paged' => 1,
                                ];

                                $newsQuery = new WP_Query($args);

                                if ($newsQuery->have_posts()):
                                    while ($newsQuery->have_posts()):
                                        $newsQuery->the_post();
                                        get_template_part('template-parts/content', 'news');
                                    endwhile;

                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>
                            <?php if ($newsQuery->max_num_pages > 1): ?>
                            <div class="post">
                                <a href="#" class="loadmore btn btn-lg c-btn-border-1x c-grey-btn">Read more</a>
                            </div>
                            <script type="text/javascript">
                            var newsPage = 2;
                            var newsLoading = false;

                            jQuery(function($) {
                                $('body').on('click', '#news .loadmore', function(e) {
                                    e.preventDefault();

                                    $(this).toggleClass('loading');

                                    if (!newsLoading) {
                                        newsLoading = true;

                                        var data = {
                                            'action': 'news_pagination',
                                            'page': newsPage,
                                            'security': '<?php echo wp_create_nonce("news_ajax_nonce"); ?>'
                                        };

                                        $.post(commGlobal.ajax_url, data, function(response) {
                                            $('#news .articles').append(response);

                                            if (<?= $newsQuery->max_num_pages; ?> == newsPage) {
                                                $('#news .loadmore').hide();
                                            }

                                            $('#news .loadmore').toggleClass('loading');

                                            newsLoading = false;
                                            newsPage++;
                                        });
                                    }
                                });
                            });
                            </script>
                            <?php endif; ?>
                        </section>
                        <section id="awards">
                            <h2>Awards</h2>
                            <?php foreach (get_field('awards') as $award): ?>
                                <div class="row award d-flex align-items-center">
                                    <div class="col-xs-12 col-sm-4 col-md-3">
                                        <img src="<?= $award['award_logo']; ?>" alt="<?= $award['title']; ?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-9">
                                        <h4><?= $award['title']; ?></h4>
                                        <?php if (isset($award['description']) && $award['description']): ?>
                                        <?= $award['description']; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </section>
                        <section id="about" class="bg-blue">
                            <h2>About Comm100</h2>
                            <?= get_field('about_comm100'); ?>
                        </section>
                        <section id="media">
                            <h2>Media</h2>
                            <?= get_field('media'); ?>
                        </section>
                    </div>
                </div>
                <section id="mediacontact" class="bg-blue col-xs-12 text-center">
                    <p>For all media inqueries please contact</p>
                    <a href="mailto:<?= get_field('media_contact_email'); ?>"><?= get_field('media_contact_email'); ?></a>
                </section>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/footer'); ?>