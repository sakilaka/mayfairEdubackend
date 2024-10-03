<div class="br-header" style="background-color: var(--theme_color)">
    <div class="br-header-left">
      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
      <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      {{-- <div class="input-group hidden-xs-down wd-170 transition">
        <input id="searchbox" type="text" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
        </span>
      </div><!-- input-group --> --}}
    </div><!-- br-header-left -->
    <div class="br-header-right">
      <nav class="nav">
        <div class="dropdown">
          {{-- <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
            <i class="icon ion-ios-email-outline tx-24"></i>
            <!-- start: if statement -->
            <span class="square-8 bg-danger pos-absolute t-15 r-0 rounded-circle"></span>
            <!-- end: if statement -->
          </a> --}}
          <div class="dropdown-menu dropdown-menu-header">
            <div class="dropdown-menu-label">
              <label>Messages</label>
              <a href="">+ Add New Message</a>
            </div><!-- d-flex -->

            <div class="media-list">
              <!-- loop starts here -->
              <a href="" class="media-list-link">
                <div class="media">
                  <img src="https://via.placeholder.com/500" alt="">
                  <div class="media-body">
                    <div>
                      <p>Donna Seay</p>
                      <span>2 minutes ago</span>
                    </div><!-- d-flex -->
                    <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                  </div>
                </div><!-- media -->
              </a>
              <!-- loop ends here -->
              <a href="" class="media-list-link read">
                <div class="media">
                  <img src="https://via.placeholder.com/500" alt="">
                  <div class="media-body">
                    <div>
                      <p>Samantha Francis</p>
                      <span>3 hours ago</span>
                    </div><!-- d-flex -->
                    <p>My entire soul, like these sweet mornings of spring.</p>
                  </div>
                </div><!-- media -->
              </a>
              <a href="" class="media-list-link read">
                <div class="media">
                  <img src="https://via.placeholder.com/500" alt="">
                  <div class="media-body">
                    <div>
                      <p>Robert Walker</p>
                      <span>5 hours ago</span>
                    </div><!-- d-flex -->
                    <p>I should be incapable of drawing a single stroke at the present moment...</p>
                  </div>
                </div><!-- media -->
              </a>
              <a href="" class="media-list-link read">
                <div class="media">
                  <img src="https://via.placeholder.com/500" alt="">
                  <div class="media-body">
                    <div>
                      <p>Larry Smith</p>
                      <span>Yesterday</span>
                    </div><!-- d-flex -->
                    <p>When, while the lovely valley teems with vapour around me, and the meridian sun strikes...</p>
                  </div>
                </div><!-- media -->
              </a>
              <div class="dropdown-footer">
                <a href=""><i class="fas fa-angle-down"></i> Show All Messages</a>
              </div>
            </div><!-- media-list -->
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
        <div class="dropdown">
          <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
            <i class="icon ion-ios-bell-outline tx-24" style="color: white"></i>
            <!-- start: if statement -->
            <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
            <!-- end: if statement -->
          </a>
          <div class="dropdown-menu dropdown-menu-header">
            <div class="dropdown-menu-label">
              <label>Notifications</label>
              <a href="">Mark All as Read</a>
            </div><!-- d-flex -->

            <div class="media-list">
              <!-- loop starts here -->
              {{-- @php
              $admin = auth()->guard('admin')->user();
             @endphp --}}
            @php
            $notifications = \App\Models\Notification::where('user_id',auth()->guard('admin')->user()->id)->orderBy('id','desc')->paginate(2);
            @endphp
              @foreach ($notifications as $notification)
              @if ($notification->type=='university')
                {{-- @foreach (@$notification->application->carts  as $cart)  --}}
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
                {{-- @endforeach --}}
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
              {{-- <!-- loop ends here -->
              <a href="" class="media-list-link read">
                <div class="media">
                  <img src="https://via.placeholder.com/500" alt="">
                  <div class="media-body">
                    <p class="noti-text"><strong>Mellisa Brown</strong> appreciated your work <strong>The Social Network</strong></p>
                    <span>October 02, 2017 12:44am</span>
                  </div>
                </div><!-- media -->
              </a>
              <a href="" class="media-list-link read">
                <div class="media">
                  <img src="https://via.placeholder.com/500" alt="">
                  <div class="media-body">
                    <p class="noti-text">20+ new items added are for sale in your <strong>Sale Group</strong></p>
                    <span>October 01, 2017 10:20pm</span>
                  </div>
                </div><!-- media -->
              </a>
              <a href="" class="media-list-link read">
                <div class="media">
                  <img src="https://via.placeholder.com/500" alt="">
                  <div class="media-body">
                    <p class="noti-text"><strong>Julius Erving</strong> wants to connect with you on your conversation with <strong>Ronnie Mara</strong></p>
                    <span>October 01, 2017 6:08pm</span>
                  </div>
                </div><!-- media -->
              </a> --}}
              <div class="dropdown-footer">
                <a href="{{ route('backend.all.notification') }}"><i class="fas fa-angle-down"></i> Show All Notifications</a>
              </div>
            </div><!-- media-list -->
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
        <!-- Settings Dropdown -->
        {{-- <div class="hidden sm:flex sm:items-center sm:ml-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->fname }}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="url('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ url('admin.logout') }}">
                        @csrf

                        <x-dropdown-link :href="url('admin.logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div> --}}
        {{-- <div class="hidden sm:flex sm:items-center sm:ml-6">
            <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                <div @click="open = ! open">
                    <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>Admin</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </button>
                </div>

                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0" style="display: none;" @click="open = false">
                    <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                        <a class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="http://localhost/safihealth/profile.edit">Profile</a>

                        <!-- Authentication -->
                        <form method="POST" action="http://localhost/safihealth/admin.logout">
                            <input type="hidden" name="_token" value="FcBxSzKYDQBtyFFtGxGIuWzFepYYoR0Nt5vV6W1f" autocomplete="off">
                            <a class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="http://localhost/safihealth/admin.logout" onclick="event.preventDefault();this.closest('form').submit();">
                                Log Out
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        @php
          $admin = auth()->guard('admin')->user();
        @endphp
        <div class="dropdown">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <span class="logged-name hidden-md-down">{{ $admin->name }}</span>
            <img src="{{ $admin->image_show }}" class="wd-32 rounded-circle" alt="">
            <span class="square-10 bg-success"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-250">
            <div class="tx-center">
              <a href=""><img src="{{ $admin->image_show }}" class="wd-80 rounded-circle" alt=""></a>
              <h6 class="logged-fullname">{{ $admin->name }}</h6>
              <p>{{ $admin->email }}</p>
            </div>
            <hr>
            {{-- <div class="tx-center">
              <span class="profile-earning-label">Earnings After Taxes</span>
              <h3 class="profile-earning-amount">$13,230 <i class="icon ion-ios-arrow-thin-up tx-success"></i></h3>
              <span class="profile-earning-text">Based on list price.</span>
            </div> --}}

            <ul class="list-unstyled user-profile-nav">
              <li><a href="{{ route('backendog.edit_admin', $admin->id) }}"><i class="icon ion-ios-person"></i> Edit Profile</a></li>

              <li><a href="{{ route('logout') }}"><i class="icon ion-power"></i> Sign Out</a> </li>

              <li>

              </li>
            </ul>

          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </nav>
      {{-- <div class="navicon-right">
        <a id="btnRightMenu" href="" class="pos-relative">
          <i class="icon ion-ios-chatboxes-outline"></i>
          <!-- start: if statement -->
          <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span>
          <!-- end: if statement -->
        </a>
      </div><!-- navicon-right --> --}}
    </div><!-- br-header-right -->
  </div><!-- br-header -->



