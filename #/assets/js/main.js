   alert("X");
requirejs.config({
    urlArgs: "v="+_version,
    baseUrl: 'assets/js',
    pluginsPath: '../plugins/',
    paths: {
        'jquery': "jquery.min",
        'css': "css.min",
        'apps': "apps",
        'owlcarousel': '../plugins/owlcarousel2/owl.carousel',
        'fancybox': '../plugins/fancybox3/jquery.fancybox',
        'bootstrap': "bootstrap",
        'simplyscroll': "../plugins/simplyscroll/jquery.simplyscroll",
    },   
    shim: {
        'bootstrap': {
            deps: ["css","css!style/../../../css/fontawesome512/all.css"]
        },
        'owlcarousel':{
            deps:['css!style/../../plugins/owlcarousel2/owl.carousel','css!style/../../plugins/owlcarousel2/owl.theme.default']

        },
        'fancybox':{
            deps:['css!style/../../plugins/fancybox3/jquery.fancybox']

        },
       'apps':{
            deps:['jquery','functions']
        },
        'simplyscroll':{
            deps:['css!style/../../plugins/simplyscroll/jquery.simplyscroll']
        }
    },
});
define(['jquery'],function($){

require(['bootstrap','functions','apps'], function($b,$f,$a) {
    $.fn.exists = function(){
        return this.length;
    };
    if(jQuery(".owl-carousel").length){
        require(['owlcarousel'],function($m){
            Apps.OwlPage();
        });
    } 
    if(jQuery("*[data-fancybox]").length){
        require(['fancybox'],function($m){
            Apps.Videos();
        });
    }
    if(jQuery(".newshome-scroll").length){
        require(['simplyscroll'],function($m){
            Apps.SimplyScroll();
        });
    }
    $(".append-script").each(function(){
        eval($(this).html());
    })
    if($(".MagicZoom").length){
        require(['../plugins/magiczoomplus/magiczoomplus','css!style/../../plugins/magiczoomplus/magiczoomplus'],function($m){
         
        });
    }
    if($(".album-gallery").length){
        require(['../plugins/photobox/photobox','css!style/../../plugins/photobox/photobox'],function($m){
            Apps.Photobox();
        });
    }
    require(['css!style/../../../css/cart']);
    Apps.Cart();
    
});
});
