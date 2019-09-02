$(document).ready(function(){
   $(".postContent-owner").dblclick(function(e){
       $(this).removeAttr('readonly');
   });
   $(".showing-comment-owner").dblclick(function(e){
       $(this).removeAttr('readonly');
   });
    $(".showing-comment-owner,.showing-comment-user").focus(function(e){
        $(this).css({
            "border":"1px solid #dbdbdb",

            "box-shadow":"0px 0px 3px #dbdbdb"
        });
    });
    $(".showing-comment-owner,.showing-comment-user").blur(function(e){
        $(this).css({
            "border":"none",

            "box-shadow":"none"
        });
    });

    $(".postContent-owner,.postContent-user").focus(function(e){
        $(this).css({
            "border":"1px solid #dbdbdb",

            "box-shadow":"0px 0px 3px #dbdbdb"
        });
    });
    $(".postContent-owner,.postContent-user").blur(function(e){
        $(this).css({
            "border":"none",
            "box-shadow":"none"
        });
    });

    /////////
    var evaluation=0;
    $(".star-image").click(function(e){
        //$(this).attr('src',"http://localhost:2000/images/star_shines1.png");
        //var id=$(this).attr('id');
        $(this).toggleClass('selected');
        if($(this).hasClass('selected')){
            $(this).attr('src',"http://localhost:2000/images/star12.png");
            evaluation+=1;
        }else{
            $(this).attr('src',"http://localhost:2000/images/star.png");
            evaluation-=1;
        }
        //console.log(e.currentTarget);
        //console.log(id);
        $("#evaluation").val(evaluation);
        //console.log(evaluation);
    });

    ///////////
    $("#readerAddBook").click(function(e){
        $(".book-reader form").toggle();
    });

    $(".messageTitle").click(function(e){
        var messageContent=$(this).next();
        messageContent.toggle();
    });
});