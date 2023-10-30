<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      @include('sweetalert::alert')
      <div class="hero_area">
        @include('home.header')
        @include('home.carousel')
      </div>
      <!-- why section -->
      @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.new_arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
     @include('home.product')
      <!-- end product section -->

      <div>
         <h1>Comments</h1>
         
         <form action="{{ url('add_comment') }}" method="POST">
            @csrf
           
            <textarea name="comment" id="" cols="30" rows="10" placeholder="comments"></textarea>
            <input type="submit" class="btn btn-success" value="comment">
         </form>
      </div>

      <div>
         <h3>All Comments</h3>
         @foreach($comment as $comment)
         <div>
            <b>{{ $comment->name }}</b>
            <p>{{ $comment->comment }}</p>
            <a href="javascript::void(0);" class="btn" onclick="reply(this)" data-commentId="{{ $comment->id }}">Reply</a>

            @foreach($reply as $replied)
            @if($replied->comment_id==$comment->id)
            <div class="mx-4">
               <b>{{ $replied->name }}</b>
               <p>{{ $replied->reply }}</p>
               <a href="javascript::void(0);" class="btn" onclick="reply(this)" data-commentId="{{ $comment->id }}">Reply</a>

            </div>
            @endif
            @endforeach
         </div>
         @endforeach
      </div>

      <div class="reply" style="display:none">
         <form action="add_reply" method="POST">
            @csrf
            <input type="text" id="commentid" name="commentid">
         <textarea name="reply" id="" cols="30" rows="10" placeholder=""></textarea>
         <button class="btn btn-success" type="submit">Reply</button>
         <a href="javascript::void(0)" class="btn btn-danger" onclick="replyclose(this)">Close</a>
            
         </form>
      </div>

      <!-- subscribe section -->
      @include('home.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
      @include('home.client')
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->

      <!-- jQery -->
 <script src="home/js/jquery-3.4.1.min.js"></script>
 <!-- popper js -->
 <script src="home/js/popper.min.js"></script>
 <!-- bootstrap js -->
 <script src="home/js/bootstrap.js"></script>
 <!-- custom js -->
 <script src="home/js/custom.js"></script>

 <script>
   function reply(caller){
      document.getElementById("commentid").value=$(caller).attr('data-commentId');
            
      $('.reply').insertAfter($(caller));
      $('.reply').show();
   }
   function replyclose(caller){
      $('.reply').hide();
   }
 </script>

<script>
   document.addEventListener("DOMContentLoaded", function(event) { 
       var scrollpos = localStorage.getItem('scrollpos');
       if (scrollpos) window.scrollTo(0, scrollpos);
   });

   window.onbeforeunload = function(e) {
       localStorage.setItem('scrollpos', window.scrollY);
   };
</script>
      
   </body>
</html>