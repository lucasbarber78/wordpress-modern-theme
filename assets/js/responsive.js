/**
 * File responsive.js.
 *
 * Handles responsive functionality and enhancements.
 */
(function($) {
  // Add class to header on scroll
  $(window).scroll(function() {
    const scrollPosition = $(window).scrollTop();
    const header = $('.site-header');
    
    if (scrollPosition > 50) {
      header.addClass('scrolled');
    } else {
      header.removeClass('scrolled');
    }
  });
  
  // Add animation class to elements when they come into view
  function animateOnScroll() {
    $('.animate-on-scroll').each(function() {
      const elementTop = $(this).offset().top;
      const elementBottom = elementTop + $(this).outerHeight();
      const viewportTop = $(window).scrollTop();
      const viewportBottom = viewportTop + $(window).height();
      
      if (elementBottom > viewportTop && elementTop < viewportBottom) {
        $(this).addClass('animated');
      }
    });
  }
  
  $(window).on('scroll resize', animateOnScroll);
  animateOnScroll();
  
  // Smooth scroll to anchors
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
      let target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - 100
        }, 600);
        
        return false;
      }
    }
  });
  
  // Responsive image loading for performance
  function loadResponsiveImages() {
    $('img[data-src]').each(function() {
      const img = $(this);
      img.attr('src', img.data('src'));
      img.on('load', function() {
        img.removeAttr('data-src');
      });
    });
  }
  
  loadResponsiveImages();
  
  // Initialize tooltips
  $('.tooltip').each(function() {
    $(this).hover(
      function() {
        const tooltipText = $(this).attr('data-tooltip');
        $('<div class="tooltip-bubble">' + tooltipText + '</div>').appendTo('body')
          .css({
            top: $(this).offset().top - 40,
            left: $(this).offset().left + ($(this).width() / 2) - 100
          })
          .fadeIn('fast');
      },
      function() {
        $('.tooltip-bubble').remove();
      }
    );
  });
  
})(jQuery);
