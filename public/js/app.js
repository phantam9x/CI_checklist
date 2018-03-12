
//  Event sidebar-toggler
    var sidebar_toggler = $('#sidebar-toggler');
    var wrapper = $('#wrapper');
    sidebar_toggler.click(function () {
        if (wrapper.hasClass('hide-menu')) {
            wrapper.removeClass('hide-menu');
            wrapper.addClass('show-menu');
        } else {
            wrapper.addClass('hide-menu');
            wrapper.removeClass('show-menu');
        }
    });

// Event sidebar-menu
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if ($('#wrapper').hasClass('show-menu')) {
            if (!$(this).parent('li').hasClass('active')) {
                $('.sub-menu').slideUp();
                $(this).parent('li').find('.sub-menu').slideDown();
                $('#sidebar-menu > .nav-item').removeClass('active');
                $(this).parent('li').addClass('active');
                return false;
            } else {
                $('.sub-menu').slideUp();
                $('#sidebar-menu > .nav-item').removeClass('active');
                return false;
            }
        }
    });

    $('#fake-file-button-browse').click(function() {
        $('#files-input-upload').click();
        $('#files-input-upload').change(function(event) {
            document.getElementById('fake-file-input-name').value = this.value;
            $('#fake-file-button-upload').removeAttr('disabled');
            var files = document.getElementById('files-input-upload').files; 
            // Thêm src vào mỗi thẻ img theo 
            $('#wp-content .avatar img').attr('src', URL.createObjectURL(event.target.files[0]));  
            $("#wp-content .avatar .progress").css('display','none');
            $("#wp-content .avatar .progress-bar").css('width','0%');
            $('#wp-content .avatar .progress>.value').text('0%');
            $("#wp-content .avatar .result").html('');
        })
    })

$('.calendar-month-header .month-back,.calendar-month-header .month-next').click(function(event) {
    var month = parseInt($("input[name='month']").val());
    var year = parseInt($("input[name='year']").val());
    var base_url = $("input[name='base_url']").val();
    if($(this).hasClass('month-back')) {
        month -= 1;
        if(month <= 0) {
            month = 12;
            year -= 1;
        }
    } else {
        month += 1;
        if(month >= 13) {
            month = 1;
            year += 1;
        }
    }
    var path = base_url+'/work/?m='+month+'&y='+year;
    window.location.href = path;
})

$('.wp-message-session .close-message').click(function() {
    $(this).parents('.wp-message-session').remove();
})
setTimeout(function(){
    $('.wp-message-session').remove();
}, 6000);
// Xử lý ảnh và upload
$('#wp-content .avatar #fake-file-button-upload').on('click', function() {
    // Gán giá trị của nút chọn tệp vào var img_file
    $img_file = $('#files-input-upload').val();

    // Cắt đuôi của file để kiểm tra
    $type_img_file = $img_file.split('.').pop().toLowerCase();

    // Nếu không có ảnh nào
    if ($img_file == '')
    {
        $("#wp-content .avatar .result").addClass('text-warning');
        // Thông báo lỗi
         $("#wp-content .avatar .result").text('Vui lòng chọn ít nhất một file ảnh.');
    }
    // Ngược lại nếu file ảnh không hợp lệ với các đuôi bên dưới
    else if ($.inArray($type_img_file, ['png', 'jpeg', 'jpg', 'gif']) == -1)
    {
        $("#wp-content .avatar .result").addClass('text-warning');
        // Thông báo lỗi
        $("#wp-content .avatar .result").text('File ảnh không hợp lệ với các đuôi .png, .jpeg, .jpg, .gif.');
    }
    // Ngược lại
    else
    {
        // Tiến hành upload 
        $('#form-upload').ajaxSubmit({ 
            // Trước khi upload
            beforeSubmit: function() {
                $("#wp-content .avatar .progress").css('display','block');
            },

            // Trong quá trình upload
            uploadProgress: function(event, position, total, percentComplete){ 
                var value = percentComplete + '%';
                // Hiển thị con số % trên thanh tiến trình
                $('#wp-content .avatar .progress>.value').text(value);
                // Kéo dãn độ dài thanh tiến trình theo % tiến độ upload
                $('#wp-content .avatar .progress .progress-bar').css('width',value);
            },
            // Sau khi upload xong
            success: function() {  
                $("#wp-content .avatar .result").addClass('text-success'); 
                $("#wp-content .avatar .result").text("Đăng ảnh thành công");
            },
            // Nếu xảy ra lỗi
            error : function(error) {
                console.log(error);
                // Thông báo lỗi
                $("#wp-content .avatar .result").addClass('text-danger');
                $("#wp-content .avatar .progress").css('display','none');
                 $("#wp-content .avatar .result").text('Không thể upload ảnh vào lúc này, hãy thử lại sau.');
            }
        }); 
        return false; 
    }
});
