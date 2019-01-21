
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div data-loader="ball-scale"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'html',
        transition: function(url){ window.location.href = url; }
    });
    
    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*[ Show header dropdown ]
    ===========================================================*/
    $('.js-show-header-dropdown').on('click', function(){
        $(this).parent().find('.header-dropdown')
    });

    var menu = $('.js-show-header-dropdown');
    var sub_menu_is_showed = -1;

    for(var i=0; i<menu.length; i++){
        $(menu[i]).on('click', function(){ 
            
                if(jQuery.inArray( this, menu ) == sub_menu_is_showed){
                    $(this).parent().find('.header-dropdown').toggleClass('show-header-dropdown');
                    sub_menu_is_showed = -1;
                }
                else {
                    for (var i = 0; i < menu.length; i++) {
                        $(menu[i]).parent().find('.header-dropdown').removeClass("show-header-dropdown");
                    }

                    $(this).parent().find('.header-dropdown').toggleClass('show-header-dropdown');
                    sub_menu_is_showed = jQuery.inArray( this, menu );
                }
        });
    }

    $(".js-show-header-dropdown, .header-dropdown").click(function(event){
        event.stopPropagation();
    });

    $(window).on("click", function(){
        for (var i = 0; i < menu.length; i++) {
            $(menu[i]).parent().find('.header-dropdown').removeClass("show-header-dropdown");
        }
        sub_menu_is_showed = -1;
    });


     /*[ Fixed Header ]
    ===========================================================*/
    var posWrapHeader = $('.topbar').height();
    var header = $('.container-menu-header');

    $(window).on('scroll',function(){

        if($(this).scrollTop() >= posWrapHeader) {
            $('.header1').addClass('fixed-header');
            $(header).css('top',-posWrapHeader); 

        }  
        else {
            var x = - $(this).scrollTop(); 
            $(header).css('top',x); 
            $('.header1').removeClass('fixed-header');
        } 

        if($(this).scrollTop() >= 200 && $(window).width() > 992) {
            $('.fixed-header2').addClass('show-fixed-header2');
            $('.header2').css('visibility','hidden'); 
            $('.header2').find('.header-dropdown').removeClass("show-header-dropdown");
            
        }  
        else {
            $('.fixed-header2').removeClass('show-fixed-header2');
            $('.header2').css('visibility','visible'); 
            $('.fixed-header2').find('.header-dropdown').removeClass("show-header-dropdown");
        } 

    });
    
    /*[ Show menu mobile ]
    ===========================================================*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.wrap-side-menu').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu').slideToggle();
            $(this).toggleClass('turn-arrow');
        })
    }

    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.wrap-side-menu').css('display') == 'block'){
                $('.wrap-side-menu').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }
            if($('.sub-menu').css('display') == 'block'){
                $('.sub-menu').css('display','none');
                $('.arrow-main-menu').removeClass('turn-arrow');
            }
        }
    });


    /*[ remove top noti ]
    ===========================================================*/
    $('.btn-romove-top-noti').on('click', function(){
        $(this).parent().remove();
    })


    /*[ Block2 button add_to_cart ]
    ===========================================================*/

    $('.block2-btn-addwishlist').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");
        });
    });

    $('.block2-btn-addcart').on('click', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        var count = 1;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'/newAddtoCart',
            method:'POST',
            data:{id:id, count:count},
            success: function (data) {
                topCartUpdate(data);
                swal(nameProduct, "is added to cart !", "success");
            },
            error: function (data) {
                console.log(data);
            }
        });

    });
    $('.btn-addcart-product-detail button').on('click', function (event) {
        event.preventDefault();
        var nameProduct = $(this).data('name');
        var count = $(this).parent().parent().children().eq(0).children().eq(1).val();
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'/newAddtoCart',
            method:"POST",
            data:{id:id,count:count},
            success:function (data) {
                topCartUpdate(data);
                swal(nameProduct, "is added to cart !", "success");
            },
            error:function (data) {
                console.log(data);
            }
        });

    })

    /*[ Button  Change count of product in cart ]
===========================================================*/
    $('.cart-control-minus').on('click', function (event) {
        event.preventDefault();
        var count = 0;
        var id = $(this).parent().children().eq(1).data('id');
        var price = $(this).parent().parent().parent().children().eq(2).html();
        if($(this).parent().children().eq(1).val() != 1){
            count = $(this).parent().children().eq(1).val() - 1;
        }else{
            count = 1;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'/updatecart',
            method:"POST",
            data:{id:id,count:count},
            success:function (data) {
                topCartUpdate(data);
            },
            error:function (data) {
                console.log(data);
            }
        });
        $(this).parent().parent().parent().children().eq(4).html(count*price);
    });
    $('.cart-control-plus').on('click',function (event) {
        event.preventDefault();
        var count = ($(this).parent().children().eq(1).val())*1+1;
        var id = $(this).parent().children().eq(1).data('id');
        var price = $(this).parent().parent().parent().children().eq(2).html();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'/updatecart',
            method:"POST",
            data:{id:id,count:count},
            success:function (data) {
                topCartUpdate(data);
            },
            error:function (data) {
                console.log(data);
            }
        });

        $(this).parent().parent().parent().children().eq(4).html(count*price);

    })
    function updateCart(id, count){
        $.ajax({
            url:'/updatecart',
            method:"POST",
            data:{id:id,count:count},
            success:function (data) {
                console.log(data);
            },
            error:function (data) {
                console.log(data);
            }
        });
        console.log($(this).parent().parent().children());
    }

    /*[ Delete from cart ]
    ===========================================================*/
    $('.delete-from-cart').on('click', function (event) {
        event.preventDefault();
        var id= $(this).data('id');
        var row = $(this).closest('tr');
        var cart;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'/deletefromcart',
            method:"POST",
            data:{id:id},
            success:function (data) {
                row.css('display', 'none');
                if(data){
                    topCartUpdate(data);
                }else{
                    $('.header-cart').html('<h3>Корзина пуста</h3>');
                    $('.count-cart').html(0);
                    $('.cart-box').html('<h3>Ваша корзина пуста</h3>')
                }
            },
            error:function (data) {
                console.log(data);
            }
        });
    });

    function topCartUpdate(data){
        var products = JSON.parse(data)[0];
        var counts = JSON.parse(data)[1];
        // console.log(JSON.parse(data));
        var topCartContent = '';
        var cartTotal = 0;
        var cartCount= 0;

        for(var i=0; i<products.length; i++){
            var countId = products[i].id;
            topCartContent = topCartContent +
                '<li class="header-cart-item">' +
                '<div class="header-cart-item-img">' +
                '<img src="http://lara.loc/storage/images/'+products[i].img+'" alt="IMG">' +
                '</div>' +
                '<div class="header-cart-item-txt">' +
                '<a href="#" class="header-cart-item-name">'+products[i].name+'</a>' +
                '<span class="header-cart-item-info">'+ counts[countId]+' x '+ products[i].price +'</span>' +
                '</div></li>';
            cartCount=parseInt(cartCount + counts[countId]);
            cartTotal+=counts[countId]*products[i].price;

        }
        console.log(cartCount);
        if($('#cardCheck').length >0){
            $('#cardCheck').html('CART TOTALS: '+cartTotal);
        }
        $('.count-cart').html(cartCount);
        $('.header-cart-total').html('Total: '+cartTotal);
        $('.header-cart').html('<ul class="header-cart-wrapitem"></ul><div class="header-cart-total">' +
            'Total:' +cartTotal+
            '</div><div class="header-cart-buttons"><div class="header-cart-wrapbtn">' +
            '<a href="/cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">View Cart</a>' +
            '</div><div class="header-cart-wrapbtn">' +
            '<a href="/checkout" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">Check Out</a></div></div>');
        $('.header-cart-wrapitem').html(topCartContent);
    }

    /*[ Block2 button wishlist ]
    ===========================================================*/
    $('.block2-btn-addwishlist').on('click', function(e){
        e.preventDefault();
        $(this).addClass('block2-btn-towishlist');
        $(this).removeClass('block2-btn-addwishlist');
        $(this).off('click');

        var url = $(this).data('url');
        var product_id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:url,
            method: "POST",
            data:{id:product_id},
            success: function (data) {
                // var datas = $.parseJSON(data);
                console.log(data);
            },
            error: function (data) {
                console.log(data);

            }
        });
    });




    /*[ Clever Search in catalog ]
===========================================================*/
 $('#search_product').keyup(function (event) {
     event.preventDefault();
     var data = $(this).val();
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     $.ajax({
         url:'/clever_search',
         method:'POST',
         data:{patern:data},
         success:function (data) {

             if(data.length){
                 var results = JSON.parse(data);
                 if(results.length>0){
                     var list= "<ul>";
                     for(var i=0; i<results.length; i++){
                         list+='<li>'+results[i]+'</li>';
                     }
                     list+='</ul>'
                     $('#clever_result').html(list);
                 }else{
                     $('#clever_result').style('display','none');
                     console.log('хуйня');
                 }

             }
         }
         });
 });

    /*[ Delete from wishlist ]
===========================================================*/

    $('.delete-from-wish-list').on('click', function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).data('id');
        var row = $(this).closest('tr');
        $.ajax({
            url:'/delete_from_wish_list',
            method:"GET",
            data:{id:id},
            success:function (data) {
                row.css('display', 'none');
            },
            error: function (data) {
                console.log(data);
            }
        })
    })

    /*[ +/- num product ]
    ===========================================================*/
    $('.btn-num-product-down').on('click', function(e){
        e.preventDefault();
        var numProduct = Number($(this).next().val());
        if(numProduct > 1) $(this).next().val(numProduct - 1);
    });

    $('.btn-num-product-up').on('click', function(e){
        e.preventDefault();
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });


    /*[ Logout ]
    ===========================================================*/
    $('#logout').on('click', function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:'/logout',
            method:"POST",
            success:function (data) {
                console.log(data);

            },
            error: function (data) {
                console.log(data);
            }
        })

    });

    /*[ Show content Product detail ]
    ===========================================================*/
    $('.active-dropdown-content .js-toggle-dropdown-content').toggleClass('show-dropdown-content');
    $('.active-dropdown-content .dropdown-content').slideToggle('fast');

    $('.js-toggle-dropdown-content').on('click', function(){
        $(this).toggleClass('show-dropdown-content');
        $(this).parent().find('.dropdown-content').slideToggle('fast');
    });


    /*[ Play video 01]
    ===========================================================*/
    var srcOld = $('.video-mo-01').children('iframe').attr('src');

    $('[data-target="#modal-video-01"]').on('click',function(){
        $('.video-mo-01').children('iframe')[0].src += "&autoplay=1";

        setTimeout(function(){
            $('.video-mo-01').css('opacity','1');
        },300);      
    });

    $('[data-dismiss="modal"]').on('click',function(){
        $('.video-mo-01').children('iframe')[0].src = srcOld;
        $('.video-mo-01').css('opacity','0');
    });

})(jQuery);