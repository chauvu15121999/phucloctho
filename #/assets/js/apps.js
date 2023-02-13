/* Validation form */
ValidationFormSelf("validation-newsletter");
ValidationFormSelf("validation-cart");
ValidationFormSelf("validation-contact");

/* Exists */
$.fn.exists = function(){
    return this.length;
};
function showToast($msg,$type){
    if(!$type){
        $theme = "theme-default";
    }else{
        $theme = "theme-"+$type;
    }
    $.jnoty($msg,{life: 3000,theme: $theme});
}
if(_toast.msg!=undefined){
       showToast(_toast.msg,_toast.type);
}
 
function formatMoney(number, decPlaces, decSep, thouSep){
	
	return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
	
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    decSep = typeof decSep === "undefined" ? "." : decSep;
    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
    var j = (j = i.length) > 3 ? j % 3 : 0;

    return sign +
        (j ? i.substr(0, j) + thouSep : "") +
        i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
        (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");

};
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);

  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  showToast("Copy success");
}
 function  price($price,$ext,$wrap){
   /* if(CURRENT_LANG=="en"){
         $price = $price / PRICE;
        if($ext!==false)
            return ($wrap?"<span>":"")+"$ "+($wrap?"</span>":"")+formatMoney($price,2);    
        return formatMoney($price,2);;
    }*/
    if($ext!==false)
        return formatMoney($price,3,".",".")+($wrap?"<span>":"")+" VNĐ"+($wrap?"</span>":"");
    return formatMoney($price,3,".",".");
};

/* Lazys */
NN_FRAMEWORK.Lazys = function(){
    if($(".lazy").exists())
    {
        var lazyLoadInstance = new LazyLoad({
            elements_selector: ".lazy"
        });
    }
};

/* Loading */
NN_FRAMEWORK.Loading = function(){
    $(window).on("load",function(){
        $('.mask').addClass('hideg');
        $('#loading').fadeOut();
    });
};

/* Shiners: monoHL, oceanHL, fireHL */
NN_FRAMEWORK.Shiner = function(){
    $(window).bind("load", function(){
        // if($("#loading").exists() && $("#loading").css("display") != 'none')
        // {
        //     var shiner = $(".shiner-logo").peShiner({ api: true, paused: true, reverse: true, repeat: 1, color: 'oceanHL'});
        //     shiner.resume();
        // }

        // if($(".header-middle").exists() && $(".header-middle").css("display") != 'none')
        // {
        //     var header = $(".header-logo").peShiner({ api: true, paused: true, reverse: true, repeat: 1, color: 'oceanHL'});
        //     header.resume();
        // }

        // if($(".menu-res").exists() && $(".menu-res").css("display") != 'none')
        // {
        //     var logo = $(".logo-res").peShiner({ api: true, paused: true, reverse: true, repeat: 1, color: 'oceanHL'});
        //     logo.resume();
        // }
    });
};

/* Back to top */
NN_FRAMEWORK.BackToTop = function(){
    $(window).scroll(function(){
        if(!$('.scrollToTop').length) $("body").append('<div class="scrollToTop"><img src="'+GOTOP+'" alt="Go Top"/></div>');
        if($(this).scrollTop() > 100) $('.scrollToTop').fadeIn();
        else $('.scrollToTop').fadeOut();
    });

    $('body').on("click",".scrollToTop",function() {
        $('html, body').animate({scrollTop : 0},800);
        return false; 
    });
};

/* Alt images */
NN_FRAMEWORK.AltImages = function(){
    $('img').each(function(index, element) {
        if(!$(this).attr('alt') || $(this).attr('alt')=='')
        {
            $(this).attr('alt',WEBSITE_NAME);
        }
    });
};

/* Tools */
NN_FRAMEWORK.Tools = function(){
    $(".owl-product-category").owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        navText:['<span><i class="fas fa-chevron-left"></i></span>','<span><i class="fas fa-chevron-right"></i></span>'],
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:10,
                
                
            }
        }
    })
    if($("#ngaysinh").length){
    $("#ngaysinh").attr("autocomplete","off");
    
    new Litepicker({
      element: document.getElementById('ngaysinh'),
     dropdowns: {
        minYear: new Date().getFullYear() - 80,
        maxYear: new Date().getFullYear() -12,
        months: true,
        years: true
      },
      format: 'DD-MM-YYYY',
      singleMode: true,
      tooltipText: {
        one: 'night',
        other: 'nights'
      },
      tooltipNumber: (totalDays) => {
        return totalDays - 1;
      }
    })
}
    if($(".fixbar").exists())
    {
        $(".footer").css({marginBottom:$(".fixbar").innerHeight()});
    }
    var tabs$ = $(".profile-tab-nav a");
    $( window ).on("hashchange", function() {
    var hash = window.location.hash, // get current hash
            menu_item$ = tabs$.filter('[href="' + hash + '"]'); // get the menu element

        menu_item$.tab("show"); // call bootstrap to show the tab
    }).trigger("hashchange");
    tabs$.click(function(){
        window.location.hash=$(this).attr("href").substring(1);
    })
};

