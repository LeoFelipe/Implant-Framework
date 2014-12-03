$(document).ready(function(){
    
    $("#dinamicTable").dataTable({
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "public/libs/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": [ 
                {
                    "sExtends": "pdf",
                    "sTitle": "Grupos"
                },
                {
                    "sExtends": "xls",
                    "sTitle": "Grupos"
                }
            ]
        }
    });
    
});