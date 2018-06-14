var media = {};
media.previewImg = function (sourceImg) {
    popup.open('media-preview-img', 'Xem chi tiết ảnh', template('media/preview_img.tpl', {
        sourceImg: sourceImg
    }), [
        {
            title: 'Đóng',
            style: 'btn-default',
            fn: function () {
                popup.close('media-preview-img');
            }
        }
    ], 'modal-lg');
};

media.chooseAvatar = function (sourceId, isAuth) {
    var apiUrl = 'service/media/addimage';
    if (isAuth) {
        apiUrl = 'service/media/add-image-no-auth';
    }
    popup.open('media-choose-avatar', 'Cập nhật ảnh đại diện', template('media/choose_avatar.tpl', {
    }), [
        {
            title: 'Lưu',
            style: 'btn-primary',
            fn: function () {
                $('#upload-avatar').croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (resp) {
                    var fileName = $("input[name=fileName]").val();
                    fly.ajax({
                        service: apiUrl,
                        method: "POST",
                        loading: true,
                        data: {
                            encodeData: resp,
                            fileName: fileName
                        },
                        success: function (result) {
                            popup.close('media-choose-avatar');
                            if (result.success) {
                                var avatar = mediaUrl + "media/files/" + result.datas.body.fileName + "?authToken=" + authToken;
                                $('#' + sourceId).attr('src', avatar);
                                $("input[name=" + sourceId + "]").val(result.datas.body.fileName);
                            } else {
                                popup.msg(result.message);
                            }
                        }
                    });
                });
            }
        },
        {
            title: 'Hủy',
            style: 'btn-default',
            fn: function () {
                popup.close('media-choose-avatar');
            }
        }
    ], 'modal-lg');
};

media.chooseCertificate = function (sourceId, title, isAuth) {
    var apiUrl = 'service/media/addimage';
    if (isAuth) {
        apiUrl = 'service/media/add-image-no-auth';
    }
    popup.open('media-choose-image-certificate', title, template('media/choose_image_certificate.tpl', {
    }), [
        {
            title: 'Lưu',
            style: 'btn-primary',
            fn: function () {
                var fileName = $("input[name=fileName]").val();
                var resp = $("input[name=fileResult]").val();
                fly.ajax({
                    service: apiUrl,
                    method: "POST",
                    loading: true,
                    data: {
                        encodeData: resp,
                        fileName: fileName
                    },
                    success: function (result) {
                        popup.close('media-choose-image-certificate');
                        if (result.success) {
                            var avatar = mediaUrl + "media/files/" + result.datas.body.fileName + "?authToken=" + authToken;
                            $('#' + sourceId).attr('src', avatar);
                            $("input[name=" + sourceId + "]").val(result.datas.body.fileName);
                        } else {
                            popup.msg(result.message);
                        }
                    }
                });
            }
        },
        {
            title: 'Hủy',
            style: 'btn-default',
            fn: function () {
                popup.close('media-choose-image-certificate');
            }
        }
    ], 'modal-lg', '800px');
};