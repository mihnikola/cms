<x-admin-master>
    @section('content')

        <h1>User Profile for : {{$user->name}}</h1>

        <div class="row">

        <form action="{{route('user.profile.update',$user)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
               <img height="60px" class="img-profile rounded-circle" src="{{$user->avatar}}">
            </div>
            <div class="form-group">
                <input type="file" name="avatar">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input  type="text" 
                        name="username"
                        id="username"
                        class="form-control @error('username') is-invalid @enderror" 
                        value="{{$user->username}}">
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input  type="text" 
                        name="name"
                        id="name"
                        class="form-control" 
                        value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input  type="text" 
                        name="email"
                        id="email"
                        class="form-control" 
                        value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input  type="password" 
                        name="password"
                        id="password"
                        class="form-control">
            </div>
            <div class="form-group">
                <label for="password-confirmation">Confirm password</label>
                <input  type="password" 
                        name="password-confirmation"
                        id="password-confirmation"
                        class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Options</th>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Detach</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Options</th>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Attach</th>
                      <th>Detach</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      @foreach($roles as $role)
                        <tr>
                            <td><input type="checkbox"
                              @foreach($user->roles as $user_role)
                                  @if($user_role->slug == $role->slug)
                                      checked
                                  @endif
                              @endforeach
                              ></td>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->slug}}</td>
                            <td>
                              <form action="{{route('user.role.attach',$user)}}" method="post">
                                  @method('PUT')
                                  @csrf
                                  <input type="hidden" name="role" value="{{$role->id}}">
                                  <button type="submit" class="btn btn-primary"
                                  @if($user->roles->contains($role))
                                      disabled
                                  @endif
                                  >Attach</button>
                              </form>  
                            </td>
                            <td>
                              <form action="{{route('user.role.detach',$user)}}" method="post">
                                  @method('PUT')
                                  @csrf
                                  <input type="hidden" name="role" value="{{$role->id}}">

                                  <button 
                                    type="submit" 
                                    class="btn btn-danger"
                                    
                                    @if(!$user->roles->contains($role))
                                      disabled
                                    @endif
                                    
                                  >Dettach</button>
                              </form>
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          

    @endsection
</x-admin-master>