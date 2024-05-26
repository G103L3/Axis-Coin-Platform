const category_title = document.getElementById('username');


category_title.addEventListener('focusout', (event) => {
    document.getElementById("category_title").classList.remove("is-invalid");
    document.getElementById("used_title_category").style.display = "none";
    document.getElementById("required_title_category").style.display = "none";
});

function submit_category_title(){
  var category_title = $("#category_title").val();

  if(category_title == ""){
      document.getElementById("required_title_category").style.display = "block";
  }
  $.post(
    'scripts/add_category.php',   // url
       { category_title: category_title}, // data to be submit
       function(data) {// success callback
         if(data[0][0] == "success"){
           location.reload();
         }
         if(data[0][0] == "used_title"){
             document.getElementById("category_title").classList.add("is-invalid");
             document.getElementById("used_title_category").style.display = "block";
         }
        },
      'json')
}


var sub_category_icon = null;
function sub_icon_selected(field, icon){
    sub_category_icon = icon;

    document.getElementById("sub_category_icon_i_" + field).classList.remove("fa-dollar-sign", "fa-comments", "fa-file-alt", "fa-folder", "fa-exclamation-triangle", "fa-check");
    document.getElementById("sub_category_icon_i_" + field).classList.add(icon);
}


function submit_sub_category_title(field, categories_id){
    var sub_category_title = $("#sub_category_title_" + field).val();

    if(sub_category_icon == null){
        document.getElementById("required_icon_sub_category_" + field).style.display = "block";
    }
    if(sub_category_title == ""){
        document.getElementById("required_title_sub_category_" + field).style.display = "block";
    }
    $.post(
        'scripts/add_sub_category.php',   // url
        { icon: sub_category_icon, sub_category_title: sub_category_title, categories_id: categories_id}, // data to be submit
        function(data) {// success callback
            if(data[0][0] == "success"){
                location.reload();
            }
            if(data[0][0] == "used_title"){
                document.getElementById("sub_category_title_" + field).classList.add("is-invalid");
                document.getElementById("used_title_sub_category_" + field).style.display = "block";
            }
        },
        'json')
}

function nav_item_clicked(ID, title){
    location.href = "show_articles.php?ID=" + ID + "&title=" + title;
}
