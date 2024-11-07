function addLikes(postID){
    if($('#post-likes-'+postID).hasClass('active')){
        $('#post-likes-'+postID).removeClass('active');

        decpostslikes(postID);

    }else{
        if($('#post-dislikes-'+postID).hasClass('active')){
            $('#post-dislikes-'+postID).removeClass('active');

            decpostsdislikes(postID);
        }
        $('#post-likes-'+postID).addClass('active');

        incpostslikes(postID);
    }
}

function addDislikes(postID){
    if($('#post-dislikes-'+postID).hasClass('active')){
        $('#post-dislikes-'+postID).removeClass('active');

        decpostsdislikes(postID);
    }else{
        if($('#post-likes-'+postID).hasClass('active')){
            $('#post-likes-'+postID).removeClass('active');

            decpostslikes(postID);
        }
        $('#post-dislikes-'+postID).addClass('active');

        incpostsdislikes(postID);
    }
}

function incpostslikes(postID){
    $.ajax({
        url: URLROOT + '/posts/incpostslikes/' + postID,
        method: "POST",
        data:$('form').serialize(),
        dataType: "text",
        success: function (likes) {
            $("#post-likes-count-"+postID).html(likes);
        }
    })
}


function decpostslikes(postID){
    $.ajax({
        url: URLROOT + '/posts/decpostslikes/' + postID,
        method: "POST",
        data:$('form').serialize(),
        dataType: "text",
        success: function (likes) {
            $("#post-likes-count-"+postID).text(likes);
        }
    })
}

function incpostsdislikes(postID){
    $.ajax({
        url: URLROOT + '/posts/incpostsdislikes/' + postID,
        method: "POST",
        data:$('form').serialize(),
        dataType: "text",
        success: function (likes) {
            $("#post-dislikes-count-"+postID).html(likes);
        }
    })
}


function decpostsdislikes(postID){
    $.ajax({
        url: URLROOT + '/posts/decpostsdislikes/' + postID,
        method: "POST",
        data:$('form').serialize(),
        dataType: "text",
        success: function (likes) {
            $("#post-dislikes-count-"+postID).text(likes);
        }
    })
}

