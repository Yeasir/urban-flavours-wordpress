<?php /* Template Name: News Template */ ?>

<?php get_header(); ?>

    <!--.news-area start-->
    <section class="news-area">
        <div class="container">
            <!-- /.row start  --->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p class="sadow">Home / News</p>
                    <h4 class="green-text">NEWS</h4>
                </div>
            </div>    <!-- /.row end  -->
            <?php
            $feed_ori_url = ['https://www.leafly.com/news','https://www.thecannabist.co/category/news/us-news/'];


            $rss_feeds_urls = get_field('rss_feeds_urls', 'option');

            $rss_feeds_url_array = explode(',',$rss_feeds_urls);
            $default_featured_images = get_field('default_featured_images', 'option');

            if(!empty($rss_feeds_url_array)):
            $counter = 1;
            ?>
            <div class="row">
                <div class="col-12">
                    <?php
                    $rn_img1 = 1000;
                    foreach ($rss_feeds_url_array as $key => $rss_feeds_url):
                        $rss_feeds_url = trim($rss_feeds_url);
                        $feeds = @simplexml_load_file($rss_feeds_url, null, LIBXML_NOCDATA);
                        if($feeds) {
                            $rn = rand(0,9);
                            $rn_img = rand(1,6);
                            if($rn_img == $rn_img1){
	                            $rn_img = rand(1,6);
                            }
                            $random_image = $default_featured_images[$rn_img];
                        ?>
                            <div>
                                <?php if(!isset($feeds->channel->item[$rn]->image)){?>
                                    <img src="<?php echo ($random_image['url'] ? $random_image['url'] : get_bloginfo('template_url').'/images/feed1.png');?>" alt="<?php echo $feeds->channel->item[$rn]->title;?>">
                                <?php }else{?>
                                <img src="<?php bloginfo('template_url');?>/images/feed1.png" alt="Headshot photo">
                                <?php };?>
                                <div class="content-box d-inline">
                                    <h4 class=" text-uppercase border-bottom"><?php echo $feeds->channel->item[$rn]->title;?></h4>
                                    <?php echo $feeds->channel->item[$rn]->description;?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="read-more text-center">
                                    <!--<a href="<?php echo $feeds->channel->item[$rn]->link;?>" target="_blank" class="btn custom-btn">READ MORE</a>-->
                                    <a href="<?php echo $feed_ori_url[$key];?>" target="_blank" class="btn custom-btn">READ MORE</a>
                                </div>
                            </div>
                            <?php };?>
                    <?php if($counter != count($rss_feeds_url_array)):?>
                    <hr>
                    <?php endif;?>
                    <?php $counter++;
                    $rn_img1 = $rn_img;
                    endforeach;?>
                </div>
            </div>
            <?php endif;?>
        </div>
    </section>
    <!--.news-area end-->

<?php
get_footer();
