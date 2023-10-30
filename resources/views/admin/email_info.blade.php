<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
   @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
    @include('admin.sidebar')
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <h1 class="text-center">Send Email to {{ $order->email }}</h1>
<form action="{{ url('send_user_email/'.$order->id) }}" method="POST">
            <div>
                <label for="">Greetings</label>
                <input type="text" name="greeting">
            </div>

            <div>
                <label for="">Email First Line</label>
                <input type="text" name="firstline">
            </div>

            <div>
                <label for="">Email body</label>
                <input type="text" name="body">
            </div>

            <div>
                <label for="">Email Buttons</label>
                <input type="text" name="button">
            </div>

            <div>
                <label for="">Email URL</label>
                <input type="text" name="emailurl">
            </div>

            <div>
                <label for="">Email Last Line</label>
                <input type="text" name="finishline">
            </div>

            <div>
                <input type="submit" value="Send Email" class="Send Email">
            </div>

</form>
        </div>
      </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
   @include('admin.scripts')
  </body>
</html>