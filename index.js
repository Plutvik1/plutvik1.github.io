$("#kid-button").click(function(){
    $("#parent-box").hide();
    $("#kid-box").show();
});

$("#parent-button").click(function(){
    $("#kid-box").hide();
    $("#parent-box").show();
});