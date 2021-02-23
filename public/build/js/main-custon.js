function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {

  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
  saveDrag(ev);
}

function saveDrag(elemento){
	lote = new Array();
	lotes = $('#'+elemento.target.id +' img');

	piquete_id = elemento.target.getAttribute('data-piquete');

	lotes.map(function(k,e){

		lote.push(e.dataset.lote);
    });

	$.ajax({
	    type: "POST",
	    url: '/controle-altera-lote',
	    data: {
	    	lotes: lote,
	    	piquete_id: piquete_id,
	    	_token: $('meta[name="csrf-token"]').attr('content')
	    },
	    success: function (data) {
	       console.log('Alterado com sucesso');
	    },
	    error: function (data, textStatus, errorThrown) {
	        console.log('Erro na alteração');

	    },
    });

}
function salvaHistorico(){
    texto = $('#editor-one').text().trim();

    if($('#tipo_lancamento').val() == '') {
        alert('O Tipo de lançamento não foi informado');
        return false;
    }
    if($('#data').val() == '') {
        alert('A data não foi informada');
        return false;
    }
    if(texto == '') {
        alert('O texto não foi informado');
        return false;
    }
    $.ajax({
        type: "POST",
        url: '/salva-historico',
        data: {
            tipo_lancamento: $('#tipo_lancamento').val(),
            tipo_tela_id: $('#tipo_tela_id').val(),
            data:  $('#data').val(),
            id_referencia:  $('#id_referencia').val(),
            historico:  $('#editor-one').html(),
            tela:  $('#tabela').value,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            alert('Salvo com sucesso');
            $('#editor-one').html('');
            window.location.reload();
        },
        error: function (data, textStatus, errorThrown) {
            alert('Erro na inclução ' + data);
        },
    });
}
