//Hidden Form
function showForm() {
    if(document.getElementById('hidden-form').style.display == 'block'){
        document.getElementById('hidden-form').style.display = 'none';
    }
    else if(document.getElementById('hidden-form').style.display == 'none'){
        document.getElementById('hidden-form').style.display = 'block'
    }
}
//Bootstrtap select
$(function () {
    $('select').selectpicker('render');
});
//Data Table
// $(document).ready(function() {
//     $('#example').DataTable( {
//         select: true
//     } );
// } );
$ ( function () {
    $('#example').DataTable();
})