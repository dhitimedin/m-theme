<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */

?>

		<?php $page_id = get_the_ID(); ?>
                <div class="row justify-content-md-center text-center mb-75">
                    <div class="col-md-12">
                            <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center bg-img-center bg-no-repeat line-bottom-style3-bordered-line">
                                <div class="title-wrapper">
                                    <h2 class="title text-danger fw-bolder"> <span class="">Vision</span></h2>
                                    <div class="title-seperator-line"></div>
                                    <div class="paragraph">
                                        <p><?php echo get_post_meta( $page_id, 'vision', true ); ?></p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-12 pt-5">
                            <div class="tm-sc tm-sc-section-title section-title section-title-style1 text-center bg-img-center bg-no-repeat line-bottom-style3-bordered-line">
                                <div class="title-wrapper">
                                    <h2 class="title text-danger fw-bolder"> <span class="">Mission</span></h2>
                                    <div class="title-seperator-line"></div>
                                    <div class="paragraph">
                                        <p><?php echo get_post_meta( $page_id, 'mission', true ); ?></p>
                                    </div>
                                </div>
                            </div>
                    </div>
				</div>
