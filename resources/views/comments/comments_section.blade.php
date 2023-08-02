{{-- comments --}}

{{-- @include('comments.comments') --}}
@each('comments.comms', $comments, 'comment', 'comments.no-comments')

          {{-- hidden reply div --}}
          <div class="replyDiv col-12 col-md-10 ms-2 display-none">
            <form action="{{ url('/reply') }}" method="POST">
              @csrf
              <input type="text" id="commentId" name="commentId" hidden>
              <textarea id="reply" class="form-control" cols="50" rows="5" class="form-control" placeholder="Reply here..." name="reply"></textarea>     
              <div class="mt-2">
                <input type="submit" value="Reply" class="submitReply btn btn-primary" id="submitReply">
              </div>
            </form>
          </div>
