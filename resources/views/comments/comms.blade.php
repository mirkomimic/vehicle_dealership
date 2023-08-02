<div class="commentWithReplies border-start border-primary ps-4 mb-2">
  <div class="w-100 d-flex position-relative" style="right: 48px;">
    <div class="d-flex align-items-center bg-light position-relative" style="width: 45px; font-size: 2rem;">
      <div style="height: 40px" class="m-2">
        <i class='bx bxs-user'></i>
      </div>
    </div>
    <div class="bg-comment pt-2 ps-2 rounded-3 w-100">
      <span class="text-primary m-0">User: {{ $comment->user->name }}</span>
      <span class=""> | {{ $comment->created_at }}</span>
      <p class="m-0">{{ $comment->comment }}</p>
    </div>
  </div>
  <div class="mb-2">
    <a href="" class="replyBtn text-primary text-decoration-none" data-Commentid="{{ $comment->id }}">Reply</a>
    <a href="" class="collapseCommentBtn text-primary text-decoration-none">Collapse</a>
  </div>
  {{-- @include('comments.replies', ['comments' => $comment->replies]) --}}
  @each('comments.comms', $comment->replies, 'comment')
</div>


