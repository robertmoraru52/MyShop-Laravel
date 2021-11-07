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
                if(Object.keys(data).length == 0){
                    $("#s_paragraph").html('<p class="dropdown-item">No Product Found</p>'); 
                }
                else{
                    let output = data;
                    let html = '';
                    $.each(output,function(key,value){
                            html += '<li class="dropdown-item">' + value.name + '</li>'
                    })
                    $("#s_paragraph ul").html(html);
                }
                
            }  
        });
    });
    $(document).on('click', '#s_paragraph li', function(){
                    $("#search_cat_navbar").val($(this).text())
                    $("#s_paragraph").fadeOut();
    });
});

//Search Admin User
$(document).ready(function(){
    $('#search_user').keyup(function(){
        $this = $(this).val();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') }
        });
        jQuery.ajax({
            url: "autocomplete-user-admin",
            type: 'post',
            data:{
                'search':$this
            },
            success:function(data){
                let output = data;
                let html = '';
                $.each(output,function(key,value){
                        html += '<li class="dropdown-item">' + value.email + '</li>'
                })
                $("#s_paragraph_user ul").html(html);
            }  
        });
    });
    $(document).on('click', '#s_paragraph_user li', function(){
                    $("#search_user").val($(this).text())
                    $("#s_paragraph_user").fadeOut();
    });
});

//Search Admin Category
$(document).ready(function(){
    $('#search_category').keyup(function(){
        $this = $(this).val();
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') }
        });
        jQuery.ajax({
            url: "autocomplete-category-admin",
            type: 'post',
            data:{
                'search':$this
            },
            success:function(data){
                let output = data;
                let html = '';
                $.each(output,function(key,value){
                        html += '<li class="dropdown-item">' + value.name + '</li>'
                })
                $("#s_paragraph_category ul").html(html);
            }  
        });
    });
    $(document).on('click', '#s_paragraph_category li', function(){
                    $("#search_category").val($(this).text())
                    $("#s_paragraph_category").fadeOut();
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

//Hidden Form
function showForm() {
    if(document.getElementById('hidden-form').style.display == 'block'){
        document.getElementById('hidden-form').style.display = 'none';
    }
    else if(document.getElementById('hidden-form').style.display == 'none'){
        document.getElementById('hidden-form').style.display = 'block'
    }
}

//Change Category from Product Table
function getComboA(sel) {
    let idCat = sel.options[sel.selectedIndex].dataset.indexNumber;
    let idProd = sel.options[sel.selectedIndex].value;
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') }
    });
    jQuery.ajax({
        url: "change-category-admin",
        type: 'post',
        data:{
            'idCat':idCat,
            'prodId':idProd,
        },
        success:setTimeout(location.reload.bind(location), 100)
    });
}
