$(document).ready(function(){
    
    $("#chkVisibleAll").on('click', function(){
        if ($("#chkVisibleAll").is(":checked"))
            $('.chkVisible').prop('checked', 'checked');   
        else
            $('.chkVisible').prop('checked', '');
    });
    
//    function tableHasRow(nameTable, qtdeColspan, msg)
//    {
//        var qtdRow = $(nameTable+' tr').length - 1;
//        //alert(qtdRow);
//        if(qtdRow == 0){
//            var row = "";
//            row += '<tr>';
//            row += '<td class="redColor" colspan="'+qtdeColspan+'"><b>'+msg+'</b></td>';
//            row += '</tr>';
//            $(nameTable).append(row);
//        }
//    }
    
    function removeRow(row)
    {
        row.remove();
    }
    
    function addRowOnFixedTable(dados)
    {
        var row = '';
        row += '<tr>';
        row += '<td align="center"><input type="checkbox" class="chkVisible" name="chkVisible['+dados[0]+']" value="1" /></td>';
        row += '<td align="center">';
        row += '<input type="hidden" name="idAction['+dados[0]+']" value="'+dados[0]+'" />';
        row += dados[0];
        row += '</td>';
        row += '<td>'+dados[1]+'</td>';
        row += '<td align="center">';
        row += '<a class="btn btn-sm2 btn-danger removeRow" title="Remover esta Action" href="#">';
        row += '<i class="glyphicon glyphicon-hand-up"></i>';
        row += '</a>';
        row += '</td>';
        row += '</tr>';
        
        $("#fixedTable").append(row);
        removeRow($('#fixedTable .redColor'));
        //tableHasRow('#dinamicTable', 3, 'Todas as Actions foram selecionadas');
    }
    
    function addRowOnDinamicTable(dados)
    {
        var row = '';
        var posicaoInicio = dados[0].indexOf('>')+1;
        dados[0] = dados[0].slice(posicaoInicio);
        
        row += '<tr>';
        row += '<td align="center">';
        row += '<a class="btn btn-sm2 btn-success selectRow" title="Selecionar esta Action" href="#">';
        row += '<i class="glyphicon glyphicon-hand-down"></i>';
        row += '</a>';
        row += '</td>';
        row += '<td align="center">'+dados[0]+'</td>';
        row += '<td>'+dados[1]+'</td>';
        row += '</tr>';
        
        $("#dinamicTable").append(row);
        removeRow($('#dinamicTable .redColor'));
        //tableHasRow('#fixedTable', 4, 'Selecione as Actions da tabela acima');
    }

    $('#dinamicTable').on('click','a.selectRow',function(){
        var dados = [];
        var _tr = $(this).parent().parent()[0];
        
        dados.push(_tr.cells[1].innerHTML,_tr.cells[2].innerHTML);
        removeRow($(this).parent().parent());
        addRowOnFixedTable(dados);
    });
  
    $('#fixedTable').on('click','a.removeRow',function(){
        var dados = [];
        var _tr = $(this).parent().parent()[0];
        
        dados.push(_tr.cells[1].innerHTML,_tr.cells[2].innerHTML);
        removeRow($(this).parent().parent());
        addRowOnDinamicTable(dados);
    });
  
    
    // VALIDATION
    $("#form").validate({
        rules: {
            nome: {
                required: true,
                minlength: 3
            },
            status: {
                required: true
            }
        }
    });
    
});