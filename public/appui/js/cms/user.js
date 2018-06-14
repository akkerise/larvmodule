const user = {};

user.detail = function (userid) {
    fly.ajax({
        service: '/api/cms/user/detail/' + userid,
        method: 'GET',
        loading: true,
        success: function (result) {
            console.log(result);
            if (result.success) {
                popup.open('user-detail',
                    'Detail user : ' + result.data['id'],
                    template('user/detail.tpl',
                        {
                            data: result.data
                        }),
                    [{
                        title: 'Đóng lại',
                        style: 'btn btn-default',
                        fn: function () {
                            popup.close('user-detail');
                        }
                    }]
                    , 'modal-lg', '1000px');
            } else {
                popup.msg(result.message);
            }
        }
    });
}
