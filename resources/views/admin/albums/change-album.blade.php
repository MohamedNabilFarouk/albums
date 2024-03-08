@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('Change album')
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">@lang('Assign images to another album and delete album')</small>
                    <!--end::Description-->
                </h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Container-->
    </div>
@endsection

@section('content')

    @include('admin.includes.messages')

    <div class="container-fluid page__container p-2">

        <div class="card rounded card-form__body card-body shadow-lg">
            <form method="post" action="{{ route('change', $row->id)}}" enctype="multipart/form-data">
                @csrf
              
                  
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('assign images to this album')</label>
                    <select class="form-control" name='newAlbum_id'>
                        @foreach($albums as $a)   
                        <option value='{{ $a->id }}'>{{ $a->title }}</option>
                      @endforeach
                    
                    </select>
                
                </div>
              
                <div class="text-right mb-5">
                    <input type="submit" class="btn btn-success" value="@lang('assign and delete')">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>
@stop
