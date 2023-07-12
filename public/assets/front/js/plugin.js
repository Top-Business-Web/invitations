$(function (){

    'use strict';

    $(".owl-carousel").owlCarousel({
        autoplay: true,
        autoplayhoverpause: true,
        autoplaytimeout: 100,
        items: 1,
        nav: true,
        loop: true,
        dots: false,
        responsive: {
            0 : {
                items: 1
            },
            485 : {
                items: 1
            },
            728 : {
                items: 1
            },
            1200 : {
                items: 1
            }
        }
    });

    $('.btn-faq').click(function(){
        $(this).toggleClass('active');
    });

    $('.btn-hand').on('click', function (){ 
    
        $($(this).data('content')).fadeIn();

    });



});