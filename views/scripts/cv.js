var tablacv;

function init(){
    mostrarform2(false);
    listar2();
}

function limpiar2()
{
    $("#idjob").val("");
    $("#trabajo").val("");
    $("#descripcion").val("");
    $("#inicio").val("");
    $("#fin").val("");


}

function mostrarform2(flag)
{
    limpiar2();
    if (flag)
    {
        $("#listadoregistros2").hide();
        $("#formularioregistros2").show();
        $("#btnguardar2").prop("disabled",false);
    }
    else
    {
        $("#listadoregistros2").show();
        $("#formularioregistros2").hide(); 
    }

}

function cancelarform2()
{
    limpiar2();
    mostrarform2(false);
}

function listar2()
{
    tabla = $('#tbllistado2').dataTable(
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
                url: '../ajax/cv.php?op=listar2',
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
function mostrar2(idjob){
    $.post("../ajax/cv.php?op=mostrar2",{idjob : idjob}, function(data, status)
	{
        data = JSON.parse(data);
        mostrarform2(true);
		

        $("#trabajo").val(data.trabajo);
        $("#descripcion").val(data.descripcion);
        $("#inicio").val(data.inicio);
        $("#fin").val(data.fin);
        $("#idjob").val(data.idjob); 

})
}



init();