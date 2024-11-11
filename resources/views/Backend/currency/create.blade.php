<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
    <title>{{ env('APP_NAME') }} | Add Currency</title>
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
                            Add Currency
                        </h3>

                        <nav aria-label="breadcrumb">
                            <a href="{{ route('admin.manage_currency') }}" class="btn btn-primary btn-fw">
                                <span class="fas">&#xf0d6;</span>
                                Manage Currencies</a>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample" action="{{ route('admin.stor_currency') }}"
                                        method="POST">
                                        @csrf
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="degree_name" class=" col-form-label">Currency Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="degree_name" type="text" name="currency_name"
                                                    class="form-control" value="{{ old('currency_name') }}"
                                                    placeholder="Enter Currency Short Name (e.g: USD, BDT...)" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="degree_name" class=" col-form-label">Currency Icon
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="degree_name" type="text" name="currency_icon"
                                                    class="form-control" value="{{ old('currency_icon') }}"
                                                    placeholder="Enter Currency Icon (e.g: $, ৳...)" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="degree_name" class=" col-form-label">Exchange Rate
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <input id="degree_name" type="text" name="exchange_rate"
                                                    class="form-control" value="{{ old('exchange_rate') }}" placeholder="0.00" required>
                                                <p class="text-muted">Enter the exchange rate against USD. For example,
                                                    1 USD = 120.75 BDT.</p>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3 d-flex justify-content-between align-items-center">
                                                <label for="degree_name" class=" col-form-label">Is Default
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <p>:</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <select name="is_default" id="" class="form-control form-control-lg" required>
                                                    <option value="0">No
                                                    </option>
                                                    <option value="1">Yes
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
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

</body>

</html>