/* Popup */
NN_FRAMEWORK.Popup = function(){
    if($("#popup").exists())
    {
        $('#popup').modal('show');
    }
};

/* Wow */
NN_FRAMEWORK.WowAnimation = function(){
    new WOW().init();
};

/* Menu */
NN_FRAMEWORK.Menu = function(){
    $(window).scroll(function(){
        if($(window).scrollTop() >= $(".header").height() / 2)
        {
            $(".header").addClass('fixed animate__animated animate__fadeInDown');
        }
        else
        {
            $(".header").removeClass('fixed animate__animated animate__fadeInDown');
        }
    });
};

/* Mmenu */
NN_FRAMEWORK.Mmenu = function(){
    if($("nav#menu").exists())
    {
        $('nav#menu').mmenu();
        $("#hamburger").click(function(){
            $(".mm-listview").each(function(){
                $li = $(this).find('li');
                if(!$li.length)
                {
                    $id = $(this).parents().attr("id");
                    $("a[href=#"+$id+"]").remove();
                }
            });
        });
    }
};

/* Toc */
NN_FRAMEWORK.Toc = function(){
    if($(".toc-list").exists())
    {
        $(".toc-list").toc({
            content: "div#toc-content",
            headings: "h2,h3,h4"
        });

        if(!$(".toc-list li").length) $(".meta-toc").hide();

        $('.toc-list').find('a').click(function(){
            var x = $(this).attr('data-rel');
            goToByScroll(x);
        });
    }
};

/* Products */
NN_FRAMEWORK.Products = function(){
    /* Quick View */

    $(".preview-cart").click(function(){
        id = $(this).data("id");
        $.ajax({
            url:"ajax/ajax.php",
            data:{type:"preview-cart",id},
            type:"post",
            dataType:"json",
            success:function(data){
                $("#cartModal .modal-title").html(data.title);
                $("#cartModal .price-all").html(data.total);
                $("#cartModal .cart-tmp").html(data.data);
                $("#cartModal").modal("show");
            }
        })
        return false;
    })

    $('#popup-quickview').on('hidden.bs.modal', function (e) {
        $('#popup-quickview').find('.modal-body').html("");
    });
    
    $("body").on('click', '.product-quick-view', function(){
        var slug = $(this).attr('data-slug');

        if(slug)
        {
            $.ajax({
                type: "POST",
                url: slug + '?quickview=1',
                dataType: 'html',
                success: function(result){
                    $('#popup-quickview').find('.modal-body').html(result);
                    $('#popup-quickview').modal('show');
                    MagicZoom.refresh("Zoom-quickview");
                    NN_FRAMEWORK.OwlData($('.owl-pro-detail'));
                    $(".size-pro-detail.active").trigger("click");
                }
            });
        }
    });

    /* List Owl */
    if($(".wrap-product-list").exists())
    {
        $(".wrap-product-list").each(function(){
            $this = $(this);
            $owlPage = $this.find(".owl-page");
            $productDouble = $owlPage.find(".product-owl-double");

            $productDouble.each(function(){
                if(!$(this).find(".product-owl").exists())
                {
                    $(this).remove();
                }
            });

            if(!$owlPage.find(".product-owl-double").exists())
            {
                $this.remove();
            }
        });
    }
};

/* Search */
NN_FRAMEWORK.Search = function(){
    if($(".icon-search").exists())
    {
        $(".icon-search").click(function(){
            if($(this).hasClass('active'))
            {
                $(this).removeClass('active');
                $(".search-grid").stop(true,true).animate({opacity: "0",width: "0px"}, 200);   
            }
            else
            {
                $(this).addClass('active');                            
                $(".search-grid").stop(true,true).animate({opacity: "1",width: "230px"}, 200);
            }
            document.getElementById($(this).next().find("input").attr('id')).focus();
            $('.icon-search i').toggleClass('fa fa-search fa fa-times');
        });
    }
};

