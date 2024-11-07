$(document).ready(function() {
    $('#post-footer-commentbtn').click(function(event) {
        event.preventDefault();

        if(!($('#post-comment').val()==0)){
            
            $.ajax({
                url: URLROOT+"/comments/comment/"+CURRENT_POST,
                method: "POST",
                data:$('form').serialize(),
                dataType: "text",
                success: function (comment) {
                    $('#msg').text(comment);
                }
            })
            //Refresh the entire comment thread
            $.ajax({
                url: URLROOT+"/comments/showcomments/"+CURRENT_POST,
                dataType: "html",
                success: function (results) {
                    $('#results').html(results);
                }
            })

            $('#post-comment').val('');

        }
    })

    //onload shwow comments
    $.ajax({
        url: URLROOT+"/comments/showcomments/"+CURRENT_POST,
        dataType: "html",
        success: function (results) {
            $('#results').html(results);
        }
    })
})

//delete function
function deletecomment(commentid){
    $.ajax({
        url: URLROOT+"/comments/deletecomment/"+commentid,
        method: "POST",
        data:$('form').serialize(),
        dataType: "text",
        success: function (response) {
            location.reload();
        }
    })
}


//comment interaction

//likes 

