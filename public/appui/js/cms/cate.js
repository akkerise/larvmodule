const cate = {};

cate.detail = function (cateid) {
    fly.ajax({
        service: '/api/cms/cate/detail/' + cateid,
        method: 'GET',
        loading: true,
        success: function (result) {
            if (result.success) {
                popup.open('cate-detail',
                    'Detail Category : ' + result.data['id'],
                    template('cate/detail.tpl',
                    {
                        data: result.data
                    }),
                    [{
                        title: 'Đóng lại',
                        style: 'btn btn-default',
                        fn: function () {
                            popup.close('cate-detail');
                        }
                    }]
                    , 'modal-lg', '1000px');
            } else {
                popup.msg(result.message);
            }
        }
    });
}
