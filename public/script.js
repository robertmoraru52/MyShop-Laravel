// $(document).ready(function(){
//     $("#search_cat_navbar").keyup(function(){
//         var nameCat = $(this).val();
//         $.post("{{ route('autocomplete') }}", {
//             suggestion: nameCat
//         }, function(data){
//             $("#s_paragraph").fadeIn();
//             $("#s_paragraph").html(data);
//         });
//         $(document).on('click', 'li', function(){
//             $("#search_cat_navbar").val($(this).text())
//             $("#s_paragraph").fadeOut();
//         });
//     });
    
// });
