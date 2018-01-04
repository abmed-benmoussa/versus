(function($){
    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;
            matches = [];
            substrRegex = new RegExp(q, 'i');
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });
            cb(matches);
        };
    };
    $(function(){
        $('input.typeahead').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },
            {
                name: 'teams',
                source: substringMatcher($('input').data('list').split('|'))
            }
        );
        $('body')
            .on('click', '.tt-menu', function(event){
                $('.btn-load-team').attr('disabled', !$('input[name=team_name]').val().length)
            })
            .on('keyup', 'input[name=team_name]', function(event){
                $('.btn-load-team').attr('disabled', !this.value.length)
            })
            .on('click', '.team-line a', function(event){
                event.preventDefault();
                var $el = $(this),
                    teamname = $el.closest('.team-line').find('p').text(),
                    attrs = {action: $el.attr('href'), method:'post', class:'hide'}
                ;
                if (confirm("¿Esta seguro que desea elimiar al equipo "+teamname+" del torneo?")) {
                    $('<form/>', attrs)
                        .append($('<input type="hidden" name="_method" value="delete" />'))
                        .appendTo(document.body)
                        .submit()
                    ;
                }
            })
            .on('click', '.tournament-team-action a[data-action]', function(event){
                event.preventDefault();
                var $el = $(this),
                    action = $el.data('action'),
                    endpoint = $el.attr('href'),
                    attrs = {action: $el.attr('href'), method:'post', class:'hide'},
                    messages = {
                        edit: '¿Estas seguro que deseas volver a la edición dle Torneo?',
                        generate: '¿Estas seguro que deseas generar los emparejamientos?',
                    }
                ;
                if (confirm(messages[action])) {
                    $('<form/>', attrs)
                        .appendTo(document.body)
                        .submit()
                    ;
                }
            })
        ;
        $('input[name=team_name]').keyup();
    });
})(jQuery);
