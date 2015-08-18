$(document).ready(function() {
	$('.ui .dropdown').dropdown({
		useLabels: true,
	    onChange: function(value, text, $selectedItem) {
	    	$("#componentQtd").removeClass('disabled');
	    	$(".inputQtd").prop('disabled',false);
	    	$('#labelQtd .label').html($selectedItem[0].id);
	    	$('#labelQtd .type').val($selectedItem[0].id);
	    	$('#inputQtd').focus().val('');
	    }
	});

	$('#inputQtd').focusout(function() {
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
    			if( data.tipo == 'lista' ) {
    				alert('A média de '+vItem+' é de '+data.med+vTipo+', e na lista já possui '+data.qtd+vTipo);
    			} else if( data.tipo == 'item' ) {
    				alert('A média de '+vItem+' é de '+data.med+vTipo+', e na lista já possui '+data.qtd+vTipo);

    			console.log(data);
    			}
    		}
    		// if(data == 'lista') {
    		// 	alert('média de produtos verificado com a lista ja ultrapassou');
    		// } else if( data=='qtd' ) {
    		// 	alert('média de produtos do histórico ja ultrapassou');
    		// }

    	},'json');
	});


});