var owl = $('.owl-carousel');
owl.owlCarousel({
    items: 5,
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 1000,
    autoplayHoverPause: true,
    dots: false
});
$('.play').on('click', function() {
    owl.trigger('play.owl.autoplay', [1000])
})
$('.stop').on('click', function() {
    owl.trigger('stop.owl.autoplay')
})



$(window).scroll(function() {
    if ($(window).scrollTop() >= 300) {
        $('.custom-navbar').addClass('fixed-header');
    } else {
        $('.custom-navbar').removeClass('fixed-header');
    }
});


$(document).ready(function() {
    $('#service').click(function() {
        $('html, body').animate({
            scrollTop: $("#service-section").offset().top - 80
        }, 1000)
    }),
    $('#client').click(function() {
        $('html, body').animate({
            scrollTop: $("#client-logo").offset().top - 80
        }, 1000)
    }),
    $('#about').click(function() {
        $('html, body').animate({
            scrollTop: $("#about-area").offset().top - 80
        }, 1000)
    }),
    $('#contact-us').click(function() {
        $('html, body').animate({
            scrollTop: $("#contact-us-area").offset().top - 80
        }, 1000)
    }),
    $('.chatbox-open').click(function() {
        $('.chatbox-popup').slideToggle("slow");
		$(this).fadeOut("fast");
    }),
    $('.chatbox-close').click(function() {
        $('.chatbox-popup').slideToggle("fast");
        $('.chatbox-open').fadeIn("slow");
    }),

    $('.chat-emoji-btn').click(function() {
        $('#emojis').toggle();
    })

    $('#project_view').click(function() {
        $(this).hide();
        $('#openProject').show();
    })

});









$("#emojis").disMojiPicker()
$("#emojis").picker(emoji => console.log(emoji));
twemoji.parse(document.body);