$(document).ready(function() {
    
    listener();

	/*$('#inputQtd').focusout(function() {
		vItem = $('#item').val();
		vData = $('#data').val();
		vQtd = $(this).val();
		vTipo = $('.type').val();
    	$.post('verify.php', {
    		item: vItem,
    		data: vData,
    		qtd: vQtd
    	}, function(data) {
    		if( !data.retorno ) {
                var icon = '<i class="icon idea"></i>';
                if( data.tipo == 'lista' ) {
                    var retorno = 'Este item ja tem na lista e normalmente não passa de '+data.med+vTipo+'.<br>Que tal levar '+data.recomendado+'?';
                } else if( data.tipo == 'item' ) {
                    var retorno = 'Você não esta selecionando muitos(as) '+vTipo+' de '+vItem+'?<br>Normalmente é comprado '+data.med+vTipo+' de '+vItem+' por Lista.';
                }
                $('#notificationMessage').html(icon+retorno).removeClass('hidden');
    		} else $('#notificationMessage').addClass('hidden');
    	},'json');
	});*/
});

var listener = function() {
    $('.ui .dropdown').dropdown({
        useLabels: true,
        onChange: function(value, text, $selectedItem) {
            var item = $selectedItem[0];
            $("#componentQtd").removeClass('disabled');
            $(".inputQtd").prop('disabled', false);
            $('#labelQtd .label').html(item.id);
            $('#labelQtd .type').val(item.id);
            $('#inputQtd').prop('min', $(item).data('min')).val($(item).data('min'));
            $('#inputQtd').focus();
            $('#notificationMessage').addClass('hidden');
        }
    });

    $('[data-ordener]').on('click', function() {
        var type = $(this).data('type');
        var order = $(this).data('order');

        var search = removeParamSearch();
        window.location.search = search + '&type='+type+'&order='+order;
    });
};

var removeParamSearch = function() {
    var search = window.location.search;

    if (search.indexOf('&order') !== -1) {
        search = search.slice(0, search.indexOf('&order'));
    }
    if (search.indexOf('&type') !== -1) {
        search = search.slice(0, search.indexOf('&type'));
    }

    return search;
};