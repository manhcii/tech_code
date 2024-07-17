

<?php
$page_title = $taxonomy->title ?? ($page->title ?? ($page->name ?? ''));
$image_background = $taxonomy->json_params->image_background ?? ($web_information->image->background_breadcrumbs ?? '');
?>
<?php $__env->startPush('style'); ?>
<link rel="preload" as="style" href="<?php echo e(asset('themes/frontend/watches/bizweb.dktcdn.net/100/429/689/themes/869367/assets/ajaxcart.scss2c6f.css?1697597694844')); ?>"  type="text/css">
<link href="<?php echo e(asset('themes/frontend/watches/bizweb.dktcdn.net/100/429/689/themes/869367/assets/ajaxcart.scss2c6f.css?1697597694844')); ?>" rel="stylesheet" type="text/css" media="all" />
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
  <div class="main-index">
      <section class="bread-crumb">
        <div class="container">
          <div class="row">
            <div class="col-12 a-left">
              <ul class="breadcrumb" >          
                <li class="home">
                  <a  href="/" ><span >Trang chủ</span></a>            
                  <span class="mr_lr">&nbsp;/&nbsp;</span>
                </li>
                <li><strong ><span>Giỏ hàng</span></strong></li>
              </ul>
            </div>
          </div>
        </div>
      </section> 
      <section class="main-cart-page main-container col1-layout">
        <div class="main container cartpcstyle">
          <div class="wrap_background_aside margin-bottom-40">
            <div class="header-cart">
              <div class="title-block-page">
                <h1 class="title_cart">
                  <span>Giỏ hàng của bạn</span>
                </h1>
              </div>
            </div>
            <?php if(session('cart')): ?>
            <div class="cart-page d-xl-block d-none">
              <div class="drawer__inner">
                <div class="CartPageContainer">
                    <div class="cart-header-info">
                      <div>Thông tin sản phẩm</div><div>Đơn giá</div><div>Số lượng</div><div>Thành tiền</div>
                    </div>
                    <div class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body items">
                      <?php $total = 0 ?>
                      <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        $title = $details['title'];
                        $total += $details['price'] * $details['quantity'];
                        $alias_detail = Str::slug($details['title']);
                        $url_link = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'],$title, $details['id'], 'detail', 'san-pham');
                      ?>
                      <div class="ajaxcart__row">
                        
                        <div class="ajaxcart__product cart_product" data-line="1">
                          <a href="<?php echo e($url_link); ?>" class="ajaxcart__product-image cart_image" title="<?php echo e($title); ?>"><img src="<?php echo e($details['image_thumb'] ?? $details['image']); ?>" alt="<?php echo e($title); ?>"></a>
                          <div class="grid__item cart_info">
                            <div class="ajaxcart__product-name-wrapper cart_name">
                              <a href="<?php echo e($url_link); ?>" class="ajaxcart__product-name h4" title="<?php echo e($title); ?>"><?php echo e($title); ?></a>
                              <a data-id="<?php echo e($id); ?>" class="remove remove-from-cart cart__btn-remove remove-item-cart ajaxifyCart--remove" href="javascript:void(0)" >Xóa</a>
                              
                            </div>
                            <div class="grid">
                              <div class="grid__item one-half text-right cart_prices">
                                <span class="cart-price"><?php echo isset($details['price']) && $details['price'] > 0 ? number_format($details['price'], 0, ',', '.') . ' ₫' : __('Contact'); ?></span>
                              </div>
                            </div>
                            <div class="grid">
                              <div class="grid__item one-half cart_select">
                                <div class="ajaxcart__qty input-group-btn">
                                  <button type="button" class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count" data-id="" data-qty="0" data-line="1" aria-label="-">
                                    -
                                  </button>
                                  <input data-id="<?php echo e($id); ?>" type="text" name="quantity" class="update-cart qty ajaxcart__qty-num number-sidebar" maxlength="3" value="<?php echo e($details['quantity']); ?>" min="0" data-id="" data-line="1" aria-label="quantity" pattern="[0-9]*">
                                  <button type="button" class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count" data-id="" data-line="1" data-qty="2" aria-label="+">
                                    +             
                                  </button>
                                </div>
                              </div>
                            </div>
                            <div class="grid">
                              <div class="grid__item one-half text-right cart_prices">
                                <span class="cart-price"><?php echo e(number_format($details['price'] * $details['quantity'], 0, ',', '.') . ' ₫'); ?></span>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      
                      </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
                      <div class="row">
                        <div class="col-lg-4 col-12 offset-md-8 offset-lg-8 offset-xl-8">
                          <div class="ajaxcart__subtotal">
                            <div class="cart__subtotal">
                              <div class="cart__col-6">Tổng tiền:</div>
                              <div class="text-right cart__totle"><span class="total-price"><?php echo e(number_format($total, 0, ',', '.') . ' ₫'); ?></span></div>
                            </div>
                          </div>
                          <div class="cart__btn-proceed-checkout-dt">
                            <button onclick="location.href='/thanh-toan'" type="button" class="button btn btn-default cart__btn-proceed-checkout" id="btn-proceed-checkout" title="Thanh toán">Thanh toán</button>
                          </div>
                          <br>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="cart-mobile-page d-block d-xl-none">
              <div class="CartMobileContainer">
                <form action="/cart" method="post" novalidate="" class="cart ajaxcart cart-mobile">
                  <div class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body">
                    <?php $total = 0 ?>
                      <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        $title = $details['title'];
                        $total += $details['price'] * $details['quantity'];
                        $alias_detail = Str::slug($details['title']);
                        $url_link = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'],$title, $details['id'], 'detail', 'san-pham');
                      ?>
                      <div class="ajaxcart__row">
                        <div class="ajaxcart__product cart_product" data-line="1">
                          <a href="<?php echo e($url_link); ?>" class="ajaxcart__product-image cart_image" title="<?php echo e($title); ?>"><img width="80" height="80" src="<?php echo e($details['image_thumb'] ?? $details['image']); ?>" alt="<?php echo e($title); ?>"></a>
                          <div class="grid__item cart_info">
                            <div class="ajaxcart__product-name-wrapper cart_name">
                              <a href="<?php echo e($url_link); ?>" class="ajaxcart__product-name h4" title="<?php echo e($title); ?>"><?php echo e($title); ?></a>
                            </div>
                            <div class="grid">
                              <div class="grid__item one-half cart_select cart_item_name">
                                <div class="ajaxcart__qty input-group-btn">
                                  <button type="button" class="ajaxcart__qty-adjust ajaxcart__qty--minus items-count" data-id="" data-qty="0" data-line="1" aria-label="-">
                                  -
                                  </button>
                                  <input data-id="<?php echo e($id); ?>" type="text" name="quantity" class="update-cart qty ajaxcart__qty-num number-sidebar" maxlength="3" value="<?php echo e($details['quantity']); ?>" min="0" data-id="" data-line="1" aria-label="quantity" pattern="[0-9]*">
                                  <button type="button" class="ajaxcart__qty-adjust ajaxcart__qty--plus items-count" data-id="" data-line="1" data-qty="2" aria-label="+">
                                  +             
                                  </button>
                                </div>
                              </div>
                              <div class="grid__item one-half text-right cart_prices">
                                <span class="cart-price"><?php echo isset($details['price']) && $details['price'] > 0 ? number_format($details['price'], 0, ',', '.') . ' ₫' : __('Contact'); ?></span>
                                <a data-id="<?php echo e($id); ?>" class="remove-from-cart cart__btn-remove remove-item-cart ajaxifyCart--remove" href="javascript:;" data-line="1">Xóa</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
                    <div class="ajaxcart__subtotal">
                      <div class="cart__subtotal">
                        <div class="cart__col-6">Tổng tiền:</div>
                        <div class="text-right cart__totle"><span class="total-price"><?php echo e(number_format($total, 0, ',', '.') . ' ₫'); ?></span></div>
                      </div>
                    </div>
                    <div class="cart__btn-proceed-checkout-dt">
                      <button onclick="location.href='/checkout'" type="button" class="button btn btn-default cart__btn-proceed-checkout" id="btn-proceed-checkout" title="Thanh toán">Thanh toán</button>
                    </div>
                  </div>
                </form>  
              </div>
            </div>
            <?php else: ?>
            <div class="container">
            <div style="min-width: 100%;" class="alert alert-warning col-12"  role="alert">
              <?php echo app('translator')->get('Cart is empty!'); ?>
            </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </section>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js_filter'); ?>
<script type="text/javascript">
  $('.ajaxcart__qty--plus').click(function(){
    var quantity = $(this).parents('.cart_product').find('.update-cart').val();
    $(this).parents('.cart_product').find('.update-cart').val(++quantity)
    $(this).parents('.cart_product').find('.update-cart').trigger('change');
  })
  $('.ajaxcart__qty--minus').click(function(){
    var quantity = $(this).parents('.cart_product').find('.update-cart').val();
    if(quantity>0)
    $(this).parents('.cart_product').find('.update-cart').val(--quantity);
  $(this).parents('.cart_product').find('.update-cart').trigger('change');

  })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ttech\resources\views/frontend/pages/cart/index.blade.php ENDPATH**/ ?>