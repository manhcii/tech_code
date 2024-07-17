<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 order-last">
  <aside class="aside-item blog-sidebar sidebar-category collection-category margin-bottom-25">
    <h2 class="title-block"><span>Danh mục tin tức</span></h2>
    <?php
      $params_taxonomy['status'] = App\Consts::TAXONOMY_STATUS['active'];
      $params_taxonomy['taxonomy'] = App\Consts::TAXONOMY['post'];
      
      $taxonomys = App\Http\Services\ContentService::getCmsTaxonomy($params_taxonomy)->get();
    ?>
    <?php if(isset($taxonomys)): ?>
    <div class="aside-content">
      <nav class="nav-category navbar-toggleable-md">
        <ul class="nav navbar-pills">
         <?php $__currentLoopData = $taxonomys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($item->parent_id == 0 || $item->parent_id == null): ?>
            <?php
              $title = $item->json_params->title->{$locale} ?? $item->title;
              $alias_category = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id);
              
              $url_current = url()->full();
              $current = $alias_category == $url_current ? 'active' : '';
            ?>
            <li class="nav-item">
              <a href="<?php echo e($alias_category); ?>" class="nav-link ">
                <?php echo e($title); ?>

              </a>
              <?php if($item->sub_taxonomy_id!=null): ?>
              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="fa-plus svg-inline--fa fa-caret-down fa-w-10"><path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z" class=""></path></svg>
              <?php endif; ?>
              <ul class="dropdown-menu">
                <?php $__currentLoopData = $taxonomys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($sub->parent_id == $item->id): ?>
                    <?php
                      $title_sub = $sub->json_params->title->{$locale} ?? $sub->title;

                      $alias_category_sub = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $sub->alias ?? $title_sub, $sub->id);
                      
                      $current = $alias_category_sub == $url_current ? 'active' : '';
                    ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo e($alias_category_sub); ?>"><?php echo e($title_sub); ?>

                      </a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </li>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </nav>
    </div>
    <?php endif; ?>
  </aside>
  <div class="blog-aside aside-item blog-aside-article">
    <h2 class="title-block"><a title="Bài viết xem nhiều">Bài viết xem nhiều</a></h2>
    <div class="aside-content-article aside-content margin-top-0">
      <div class="blog-list blog-image-list">
        <?php
          $params_product['status'] = App\Consts::POST_STATUS['active'];
          $params_product['is_type'] = App\Consts::POST_TYPE['post'];
          $params_product['order_by'] = 'count_visited';
          
          $mostViews = App\Http\Services\ContentService::getCmsPost($params_product)
              ->limit(App\Consts::PAGINATE['sidebar'])
              ->get();
        ?>
        <?php if(isset($mostViews)): ?>
        <?php $__currentLoopData = $mostViews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $title = $item->json_params->title->{$locale} ?? $item->title;
            $brief = $item->json_params->brief->{$locale} ?? $item->brief;
            $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
            $date = date('H:i d/m/Y', strtotime($item->created_at));
            // Viet ham xu ly lay slug
            $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
          ?>
          <div class="loop-blog">
            <div class="thumb-left">
              <a href="<?php echo e($alias); ?>">
                <img class="" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
              </a>
            </div>
            <div class="name-right">
              <h3><a href="<?php echo e($alias); ?>" title="<?php echo e($title); ?>"><?php echo e($title); ?></a></h3>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="blog-aside aside-item blog-aside-article">
    <h2 class="title-block"><a title="Bài viết xem nhiều">Bài viết gần đây</a></h2>
    <div class="aside-content-article aside-content margin-top-0">
      <div class="blog-list blog-image-list">
        <?php
          $params_product_reccent['status'] = App\Consts::POST_STATUS['active'];
          $params_product_reccent['is_type'] = App\Consts::POST_TYPE['post'];
          $params_product_reccent['order_by'] = 'id';
          
          $recents = App\Http\Services\ContentService::getCmsPost($params_product_reccent)
              ->limit(App\Consts::PAGINATE['sidebar'])
              ->get();
        ?>
        <?php if(isset($recents)): ?>
        <?php $__currentLoopData = $recents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $title = $item->json_params->title->{$locale} ?? $item->title;
            $brief = $item->json_params->brief->{$locale} ?? $item->brief;
            $image = $item->image_thumb != '' ? $item->image_thumb : ($item->image != '' ? $item->image : null);
            $date = date('H:i d/m/Y', strtotime($item->created_at));
            // Viet ham xu ly lay slug
            $alias = App\Helpers::generateRoute(App\Consts::TAXONOMY['post'], $item->alias ?? $title, $item->id, 'detail', $item->taxonomy_title);
          ?>
          <div class="loop-blog">
            <div class="thumb-left">
              <a href="<?php echo e($alias); ?>">
                <img class="" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
              </a>
            </div>
            <div class="name-right">
              <h3><a href="<?php echo e($alias); ?>" title="<?php echo e($title); ?>"><?php echo e($title); ?></a></h3>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
        <?php endif; ?>
      </div>
    </div>
  </div>
</div><?php /**PATH /Users/tuannguyenduy/Sites/ttech/ttech/resources/views/frontend/components/sidebar/post.blade.php ENDPATH**/ ?>