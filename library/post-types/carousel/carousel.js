jQuery(document).ready(function($) {
  jQuery('.aeg-carousel').flexslider({
    animation: "slide",
  });
  jQuery('.carousel-container .next').click(function() {
    jQuery('.flexslider').flexslider('next');
  });
  jQuery('.carousel-container .prev').click(function() {
    jQuery('.flexslider').flexslider('prev');
  });
  console.log('asdfasdf');
});
