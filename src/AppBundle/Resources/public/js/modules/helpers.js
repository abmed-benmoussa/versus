(function($, _w){
    String.prototype.format = function() {
        var str = this;
        for (var i = 0; i < arguments.length; i++) {
            var reg = new RegExp("\\{" + i + "\\}", "gm");
            str = str.replace(reg, arguments[i]);
        }
        return str;
    };

    _w.factors = function (num){
        var list = [];
        for (i=1;i<=num;i++){
            if (num % i == 0 && i != 1){
                list.push(i);
            }
        }
        return list;
    };
    _w.range = function (init, end){
        init=end-init+1;
        list=[];
        while(init--)list[init]=end--;
        return list
    };
    $.fn.isSelect = function() {
        return (this.tagName||this.get(0).tagName) == 'SELECT';
    };
    $.fn.addOption = function(text, value) {
        if (this.isSelect()) {
            this.eq(0).append($('<option/>', {val: value, text: text}));
        }
        return this;
    };
    $.fn.clearOptions = function() {
        this.each(function(){
            if ($(this).isSelect()) {
                $(this).find('option').each(function(){
                    if (this.value != '') {
                        $(this).remove();
                    }
                })
            }
        })
        return this;
    };
})(jQuery, window);
