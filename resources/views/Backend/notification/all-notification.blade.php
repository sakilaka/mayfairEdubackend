@section('title')
    Admin - All notification
@endsection

@extends('Backend.layouts.layouts')
@section('style')
<style>
/* .appointment_contains_doct {
    border-bottom: 1px solid #000000;
    margin-top: 1rem;
} */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Playfair Display", serif;
}
.doctor_profile_contains {
    padding: 20px 0;
    text-align: center;
    max-width: 600px;
    margin: auto;
}
.media-list-link .media {
    padding: 15px 20px;
}
.media {
    display: flex;
    align-items: flex-start;
}
.media-body {
    flex: 1;
}
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Playfair Display", serif;
}
</style>
@endsection

@section('main_contain')

<section class="appointment_inner mt-5 mb-5">
    <div class="container">
      <div class="appointment_contains_doct">
        <div class="doctor_profile_contains">
            <div class="media-list">
                <!-- loop starts here -->
                <div class="show-notification-data">

                @foreach ($notifications as $notification)
                @if ($notification->type=='university')
                    <a href="{{ route('admin.student_appliction_details',@$notification->application->id) }}" class="media-list-link @if($notification->is_read == 0)unread @else read @endif">
                      <div class="media">
                        <img src="{{ @$notification->application->student->image_show }}" alt="">
                        <div class="media-body">
                          <p class="noti-text"> {{ @$notification->text }}.</p>
                          <p class="noti-text"> {{ @$notification->application->student->name }}.</p>
                          <span>{{date('F,d,Y H:i:s',strtotime($notification->created_at))}}</span>
                        </div>
                      </div><!-- media -->
                    </a>
                @elseif ($notification->type=='event')
                <a href="" class="media-list-link @if($notification->is_read == 0)unread @else read @endif">
                  <div class="media">
                    <img src="{{ @$notification->event_cart->event->host->image_show }}" alt="">
                    <div class="media-body">
                      <p class="noti-text"> {{ $notification->text }}.</p>
                      <p class="noti-text"> {{ @$notification->event_cart->event->name}}.</p>
                      <span>{{date('F,d,Y H:i:s',strtotime($notification->created_at))}}</span>
                    </div>
                  </div><!-- media -->
                </a>
                @elseif ($notification->type=='package')
                <a href="" class="media-list-link @if($notification->is_read == 0)unread @else read @endif">
                  <div class="media">
                    <img src="{{ @$notification->image_show }}" alt="">
                    <div class="media-body">
                      <p class="noti-text"> {{ $notification->text }}.</p>
                      <p class="noti-text"> {{ @$notification->cart->package->name}}.</p>
                      <span>{{date('F,d,Y H:i:s',strtotime($notification->created_at))}}</span>
                    </div>
                  </div><!-- media -->
                </a>

                @elseif ($notification->type=='ebook')
              <a href="" class="media-list-link @if($notification->is_read == 0)unread @else read @endif">
                <div class="media">
                  <img src="{{ @$notification?->cart?->ebook?->user?->image_show }}" alt="">
                  <div class="media-body">
                    <p class="noti-text"> {{ $notification->text }}.</p>
                    <p class="noti-text"> {{ @$notification->cart->ebook->title}}.</p>
                    <span>{{date('F,d,Y H:i:s',strtotime($notification->created_at))}}</span>
                  </div>
                </div><!-- media -->
              </a>
                @endif
                @endforeach

                </div>

                  @if($notifications->lastPage() != 1)
                <div class="dropdown-footer" style="padding: 0px;text-align: center;padding-top: 10px;">
                  <a href="javascript:void(0)" id="showMore"><i class="fas fa-angle-down"></i> Show All Notifications</a>
                </div>
                @endif
              </div><!-- media-list -->

          <!-- =========== review Item  =========== -->


          <!-- ===========  Review item ============ -->
        </div>
      </div>


    </div>
</section>


@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
<script>
     var curPageNum = "{{ $notifications->currentPage() }}";
     var lastPage = "{{ $notifications->lastPage() }}";
     let pageN=curPageNum;
   // console.log(department);
    $('#showMore').on('click',function(){
       // console.log(searchval);
        if(parseInt(lastPage) > parseInt(curPageNum)){
            pageN=parseInt(curPageNum)+1;
            let url = '{{ url("/get-backend-notification") }}' +"?page="+pageN;
            axios.get(url)
            .then(res => {
                // console.log(res);
                curPageNum=parseInt(curPageNum)+1;

                $('.show-notification-data').append(res.data);
                if(parseInt(lastPage) == parseInt(curPageNum)){
                    $(this).parent().hide();
                }

            });
        }else{
            $(this).parent().hide();
        }

    });

</script>
@endsection
