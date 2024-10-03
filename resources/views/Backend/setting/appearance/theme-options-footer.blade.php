<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Footer</title>
</head>

<body>
    <div class="container-scroller">
        @include('Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            {{ __('Footer') }}
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            @include('Backend.setting.appearance.theme_options_appearance_nav_tabs')
                        </div>

                        <div class="col-10">
                            <div class="tab-content tab-content-vertical bg-white rounded">
                                <div class="tab-pane fade show active" id="program-info-tab-content" role="tabpanel"
                                    aria-labelledby="home-tab-vertical">

                                    <form novalidate="" method="post"
                                        action="{{ route('backend.theme-options-footer-save') }}"
                                        data-validate="parsley" id="DataEntry_formId" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('Address') }}</label>
                                                    <input value="{{ $results['address1'] }}" type="text"
                                                        name="address1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('Google Map') }}</label>
                                                    <input value="{{ $results['address2'] }}" type="text"
                                                        name="address2" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('Email 1') }}</label>
                                                    <input value="{{ $results['email1'] }}" type="text"
                                                        name="email1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('Email 2') }}</label>
                                                    <input value="{{ $results['email2'] }}" type="text"
                                                        name="email2" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('Phone 1') }}</label>
                                                    <input value="{{ $results['phone1'] }}" type="text"
                                                        name="phone1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('Phone 2') }}</label>
                                                    <input value="{{ $results['phone2'] }}" type="text"
                                                        name="phone2" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('Description') }}</label>
                                                    <input value="{{ $results['description'] }}" type="text"
                                                        name="description" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label  class="font-weight-bold text-muted">{{ __('Payment Gateway Icons') }}</label>
                                                    <div class="mg-t-10 mg-sm-t-0 add-data">
                                                        @if (@$results->paywiths->count() == 0)
                                                            <div class="d-flex align-items-center mt-2">
                                                                <div class="d-flex align-items-center select-add-section"
                                                                    style="width: 40%;">
                                                                    <input type="text" name="pay_name[]"
                                                                        class="form-control"
                                                                        placeholder="Pay With Name" required>
                                                                </div>

                                                                <div class="ml-3 border rounded"
                                                                    style="position:relative;width: 110px;">
                                                                    <img class="display-upload-img"
                                                                        style="width: 100%;height: 48px;"
                                                                        src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                        alt="">
                                                                    <input type="file" name="pay_image[]"
                                                                        class="form-control upload-img"
                                                                        style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                                                </div>

                                                                <a id="plus-btn-data" href="javascript:void(0)"
                                                                    class="plus-btn-data px-1 p-0 m-0 ml-2"><i
                                                                        class="fas fa-plus"></i></a>
                                                            </div>
                                                        @else
                                                            @foreach (@$results->paywiths as $j => $paywith)
                                                                <div class="d-flex align-items-center mt-2">

                                                                    <div class="d-flex align-items-center select-add-section"
                                                                        style="width: 40%;">
                                                                        <input type="text"
                                                                            name="old_pay_name[{{ @$paywith->id }}]"
                                                                            value="{{ @$paywith->pay_name }}"
                                                                            class="form-control"
                                                                            placeholder="Pay With Name" required>
                                                                    </div>

                                                                    <div class="ml-3 border rounded"
                                                                        style="position:relative;width: 110px;">
                                                                        <img class="display-upload-img"
                                                                            style="width: 100%;height: 48px;"
                                                                            src="{{ @$paywith->pay_image_show }}"
                                                                            alt="">
                                                                        <input type="file"
                                                                            name="old_pay_image[{{ @$paywith->id }}]"
                                                                            class="form-control upload-img"
                                                                            style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                                                    </div>

                                                                    @if ($j == @$results->paywiths->count() - 1)
                                                                        <a id="plus-btn-data"
                                                                            href="javascript:void(0)"
                                                                            class="plus-btn-data px-1 p-0 m-0 ml-2"><i
                                                                                class="fas fa-plus"></i></a>
                                                                    @else
                                                                        <a facilitiyitem_id="{{ @$paywith->id }}"
                                                                            href="javascript:void(0)"
                                                                            class="minus-btn-data-old px-1 p-0 m-0 ml-2"><i
                                                                                class="fas fa-minus-circle"></i></a>
                                                                    @endif

                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row tabs-footer mt-15">
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="btn blue-btn btn-primary">Save</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')

    <script>
        $('#plus-btn-data').on('click', function() {

            let myVar = `
					<div class="d-flex align-items-center mt-2">
						<div class="d-flex align-items-center select-add-section"
							style="width: 40%;">
							<input type="text" name="pay_name[]" class="form-control"
								placeholder="Pay With Name" required>
						</div>

						<div class="ml-3 border rounded"
							style="position:relative;width: 110px;">
							<img class="display-upload-img"
								style="width: 100%;height: 48px;"
								src="{{ asset('frontend/images/No-image.jpg') }}"
								alt="">
							<input type="file" name="pay_image[]"
								class="form-control upload-img"
								style="position: absolute;top: 0;opacity: 0;height: 100%;">
						</div>

						<a href="javascript:void(0)"
							class="minus-btn-data px-1 p-0 m-0 ml-2"><i
								class="fas fa-minus-circle"></i></a>
					</div>
				`;

            $('.add-data').prepend(myVar);
        });

        $(document).on('click', '.minus-btn-data', function() {
            $(this).parent().remove();
        });
        $('.minus-btn-data-old').on('click', function() {
            $(this).parent().parent().append('<input type="hidden" name="delete_facilitiyitem[]" value="' + $(this)
                .attr('facilitiyitem_id') + '">');
            $(this).parent().remove();
        });

        $('.upload-img').on('change', function() {
            var files = $(this).get(0).files;
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            var arg = this;
            reader.addEventListener("load", function(e) {
                var image = e.target.result;
                $(arg).parent().find('.display-upload-img').attr('src', image);
            });
        });
    </script>

</body>

</html>
