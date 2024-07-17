

<?php
  $page_title = $taxonomy->title ?? ($page->title ?? ($page->name ?? ''));
  $image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
?>
<?php $__env->startPush('style'); ?>
<link href="<?php echo e(asset('themes/frontend/watches/bizweb.dktcdn.net/100/429/689/themes/869367/assets/checkout.min.css')); ?>" rel="stylesheet" type="text/css" media="all" />
  <style>
    input{
      margin-bottom: 0px !important;
    }
    td, th{
      border: 0px !important;
    }
  </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
  <?php if(session('cart')): ?>
  <div data-tg-refresh="checkout" id="checkout" class="content">
    <form  action="<?php echo e(route('frontend.order.store.product')); ?>" id="checkoutForm" method="post" >
      <?php echo csrf_field(); ?>
      <div class="wrap">
        <main class="main">
          <div class="main__content">
            <article class="animate-floating-labels row">
              <div class="col col--two">
                <section class="section">
                  <div class="section__header">
                    <div class="layout-flex">
                      <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                        <i class="fa fa-id-card-o fa-lg section__title--icon hide-on-desktop"></i>
                        Thông tin nhận hàng
                      </h2>
                    </div>
                  </div>
                  <div class="section__content">
                    <div class="fieldset">
                      <div class="field" >
                        <div class="field__input-wrapper">
                          <label for="email" class="field__label">
                            Email
                          </label>
                          <input type="email" class="sm-form-control" placeholder="<?php echo app('translator')->get('Email'); ?> *" id="email"name="email" value="<?php echo e(old('email')); ?>" required />
                        </div>
                      </div>
                      <div class="field " >
                        <div class="field__input-wrapper">
                          <label for="billingName" class="field__label">Họ và tên</label>
                          <input type="text" class="sm-form-control" placeholder="<?php echo app('translator')->get('Fullname'); ?> *" id="name"name="name" required value="<?php echo e($user_auth->name ?? old('name')); ?>" />
                        </div>
                      </div>
                      <div class="field " >
                        <div class="field__input-wrapper">
                          <label for="billingName" class="field__label">Số điện thoại</label>
                           <input type="text" class="sm-form-control" placeholder="<?php echo app('translator')->get('Phone'); ?> *" id="phone"name="phone" required value="<?php echo e($user_auth->phone ?? old('phone')); ?>" />
                        </div>
                      </div>
                      
                      <div class="field " >
                        <div class="field__input-wrapper">
                          <label for="billingAddress" class="field__label">
                            Địa chỉ (tùy chọn)
                          </label>
                          <input type="text" class="sm-form-control" placeholder="<?php echo app('translator')->get('Address'); ?>" id="address"name="address" value="<?php echo e(old('address')); ?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                
                <div class="fieldset">
                  <h3 class="visually-hidden">Ghi chú</h3>
                  <div class="field " >
                    <div class="field__input-wrapper">
                      <label for="note" class="field__label">
                        Ghi chú (tùy chọn)
                      </label>
                      <textarea placeholder="<?php echo app('translator')->get('Content note'); ?>"  name="customer_note" id="note" class="field__input" data-bind="note"><?php echo e(old('customer_note')); ?></textarea>
                    </div>
                    
                  </div>
                </div>
              </div>
            </article>
            <div class="field__input-btn-wrapper field__input-btn-wrapper--vertical hide-on-desktop">
              <button type="submit" class="btn btn-checkout spinner" >
                <span class="spinner-label">ĐẶT HÀNG</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                  <use href="#spinner"></use>
                </svg>
              </button>
              <a href="<?php echo e(route('frontend.order.cart')); ?>" class="previous-link">
                <i class="previous-link__arrow">❮</i>
                <span class="previous-link__content">Quay về giỏ hàng</span>
              </a>
            </div>
          </div>
        </main>
        <aside class="sidebar">
          <div class="sidebar__header">
            <h2 class="sidebar__title">
              Đơn hàng (<?php echo e(count(session('cart'))); ?> sản phẩm)
            </h2>
          </div>
          <div class="sidebar__content">
            <div id="order-summary" class="order-summary order-summary--is-collapsed">
              <div class="order-summary__sections">
                <div class="order-summary__section order-summary__section--product-list order-summary__section--is-scrollable order-summary--collapse-element">
                  <table class="product-table">
                    <caption class="visually-hidden">Chi tiết đơn hàng</caption>
                    <thead class="product-table__header">
                      <tr>
                        <th>
                          <span class="visually-hidden">Ảnh sản phẩm</span>
                        </th>
                        <th>
                          <span class="visually-hidden">Mô tả</span>
                        </th>
                        <th>
                          <span class="visually-hidden">Sổ lượng</span>
                        </th>
                        <th>
                          <span class="visually-hidden">Đơn giá</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $total = 0 ?>
                      <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                          $title = $details['title'];
                          $total += $details['price'] * $details['quantity'];
                          $alias_detail = Str::slug($details['title']);
                          $url_link = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'],$title, $details['id'], 'detail', 'san-pham');
                        ?>
                        <tr class="product">
                          <td class="product__image">
                            <div class="product-thumbnail">
                              <div class="product-thumbnail__wrapper" data-tg-static="">
                                <img src="<?php echo e($details['image_thumb'] ?? $details['image']); ?>" alt="" class="product-thumbnail__image">
                              </div>
                              <span class="product-thumbnail__quantity"><?php echo e($details['quantity']); ?></span>
                            </div>
                          </td>
                          <th class="product__description">
                            <span class="product__description__name">
                              <?php echo e($details['title']); ?>

                            </span>
                          </th>
                          <td class="product__quantity visually-hidden"><em>Số lượng:</em> <?php echo e($details['quantity']); ?></td>
                          <td class="product__price">
                            <?php echo e(isset($details['price']) && $details['price'] > 0 ? number_format($details['price']) : __('Contact')); ?>

                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    </tbody>
                  </table>
                </div>
                
                <div class="order-summary__section order-summary__section--total-lines order-summary--collapse-element"id="orderSummary">
                  <table class="total-line-table">
                    <caption class="visually-hidden">Tổng giá trị</caption>
                    <thead>
                      <tr>
                        <td><span class="visually-hidden">Mô tả</span></td>
                        <td><span class="visually-hidden">Giá tiền</span></td>
                      </tr>
                    </thead>
                    
                    <tfoot class="total-line-table__footer">
                      <tr class="total-line payment-due">
                        <th class="total-line__name">
                          <span class="payment-due__label-total">
                            Tổng cộng
                          </span>
                        </th>
                        <td class="total-line__price">
                          <span class="payment-due__price" data-bind="getTextTotalPrice()"><?php echo e(number_format($total, 0, ',', '.') . ' ₫'); ?></span>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="order-summary__nav field__input-btn-wrapper hide-on-mobile layout-flex--row-reverse">
                  <button type="submit" class="btn btn-checkout spinner" >
                    <span class="spinner-label">ĐẶT HÀNG</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                      <use href="#spinner"></use>
                    </svg>
                  </button>

                  
                  <a href="<?php echo e(route('frontend.order.cart')); ?>" class="previous-link">
                    <i class="previous-link__arrow">❮</i>
                    <span class="previous-link__content">Quay về giỏ hàng</span>
                  </a>
                  
                </div>
                
              </div>
            </div>
          </div>
        </aside>
      </div>
    </form>
  </div>
  <?php else: ?>
  <br>
  <div class="container">
  <div style="min-width: 100%;" class="alert alert-warning col-12"  role="alert">
    <?php echo app('translator')->get('Cart is empty!'); ?>
  </div>
  </div>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
  <script>
    
  </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ttech\resources\views/frontend/pages/branch/index.blade.php ENDPATH**/ ?>