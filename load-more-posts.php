// Add this piece of code in you template. 
<div class="row" id="ajax-posts">
        <?php
        // WP_Query arguments
          $args = array(
            'post_type'              => array( 'post' ),
            'post_status'            => array( 'publish' ),
            'nopaging'               => false,
            'paged'                  => '1',
            'posts_per_page'         => '9',
            'order'                  => 'ASC',
          );
          // The Query
          $query = new WP_Query( $args );
          // The Loop
          if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
              $query->the_post();?>
             <div class="col-lg-4 mb-4">
                <div class="blogItem shadow overflow-hidden">
                   <a href="<?php the_permalink();?>" class="card rounded-0 border-0">
                    <?php  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
                   <img src="<?php echo $image[0];?>" class="card-img-top" alt="<?php the_title();?>" />
                   </a>
                   <div class="textArea p-4">
                      <a href="<?php the_permalink();?>" class="h5 mb-4 d-block text-dark">
                        <?php the_title();?>
                      </a>
                      <p>
                        <?php
                          echo wp_trim_words( get_the_content(), 30, '...' );
                        ?>
                      </p>
                   </div>
                </div>
             </div>
          <?php  }
          } else {
            // no posts found
          }
          // Restore original Post Data
          wp_reset_postdata();
        ?>
      </div>

// Add this code in your js file.

<!-- Ajax Load more functionality :: Start -->
<script type="text/javascript">
    jQuery(document).ready( function($) {
        var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
        // What page we are on.
        var page = 1; 
        // Post per page
        var ppp = 9; 
        
        jQuery("#more_posts").on("click", function() {
          page++;
           $("#more_posts").attr("disabled",true);
            // Disable the button, temp.
            jQuery.post(ajaxUrl, {
                action: "more_post_ajax",
                offset: (page * ppp-ppp),
                ppp: ppp
            })
            .done(function(posts) {
                if (posts != '') {
                  jQuery("#ajax-posts").append(''+posts+'').slideDown();
                  // CHANGE THIS!
                  $("#more_posts").attr("disabled", false);
                }else{
                  $("#more_posts").text('No more posts availabe!').attr("disabled",true);
                }
            });
        });
    });
</script>
<!-- Ajax Load more functionality :: End -->

<!-- Add This code in functions.php -->

unction more_post_ajax(){
    $offset = $_POST["offset"]; 
    $ppp = $_POST["ppp"];
    $args = [
        'post_type' => 'post',
        'posts_per_page' => $ppp,
        'offset' => $offset,
        'order'  => 'ASC',
    ];
    $loop = new WP_Query($args);
    while ($loop->have_posts()) { $loop->the_post(); ?>
    <div class="col-lg-4 mb-4">
        <div class="blogItem shadow overflow-hidden">
           <a href="<?php the_permalink();?>" class="card rounded-0 border-0">
            <?php  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
           <img src="<?php echo $image[0];?>" class="card-img-top" alt="<?php the_title();?>" />
           </a>
           <div class="textArea p-4">
              <a href="<?php the_permalink();?>" class="h5 mb-4 d-block text-dark">
                <?php the_title();?>
              </a>
              <p>
                <?php
                  echo wp_trim_words( get_the_content(), 30, '...' );
                ?>
              </p>
           </div>
        </div>
     </div>
   <?php  }
    exit; 
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax'); 
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');
