@extends('posts.create') <!-- Assuming you have a layout file, adjust as needed -->
@section('posts')

<div class="container">
    @foreach($posts as $post)
    <div class="card mb-3">
       
        @if($post->image_url)
        <div class="text-center">
            <img src="{{ asset('storage/' . $post->image_url) }}" class="img-fluid" alt="Post Image">
        </div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <h5 class="card-title">{{ $post->title }}</h5>
                </div>
                @if ($post->user->id == 1)

                <div class="col-md-1">
                    <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-info text-white py-1">edit</a>
                </div>
                <div class="col-md-1">
                    <a  class="btn btn-danger text-white py-1" onclick="handleDelete({{$post->id}})">delete</a>
                </div>
                @endif
            </div>
            <a href="/post/{{$post->id}}">
            <p class="card-text">{{ $post->content }}</p>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-5">
                    <small class="text-muted">Posted by: {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small>
                </div>
                <div class="col-md-7">
                    <a href="#commentsCollapse-{{ $post->id }}" data-toggle="collapse"><small>Comments: {{ $post->comments_count }}</small></a>
                </div>
            </div>
            
            <!-- Collapsible Comments Section -->
            <div id="commentsCollapse-{{ $post->id }}" class="collapse">
                @php
                    $comments = $post->comments->take(-3)->reverse();
                    $remainingCommentsCount = $post->comments_count - count($comments);
                @endphp
        
                @foreach ($comments as $comment)
                <hr>
                <div class="row mb-2">
                    <div class="card-body">
                        <small class="card-text">{{ $comment->text }}</small>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Commented by: {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y') }}</small>
                    </div>
                </div>
                @endforeach
        
                @if ($remainingCommentsCount > 0)
                <hr>
                <div class="text-center">
                    <a href="#">View {{ $remainingCommentsCount }} more comments</a>
                </div>
                @endif
            </div>
        </div>
        
        
        
    </a>
    </div>
    @endforeach


    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="deleteModelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="deletePostForm">
                @csrf
                @method('DELETE')
          <div class="modal-content" >
            <div class="row" style="height: 60px !important;">
                <h5 class="modal-title col-md-11 mt-3" id="deleteModelLabel">Delete Post</h5>
                <button type="button" class="close col-md-1 bg-transparent " data-dismiss="modal" aria-label="Close" style="border: none; font-size: 24px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                
                
                
            </div>
            
            <div class="modal-body">
          Are you sure you want to delete this post ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
          </div>
        </form>
        </div>
      </div>


      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      
      <script>
function handleDelete(id){

var form=document.getElementById('deletePostForm')
form.action='/posts/'+id
$('#deleteModel').modal('show'); 

}

      </script>

</div>
@endsection
