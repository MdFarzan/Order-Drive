$(document).ready(function(){
    $('#sort-table').DataTable();



// function for slugify category slug from category name
$('#category-name').keyup(function(event){
    var cat_name = event.target.value;  
    cat_slug = cat_name.toLowerCase()
    .trim()
    .replace(/[^\w\s-]/g, '')
    .replace(/[\s_-]+/g, '-')
    .replace(/^-+|-+$/g, '');

    $('#category-slug').val(cat_slug);

});

// function for search product category
    $('#parent-category').select2();


});

