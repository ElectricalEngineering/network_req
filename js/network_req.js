jQuery(document).ready(function($){

  $(document).keyup( function(e) {
    if( e.keyCode === 27 ) {
      var data = $('span.highlight');
      $.each(data, function() {
        $(this).replaceWith($(this).text());
      });
      $('#search').val('');
      $('.network-req tr.f').show('fast');
    }
  });

  $('#xClear').click(function(e) {
    e.preventDefault();
    var data = $('span.highlight');
    $.each(data, function() {
      $(this).replaceWith($(this).text());
    });
    $('#search').val('');
    $('.network-req tr.f').show('fast');
  });

  $('#search').search('.network-req tr.f');
  setInterval(function() {
    var updateCount = ($('tr.f:visible').length / 2);
    $('#count').text( updateCount );
  }, 1000);
  $('#network-request-scroll-to-top').click(function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:( $('body').position().top)}, 1200);
  });
  $('.network-request-more-info').click( function(e) {

    e.preventDefault();
    var that = this;

    if( $(that).find('.more-info').is(':hidden') ) {
      $('.more-info').slideUp(1500);
    }

    $(that).find('.more-info').slideToggle(1000);
    setTimeout(function() {
      if($(that).find('.more-info').is(':visible')) {
        $('html, body').animate({scrollTop:($(that).position().top - 100)}, 1200);
      }
    }, 1100);
  });

  $('#edit-manufacturer').change(function() { // add or remove classes from manufacturer depending on select state
    if ( $('#edit-manufacturer-other').is(':visible') ) {
      $('#edit-manufacturer-other').addClass('required');
    }
    else {
      $('#edit-manufacturer-other').removeClass('required');
    }
  });

  $('#edit-wired').change(function() {
    if ( $('#edit-tso').is(':visible') ) {
      $('#edit-tso').addClass('required');
    }
    else {
      $('#edit-tso').removeClass('required');
    }
  });

 $('.accordion-toggle').on('click', function() {
    jQuery('body').animate({scrollTop:'292px'});
  });
  $('.top').on('click', function() {
    jQuery('body').animate({scrollTop:0});
  });

});
