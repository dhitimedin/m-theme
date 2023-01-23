<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */


    $job_titles = explode(",", $post->post_excerpt ,2);
    $title_text_modal = $title_page = '';
    foreach ( $job_titles as $job_title ) {
        $title_text_modal = $title_text_modal . "<p class='text-center h6 d-block'>$job_title</p>";
        $title_page = $title_page . "<p class='text-center h6'>$job_title</p>";
    }

    $post_count = $args['count']

?>

<div class="mithun-team-cards">
    <div class="mithun-team-figure" data-bs-target="#teamModal-<?php echo ((int)($post_count) + 1); ?>" data-bs-toggle="modal" role="button">
        <picture>
            <source srcset="<?php echo $post->guid; ?>" media="(min-width: 1400px)">
            <source srcset="<?php echo $post->guid; ?>" media="(min-width: 769px)">
            <source srcset="<?php echo $post->guid; ?>" media="(min-width: 577px)">
            <img srcset="<?php echo $post->guid; ?>" alt="responsive image" class="mithun-team-figure-img shadow">
        </picture>
        <h4 class="text-center"><?php echo $post->post_title; ?></h4>
            <?php echo $title_page; ?>
    </div>

    <!-- Modal Section Begins -->
    <div class="modal fade" id="teamModal-<?php echo ((int)($post_count) + 1); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row position-relative">
                            <button type="button" class="btn-close position-absolute end-0" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row g-5 m-auto d-flex justify-content-center align-items-center">
                            <div class="col-md-4 p-0">
                                <figure>
                                    <div class="d-flex justify-content-center">
                                        <picture>
                                            <source srcset="<?php echo wp_get_attachment_url($post->ID); ?>" media="(min-width: 1400px)">
                                            <source srcset="<?php echo wp_get_attachment_url($post->ID); ?>" media="(min-width: 769px)">
                                            <source srcset="<?php echo wp_get_attachment_url($post->ID); ?>" media="(min-width: 577px)">
                                            <img srcset="<?php echo wp_get_attachment_url($post->ID); ?>" alt="responsive image" class="img-fluid img-thumbnail rounded shadow border border-primary p-0 m-0">
                                        </picture>
                                    </div>
                                    <figcaption>
                                        <h4 class="text-center pt-3" id="teamModalLabel"><?php echo $post->post_title; ?></h4>
                                            <?php echo $title_text_modal; ?>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-md-8"><?php echo $post->post_content; ?></div>
                        </div>
                    </div>
                </div> <!-- Close Modal Body -->
            </div>
        </div>
    </div>
    <!-- Modal Section Ends -->
</div>
