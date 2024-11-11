@section('title')
    Admin - Role Permission
@endsection
@section('style')
<style>
    .main_menu_container li{
        padding: 5px;
        width: 200px;
        background: #ededed;
        margin: 4px;
        border: 1px solid;
    }
    .child_menu_container{
        margin-left: 20px
    }
     .child_menu_container li{
        position: relative;
     }


    .menu-item-con{
        position: relative;

    }
    .menu-item-con .menu-item-icon{
        position: absolute;
        right: 10px;
        top: 50%;
    }
</style>
@endsection
@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('admin.role.index')}}"> <i class="icon ion-reply text-22"></i> All Role</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> Role Permission</h6>
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif
            <!----- Start Add Category Form input ------->
            <div class="col-xl-12 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('admin.role.set_permission',$role->id) }}" method="post" enctype="multipart/form-data" id="permission_form">
                        <input type="hidden" name="role" value="{{ $role->id }}">
                        @csrf
                        <div class="row mb-4 pb-4">
                            <div class="col-md-12">
                                <h3>Role Name: {{ $role->name }}</h3>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <ul class="main_menu_container">
                                    @foreach ($main_menus as $m_menu)
                                    <li class="menu-item-con">
                                        {{ $m_menu->menu_name }}
                                       <i class="menu-item-icon fa fa-minus" style="width: 10px"></i>
                                    </li>
                                    @if($m_menu->sub_menus->count() > 0)
                                        <ul class="child_menu_container">
                                            @foreach ($m_menu->sub_menus as $sub_menu)
                                            <li>{{ $sub_menu->menu_name }}</li>
                                            @if($sub_menu->sub_menus->count() > 0)
                                                <ul class="child_menu_container">
                                                    @foreach ($sub_menu->sub_menus as $child_menu)
                                                    <li><input style="margin-right:5px;" type="checkbox" name="item[]" >{{ $child_menu->menu_name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                    @endforeach

                                </ul>
                            </div>
                        </div> --}}
                         <div class="row">
                            <div class="col-md-8" >
                            </div>
                            <div class="col-md-1" >
                            </div>
                            <div class="col-md-1" >
                            </div>
                            <div class="col-md-1" >
                            </div>
                            <div class="col-md-1" >
                            </div>
                        </div>
                            @php
                                $items = \App\Models\PermissionMenuItem::get();
                            @endphp
                        @foreach ($permission_g as $g_permission)
                        @if($g_permission->is_sub == 1)
                            @php
                                $r_check = $role_permissions->where('permission_id',$g_permission->id)->count();
                            @endphp
                            @if($r_check)
                         <strong>{{ $g_permission->menu_name }}</strong> <input type="checkbox" checked value="{{ $g_permission->id }}" name="item[]" >
                            @else
                              <strong>{{ $g_permission->menu_name }}</strong> <input type="checkbox" value="{{ $g_permission->id }}" name="item[]" >
                            @endif
                        @else
                        <div class="row p-3">
                            <div class="col-md-12">
                               <strong>{{ $g_permission->menu_name }}</strong>
                            </div>
                        </div>
                        @php
                            $pre_menu_id=0;
                        @endphp
                        @foreach ($g_permission->menus as $menu)


                        <div class="row p-2" style="border:1px solid #bebea2">
                            <div class="col-md-8">
                               {{ $menu->menu_name }}
                            </div>
                            {{-- @if($m_permission->is_single==1)
                             <div class="col-md-1">
                            </div>
                             <div class="col-md-1">
                                <input type="checkbox" value="2" name="item[{{ $m_permission->id }}][]" >
                            </div>
                             <div class="col-md-1">
                            </div>
                             <div class="col-md-1">
                            </div>
                            @else --}}
                            @foreach ($menu->menus as $sub_menu)
                            <div class="col-md-1">

                                @php
                                    $r_check = $role_permissions->where('permission_id',$sub_menu->id)->count();
                                @endphp
                                @if($r_check)
                                <input checked class="item check-g-{{ $g_permission->id }} check-p-{{ $menu->id }}" item_g_id={{ $g_permission->id }} item_p_id={{ $menu->id }} type="checkbox" value="{{ $sub_menu->id }}" name="old_item[]" > {{ $sub_menu->menu_name }}
                                @else
                                 <input class="item check-g-{{ $g_permission->id }} check-p-{{ $menu->id }}" item_g_id={{ $g_permission->id }} item_p_id={{ $menu->id }} type="checkbox" value="{{ $sub_menu->id }}" name="item[]" > {{ $sub_menu->menu_name }}
                                @endif


                            </div>
                            @endforeach

                            {{-- @endif --}}

                        </div>

                        @endforeach
                        @endif
                        @endforeach

                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('admin.role.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Close</a>
                            <button type="submit" class="btn btn-info ">Save</button>
                          </div>
                        </div>
                    </form>

                </div><!-- form-layout -->
            </div><!-- col-6 -->
            <!----- Start Add Category Form input ------->
          </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->

    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->







@endsection
@section('script')
<script>
    $('.item').on('click',function(){
        console.log(this);
        console.log($('#permission_form').find('.g_item_'+$(this).attr('item_g_id')).length);
        let g_any_check=0;
        $('#permission_form').find('.check-g-'+$(this).attr('item_g_id')).each(function(){
           if($(this).is(":checked")){
            g_any_check = 1;
           }
        })

        if(g_any_check == 0){
            $('.g_item_'+$(this).attr('item_g_id')).remove();
        }
        if(this.checked){
            if($('#permission_form').find('.g_item_'+$(this).attr('item_g_id')).length == 0){
                $('#permission_form').prepend('<input type="hidden" name="g_item[]" class="g_item_'+$(this).attr('item_g_id')+'" value="'+$(this).attr('item_g_id')+'"/>');
            }
        }
        let p_any_check=0;
        $('#permission_form').find('.check-p-'+$(this).attr('item_p_id')).each(function(){
           if($(this).is(":checked")){
            p_any_check = 1;
           }
        })

        if(p_any_check == 0){
            $('.p_item_'+$(this).attr('item_p_id')).remove();
        }
        if(this.checked){
            if($('#permission_form').find('.p_item_'+$(this).attr('item_p_id')).length == 0){
                $('#permission_form').prepend('<input type="hidden" name="p_item[]" class="p_item_'+$(this).attr('item_p_id')+'" value="'+$(this).attr('item_p_id')+'"/>');
            }
        }


    });
    $('.old_item').on('click',function(){
        // console.log(this.checked);
        if(this.checked == false){
            $(this).parent().parent().parent().append('<input type="hidden" name="del_item[]" id="del_item_'+$(this).attr('p_item')+'" value="'+$(this).attr('p_item')+'">');
        }else{
            $('#del_item_'+$(this).attr('p_item')).remove();
        }
        // if(this)
    });
    $('#color_code').on('input',function(){
        $('#show_color_code').val(this.value.replace('#',""));
       // console.log(this.value.replace('#',""));
    });
    // $('#color_code').on('change',function(){
    //     console.log(this.value.replace('#',""));
    // })
</script>
@endsection
