var clairedr = clairedr || {};

clairedr.Wall = function(options) {
  var self = this;

  self.__construct = function() {
    self.initMasonry();
    self.initZoom();
  };

  self.initMasonry = function() {
    self.$grid = $('.grid').masonry({
      itemSelector: '.grid-item',
      columnWidth: '.grid-sizer',
      //gutter: '.gutter-sizer',
      percentPosition: true,
      transitionDuration: 0,
      //percentPosition: true,
      //isFitWidth: true
    });
    self.$grid.imagesLoaded().progress(function() {
      self.$grid.masonry('layout');
    });
  };

  self.initZoom = function() {
    var $reveal = $('div[data-reveal]');
    var $content = $reveal.find('.content');

    var zoomData;
    var swiper;
    function initSwiper() {
      setTimeout(function() {
        swiper = new Swiper('.swiper-container', {
          zoom: true,
          nextButton: '.swiper-button-next',
          prevButton: '.swiper-button-prev',
          pagination: '.swiper-pagination',
          paginationClickable: true,
          preloadImages: false,
          lazyLoading: true,
          onDestroy: function() {
            $content.empty();
          }
        });
      }, 500);
    }

    self.$grid.find('div.js-zoomable img').click(function() {
      var name = $(this).closest('.js-zoomable').attr('name');
      zoomData = _.find(options.images, function(image, index) {
        return image.name == name;
      });
      zoomData.nbZoom = zoomData.nbZoom || 1;
      var isMultiple = zoomData.nbZoom > 1;

      $content.html(
        '<div class="caption">' + zoomData.caption + '</div>'
        + '<div class="swiper-container"><div class="swiper-wrapper"></div></div>'
      );
      if (isMultiple) {
        $content.find('.swiper-container')
          .append('<div class="swiper-pagination swiper-pagination-black"></div>')
          .append('<div class="swiper-button-next swiper-button-black"></div>')
          .append('<div class="swiper-button-prev swiper-button-black"></div>')
          ;
      }
      var $swiperWrapper = $content.find('.swiper-wrapper');
      _.forEach(_.range(zoomData.nbZoom), function(index) {
        var $slide = $('<div class="swiper-slide" />');
        var imgUrl = options.zoomDir + zoomData.name;
        if (isMultiple)
          imgUrl += '-' + (index + 1);
        imgUrl += '.jpg';
        $slide
          .append($('<div class="swiper-zoom-container"><img data-src="' + imgUrl + '" class="swiper-lazy" /></div>'))
          //.append($('<div class="swiper-zoom-container"><img data-src="http://lorempixel.com/1200/800/abstract/' + (index + 1) + '" class="swiper-lazy" /></div>'))
          .append($('<div class="swiper-lazy-preloader swiper-lazy-preloader-black" />'))
          ;
        $swiperWrapper.append($slide);
      });

      $reveal.foundation('open');
    });

    $reveal.on('open.zf.reveal', initSwiper);
    $reveal.on('closed.zf.reveal', function() {
      swiper.destroy();
    });
  };

  self.__construct();
};
