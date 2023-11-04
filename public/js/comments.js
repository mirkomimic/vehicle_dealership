$(document).ready(function () {
  hideCollapseBtns();
});

function hideCollapseBtns() {
  commentWithReplies = $(".commentWithReplies");

  commentWithRepliesChildren = commentWithReplies.children(
    ".commentWithReplies"
  );

  $(".commentWithReplies").each(function (index, value) {
    if ($(this).children(".commentWithReplies").length == 0) {
      $(this).find(".collapseCommentBtn").first().addClass("d-none");
    }
  });
}

// open reply form
$(document).on("click", ".replyBtn", function (e) {
  // $(".replyBtn").click(function (event) {
  e.preventDefault();

  $("#commentId").val($(this).attr("data-Commentid"));

  // $(this).parent().parent().siblings().toggle("d-none");

  if ($(this).text() == "Close") {
    $(this).text("Reply");
  } else {
    $(this).text("Close");
  }

  $(".replyBtn").not(this).toggle("d-none");
  // $(".replyBtn").not(this).slideToggle();
  $(".replyDiv").insertAfter($(this).siblings(".collapseCommentBtn").first());
  $(".replyDiv").toggle("d-none");
  // $(".replyDiv").slideToggle("d-none");
});

$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
});

// comment
$(document).on("click", "#add_comment_btn", function (e) {
  e.preventDefault();
  // alert('ovde');
  let vehicleId = $("#vehicleId").val();
  let commentBody = $("#commentBody").val();
  if (commentBody == "") {
    alert("empty comment");
    return;
  } else {
    if (!confirm("Are you sure you want to post a comment")) return;
  }
  $.ajax({
    type: "POST",
    url: "/vehicle/" + vehicleId + "/comment",
    data: {
      comment: commentBody,
    },
    success: function (data) {
      // console.log(data);
      // $("#comments_section").html("");
      $("#comments_section").html(data);
      $("#commentBody").val("");
      hideCollapseBtns();
    },
  });
});

// reply
$(document).on("click", "#submitReply", function (e) {
  e.preventDefault();

  let commentId = $("#commentId").val();
  let reply = $("#reply").val();

  $.ajax({
    type: "POST",
    url: "/reply",
    data: {
      commentId: commentId,
      reply: reply,
    },
    success: function (data) {
      $("#comments_section").html(data);
      hideCollapseBtns();
    },
  });
});

// sort comments
$(document).on("change", "#comments_sort", function (e) {
  e.preventDefault();
  let selectedValue = $("#comments_sort").find(":selected").val();
  let vehicleId = $("#vehicleId").val();

  if (selectedValue == "") {
    return;
  }

  $.ajax({
    url: "/comments/search",
    type: "POST",
    data: {
      selectedValue: selectedValue,
      vehicleId: vehicleId,
    },
    success: function (data) {
      $("#comments_section").html(data);
      hideCollapseBtns();
    },
  });
});

// collapse comments
$(document).on("click", ".collapseCommentBtn", function (e) {
  e.preventDefault();
  let parent = $(this).parent().parent();
  if (parent.children(".commentWithReplies").length > 0) {
    // console.log("ovde");
    // parent.children(".commentWithReplies").toggle("d-none");
    parent.children(".commentWithReplies").slideToggle(1);

    if ($(this).text() == "Collapse") {
      $(this).text("Expand");
    } else {
      $(this).text("Collapse");
    }
  }
});
