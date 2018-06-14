(function () {
    this.tmpl = function (selector, data) {
        var html = $(selector).html();
        Mustache.parse(html);
        return Mustache.render(html, data);
    };

    this.template = function (template, data) {
        try {
            return new EJS({
                url: baseUrl + '/appui/tpl/' + template
            }).render(data);
        } catch (err) {
            return "";
        }
    };
})();