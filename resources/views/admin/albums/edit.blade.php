@extends('admin.layouts.app')


@section('toolbar')
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="d-flex align-items-center me-3">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">@lang('Company')
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <!--end::Separator-->
                    <!--begin::Description-->
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">@lang('Edit')</small>
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
            <form method="post" action="{{ route('album.update', $row->id)}}" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('Title')</label>
                    <input type='text' name="title" class="form-control" value="{{ $row->title }}" />
                </div>
                <div class="form-group mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">@lang('Images')</label>
                    <input type='file' name="image[]" multiple="multiple" accept="image/png, image/jpg, image/jpeg" class="form-control" value="" />
                </div>

                <div class="text-right mb-5">
                    <input type="submit" class="btn btn-success" value="@lang('Edit')">
                </div>
            </form>
        </div>
    </div>
    <!-- // END drawer-layout__content -->
    </div>
@stop
