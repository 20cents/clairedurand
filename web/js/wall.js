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
    var $caption = $reveal.find('.caption');
    var $swiperWrapper = $reveal.find('.swiper-wrapper');
    var zoomData;
    var swiper;
    function initSwiper() {
      zoomData.nbZoom = zoomData.nbZoom || 1;
      _.forEach(_.range(zoomData.nbZoom), function(index) {
        var $slide = $('<div class="swiper-slide" />');
        $slide
          .append($('<img src="' + options.zoomDir + zoomData.name + '-' + (index+1) + '.jpg" class="swiper-laz" />'))
          //.append($('<div class="swiper-lazy-preloader swiper-lazy-preloader-black" />'))
          ;
        $swiperWrapper.append($slide);
      });
      swiper = new Swiper('.swiper-container', {
        //zoom: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        pagination: '.swiper-pagination',
        paginationClickable: true,
        // Disable preloading of all images
        //preloadImages: false,
        // Enable lazy loading
        //lazyLoading: true,
        onDestroy: function() {
          console.log('la');
          $swiperWrapper.empty();
        }
      });
    }

    self.$grid.find('div.js-zoomable img').click(function() {
      var name = $(this).closest('.js-zoomable').attr('name');
      zoomData = _.find(options.images, function(image, index) {
        return image.name == name;
      });
      $caption.html(zoomData.caption);
      $reveal.foundation('open');
    });

    $reveal.on('open.zf.reveal', initSwiper);
    $reveal.on('closed.zf.reveal', function() {
      swiper.destroy();
    });
  };

  self.initZoom_ = function() {
    var $reveal = $('div[data-reveal]');
    var $img = $reveal.find('.img');
    var $caption = $reveal.find('.caption');
    self.$grid.find('div.js-zoomable img').click(function() {
      var name = $(this).closest('.js-zoomable').attr('name');
      var zoomData = _.find(options.images, function(image, index) {
        return image.name == name;
      });
      $caption.html(zoomData.caption);
      $img.css('background-image', 'url("' + options.zoomDir + zoomData.zoom + '.jpg")');
      $reveal.foundation('open');
    });
  };

  self.__construct();
};