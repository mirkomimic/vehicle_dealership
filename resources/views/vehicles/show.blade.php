@extends('layouts.app')

@section('content')

@section('styles')
  <link rel="stylesheet" href="../css/skitter.css">
  <link rel="stylesheet" href="../css/style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .bg-comment {
      background-color: gainsboro;
    }
    #comments_sort {
      width: 200px;
      height: 50px;
      border: 2px solid rgb(49 120 185);
      background: #95959566;
      border-radius: 15px;
    }
    .display-none {
      display: none;
    }
  </style>
@endsection

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10"> 
      <div class="card">
        <div class="card-header">{{ __('Vehicle') }}</div>
        <div class="card-body">
          {{-- galery --}}
          {{-- https://skitter-slider.net/options.html --}}

          <div class="mb-5 pb-5">
            <div class="skitter skitter-large skitter-themed skitter-clean mx-auto">
              <ul>
                @foreach ($vehicle->images as $image)
                  <li>
                    <a href="">
                      <img src="{{ asset('storage/images/'.$image->img) }}" class="fade" />
                    </a>
                  </li>                 
                @endforeach
              </ul>
            </div>

          </div>
          <div class="col-md-6 mb-5">
            {{-- vehicle info --}}
            <ul class="list-group">
              <li class="list-group-item"><span class="fw-bold" style="font-weight: bold">ID:</span> {{ $vehicle->id}}</li>
              <li class="list-group-item"><span class="fw-bold" style="font-weight: bold">Brand:</span> {{ $vehicle->brandName}}</li>
              <li class="list-group-item"><span class="fw-bold" style="font-weight: bold">Model:</span> {{ $vehicle->model }}</li>
              <li class="list-group-item"><span class="fw-bold" style="font-weight: bold">Price:</span> {{ number_format($vehicle->price, '2', ',', '.') }} &euro;</li>
              <li class="list-group-item"><span class="fw-bold" style="font-weight: bold">Mileage:</span> {{ $vehicle->mileage }}</li>
            </ul>
          </div>
          <hr>
          <h2>Comments</h2>
          {{-- add comment --}}
          <div class="row">
            <div class="col-12">
              <div id="new_comment">
                <div class="w-50 mb-2">
                  <textarea class="form-control" id="commentBody" cols="60" rows="5" placeholder="Enter your comment here..." form="add_comment_form" name="comment"></textarea>
                </div>
                <div>
                  <form action="" id="add_comment_form">
                    @csrf
                    <input type="hidden" name="vehicleId" value="{{ $vehicle->id }}" id="vehicleId">
                    <input type="submit" value="Comment" id="add_comment_btn" class="btn btn-primary">
                  </form>
                </div>
              </div>
            </div>
          </div>
          <hr>
          {{-- comments sort --}}
          <div class="my-3 ">
            <select name="comments_sort" id="comments_sort" class="d-block ms-auto ps-3">
              <option value="" selected disabled>Sort</option>
              <option value="desc">Newest</option>
              <option value="asc">Oldest</option>
            </select>
          </div>
          
          <div id="comments_section" class="ps-2">
            @include('comments.comments_section', ['comments'=> $comments])
          </div>


        </div>
      </div>     
    </div>
  </div>
</div>

@section('scripts')
  {{-- <script src="../js/jquery-2.1.1.min.js"></script> --}}
  <script src="../js/jquery.skitter.min.js"></script>
  <script src="../js/jquery.easing.1.3.js"></script>
  <script src="../js/comments.js"></script>
  <script src="../js/script.js"></script>
  <script>
    $(document).ready(function () {
      
      $(".skitter-large").skitter({
        thumbs: true,
        <!-- dots: true, -->
        navigation: true,
        interval: 5000000,
        enable_navigation_keys: true,
        focus: true
      });

    });

  </script>

  <script>
    // $.ajaxSetup({
    //   headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //   }
    // });   

    // // comment
    // $(document).on('click', '#add_comment_btn', function(e) {
    //   e.preventDefault();
    //   // alert('ovde');
    //   let vehicleId = $('#vehicleId').val();
    //   let commentBody = $('#commentBody').val();
    //   if (commentBody == "") {
    //     alert('empty comment');
    //     return;
    //   } else {
    //     if(!confirm('Are you sure you want to post a comment')) return;
    //   }
    //   $.ajax({
    //     type: "POST",
    //     url: "/vehicle/"+vehicleId+"/comment",
    //     data: {
    //       comment: commentBody,
    //     },
    //     success: function(data) {
    //       // console.log(data);
    //       $('#comments_section').html(data);
    //       $('#commentBody').val('');
    //     }
    //   })
    // });

    // // reply
    // $(document).on("click", "#submitReply", function (e) {
    //   e.preventDefault();
  
    //   let commentId = $("#commentId").val();
    //   let reply = $("#reply").val();
  
    //   $.ajax({
    //     type: "POST",
    //     url: "/reply",
    //     data: {
    //       commentId: commentId,
    //       reply: reply,
    //     },
    //     success: function(data) {
    //         // console.log(data);
  
    //         $("#comments_section").html(data);
    //         $("#reply").val("");
    //       },
    //   });
    // });
  </script>

  <script src="../js/vanillaSelectBox.js" typse="text/javascript"></script>

@endsection


@endsection
