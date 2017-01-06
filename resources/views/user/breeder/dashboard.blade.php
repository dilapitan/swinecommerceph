{{--
    Displays products of the respective Breeder user
--}}

@extends('user.breeder.home')

@section('title')
    | Breeder - Dashboard
@endsection

@section('pageId')
    id="page-breeder-dashboard"
@endsection

@section('breadcrumbTitle')
    Dashboard
@endsection

@section('breadcrumb')
    <a href="{{ route('home_path') }}" class="breadcrumb">Home</a>
    <a href="#!" class="breadcrumb">Dashboard</a>
@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            <p class="caption">
                Your Dashboard. <br>
            </p>
        </div>
    </div>
    <div id="card-status" class="row">

        {{-- Charts --}}
        <div id="charts-container" class="">
            <p><br></p>

            <div class="col s1">
                <div class="">
                    <input class="with-gap" name="frequency" type="radio" id="frequency-monthly" value="monthly" v-model="chosenFrequency" @change="valueChange" />
                    <label for="frequency-monthly">Monthly</label>
                </div>
                <div class="">
                    <input class="with-gap" name="frequency" type="radio" id="frequency-weekly" value="weekly" v-model="chosenFrequency" @change="valueChange" />
                    <label for="frequency-weekly">Weekly</label>
                </div>
                <div class="">
                    <input class="with-gap" name="frequency" type="radio" id="frequency-daily" value="daily" v-model="chosenFrequency" @change="valueChange" />
                    <label for="frequency-daily">Daily</label>
                </div>
            </div>
            <div class="col s5">
                <div class="input-field col s5">
                    <custom-date-from-select v-model="dateFromInput"
                        :date-accreditation="latestAccreditation"
                        @date-from-select="dateFromChange"
                    >
                    </custom-date-from-select>
                </div>
                <div class="input-field col s5">
                    <custom-date-to-select v-model="dateToInput"
                        @date-to-select="dateToChange"
                        v-show="chosenFrequency !== 'weekly'"> </custom-date-to-select>
                </div>
                <div class="" style="margin-top:1rem;">
                    <a class="btn-floating" @click.prevent="retrieveSoldProducts"><i class="material-icons">send</i></a>
                </div>
            </div>

            <div class="col s12">
                <canvas id="barChart"></canvas>
            </div>

            <p><br></p>
        </div>

        <div class="col s12">
            <br>
        </div>

        <div id="card-product-status" class="col z-depth-1">
            <p></p>
            <div class="col s12">
                <h5 class="center-align">
                    <a href="{{ route('dashboard.productStatus') }}" class="black-text">Product Status</a>
                </h5>
            </div>

            {{-- Paid Products --}}
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content teal white-text">
                        <span class="card-title">
                            <a href="{{route('dashboard.productStatus',['status' => 'paid'])}}" class="white-text">Paid</a>
                        </span>
                        <h3>{{ $dashboardStats['paid']['overall'] }}</h3>
                    </div>
                    <div class="card-action teal">
                        <a class="white-text">Boar: {{ $dashboardStats['paid']['boar'] }} </a>
                        <a class="white-text">Sow: {{ $dashboardStats['paid']['sow'] }} </a>
                        <a class="white-text">Gilt: {{ $dashboardStats['paid']['gilt'] }} </a>
                        <a class="white-text">Semen: {{ $dashboardStats['paid']['semen'] }} </a>
                    </div>
                </div>
            </div>


            {{-- On Delivery Products --}}
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content grey white-text">
                        <span class="card-title">
                            <a href="{{route('dashboard.productStatus',['status' => 'on_delivery'])}}" class="white-text">On Delivery</a>
                        </span>
                        <h3>{{ $dashboardStats['on_delivery']['overall'] }}</h3>
                    </div>
                    <div class="card-action grey">
                        <a class="white-text">Boar: {{ $dashboardStats['on_delivery']['boar'] }} </a>
                        <a class="white-text">Sow: {{ $dashboardStats['on_delivery']['sow'] }} </a>
                        <a class="white-text">Gilt: {{ $dashboardStats['on_delivery']['gilt'] }} </a>
                        <a class="white-text">Semen: {{ $dashboardStats['on_delivery']['semen'] }} </a>
                    </div>
                </div>
            </div>

            {{-- Reserved Products --}}
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content pink white-text">
                        <span class="card-title">
                            <a href="{{route('dashboard.productStatus',['status' => 'reserved'])}}" class="white-text">Reserved</a>
                        </span>
                        <h3>{{ $dashboardStats['reserved']['overall'] }}</h3>
                    </div>
                    <div class="card-action pink">
                        <a class="white-text">Boar: {{ $dashboardStats['reserved']['boar'] }} </a>
                        <a class="white-text">Sow: {{ $dashboardStats['reserved']['sow'] }} </a>
                        <a class="white-text">Gilt: {{ $dashboardStats['reserved']['gilt'] }} </a>
                        <a class="white-text">Semen: {{ $dashboardStats['reserved']['semen'] }} </a>
                    </div>
                </div>
            </div>

            {{-- Hidden Products --}}
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">
                            <a href="{{route('products',['type' => 'all-type', 'status' => 'hidden', 'sort' => 'none'])}}" class="black-text">Hidden</a>
                        </span>
                        <h3>{{ $dashboardStats['hidden']['overall'] }}</h3>
                    </div>
                    <div class="card-action pink">
                        <a class="white-text">Boar: {{ $dashboardStats['hidden']['boar'] }} </a>
                        <a class="white-text">Sow: {{ $dashboardStats['hidden']['sow'] }} </a>
                        <a class="white-text">Gilt: {{ $dashboardStats['hidden']['gilt'] }} </a>
                        <a class="white-text">Semen: {{ $dashboardStats['hidden']['semen'] }} </a>
                    </div>
                </div>
            </div>

            {{-- Displayed Products --}}
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">
                            <a href="{{route('products',['type' => 'all-type', 'status' => 'displayed', 'sort' => 'none'])}}" class="black-text">Displayed</a>
                        </span>
                        <h3>{{ $dashboardStats['displayed']['overall'] }}</h3>
                    </div>
                    <div class="card-action teal">
                        <a class="white-text">Boar: {{ $dashboardStats['displayed']['boar'] }} </a>
                        <a class="white-text">Sow: {{ $dashboardStats['displayed']['sow'] }} </a>
                        <a class="white-text">Gilt: {{ $dashboardStats['displayed']['gilt'] }} </a>
                        <a class="white-text">Semen: {{ $dashboardStats['displayed']['semen'] }} </a>
                    </div>
                </div>
            </div>

            {{-- Requested Products --}}
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">
                            <a href="{{route('dashboard.productStatus',['status' => 'requested'])}}" class="black-text">Requested</a>
                        </span>
                        <h3>{{ $dashboardStats['requested']['overall'] }}</h3>
                    </div>
                    <div class="card-action grey">
                        <a class="white-text">Boar: {{ $dashboardStats['requested']['boar'] }} </a>
                        <a class="white-text">Sow: {{ $dashboardStats['requested']['sow'] }} </a>
                        <a class="white-text">Gilt: {{ $dashboardStats['requested']['gilt'] }} </a>
                        <a class="white-text">Semen: {{ $dashboardStats['requested']['semen'] }} </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Rating --}}
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content grey white-text">
                    <span class="card-title">
                        <a href="{{route('dashboard.reviews')}}" class="white-text">Rating</a>
                    </span>
                    <h3>{{ $dashboardStats['ratings']['overall'] }}/5</h3>
                </div>
                <div class="card-action grey">
                    <a class="white-text">Delivery: {{ $dashboardStats['ratings']['delivery'] }} </a>
                    <a class="white-text">Transaction: {{ $dashboardStats['ratings']['transaction'] }} </a>
                    <a class="white-text">Product Quality: {{ $dashboardStats['ratings']['productQuality'] }} </a>
                </div>
            </div>
        </div>

        {{-- Review --}}
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content teal white-text">
                    <span class="card-title">
                        <a href="{{route('dashboard.reviews')}}" class="white-text">Reviews</a>
                    </span>
                    <div id="review-slider" class="slider">
                        <ul class="slides teal">
                            @foreach($dashboardStats['ratings']['reviews'] as $review)
                                <li>
                                    <img>
                                    <div class="caption center-align">
                                        <h4>"{{ $review['comment'] }}"</h4>
                                        <h6 class="light grey-text text-lighten-3">- {{ $review['customerName'] }}</h6>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- <div class="row"> --}}
        {{-- Location --}}
        {{-- <div class="col s12">
            <div class="card">
                <div class="card-content teal darken-4 white-text">
                    <span class="card-title">Sales by Region</span>
                    <p>I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.</p>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('customScript')
    <script src="/js/vendor/autobahn.min.js"></script>
    <script type="text/javascript">

        var onConnectCallback = function(session){
            console.log('Session is open!');
            session.subscribe('{{ $topic }}', function(topic, data) {
                // This is where you would add the new article to the DOM (beyond the scope of this tutorial)
                console.log('New task name added "' + topic + '"');
                console.log(data);
            });
        };

        var onHangupCallback = function(code, reason, detail){
            console.warn('WebSocket connection closed');
            console.warn(code+': '+reason);
        };

        var conn = new ab.connect(
            config.breederWSServer,
            onConnectCallback,
            onHangupCallback,
            {
                'maxRetries': 30,
                'retryDelay': 2000,
                'skipSubprotocolCheck': true
            }
        );
    </script>
    <script src="/js/vendor/chart.min.js"></script>
    <script type="text/javascript">
        var rawLatestAccreditation = "{{ $latestAccreditation }}";
        var rawServerDateNow = "{{ $serverDateNow }}";
        var rawChartTitle = "{!! $soldData['title'] !!}";
        var rawBarChartData = {
            labels: {!! json_encode($soldData['labels']) !!},
            datasets: [{
                label: 'Boar',
                backgroundColor: 'rgb(255, 99, 132)',
                data: {{ json_encode($soldData['dataSets'][0]) }}
            }, {
                label: 'Sow',
                backgroundColor: 'rgb(54, 162, 235)',
                data: {{ json_encode($soldData['dataSets'][1]) }}
            }, {
                label: 'Gilt',
                backgroundColor: 'rgb(75, 192, 192)',
                data: {{ json_encode($soldData['dataSets'][2]) }}
            }, {
                label: 'Semen',
                backgroundColor: 'rgb(153, 102, 255)',
                data: {{ json_encode($soldData['dataSets'][3]) }}
            }]

        };
    </script>
    <script src="/js/breeder/dashboard.js"></script>
@endsection
