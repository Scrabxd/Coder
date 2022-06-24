var tabla;

function init(){
    mostrarform(false);
    listar();
}

function limpiar()
{
    $("#idcategoria").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
}

function mostrarform(flag)
{
    limpiar();
    if (flag)
    {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnguardar").prop("disabled",false);
    }
    else
    {
        $("#listadoregistros").show();
        $("#formularioregistros").hide(); 
    }

}

function cancelarform()
{
    limpiar();
    mostrarform(false);
}

function listar()
{
    tabla = $('#tbllistado').dataTable(
    {
        "aProcessing": true,
        "sServerSide": true,
        dom:    'Bfrtip',

        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax":
            {
                url: '../ajax/categoria.php?op=listar',
                type : "get",
                dataType: "json",
                error: function(e){
                    console.log(e.responseText);
                }
            },
        "bDestroy":true,
        "iDisplayLength": 5,
        "order": [[0, "desc"]]
    }).DataTable();
}


init()