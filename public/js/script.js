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

  $(".demo").slick({
    arrows: true,
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    slidesToShow: 3,
    centerMode: true,
    centerPadding: "",
    draggable: true,

    // appendDots: $("#dots"),

    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          arrows: false,

          // centerMode: true,
          // infinite: true,
        },
      },
    ],
  });

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

    // let page = $(this).attr("href").split("page=")[1];
    let pageHref = $(this).attr("href");
    let selectedValues = $("#model").val();

    $.ajax({
      // url: "/search?page=" + page,
      type: "GET",
      url: pageHref,
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
      type: "GET",
      url: "/search",
      // url: "/search",
      data: {
        keyword: keyword,
        modelsIds: selectedValues,
        priceMin: priceMin,
        priceMax: priceMax,
        yearMin: yearMin,
        yearMax: yearMax,
        sort: sort,
      },
      success: function (data) {
        // let url = this.url;
        // let newUrl = url.slice(1);

        // window.history.replaceState(null, null, newUrl);

        $(".loader").show();
        setTimeout(function () {
          // mySelectModels.disable();
          $("#vehiclesTable").html("");
          $("#vehiclesTable").html(data);

          $("#vehicles_sort").val(sort);
          scrollToVehicles();
          mySelectBrands.setValue(brandId);
          $(".loader").hide();
        }, 1000);
      },
    });
  }

  // autocomplete
  $(document).on("keyup", "#keyword", function (e) {
    e.preventDefault();
    // keyword = $("#keyword").val();
    $("#keyword").autocomplete({
      source: function (request, response) {
        $.ajax({
          url: "/api/",
          type: "GET",
          dataType: "json",
          data: {
            keyword: request.term,
          },
          success: function (data) {
            // console.log(data);
            var resp = $.map(data.vehicles.data, function (obj) {
              // return obj.modelName + obj.brandName;
              // autocomplete(obj);
              return obj.modelName;
            });
            response(resp);
          },
        });
      },
      select: function (event, ui) {
        // console.log(ui.item.modelName);
        $("#keyword").val(ui.item.modelName);
        return true;
      },
    });
  });
});
