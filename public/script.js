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

$ ( function () {
    $('#example').DataTable();
})