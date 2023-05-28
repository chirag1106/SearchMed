function addCart(click_id){
    var btn_id = '#'+click_id; 
    $(btn_id).text("ADDED");
    $(btn_id).css("color","green");
    $.ajax({
        url: "action.php",
        type: "post",
        data: {"medicine_id":$(btn_id).data("fpid"),"action":"addToCart"},
        success: function(data){
            if(data == "couldn't able to add"){
                window.alert(data);
            }
            else{
                // data = JSON.parse(data);
                // sessionStorage.setItem(data.NonGeneric,data.Generic);

                $('#show-list-table').html(data);
            }
        }
    }); 
}
$(document).ready(function(){
    $(".search-input").keyup(function(){ 
        $(window).resize(function(){
                    
                    if ($(window).width() <= 768) {  
                        $()
                        $(".search").css("border-bottom-right-radius","50px").css("border-top-right-radius","50px");
                        $("#search-btn").css("border-bottom-right-radius","50px").css("border-top-right-radius","50px");
                        $(".search form input").css("border-bottom-left-radius","50px");
                        $(".search").css("border-bottom-left-radius","50px").css("border-top-left-radius","50px");
                        
                    } 
                    else if ($(window).width() >= 768) {
                        $(".search form input").css("border-bottom-left-radius","0px");
                        $(".search").css("border-bottom-right-radius","0px").css("border-top-right-radius","50px");
                        $("#search-btn").css("border-bottom-right-radius","0px").css("border-top-right-radius","50px");
                        $(".search").css("border-bottom-left-radius","0px").css("border-top-left-radius","50px");
                    }      
                });
        $.ajax({
            url: "action.php",
            type: "post",
            data: $("#search-form").serialize()+'&action=liveSearch',
            success: function(response){
                $("#main").css("top","30%");
                $(".search").css("border-bottom-right-radius","0px").css("border-top-right-radius","50px");
                $("#search-btn").css("border-bottom-right-radius","0px").css("border-top-right-radius","50px");
                $(".search-result").show(800);
                $(".welcome").hide(800);
                $("#search-btn").text("Searching...");
                $("#result-table").html(response);
            }
        });
    });

    $("#search-btn").click(function(e){
        e.preventDefault();  
    });
    
    $("#sugg-hide").click(function(){
        $("#sugg-form").css("display","none");
    }); 
    $(".hide").click(function(){
        $(".list").css("display","none");
    }); 

    $("#sugg-btn").click(function(e){
        e.preventDefault();
        $("#sugg-form").css("display","block");
    });
    
    $("#min").click(function(e){
        e.preventDefault();
        $("#max").css("display","block");
        $("#min").css("display","none")
        $(".chat").hide(600);
    });
    
    $("#max").click(function(e){
        e.preventDefault();
        $("#min").css("display","block");
        $("#max").css("display","none");
        $(".chat").show(600);
    });

    $("#show-list").click(function(){
        $(".list").css("display","block");
    });
    
});