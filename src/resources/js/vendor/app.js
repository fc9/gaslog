// Fancybox

$(document).ready(function () {
    $("[data-fancybox]").fancybox();
    let sliders = $(".slider");
    let missionSlider = $('.conteudo_pagina__video')
    if (sliders.length) {
        sliders.each((i, el) => {
            $(el).slick({
                arrows: false,
                dots: true
            });
        });
    }
    if (missionSlider.length) {
        missionSlider.each((i, el) => {
            $(el).slick({
                arrows: true,
                dots: true,
                prevArrow: "<button type='button' class='slick-prev slick-arrow'><i class='icon-seta-lado'></i></button>",
                nextArrow: "<button type='button' class='slick-next  slick-arrow'><i class='icon-seta-lado'></i></button>"
            });
        });
    }
});
