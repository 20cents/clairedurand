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
    var $img = $reveal.find('figure .img');
    var $caption = $reveal.find('figcaption');
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