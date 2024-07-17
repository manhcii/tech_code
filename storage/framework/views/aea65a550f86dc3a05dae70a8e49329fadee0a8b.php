<?php if($block): ?>
<?php
  $params_taxonomy['status'] = App\Consts::TAXONOMY_STATUS['active'];
  $params_taxonomy['taxonomy'] = App\Consts::TAXONOMY['product'];
  $taxonomys = App\Http\Services\ContentService::getCmsTaxonomy($params_taxonomy)->get();
?>
  <section class="section_category">
    <div class="container">
      <div class="cate-list">
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <?php if(isset($taxonomys)): ?>
                <?php $__currentLoopData = $taxonomys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $title = $item_sub->json_params->title->{$locale} ?? $item_sub->title;
                    $brief = $item_sub->json_params->brief->{$locale} ?? $item_sub->brief;
                    $image= $item_sub->json_params->image != '' ? $item_sub->json_params->image : null;
                    $alias_category = App\Helpers::generateRoute($item_sub->taxonomy, $item_sub->alias ?? $item_sub->title, $item_sub->id);
                  ?>
                  <?php if($item_sub->parent_id == 0 || $item_sub->parent_id == null): ?>
                    <div class="swiper-slide">
                      <div class="cate-item">
                        <a class="image" href="<?php echo e($alias_category); ?>" title="<?php echo e($title); ?>">

                          <img class="image_cate_thumb" width="80" height="80" src="<?php echo e($image); ?>"   alt="<?php echo e($title); ?>"/>
                        </a>
                        <h4 class="title_cate_"><a href="<?php echo e($alias_category); ?>" title="<?php echo e($title); ?>"><?php echo e($title); ?></a></h4> 
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>  
          </div>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
  </section>
<?php endif; ?>  <?php /**PATH E:\xampp\htdocs\ttech\resources\views/frontend/blocks/custom/styles/about_us.blade.php ENDPATH**/ ?>