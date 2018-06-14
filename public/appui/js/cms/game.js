const game = {};

game.del = function(gameid) {
    if(confirm('Are you delete game id : ' + gameid)){
        fly.ajax({
            service: '/api/cms/game/del/' + gameid,
            method: 'DELETE',
            loading: true,
            success: function (result) {
                if (result.success) {
                    popup.open('mess', 'Deleted Success', template('mess/mess.tpl', {
                        data: result.data,
                        id: gameid
                    }), [{
                            title: 'Đóng lại',
                            style: 'btn btn-default',
                            fn: function () {
                                popup.close('mess');
                                game.load();
                            }
                        }]
                        , 'modal-lg');
                }else{
                    popup.msg(result.message);
                }
            }
        });
    }
}

game.detail = function(gameid) {
    fly.ajax({
        service: '/api/cms/game/detail/' + gameid,
        method: 'GET',
        loading: true,
        success: function (result) {
            if (result.success) {
                popup.open('game-detail', 'Detail User : ' + result.data['id'], template('game/detail.tpl', {
                    data: result.data
                }), [{
                        title: 'Đóng lại',
                        style: 'btn btn-default',
                        fn: function () {
                            popup.close('game-detail');
                        }
                    }]
                        , 'modal-lg');
            } else {
                popup.msg(result.message);
            }
        }
    });
}

game.load = function () {
    fly.ajax({
        service: '/api/cms/game/list/',
        data: {
            '_method': 'GET',
        },
        loading: true,
        success: function (result) {
            if (result.success) {
                $('tbody').html(result.data);
                App.datatables();
            } else {
                popup.msg(result.message);
            }
        }
    });
}
