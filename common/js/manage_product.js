 
//Add Multiple Images Of Product
$(document).on("click", ".addimgmulti", function () {
  $("#modal-add-multiple-img").modal("show");
  var p_id = $(this).data("productviewid");
  var obj = { p_id: p_id };
  var myJson = JSON.stringify(obj);
  $.ajax({
    url: "/new/oba/admin/apis/select/fetch_single_product.php",
    type: "POST",
    data: myJson,
    dataType: "json",
    success: function (data) {
      //console.log(data);
      $("#product-id").val(data[0].id);
    }

  });


});

$('#multi-image-form').on('submit', function (e) {
  $("#loader-multi-img").show();
  toastr.options = {
    "positionClass": "toast-top-right",
    "preventDuplicates": true
  };
  $.ajax({
    type: 'POST',
    url: '/new/oba/admin/apis/add/add_multiple_images.php',
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {
      $("#loader-multi-img").hide();

      if (response.status == 1) {
        $("#multi-image-form").trigger("reset");
        $('#modal-add-multiple-img').modal('hide');
        //location.reload();
        toastr.success('Images Added Succesfully');
        //   toastr .delay(1000)
        toastr.fadeOut(1000);

      }

    },
    error: function (error) {
      toastr.error('Something went wrong.');
    }
  })
  e.preventDefault();
});

loadTableProduct();
//Add Multiple Images Of Product


//Fetch All Records
function loadTableProduct() {
  /*
  $("#load-table-product").html("");
  $.ajax({
    url: "/new/oba/admin/apis/select/get_product.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var html = '';
      console.log(data);
      $.each(data, function (key, value) {
        imgurl = value.default_image_url;
        var available = 'checked';
        if (!value.available) {
          available = 'unchecked';
        }
        html = html + ("<tr>" +
          "<td>" + value.name + "</td>" +
          "<td>" + value.low_price + "</td>" +
          "<td>" + value.max_price + "</td>" +
          "<td>" + value.unit_name + "</td>" +
          "<td><img src='/new/oba/uploads/" + imgurl + "' width='90px' height='60px'></td>" +
          "<td><a href='./view_product.php?id=" + value.id + "' class='View-product' data-productviewid='" + value.id + "'><i class='fas fa-eye'></i></a>  &nbsp; &nbsp;<a href='./edit_product.php?id=" + value.id + "' class='edit-product' data-productviewid='" + value.id + "'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='#' class='remove-product'  data-productviewid='" + value.id + "'><i class='fa fa-trash' aria-hidden='true'></i></a></td>" +
          "<td><a href='#' class='addimgmulti' data-productviewid='" + value.id + "'><i class='fas fa-image'></i></a>&nbsp; &nbsp; &nbsp; &nbsp;<a href='#' class='View-im' data-firmviewid='" + value.id + "'><i class='fas fa-eye'></i></a> " +
          "<td><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='checkbox' class='custom-control-input' " + available + " id='customSwitch3'><label class='custom-control-label' for='customSwitch3'></label></div></td></tr>");
      });
      $("#load-table-product").html(html);
    }
  });
  */
}
//loadTableProduct();
//Data Table Script
$(function () {
  $("#example1").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'ajax': {
      'url': '/new/oba/admin/apis/select/get_product.php'
    },
    'columns': [
      { data: 'name' },
      { data: 'category' },
      { data: 'low_price' },
      { data: 'max_price' },
      { data: 'unit' },
      {
        data: 'default_image_url',
        render: function (data, type, row, meta) {
          return type === 'display' ?
            "<img src='/new/oba/uploads/" + data + "' width='30px' height='30px'>"
            : data;
        }
      },
      {
        data: 'available',
        render: function (data, type, row, meta) {
          if (data == 1) {
            return "<div class='custom-control custom-checkbox'><input type='checkbox' onclick='updateAvailability(this," + row.id + ")' checked class='custom-control-input custom-control-input-danger' id='checkbox_" + row.id + "'><label for='checkbox_" + row.id + "' class='custom-control-label'></label></div>";
          } else {
            return "<div class='custom-control custom-checkbox'><input type='checkbox' onclick='updateAvailability(this," + row.id + ")' class='custom-control-input custom-control-input-danger' id='checkbox_" + row.id + "'><label for='checkbox_" + row.id + "' class='custom-control-label'></label></div>";
          }

        }
      },
      {
        data: 'id',
        render: function (data, type, row, meta) {
          return type === 'display' ?
            "<a href='./view_product.php?id=" + data + "' class='View-product' data-productviewid='" + data + "'><i class='fas fa-eye'></i></a> &nbsp; &nbsp; &nbsp;<a href='./edit_product.php?id=" + data + "' class='edit-product' data-productviewid='" + data + "'><i class='fas fa-edit'></i></a>&nbsp; &nbsp; &nbsp;<a href='#' class='remove-product'  data-productviewid='" + data + "'><i class='fa fa-trash' aria-hidden='true' style='color:red;'></i></a>&nbsp;&nbsp;&nbsp; <a href='#' class='addimgmulti' data-productviewid='" + data + "'><i class='fas fa-camera'></i></a>&nbsp; &nbsp; &nbsp; &nbsp;<a href='remove_multiimg_product.php?id=" + data + "' class='multi-view-img' data-productid='" + data + "'><i class='fas fa-images'></i></a> "
            : data;
        }

      }
    ]
  });
  //}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});
