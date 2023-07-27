$(document).ready(function () {
  let mySelectBrands = new vanillaSelectBox("#brand", {
    maxWidth: 500,
    minWidth: 300,
    search: true,
    placeHolder: "Select Brand",
    // maxOptionWidth: 300,
    // minOptionWidth: 300,
  });
  let mySelectModels = new vanillaSelectBox("#model", {
    maxWidth: 300,
    minWidth: 300,
    itemsSeparator: " | ",
    search: true,
    placeHolder: "Select Model",
    maxOptionWidth: 240,
    // maxSelect: 3,
    // disableSelectAll: false,
  });
  mySelectModels.disable();
  $(".loader").hide();

  $(document).on("change", "#brand", function () {
    let brandId = $("#brand").find(":selected").val();
    $("#model").html("");
    $.ajax({
      type: "GET",
      url: "api/brand/" + brandId + "/all_models",
      success: function (data) {
        var array = data.brandModels;

        for (model of array) {
          var html = `<option value="${model.id}">${model.name}</option>`;
          $("#model").append(html);
        }
        let mySelectModels = new vanillaSelectBox("#model", {
          maxWidth: 300,
          minWidth: 300,
          maxHeight: 200,
          itemsSeparator: " | ",
          search: true,
          placeHolder: "Select Model",
          maxOptionWidth: 240,
        });
      },
    });
  });

  // add vehicle button
  $(document).on("click", "#add_vehicle_btn", function (e) {
    e.preventDefault();
    alert("Are You Sure?");
    let selectedModel = $("#model").val();
    let price = $("#price").val();
    let year = $("#year").val();
    let mileage = $("#mileage").val();
    if (selectedModel.length === 0) {
      return;
    }

    $.ajax({
      type: "POST",
      url: "api/add_vehicle",
      data: {
        model_id: selectedModel,
        price: price,
        year: year,
        mileage: mileage,
      },
      success: function (data) {
        if (data.msg == "success") {
          $(".loader").show();
          setTimeout(function () {
            $("#alert").removeClass("d-none");
            $("#alert #alertMsg").text("Vehicle Added");
            $(".loader").hide();
            $("#add_vehicle_form")[0].reset();
            mySelectModels.empty();
            mySelectBrands.empty();
            // mySelectModels.disable();
          }, 1000);
        }
        $("#alert").delay(5000).fadeOut(800);
      },
    });
  });
});