/* Dom Changed */
NN_FRAMEWORK.DomChanged = function(){
    $('#video-intro').one('DOMSubtreeModified', function(){
        if($(".video-right").exists())
        {
            /* Video Simply */
            $(".video-right ul").simplyScroll({
                customClass: 'vert',
                orientation: 'vertical',
                auto: true,
                manualMode: 'auto',
                pauseOnHover: 1,
                speed: 1,
                loop: 0
            });

            /* Video Click */
            $('.video-right ul li').click(function() 
            {
                var id = $(this).attr("data-id");
                $.ajax({
                    url:'ajax/ajax_video.php',
                    type: "POST",
                    dataType: 'html',
                    data: {id:id},
                    success: function(result){
                        $('.video-left').html(result);
                    }
                });
            });

            /* Video Changed */
            $('.listvideos').change(function() 
            {
                var id = $(this).val();
                $.ajax({
                    url:'ajax/ajax_video.php',
                    type: "POST",
                    dataType: 'html',
                    data: {id:id},
                    success: function(result){
                        $('.video-left').html(result);
                    }
                });
            });

            /* Video Lazy */
            NN_FRAMEWORK.Lazys();
        }
    });
};

/* Owl Data */
NN_FRAMEWORK.OwlData = function(obj){
    if(!obj.exists()) return false;
    var xsm_items = obj.attr("data-xsm-items");
    var sm_items = obj.attr("data-sm-items");
    var md_items = obj.attr("data-md-items");
    var lg_items = obj.attr("data-lg-items");
    var xlg_items = obj.attr("data-xlg-items");
    var rewind = obj.attr("data-rewind");
    var autoplay = obj.attr("data-autoplay");
    var loop = obj.attr("data-loop");
    var lazyLoad = obj.attr("data-lazyLoad");
    var mouseDrag = obj.attr("data-mouseDrag");
    var touchDrag = obj.attr("data-touchDrag");
    var animateIn = obj.attr("data-animateIn");
    var animateOut = obj.attr("data-animateOut");
    var smartSpeed = obj.attr("data-smartSpeed");
    var autoplaySpeed = obj.attr("data-autoplaySpeed");
    var autoplayTimeout = obj.attr("data-autoplayTimeout");
    var dots = obj.attr("data-dots");
    var nav = obj.attr("data-nav");
    var navText = false;
    var navContainer = false;
    var responsive = {};
    var responsiveClass = true;
    var responsiveRefreshRate = 200;

    if(xsm_items != '') { xsm_items = xsm_items.split(":"); }
    if(sm_items != '') { sm_items = sm_items.split(":"); }
    if(md_items != '') { md_items = md_items.split(":"); }
    if(lg_items != '') { lg_items = lg_items.split(":"); }
    if(xlg_items != '') { xlg_items = xlg_items.split(":"); }
    if(rewind == 1) { rewind = true; } else { rewind = false; };
    if(autoplay == 1) { autoplay = true; } else { autoplay = false; };
    if(loop == 1) { loop = true; } else { loop = false; };
    if(lazyLoad == 1) { lazyLoad = true; } else { lazyLoad = false; };
    if(mouseDrag == 1) { mouseDrag = true; } else { mouseDrag = false; };
    if(animateIn != '') { animateIn = animateIn; } else { animateIn = false; };
    if(animateOut != '') { animateOut = animateOut; } else { animateOut = false; };
    if(smartSpeed > 0) { smartSpeed = Number(smartSpeed); } else { smartSpeed = 800; };
    if(autoplaySpeed > 0) { autoplaySpeed = Number(autoplaySpeed); } else { autoplaySpeed = 800; };
    if(autoplayTimeout > 0) { autoplayTimeout = Number(autoplayTimeout); } else { autoplayTimeout = 5000; };
    if(dots == 1) { dots = true; } else { dots = false; };
    if(nav == 1)
    {
        nav = true;
        navText = obj.attr("data-navText");
        navContainer = obj.attr("data-navContainer");

        if(navText != '')
        {
            navText = navText.split(":");
            navText = [navText[0],navText[1]];
        }

        if(navContainer != '')
        {
            navContainer = navContainer;
        }
    }
    else
    {
        nav = false;
    };

    responsive = {
        0: {
            items: Number(xsm_items[0]),
            margin: Number(xsm_items[1])
        },
        576: {
            items: Number(sm_items[0]),
            margin: Number(sm_items[1])
        },
        768: {
            items: Number(md_items[0]),
            margin: Number(md_items[1])
        },
        992: {
            items: Number(lg_items[0]),
            margin: Number(lg_items[1])
        },
        1200: {
            items: Number(xlg_items[0]),
            margin: Number(xlg_items[1])
        }
    };

    obj.owlCarousel({
        rewind: rewind,
        autoplay: autoplay,
        loop: loop,
        lazyLoad: lazyLoad,
        mouseDrag: mouseDrag,
        touchDrag: touchDrag,
        animateIn: animateIn,
        animateOut: animateOut,
        smartSpeed: smartSpeed,
        autoplaySpeed: autoplaySpeed,
        autoplayTimeout: autoplayTimeout,
        dots: dots,
        nav: nav,
        navText: navText,
        navContainer: navContainer,
        responsiveClass: responsiveClass,
        responsiveRefreshRate: responsiveRefreshRate,
        responsive: responsive
    });

    if(autoplay)
    {
        obj.on("translate.owl.carousel", function(event){
            obj.trigger('stop.owl.autoplay');
        });

        obj.on("translated.owl.carousel", function(event){
            obj.trigger('play.owl.autoplay',[autoplayTimeout]);
        });
    }
};

