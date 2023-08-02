  <div class="col-12">
    <div id="comments" class="ps-2">
      @forelse ($comments as $comment)
        <div class="borderHover border-start border-primary ps-4 mb-2">
          <div class="w-100 d-flex position-relative" style="right: 48px;">
            <div class="d-flex align-items-center bg-light position-relative" style="width: 45px; font-size: 2rem;">
              <div style="height: 40px" class="m-2">
                <i class='bx bxs-user'></i>
              </div>
            </div>
            <div class="commentDiv2 pt-2 ps-2 rounded-3 w-100">
              <span class="text-primary m-0">User: {{ $comment->user->name }}</span>
              <span class=""> | {{ $comment->created_at }}</span> 
              <p class="m-0">{{ $comment->comment }}</p>
            </div>
          </div>
          <div class="mb-2">
            <a href="" class="text-primary text-decoration-none replyBtn" data-Commentid="{{ $comment->id }}">Reply</a>
          </div>
          @include('comments.replies', ['comments' => $comment->replies])
        </div>
      @empty
        <p>Be First To Comment.</p>
      @endforelse
    </div>
  </div>