//Fetch Single Record For Remove Product
$(document).on("click", ".remove-product", function () {
  $('#modal-product-remove').modal('show');
  var p_id = $(this).data("productviewid");
  var obj = { p_id: p_id };
  var myJson = JSON.stringify(obj);
  $.ajax({
    url: "/new/oba/admin/apis/select/fetch_single_product.php",
    type: "POST",
    data: myJson,
    dataType: "json",
    success: function (data) {
      //console.log(data);
      $("#removeid").val(data[0].id);
      $("#hidden-p-img-remove").val(data[0].default_image_url);

    }
  });

});
//Delete Product 
$('#remove-product-form').on('submit', function (e) {
  $("#loader-remove-product").show();
  toastr.options = {
    "positionClass": "toast-top-right",
    "preventDuplicates": true
  };
  e.preventDefault();
  $.ajax({
    type: 'POST',
    url: '/new/oba/admin/apis/delete/delete_product.php',
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData: false,
    success: function (response) {
      $("#loader-remove-product").hide();
      $('#remove-product-form')[0].reset();
      $('#modal-product-remove').modal('hide');
      if (response > 0) {

        toastr.success('Product Deleted Succesfully');


      } else {
        toastr.danger('Product Deleted Failed');
      }
      toastr.delay(1000)
      toastr.fadeOut(1000);
    },
    error: function (error) {
      $('#modal-product-remove').modal('hide');
      toastr.error('Can not delete this item');
      //toastr .delay(1000)
      toastr.fadeOut(1000);
      location.reload();

    }
  })
  //Delete Product

});




$('#imageInput').on('change', function (e) {
  var files = e.target.files;

  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    var reader = new FileReader();

    reader.onload = function (e) {
      var image = $('<div class="image-container"><img src="' + e.target.result + '"><span class="remove-image">Remove</span></div>');

      // Add a click event to the "Remove" button
      image.find('.remove-image').click(function () {
        $(this).parent().remove(); // Remove the image container
      });

      $('#imagePreview').append(image);
    }

    reader.readAsDataURL(file);
  }
});


function updateAvailability(self, id) {
  $("#loader-remove-product").show();
  toastr.options = {
    "positionClass": "toast-top-right",
    "preventDuplicates": true
  };
  var available = 0;
  if (self.checked) {
    available = 1;
  }
  $.ajax({
    type: 'POST',
    url: '/new/oba/admin/apis/update/update_availability.php',
    data: {
      id: id,
      availability: available
    },
    success: function (response) {
      debugger;
      $("#loader-remove-product").hide();
      $('#remove-product-form')[0].reset();
      $('#modal-product-remove').modal('hide');
      if (response.status == "201") {
        toastr.success(response.message);
      } else {
        toastr.danger(response.message);
      }
      toastr.delay(1000)
      toastr.fadeOut(1000);
    },
    error: function (error) {
      $('#modal-product-remove').modal('hide');
      toastr.error('Some error occur.');
      toastr.fadeOut(1000);

    }
  })

}