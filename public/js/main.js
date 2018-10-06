function add_like(id) {
    $.get(
        urlroot+"/posts/add_like/"+id,        
        function(data) {
            // debugger
            if (data == "success") {
                $("#likebtn"+id).text("Liked")
                get_likes(id)
            } else if (data == "removed") {
                $("#likebtn"+id).text("Like")
                get_likes(id)
                alert("You unliked this post.")
            } else {
                alert("Couldn't Like/Unlike this post. We apologize for this.")
            }
        }
    )
}

// Get total number of likes for a post

function get_likes(id) {
    $.get(
        urlroot+"/posts/get_likes/"+id,
        function(data) {
            $("#post_"+id+"_likes").text(data)
        }
    )
}

// display users who like a post

function show_likes(id) {
    $.get(
        urlroot+"/posts/show_likes/"+id,
        function(data) {
            // debugger
            $("#likesModal .modal-body").html(data)
        }
    )
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})