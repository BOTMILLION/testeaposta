/* DATATABLE */
if($("#dataTable").length){ 
    $('#dataTable').DataTable( {
        responsive: true,
        "order": [],
        language: { 
            sSearch: "",
            sSearchPlaceholder: "Buscar",
            sLengthMenu: "_MENU_",
            sInfo: "Exibindo _END_ de _MAX_ resultados",
            sInfoEmpty: "",
            sInfoFiltered:"",
            sEmptyTable: "Nenhum registro encontrado",
            sZeroRecords: "Nenhum registro encontrado",
            paginate: {
                next: '<i class="fas fa-arrow-right"></i>', 
                previous: '<i class="fas fa-arrow-left"></i>'
            }
        },
        
    }); 
}
/* DATATABLE AJAX */
Object.assign(DataTable.defaults, {
    language: { 
        sSearch: "",
        sSearchPlaceholder: "Buscar",
        sLengthMenu: "_MENU_",
        sInfo: "Exibindo _END_ de _MAX_ resultados",
        sInfoEmpty: "",
        sInfoFiltered:"",
        sEmptyTable: "Nenhum registro encontrado",
        sZeroRecords: "Nenhum registro encontrado",
        loadingRecords: "&nbsp;",
        processing: "&nbsp;",
        paginate: {
            next: '<i class="fas fa-arrow-right"></i>', 
            previous: '<i class="fas fa-arrow-left"></i>'
        }
    },
    iDisplayLength: 25,
    processing: true,
    async: true,
    cache: false,
    contentType: 'application/json',            
});