$(function (){
    
    var imagesPickerTemplate = Handlebars.compile($("#entry-template").html());
    
    $("#btn-insert-image").click(function (e){
        e.preventDefault();
        $("#images-picker-modal").modal();
        $.ajax({
            url: $("#images-query-url").html()
        }).done(function (data){
            $("#images-picker").html(imagesPickerTemplate(data));
            $(".insert-image-button").click(function (event){
                var url = $(event.currentTarget).attr("data-url");
                var $post_content = $("#input-post_content");
                var post_content_position = document.getElementById("input-post_content").selectionStart;
                var post_content_text = $post_content.val();
                var imgTag = "<img src='" + url + "'>";
                $post_content.val(post_content_text.substring(0, post_content_position) + imgTag + post_content_text.substring(post_content_position));
                $("#images-picker-modal").modal('hide');
                document.getElementById("input-post_content").selectionStart += imgTag.length;
                document.getElementById("input-post_content").focus();
            });
        });
    });
    
});