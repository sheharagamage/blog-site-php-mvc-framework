function addcommentLikes(commentID){
    if($('#comment-likes-'+commentID).hasClass('active')){
        $('#comment-likes-'+commentID).removeClass('active');
        deccommentslikes(commentID);
        

    }else{
        if($('#comment-dislikes-'+commentID).hasClass('active')){
            $('#comment-dislikes-'+commentID).removeClass('active');
            deccommentsdislikes(commentID);
            
        }
        $('#comment-likes-'+commentID).addClass('active');
        inccommentslikes(commentID);
        
    }
}


function addcommentDislikes(commentID){
    if($('#comment-dislikes-'+commentID).hasClass('active')){
        $('#comment-dislikes-'+commentID).removeClass('active');
        deccommentsdislikes(commentID);
        
    }else{
        if($('#comment-likes-'+commentID).hasClass('active')){
            $('#comment-likes-'+commentID).removeClass('active');
            deccommentslikes(commentID);
            
        }
        $('#comment-dislikes-'+commentID).addClass('active');
        inccommentsdislikes(commentID);
        
    }
}

function inccommentslikes(commentID){
    $.ajax({
        url: URLROOT + '/comments/inccommentslikes/' + commentID,
        method: "POST",
        data:$('form').serialize(),
        dataType: "text",
        success: function (likes) {
            $("#comment-count-like-"+commentID).html(likes);
        }
    })
}


function deccommentslikes(commentID){
    $.ajax({
        url: URLROOT + '/comments/deccommentslikes/' + commentID,
        method: "POST",
        data:$('form').serialize(),
        dataType: "text",
        success: function (likes) {
            $("#comment-count-like-"+commentID).text(likes);
        }
    })
}

function inccommentsdislikes(commentID){
    $.ajax({
        url: URLROOT + '/comments/inccommentsdislikes/' + commentID,
        method: "POST",
        data:$('form').serialize(),
        dataType: "text",
        success: function (likes) {
            $("#comment-count-dislike-"+commentID).html(likes);
        }
    })
}


function deccommentsdislikes(commentID){
    $.ajax({
        url: URLROOT + '/comments/deccommentsdislikes/' + commentID,
        method: "POST",
        data:$('form').serialize(),
        dataType: "text",
        success: function (likes) {
            $("#comment-count-dislike"+commentID).text(likes);
        }
    })
}