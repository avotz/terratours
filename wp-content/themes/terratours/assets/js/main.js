;(function($){


  $('#bannerNav li').on('click', function (e) {
     $('#bannerNav li').removeClass('on');
     $(this).addClass('on');
    $('#bgImage').attr('style', 'background-image: url('+ $(this).attr('rel'));
  });

  $(".gallery-carousel").owlCarousel({
    animateOut: 'fadeOut',
    items : 1,
    autoplay : false,
    autoplayTimeout: 5000,
    loop : true,
    nav : true,
    mouseDrag :false,
    navText : ['<a href="#" class="owl-prev"><i class="fa fa-arrow-left"></i></a>','<a href="#" class="owl-next"> <i class="fa fa-arrow-right"></i></a>']
    
});
  

  $('.woocommerce-product-gallery__image a').magnificPopup({
    type: 'image',
    gallery:{
      enabled:true
    }
  });

  $('.tour-popup-link').magnificPopup({
    type: 'inline',
    midClick: true,
    removalDelay: 500, //delay removal by X to allow out-animation
    callbacks: {
        beforeOpen: function() {
  
            this.st.mainClass = 'mfp-zoom-out';
            $('body').addClass('mfp-open');
        },
        beforeClose: function() {
  
           
            $('body').removeClass('mfp-open');
        }
  
    }
  
   
  });
  
  $('.tour-popup-link').on('click',function (e) {
    
  
  
   
    $('#tour-popup').find('input[name="your-subject"]').val('Inquire for '+$(this).attr('data-title'));
    
   
    
  
    });

  $(window).scroll(function () {         

   
    });


 
$(window).load(function() {
     
      resize();

});


$(window).resize(resize);

function resize () {

  
  
  positionFooter();


   
}


function positionFooter() {
          var footerHeight = 0,
          footerTop = 0,
          $footer = $(".footer");
         footerHeight = $footer.height()+16;
         footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";
  
        if ( ($(document.body).height()+footerHeight) < $(window).height()) {
            $footer.css({
                 position: "fixed"
             })
         //    }).animate({
         //         top: footerTop
         //    })
        } else {
            $footer.css({
                 position: "relative"
            })
        }
        
  }


    
})(jQuery);


