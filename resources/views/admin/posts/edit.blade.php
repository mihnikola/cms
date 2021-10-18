<x-admin-master>
    @section('content')
        <h1>Edit a Post</h1>

        <form action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="title">Title</label>
                <input  type="text" 
                        name="title"
                        id="title"
                        class="form-control" 
                        aria-describedby="" 
                        placeholder="Enter title"
                        value="{{$post->title}}">
            </div>
            <div class="form-group">
                <div><img src="{{$post->post_image}}" alt=""></div>
                <label for="file">File</label>
                <input  type="file" 
                        name="post_image" 
                        id="post_image" 
                        class="form-control-file">
            </div>
            <div class="form-group">
                <textarea name="body" id="body" cols="30" class="form-control" rows="10">{{$post->body}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>

        </form>

    @endsection
</x-admin-master>