
function onScroll(){
  $('window').on('touchmove', function(event) {
    event.preventDefault();
    window.scroll({top: 0,left: 0,behavior: 'smooth'})
});

  window.scroll({top: 0,left: 0,behavior: 'smooth'})

}
$(document).ready(function() {
    $('.popup-btn').click(function() {
var id=this.id;

$(document.body).on('touchmove',onScroll()); // for mobile
$(window).on('scroll',onScroll());


      $('.pw').fadeIn(500);
      $('.pb').removeClass('transform-out').addClass('transform-in');
      //  alert(this.id);

    });

    $('.pcu').click(function(e) {

      $('.pw').fadeOut(500);
      $('.pb').removeClass('transform-in').addClass('transform-out');


    });



    $('.popup-down').click(function() {
        var id=this.id;

        $(document.body).on('touchmove',onScroll()); // for mobile
        $(window).on('scroll',onScroll());


              $('.popup-wrapd').fadeIn(500);
              $('.popup-boxd').removeClass('transform-out').addClass('transform-in');
              //  alert(this.id);

            });

            $('.pc').click(function(e) {

              $('.popup-wrapd').fadeOut(500);
              $('.popup-boxd').removeClass('transform-in').addClass('transform-out');


            });


  });

