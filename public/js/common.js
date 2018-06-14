const common = {};

common.hideMsg = function (obj) {
    setTimeout(function () {
        $(obj).hide()
    }, 3000);
}
