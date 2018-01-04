(function($){
    $(function(){
        $('input[type=file]').each(function(){
            var $el = $(this)
                $fileAction = $($el.data('file-action'))
            ;
            $el.on('change',function(event){
                $($el.data('file-action')).val($el.val().split('\\').pop()).blur();
            });
            $fileAction.on('click', function(event){
                $el.click();
            });
        });
    });
})(jQuery)