/* Owl Page */
NN_FRAMEWORK.OwlPage = function(){
    if($(".owl-page").exists())
    {
        $(".owl-page").each(function(){
            NN_FRAMEWORK.OwlData($(this));
        });
    }
};

/* Cart */
NN_FRAMEWORK.Cart = function(){
    $("body").on("click",".addcart",function(){
        $this = $(this);
        $parents = $this.parents(".right-pro-detail");
        var id = $this.data("id");
        var action = $this.data("action");
        var quantity = $parents.find(".quantity-pro-detail").find(".qty-pro").val();
        quantity = (quantity) ? quantity : 1;
        var mau = $parents.find(".color-block-pro-detail").find(".color-pro-detail input:checked").val();
        mau = (mau) ? mau : 0;
        var size = $parents.find(".size-block-pro-detail").find(".size-pro-detail input:checked").val();
        size = (size) ? size : 0;

        if(id)
        {
            $.ajax({
                url:'ajax/ajax_cart.php',
                type: "POST",
                dataType: 'json',
                async: false,
                data: {cmd:'add-cart',id:id,mau:mau,size:size,quantity:quantity},
                success: function(result){
                    if(action=='addnow')
                    {
                        $('.count-cart').html(result.max);
                        $.ajax({
                            url:'ajax/ajax_cart.php',
                            type: "POST",
                            dataType: 'html',
                            async: false,
                            data: {cmd:'popup-cart'},
                            success: function(result){
                                $('#popup-cart').css({'z-index':'1051'});
                                $("#popup-cart .modal-body").html(result);
                                $('#popup-cart').modal('show');
                                NN_FRAMEWORK.Lazys();
                            }
                        });
                    }
                    else if(action=='buynow')
                    {
                        window.location = CONFIG_BASE + "cart";
                    }
                }
            });
        }
    });

    $("body").on("click",".del-procart",function(){
        if(confirm(LANG['delete_product_from_cart']))
        {
            var code = $(this).data("code");
            var ship = $(".price-ship").val();

            $.ajax({
                type: "POST",
                url:'ajax/ajax_cart.php',
                dataType: 'json',
                data: {cmd:'delete-cart',code:code,ship:ship},
                success: function(result){
                    $('.count-cart').html(result.max);
                    if(result.max)
                    {
                        $('.price-temp').val(result.temp);
                        $('.load-price-temp').html(result.tempText);
                        $('.price-total').val(result.total);
                        $('.load-price-total').html(result.totalText);
                        $(".procart-"+code).remove();
                    }
                    else
                    {
                        $(".wrap-cart").html('<a href="" class="empty-cart text-decoration-none"><i class="fa fa-cart-arrow-down"></i><p>'+LANG['no_products_in_cart']+'</p><span>'+LANG['back_to_home']+'</span></a>');
                    }
                }
            });
        }
    });

    $("body").on("click",".counter-procart",function(){
        var $button = $(this);
        var quantity = 1;
        var input = $button.parent().find("input");
        var id = input.data('pid');
        var code = input.data('code');
        var oldValue = $button.parent().find("input").val();
        if($button.text() == "+") quantity = parseFloat(oldValue) + 1;
        else if(oldValue > 1) quantity = parseFloat(oldValue) - 1;
        $button.parent().find("input").val(quantity);
        update_cart(id,code,quantity);
    });

    $("body").on("change","input.quantity-procat",function(){
        var quantity = $(this).val();
        var id = $(this).data("pid");
        var code = $(this).data("code");
        update_cart(id,code,quantity);
    });

    if($(".select-city-cart").exists())
    {
        $(".select-city-cart").change(function(){
            var id = $(this).val();
            load_district(id);
            load_ship();
        });
    }

    if($(".select-district-cart").exists())
    {
        $(".select-district-cart").change(function(){
            var id = $(this).val();
            load_wards(id);
            load_ship();
        });
    }

    if($(".select-wards-cart").exists())
    {
        $(".select-wards-cart").change(function(){
            var id = $(this).val();
            load_ship();
        });
    }

    if($(".payments-label").exists())
    {
        $(".payments-label").click(function(){
            var payments = $(this).data("payments");
            $(".payments-cart .payments-label, .payments-info").removeClass("active");
            $(this).addClass("active");
            $(".payments-info-"+payments).addClass("active");
        });
    }

    $("body").on("click", ".color-pro-detail", function(){
        $this = $(this);
        $parents = $this.parents(".attr-pro-detail");
        $parents_detail = $this.parents(".grid-pro-detail");
        var text = $this.attr('data-product-name') + ' - ' + $this.attr('data-color-text');
        var id_mau = $parents.find(".color-block-pro-detail").find(".color-pro-detail input:checked").val();
        var idpro = $this.data('idpro');

        $parents.find(".color-block-pro-detail").find("label strong").html(text);
        $parents.find(".color-block-pro-detail").find(".color-pro-detail").removeClass("active");
        $parents.find(".color-block-pro-detail").find(".color-pro-detail input").prop('checked',false);
        $this.addClass("active");
        $this.find("input").prop('checked',true);

        $.ajax({
            url:'ajax/ajax_color.php',
            type: "POST",
            dataType: 'html',
            data: {id_mau:id_mau,idpro:idpro},
            success: function(result){
                if(result!='')
                {
                    $parents_detail.find('.left-pro-detail').html(result);
                    MagicZoom.refresh("Zoom-" + idpro);
                    NN_FRAMEWORK.OwlData($('.owl-pro-detail'));
                    NN_FRAMEWORK.Lazys();
                }
            }
        });
    });

    $("body").on("click", ".size-pro-detail", function(){
        $this = $(this);
        $parents = $this.parents(".attr-pro-detail");
        var price_origin = $this.attr('data-price-origin');
        var price_new = $this.attr('data-price-new');
        var price_promotion = parseInt($this.attr('data-price-promotion'));
        var price_text = $this.attr('data-price-text');
     
        if(price_promotion)
        {
            $parents.find("li").find(".price-new-pro-detail").html(price(price_new,true,true));
            $parents.find("li").find(".price-old-pro-detail").html(price(price_origin,true,true));
            $parents.find("li").find(".price-per-pro-detail").html('-' + price_promotion + '%');
            $parents.find("li").find(".price-per-pro-detail, .price-old-pro-detail").removeClass("d-none");
        }
        else
        {

            //price_origin = (parseInt(price_origin)) ? formatPrice(price_origin) + '<span>vnđ</span>' : 'Liên hệ';
            $parents.find("li").find(".price-new-pro-detail").html(price(price_origin,true,true));
            $parents.find("li").find(".price-per-pro-detail, .price-old-pro-detail").html('');
            $parents.find("li").find(".price-per-pro-detail, .price-old-pro-detail").addClass("d-none");
        }
        
        $parents.find(".size-block-pro-detail").find("label strong").html(price_text);
        $parents.find(".size-block-pro-detail").find(".size-pro-detail").removeClass("active");
        $parents.find(".size-block-pro-detail").find(".size-pro-detail input").prop('checked',false);
        $this.addClass("active");
        $this.find("input").prop('checked',true);
    });
    $(".size-pro-detail.active").trigger("click");

    $("body").on("click", ".quantity-pro-detail span", function(){
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if($button.text() == "+")
        {
            var newVal = parseFloat(oldValue) + 1;
        }
        else
        {
            if(oldValue > 1) var newVal = parseFloat(oldValue) - 1;
            else var newVal = 1;
        }
        $button.parent().find("input").val(newVal);
    });
};

/* Ready */
$(document).ready(function(){
    NN_FRAMEWORK.Shiner();
    NN_FRAMEWORK.Loading();
    NN_FRAMEWORK.Lazys();
    NN_FRAMEWORK.Tools();
    NN_FRAMEWORK.Popup();
    NN_FRAMEWORK.WowAnimation();
    NN_FRAMEWORK.DomChanged();
    NN_FRAMEWORK.AltImages();
    NN_FRAMEWORK.BackToTop();
    /*NN_FRAMEWORK.Menu();*/
    NN_FRAMEWORK.Mmenu();
    NN_FRAMEWORK.Products();
    NN_FRAMEWORK.OwlPage();
    NN_FRAMEWORK.Toc();
    NN_FRAMEWORK.Cart();
    NN_FRAMEWORK.Search();
});