<?php
  $params_taxonomy['status'] = App\Consts::TAXONOMY_STATUS['active'];
  $params_taxonomy['taxonomy'] = App\Consts::TAXONOMY['product'];
  $params_taxonomy['is_show_home'] = true;
  $taxonomys = App\Http\Services\ContentService::getCmsTaxonomy($params_taxonomy)->get();
?>
<?php if(isset($taxonomys)): ?>
<?php $__currentLoopData = $taxonomys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  
  <?php if(true): ?>
    <?php
      $title = $item->json_params->title->{$locale} ?? $item->title;
      $brief = $item->json_params->brief->{$locale} ?? $item->brief;
      $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $title, $item->id);
      $image_background = $item->json_params->image_background != '' ? $item->json_params->image_background : $web_information->image->Image_home_sidebar ?? '';
    ?>
      <section class="section_tech">
        <div class="container">
          <div class="swap">
            <h2 class="title-block upscape">
              <a href="<?php echo e($alias_category); ?>" title="<?php echo e($title); ?>"><?php echo e($title); ?></a>
            </h2>
            
            <div class="row">
              <div class="col-lg-3 d-md-none d-lg-block col-12 order-2 order-lg-1 block-image">
                <a class="d-block banner-vertical" href="<?php echo e($alias_category); ?>" title="Săn sale thả ga">
                  <img class="" width="280" height="310" src="<?php echo e($image_background); ?>"   alt="Săn sale thả ga"/>
                </a>
                <a class="d-block banner-vertical" href="<?php echo e($alias_category); ?>" title="Giảm sốc">
                  <img class="" width="280" height="310" src="<?php echo e($image_background); ?>" alt="Giảm sốc"/>
                </a>
              </div>
              <div class="col-lg-9 col-md-12 col-12 order-1 order-lg-2 no-padding-left">
                <div class="slide-tech row">
                  <?php
                    $params['status'] = App\Consts::POST_STATUS['active'];
                    $params['is_type'] = App\Consts::POST_TYPE['product'];
                    if ($item->sub_taxonomy_id != null) {
                        $str_taxonomy_id = $item->id . ',' . $item->sub_taxonomy_id;
                        $params['taxonomy_id'] = array_map('intval', explode(',', $str_taxonomy_id));
                    } else {
                        $params['taxonomy_id'] = $item->id;
                    }
                    $rows = App\Http\Services\ContentService::getCmsPost($params)
                        ->limit(6)
                        ->get();
                  ?>
                  <?php if($rows): ?>
                  <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $title = $item_sub->json_params->title->{$locale} ?? $item_sub->title;
                    $price = $item_sub->json_params->price ?? null;
                    $price_old = $item_sub->json_params->price_old ?? null;
                    $brief = $item_sub->json_params->brief->{$locale} ?? $item_sub->brief;
                    $image = $item_sub->image_thumb != '' ? $item_sub->image_thumb : ($item_sub->image != '' ? $item_sub->image : null);
                    $date = date('H:i d/m/Y', strtotime($item_sub->created_at));
                    // Viet ham xu ly lay slug
                    $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $item_sub->taxonomy_title, $item_sub->taxonomy_id);
                    $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $title, $item_sub->id, 'detail', $item_sub->taxonomy_title);
                  ?>
                  <div class="col-lg-3 col-md-3 col-6">
                    <div class=" item_product_main">
                      <div class="product-thumbnail <?php echo e(($price>0 && $price_old>0 && $price < $price_old)? "sale":""); ?> " data-sale='Giảm <?php echo e(($price>0 && $price_old>0 && $price < $price_old) ?round(100-($price/$price_old)*100):""); ?> % '>
                        <a class="image_thumb" href="<?php echo e($alias); ?>" title="Samsung Galaxy Note 21">
                          <picture>
                            <img  
                              width="240" height="240" src="<?php echo e($image); ?>"  
                              alt="Samsung Galaxy Note 21" class="lazyload img-responsive center-block" />
                          </picture>
                        </a>
                      </div>
                      <div class="product-info">
                        <h3 class="product-name"><a href="<?php echo e($alias); ?>" title="<?php echo e($title); ?>"><?php echo e($title); ?></a></h3>
                        <div class="price-box">
                          <span class="price"><?php echo isset($price) && $price > 0 ? number_format($price, 0, ',', '.') . ' ₫' : __('Contact'); ?></span>
                          <?php if(isset($price_old) && $price_old > 0): ?>
                          <span class="compare-price"><?php echo isset($price_old) && $price_old > 0 ? number_format($price_old, 0, ',', '.') . ' ₫' : ""; ?></span>
                          <?php endif; ?>
                          <div class="action-cart">
                            <button data-id="<?php echo e($item_sub->id); ?>" data-quantity="1" class="btn-buy btn-views add_to_cart add-to-cart" title="Mua ngay">
                              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25">
                                <circle cx="7" cy="17" r="2"></circle>
                                <circle cx="15" cy="17" r="2"></circle>
                                <path d="M20,4.4V5l-1.8,6.3c-0.1,0.4-0.5,0.7-1,0.7H6.7c-0.4,0-0.8-0.3-1-0.7L3.3,3.9C3.1,3.3,2.6,3,2.1,3H0.4C0.2,3,0,2.8,0,2.6
                                     V1.4C0,1.2,0.2,1,0.4,1h2.5c1,0,1.8,0.6,2.1,1.6L5.1,3l2.3,6.8c0,0.1,0.2,0.2,0.3,0.2h8.6c0.1,0,0.3-0.1,0.3-0.2l1.3-4.4
                                     C17.9,5.2,17.7,5,17.5,5H9.4C9.2,5,9,4.8,9,4.6V3.4C9,3.2,9.2,3,9.4,3h9.2C19.4,3,20,3.6,20,4.4z"></path>
                              </svg>
                            </button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
<?php endif; ?><?php /**PATH /Users/tuannguyenduy/Sites/ttech/ttech/resources/views/frontend/blocks/cms_product/styles/default.blade.php ENDPATH**/ ?>