(function($){
    var Avatar = function() {
        this.$els = $('.avatar-container');
        this.$div = $('<div>', {class:"avatar img-circle img-thumbnail trigger-avatar"})
        this.$img = $('<img>', {class:"avatar img-circle img-thumbnail"})
        this.icons = {plus:"fa-plus", pencil:"fa-pencil"}
        this.init();
    };
    Avatar.prototype.init = function () {
        var self = this;
        this.$els.each(function(){
            var $el = $(this),
                $icon = $el.find('a i').eq(0),
                $img = $el.find('img').eq(0),
                $div = $el.find('div.img-thumbnail').eq(0),
                $input = $el.find('[type=file]').eq(0)
            ;
            $input.on('change', function(event){
                event.preventDefault();
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $img
                            .attr('src', e.target.result)
                            .removeClass('hide')
                        ;
                        $div.addClass('hide');
                        $icon
                            .removeClass(self.icons.plus)
                            .addClass(self.icons.pencil)
                        ;
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            $('.trigger-avatar').on('click', function(event) {
                event.preventDefault();
                $input.click();
            })
        })
    };

    var TournamentTypeAction = function() {
        this.$els = $('[data-tournament-type-action]');
        this.init()
    }
    TournamentTypeAction.prototype.init = function(){
        this.$els.on('change', function(event){
            event.preventDefault();
            var $el = $(this),
                $butons = $($el.data('tournament-type-action'))
            ;
            if ($el.val()) {
                $.get(app.api.path($el.data('tournament-type-action-endpoint'), {ID:$el.val()}), function(json){
                    json.action
                    $butons.each(function(){
                        var isDisabled = $(this).data('button-action') != json.action;
                        $(this).prop('disabled', isDisabled);
                        if (isDisabled) {
                            $($(this).data('target'))
                                .find('[type=text], [type=number]')
                                .val('').end()
                                // .find('[data-dinamyc-team-groups], [data-dinamyc-team-classify]')
                                // .clearOptions()
                            ;
                        }
                    });
                })
            }
        }).change();
    };

    var ShirtColor = function() {
        this.$el = $('#shirt');
        this.$parent = this.$el.parent();
        this.$path = this.$el.find('path');
        this.$input = this.$parent.find('input[type=hidden]');
        this.$players = $('.player-container');
        this.init();
    };
    ShirtColor.prototype.init = function(){
        var self = this;
        this.$el.colorpicker().on('changeColor', function(event){
            var color = event.color.toHex()
            self.$path.attr('fill', color);
            self.$parent.css('border-color', color);
            self.$input.val(color);
            self.$players.find('img,span').css('border-color', color);
        });
    };
    var FileTrigger = function() {
        this.$els = $('input[type=file][data-file-trigger]');
        this.init();
    };
    FileTrigger.prototype.init = function() {
        this.$els.each(function(){
            var $el = $(this)
                $fileTrigger = $($el.data('file-trigger'))
            ;
            $el.on('change',function(event){
                $($el).trigger('file.trigger.change', [$el, $fileTrigger]);
            });
            $fileTrigger.on('click', function(event){
                event.preventDefault();
                $el.click();
            });
        });
    }
    $(function(){
        new Avatar();
        new TournamentTypeAction();
        new ShirtColor();
        new FileTrigger();
        $('body')
            .on('click', 'ul.address-list li > a', function(event){
                event.preventDefault();
                $(this).closest('li').remove();
            })
        ;
    })
})(jQuery)
