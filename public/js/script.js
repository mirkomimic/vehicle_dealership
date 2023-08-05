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
  // mySelectModels2.disable();

  // on change select
  $(document).on("change", "#brand", function () {
    var pathname = window.location.pathname;
    let brandId = $("#brand").find(":selected").val();
    $("#model").html("");
    $.ajax({
      type: "GET",
      url: "api/brand/" + brandId + "/models",
      success: function (data) {
        var array = data.brandModels;
        for (model of array) {
          var html = `<option value="${model.id}">${model.name} (${model.vehicles_count})</option>`;

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

  // filter button
  $(document).on("click", "#filterBtn", function (e) {
    e.preventDefault();
    getVehicles();
  });

  // sort vehicles
  $(document).on("change", "#vehicles_sort", function (e) {
    e.preventDefault();
    getVehicles();
  });

  // pagination
  $(document).on("click", ".pagination a", function (e) {
    e.preventDefault();

    let page = $(this).attr("href").split("page=")[1];
    let selectedValues = $("#model").val();

    $.ajax({
      url: "/search?page=" + page,
      data: {
        modelsIds: selectedValues,
      },
      success: function (data) {
        $("#vehiclesTable").html("");
        $("#vehiclesTable").html(data);
        scrollToVehicles();
      },
    });
  });

  function scrollToVehicles() {
    $("html, body").animate(
      {
        scrollTop: $("#vehicles_section").offset().top,
      },
      500
    );
  }

  function getVehicles() {
    let brandId = $("#brand").find(":selected").val();
    let selectedValues = $("#model").val();
    let keyword = $("#keyword").val();
    let priceMin = $("#priceMin").val();
    let priceMax = $("#priceMax").val();
    let yearMin = $("#yearMin").val();
    let yearMax = $("#yearMax").val();
    let sort = $("#vehicles_sort").find(":selected").val();

    $.ajax({
      url: "/search",
      data: {
        modelsIds: selectedValues,
        keyword: keyword,
        priceMin: priceMin,
        priceMax: priceMax,
        yearMin: yearMin,
        yearMax: yearMax,
        sort: sort,
      },
      success: function (data) {
        $("#vehiclesTable").html("");
        $("#vehiclesTable").html(data);

        $("#vehicles_sort").val(sort);
        scrollToVehicles();
        mySelectBrands.setValue(brandId);
      },
    });
  }

  // on change select for add_vehicle page
  // $(document).on("change", "#brand2", function () {
  //   let brandId = $("#brand2").find(":selected").val();
  //   $("#model2").html("");
  //   $.ajax({
  //     type: "GET",
  //     url: "api/brand/" + brandId + "/models",
  //     success: function (data) {
  //       var array = data.brandModels;
  //       for (model of array) {
  //         var html = `<option value="${model.id}">${model.name}</option>`;
  //         $("#model2").append(html);
  //       }
  //     },
  //   });
  // });
});
