//Search Navbar
$(document).ready(function(){
    $('#search_cat_navbar').keyup(function(){
        $this = $(this).val();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') }
        });
        jQuery.ajax({
            url: "autocomplete",
            type: 'post',
            data:{
                'suggestion':$this
            },
            success:function(data){
                for (let i = 0; i < Object.keys(data).length; i++) {
                    $("#s_paragraph").html('<ul class="list-unstyled"><li class="dropdown-item">'+data[i]['name']+'</li></ul>');
                }
            }
        });
    });
    $(document).on('click', '#s_paragraph', function(){
                    $("#search_cat_navbar").val($(this).text())
                    $("#s_paragraph").fadeOut();
    });
});

//Rating JS
$('.modal-review__rating-order-wrap > span').click(function() {
    $(this).addClass('active').siblings().removeClass('active');
    $(this).parent().attr('data-rating-value', $(this).data('rating-value'));
    let rating = $(this).data('rating-value');
    var val = this.getAttribute('data-value');
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') }
    });
    $.post("rating",{
        star: rating,
        id: val
    });
});