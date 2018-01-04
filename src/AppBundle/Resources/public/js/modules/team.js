(function($){
    $(function(){
        $('body')
            .on('click', '#modal-player .btn-update', function(event){
                event.preventDefault();
                var $modal = $(this).closest('#modal-player'),
                    $playerContent = $modal.find('.player-content').eq(0),
                    $form = $modal.find('form').eq(0),
                    formData = new FormData($form.get(0))
                ;
                $.ajax({
                    url: $form.attr('action'),
                    data: formData,
                    type: 'POST',
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (resp) {
                        if (typeof(resp) == 'object') {
                            $modal.modal('hide');
                            window.location.reload(true);
                        } else {
                            $playerContent.html(resp);
                        }
                    }
                });
            })
            .on('show.bs.modal', "#modal-player", function(event){
                var $el = $(this),
                    $loading = $el.find('.loading').eq(0),
                    $playerContent = $el.find('.player-content').eq(0),
                    $invoker = $(event.relatedTarget),
                    endpoint = $invoker.data('endpoint')
                ;
                $playerContent.load(endpoint, function() {
                    $loading.hide();
                    $playerContent.fadeIn();
                });
            })
            .on('hidden.bs.modal', "#modal-player", function(event){
                var $el = $(this),
                    $loading = $el.find('.loading').eq(0),
                    $playerContent = $el.find('.player-content').eq(0)
                ;
                $playerContent.html('');
                $loading.show();
            })
            .on('click', '#modal-player .player-avatar .trigger-avatar', function(event){
                event.preventDefault();
                var $el = $(this);
                $el.closest('.player-avatar').find('[type=file]').click();
            })
            .on('change', '#modal-player .player-avatar [type=file]', function(event){
                event.preventDefault();
                var $el = $(this),
                    $img = $el.closest('.player-avatar').find('img').eq(0)
                ;
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(evt) {
                        $img
                            .attr('src', evt.target.result)
                            .removeClass('hide')
                        ;
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            })
        ;
    });
})(jQuery);
