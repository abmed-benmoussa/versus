(function($){
    $(function(){
        $('body')
            .on('change', '[data-provide=datepicker]', function(event){
                var dateInit = new Date($('[data-date-role=init]').val()),
                    dateEnd = new Date($('[data-date-role=end]').val()),
                    isValid = true
                ;
                switch ($(this).data('date-role')) {
                    case 'init':
                        if (dateEnd&&dateInit>dateEnd) {
                            isValid = false;
                            alert('La fecha de inicio no puede ser mayor que la fecha final');
                        }
                        break;
                    case 'end':
                        if (dateInit&&dateEnd<dateInit) {
                            isValid = false;
                            alert('La fecha de final no puede ser menor que la fecha inicio');
                        }
                        break;
                }

                if (!isValid) {
                    $(this).val('');
                }
            })
            .on('show.bs.modal', "#modal-tournament-modality", function(event){
                var $el = $(this),
                    $invoker = $('[data-button-action]:enabled'),
                    modalidades = {groups:"Grupos", playoff:"Plaoff", combined:"Combinado"},
                    modaltitleformat = $el.data('title-format'),
                    modaltype = $invoker.data('button-action'),
                    modaltitle = modaltitleformat.format(modalidades[modaltype]),
                    $teamGroups = $el.find('[data-dinamyc-team-groups]'),
                    valformat = $teamGroups.data('value-format'),
                    teamNumber = $($teamGroups.data('dinamyc-team-groups')).val(),
                    options = factors(teamNumber)
                ;
                $el.find('#modal-title p').text(modaltitleformat.format(modalidades[modaltype]))
                $el.find('.group-modality, .title-group, .playoff-modality, .title-playoff').addClass('hide');
                switch (modaltype) {
                    case 'groups':
                        $el.find('.group-modality').removeClass('hide');
                        $el.find('.title-group, .playoff-modality, .title-playoff').addClass('hide');
                        break;
                    case 'playoff':
                        $el.find('.playoff-modality').removeClass('hide');
                        $el.find('.group-modality, .title-group, .title-playoff').addClass('hide');
                        break;
                    case 'combined':
                        $el.find('.group-modality, .title-group, .playoff-modality, .title-playoff').removeClass('hide');
                        break;
                }
                if ($.inArray(modaltype, ['groups', 'combined'])!=-1&&!$teamGroups.find('option').length) {
                    $.each(options, function(inx, ele){
                        $teamGroups.addOption(valformat.format(ele), ele)
                    });
                    $teamGroups.change();
                }
            })
            .on('change', "#modal-tournament-modality [data-dinamyc-team-groups]", function(event){
                var $el = $(this),
                    $groupNumber = $("#groups-number"),
                    $teamClassify =  $('[data-dinamyc-team-classify]'),
                    groupNumberFormat = $groupNumber.data('value-format'),
                    teamClassifyFormat = $teamClassify.data('value-format'),
                    teamByGroup = parseInt($el.val()),
                    teamNumber = parseInt($($el.data('dinamyc-team-groups')).val())
                ;
                if (teamByGroup > 0 ) {
                    $groupNumber.text(groupNumberFormat.format(teamNumber/teamByGroup));
                    $teamClassify.clearOptions();
                    $.each(range(1, teamByGroup), function(inx, ele){
                        $teamClassify.addOption(teamClassifyFormat.format(ele), ele);
                    });
                }
            })
            .on('change', '#backendbundle_tournament_numeroEquipos, #backendbundle_tournament_tournamentType', function(event){
                if($('[data-button-action="groups"]:enabled,[data-button-action="combined"]:enabled').length) {
                    $('[data-dinamyc-team-groups]').clearOptions();
                    $('#modal-tournament-modality').trigger('show.bs.modal');
                }
            })
            .on('click', '.btn-step', function(event){
                event.preventDefault();
                var $el = $(this),
                    attrs = {action: $el.attr('href'), method:'post', class:'hide'}
                ;
                if (confirm("¿Estas seguro que terminaste con la base del torneo?")) {
                    $('<form/>', attrs).appendTo(document.body).submit();
                }
            })
        ;
        $('#backendbundle_tournament_numeroEquipos').change();
    });
})(jQuery);
