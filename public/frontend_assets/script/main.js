var curIdx = 0;

$(document).ready(function(){
    PQP.init();
});

function openSlider(num) {
    $(".slider-button").attr("class", "slider-button");
    $(".slider-button:eq("+(num-1)+")").attr("class", "slider-button slider-button-current");
    $(".slider-image:eq("+(curIdx)+")").slideUp(1000);
    curIdx = num-1;
    $(".slider-image:eq("+(num-1)+")").slideDown(1000);
}