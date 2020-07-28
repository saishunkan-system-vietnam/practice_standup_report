$(document).ready(function() {
    $(document).on('click','.memberDel',function(e) {
        let user_cd = $(this).attr("user_cd");
        e.preventDefault();
        $.MessageBox({
            customClass         : "custom_messagebox",
            customOverlayClass  : "custom_messagebox_overlay",
            buttonDone  : "Đồng ý",
            buttonFail  : "Không",
            message     : "Bạn có chắc chắn muốn xóa không?"
        }).done(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/member-del',
                type: 'post',
                dataType: 'json',
                data: {
                    user_cd: user_cd
                }
            }).done(function(res) {
                console.log(res);
                     debugger;
                if (res.status == 'Success') {
                    location.href = '/admin/member-list';
                } else {
                    alert('Lỗi server');
                }

            })
        });
    });

});

