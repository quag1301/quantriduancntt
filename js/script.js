

var productSearchInput = document.getElementById("product-search")
var orderSearchInput = document.getElementById("order-search")
try {
  productSearchInput.onkeyup = function(){

    var txtValue, filter, table, input, tr;
    input = productSearchInput.value;
    filter = input.toUpperCase();
    table = document.getElementsByClassName("table")[0];
    tr = table.getElementsByTagName("tr");
    
    
    // Loop through all table rows, and hide those who don't match the search query
    for (var i = 0; i < tr.length; i++) {
      var td = tr[i].getElementsByTagName("td")[1];
      
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
      }
    }
  };
}
catch (err){
  orderSearchInput.onkeyup = function(){

    var txtValue, filter, table, input, tr;
    input = orderSearchInput.value;
    filter = input.toUpperCase();
    table = document.getElementsByClassName("table")[0];
    tr = table.getElementsByTagName("tr");
    
    
    // Loop through all table rows, and hide those who don't match the search query
    for (var i = 0; i < tr.length; i++) {
      var td;
      if (isNaN(parseInt(input.value))){
        td = tr[i].getElementsByTagName("td")[2];
      }

     
      
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
      }
    }
  };
}

