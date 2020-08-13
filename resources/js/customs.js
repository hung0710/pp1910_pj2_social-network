$(document).ready(function() {
    $(function () {
        $("#upload-image").change(function () {
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#dvPreview");
                dvPreview.html("");
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                $($(this)[0].files).each(function () {
                    var file = $(this);
                    if (regex.test(file[0].name.toLowerCase())) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var img = $("<img />");
                            img.attr("style", "height:100px;width: 100px");
                            img.attr("src", e.target.result);
                            dvPreview.append(img);
                        }
                        reader.readAsDataURL(file[0]);
                    } else {
                        alert(file[0].name + " is not a valid image file.");
                        dvPreview.html("");
                        return false;
                    }
                });
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.action-follow').click(function(){
        var user_id = $(this).data('id');
        var cObj = $(this);

        $.ajax({
            type:'POST',
            url:'/follow',
            data:{ user_id: user_id },
            success: function (data) {
                if (jQuery.isEmptyObject (data.success.attached)) {
                    cObj.find("strong").text("Follow");
                } else{
                    cObj.find("strong").text("UnFollow");
                }
            }
        });
    });

    $('body').on('click', '.store-comment', function (event) {
        event.preventDefault();

        var url = '/comments';
        var _this = $(this);
        var postId = parseInt($(this).data('post_id'));
        var content = $(this).parent().find('.comment-content').val();
        if (content == '') {
            errorEmptyContent();
        } else {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'post_id': postId,
                    'content': content,
                },
                cache: false,

                success: function (result) {
                    if (result.status) {
                        _this.parent().find('.comments-list').append(result.comment);
                        $('.comment-content').val('');
                    } else {
                        errorMessage();
                    }
                },
                error: function () {
                    errorMessage();
                }
            });
        }
    });
    $("#upload-avatar").on('change', function () {
        //Get count of selected files

        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var imgSize = $(this).get(0).files[0].size;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder-avatar");
        image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {
                if (imgSize < 2048000) {
                    //loop for each file selected for uploaded.
                    for (var i = 0; i < countFiles; i++) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $("<img />", {
                                "src": e.target.result,
                                "class": "thumb-image"
                            }).appendTo(image_holder);
                        }
                        image_holder.show();
                        $('.btn-avatar').show();
                        reader.readAsDataURL($(this)[0].files[i]);
                    }
                } else {
                    errorImageSize();
                }
            }
        } else {
            errorImages();
        }
    });

});