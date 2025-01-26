<?php

/**
 * Title: Bruno Post Header
 * Slug: bruno-the-frog-theme/bruno-post-header
 * Block Types: core/group
 * Keywords: post, header
 * Description: A post header with a date, title, and excerpt.
 */
?>

<!-- wp:group {"tagName":"section","metadata":{"name":"Post Header","categories":["text"],"patternName":"bruno-the-frog-theme/section"},"align":"full","className":"section is-style-forest-green","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull section is-style-forest-green" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:group {"metadata":{"name":"Container"},"align":"full","className":"section__container","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|md"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
  <div class="wp-block-group alignfull section__container" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg);padding-left:var(--wp--preset--spacing--lg)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|2xs"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
    <div class="wp-block-group"><!-- wp:post-date {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}}} /-->

      <!-- wp:post-title {"level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|green"}}}},"textColor":"green","fontSize":"heading-level-2"} /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:post-excerpt {"textAlign":"center","fontSize":"paragraph"} /-->
  </div>
  <!-- /wp:group -->
</section>
<!-- /wp:group -->