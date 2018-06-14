const ryc = {};


ryc.add = function () {
    console.log('Add Game');
}

ryc.edit = function(gameid) {
	fly.ajax({
        service: '/api/cms/game/getone/' + gameid,
        method: "POST",
        loading: true,
        success: function (result) {
            if (result.success) {
                popup.open('game-edit', 'Edit Info Game ID : ' + gameid, template('game/edit.tpl', {
                    data: result.data,
                    token: $('meta[name="csrf-token"]').attr('content'),
                    method: "PUT"
                }), [
                    {
                        title: 'Xác nhận',
                        style: 'btn-primary',
                        fn: function () {
                            fly.submit({
                                id: 'game-edit',
                                data: $('#game-edit-form-post').serialize(),
                                service: '/api/cms/game/edit/' +  gameid,
                                success: function (result) {
                                    if(result.success){
                                        window.location.reload();
                                    }else{

                                        popup.open('game-edit', 'Edit Info Game ID : ' + gameid, template('game/edite.tpl', {
                                            result: result,
                                            token: $('meta[name="csrf-token"]').attr('content'),
                                            method: "PUT"
                                        }), [
                                        {
                                            title: 'Xác nhận',
                                            style: 'btn-primary',
                                            fn: function () {
                                                fly.submit({
                                                    id: 'game-edit',
                                                    data: {
                                                        "_method": $('input[name=_method]').val(),
                                                        "name": $('input[name=name]').val(),
                                                        "slug": $('input[name=slug]').val(),
                                                        "file": $('input[name=file]').val(),
                                                        "logo": $('input[name=logo]').val(),
                                                        "cover": $('input[name=cover]').val(),
                                                        "thumb_share": $('input[name=thumb_share]').val(),
                                                        "description": $('input[name=description]').val(),
                                                        "status": $('input[name=status]').val(),
                                                    },
                                                    service: '/api/cms/game/edit/' +  gameid,
                                                    success: function (result) {
                                                        console.log(result);
                                                    }
                                                });
                                            }
                                        },
                                        {
                                            title: 'Bỏ qua',
                                            style: 'btn-default',
                                            fn: function () {
                                                popup.close('game-edit');
                                            }
                                        }
                                        ], 'modal-lg');
                                    }
                                }
                            });
                        }
                    },
                    {
                        title: 'Bỏ qua',
                        style: 'btn-default',
                        fn: function () {
                            popup.close('game-edit');
                        }
                    }
                ], 'modal-lg');
            }
        }
    });
}
