<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
    @include('admin.sidebar')
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')

        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="text-center">
                    <h2>Add catagory</h2>

                    <form action="{{ url('/add_catagory') }}" method="POST">
                        @csrf
                        <input class="php" type="text" name="name" placeholder="Enter Catagry Name">
                        <input class="btn btn-success" type="submit" name="submit" value="Add Catagory">
                    </form>
                </div>
                <table class="d-flex justify-content-center">
                    <tr>
                        <td>catagory</td>
                        <td>action</td>
                    </tr>
                    @foreach($data as $data)
                    <tr>
                        <td>{{ $data->catagory_name }}</td>
                        <td><a class="btn btn-danger" href="{{ url('delete_catagory',$data->id) }}" onclick="return confirm('are you sure')">Delete</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
   @include('admin.scripts')
  </body>
</html>