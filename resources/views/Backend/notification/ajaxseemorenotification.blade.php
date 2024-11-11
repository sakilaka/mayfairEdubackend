@foreach ($notifications as $notification)
@if ($notification->type == 'university')
    <a href="{{ route('admin.student_appliction_details',@$notification->application->id) }}" class="media-list-link @if(@$notification->is_read == 0)unread @else read @endif">
      <div class="media">
        <img src="{{ @$notification->application->student->image_show }}" alt="" style="height:60px;width:60px;">
        <div class="media-body">
          {{-- <p class="noti-text">&nbsp; Course<strong> &nbsp; {{ @$notification->cart->order->order_number }}</strong> {{ $notification->text }}.</p> --}}
          <p class="noti-text">&nbsp; <strong> &nbsp; {{ @$notification->application->student->name }}</strong> {{ @$notification->text }}.</p>
          <p> &nbsp; {{date('F,d,Y H:i:s',strtotime(@$notification->created_at))}}</p>
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
