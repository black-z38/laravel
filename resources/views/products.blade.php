@php $page = 'product'; @endphp
        <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                    @endauth
        </div>
    @endif

    <div class="content">
        <div class="row">
            {{ csrf_field() }}
            <div class="col-md-12 text-left bg0 panel-shadow p-t-10">
                <!-- Horizontal form -->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3 class="panel-title">Horizontal form</h3></div>
                        <div class="panel-body">
                            <form name="frm_product" id="frm_product" method="post">
                                <input type="hidden" id="pro_id" name="pro_id" value="">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="product_name" class="col-sm-3 control-label">Product name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="product_name" name="product_name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="quantity_in_stock" class="col-sm-3 control-label">Quantity in
                                        stock</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="quantity_in_stock"
                                               name="quantity_in_stock">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price_per_item" class="col-sm-3 control-label">Price per item</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="price_per_item"
                                               name="price_per_item">
                                    </div>
                                </div>
                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="button" class="btn btn-info waves-effect waves-light submitform">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- panel-body -->
                    </div> <!-- panel -->
                </div> <!-- col -->
            </div>
        </div>
        <br><br>
        <!-- Start table -->
        <div class="row">
            <div class="col-md-12 bg0 panel-shadow p-t-10">
                <table width="100%" class="table table-bordered" id="dataTables-example">
                    <thead>
                    <tr>
                        @foreach($label as $item)
                            <th class="text-center">@lang($page.'.'.$item)</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody id="t_body">
                    @foreach($data as $item)
                        @if(!$item['delete']){{-- if is not deleted --}}
                        @php $id = $label[0]; @endphp
                        <tr style="cursor:pointer" onClick="myclick({{ $item->$id }})" id="{{ $item->$id }}">
                            @foreach($label as $value)
                                @if($value == 'created_at' || $value == 'updated_at')
                                    <td>{{$item->$value}}</td>
                                @else
                                    <td>{{$item->$value}}</td>
                                @endif
                            @endforeach
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- End row-->
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.submitform').click(function () {
            $.ajax({
                type: "POST",
                url: '/submit',
                data: $('#frm_product').serialize(),
                success: function (result) {
                    alert('OK');
                }
            });
        });
    });
</script>
</body>
</html>
