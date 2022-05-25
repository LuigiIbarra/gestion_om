$(document).ready(function() {

    var numFilas = [ 5, 10, 15, 20, 25, 50, -1 ];
    var filas    = [ '5 filas','10 filas','15 filas','20 filas','25 filas','50 filas','Todas' ];
    var botones  = ['pageLength','copy', 'excel', 'pdf', 'print'];
    var idioma   = "/js/Spanish.json";

    $('#MyTable').DataTable( {
        language: {
             //"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             "url": idioma
             },
        responsive: "true",
        //dom: 'Bfrtip',
        lengthMenu: [
        numFilas,
        filas
       ],
        buttons: botones
    } );

    $('#MyTableAcuerdos').DataTable( {
        language: {
             //"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             "url": idioma
             },
        responsive: "true",
        //dom: 'Bfrtip',
        lengthMenu: [
        numFilas,
        filas
       ],
        buttons: botones
    } );

    $('#MyTableDocumentos').DataTable( {
        language: {
             //"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             "url": idioma
             },
        responsive: "true",
        //dom: 'Bfrtip',
        lengthMenu: [
        numFilas,
        filas
       ],
        buttons: botones
    } );

    $('#MyTableSellos').DataTable( {
        language: {
             //"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             "url": idioma
             },
        responsive: "true",
        //dom: 'Bfrtip',
        lengthMenu: [
        numFilas,
        filas
       ],
        buttons: botones
    } );

    $('#MyTableLibros').DataTable( {
        language: {
             //"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             "url": idioma
             },
        responsive: "true",
        //dom: 'Bfrtip',
        lengthMenu: [
        numFilas,
        filas
       ],
        buttons: botones
    } );

    $('#MyTableGarantias').DataTable( {
        language: {
             //"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             "url": idioma
             },
        responsive: "true",
        //dom: 'Bfrtip',
        lengthMenu: [
        numFilas,
        filas
       ],
        buttons: botones
    } );

    $('#MyTableGestores').DataTable( {
        language: {
             //"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             "url": idioma
             },
        responsive: "true",
        //dom: 'Bfrtip',
        lengthMenu: [
        numFilas,
        filas
       ],
        buttons: botones
    } );

    $('#MyTableExamenes').DataTable( {
        language: {
             //"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
             "url": idioma
             },
        responsive: "true",
        //dom: 'Bfrtip',
        lengthMenu: [
        numFilas,
        filas
       ],
        buttons: botones
    } );
} );
