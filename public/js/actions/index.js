$(document).ready(function(){
    
    $("#dinamicTable").dataTable({
        "sDom": 'T<"clear">lfrtip',
        "oTableTools": {
            "sSwfPath": "public/libs/datatables/js/media/swf/copy_csv_xls_pdf.swf",
            "aButtons": [ 
                {
                    "sExtends": "pdf",
                    "sTitle": "Actions"
                },
                {
                    "sExtends": "xls",
                    "sTitle": "Actions"
                }
            ]
        }
    });
    
});