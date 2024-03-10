@extends('backend.master')

@section('content')

<div class="br-pagetitle">
<i class="icon ion-ios-home-outline"></i>
<div>
  <h4><span style="text-transform: capitalize;">Admin</span> Dashboard</h4>
  <p class="mg-b-0">Welcome Admin, You can manage all the tasks from dashboard.</p>
</div>
</div>

<div class="br-pagebody">
<div class="row row-sm">
  <div class="col-sm-6 col-xl-3">
    <div class="bg-info rounded overflow-hidden">
      <div class="pd-x-20 pd-t-20 d-flex align-items-center">
        <i class="ion ion-android-people  tx-60 lh-0 tx-white op-7"></i>
        <div class="mg-l-20">
          <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Order</p>
          <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">0</p>
        </div>
      </div>
      <div id="ch1" class="ht-50 tr-y-1"></div>
    </div>
  </div><!-- col-3 -->
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
    <div class="bg-purple rounded overflow-hidden">
      <div class="pd-x-20 pd-t-20 d-flex align-items-center">
        <i class="ion ion-android-people  tx-60 lh-0 tx-white op-7"></i>
        <div class="mg-l-20">
          <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">User</p>
          <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">0</p>
        </div>
      </div>
      <div id="ch3" class="ht-50 tr-y-1"></div>
    </div>
  </div><!-- col-3 -->
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
    <div class="bg-teal rounded overflow-hidden">
      <div class="pd-x-20 pd-t-20 d-flex align-items-center">
        <i class="ion ion-android-people  tx-60 lh-0 tx-white op-7"></i>
        <div class="mg-l-20">
          <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Products</p>
          <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">0</p>
        </div>
      </div>
      <div id="ch2" class="ht-50 tr-y-1"></div>
    </div>
  </div><!-- col-3 -->
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
    <div class="bg-primary rounded overflow-hidden">
      <div class="pd-x-20 pd-t-20 d-flex align-items-center">
        <i class="ion ion-android-list tx-60 lh-0 tx-white op-7"></i>
        <div class="mg-l-20">
          <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Today order</p>
          <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">0</p>
        </div>
      </div>
      <div id="ch4" class="ht-50 tr-y-1"></div>
    </div>
  </div><!-- col-3 -->
</div><!-- row -->



<div class="row mt-4">
  
  <div class="col-lg-12">
    <div class="card bd-0 shadow-base">
      <div class="d-md-flex justify-content-between pd-25">
        <div>
          <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">How Engaged Our Users Daily</h6>
          <p>Past 10 Days — Last Updated {{ Date('d M, Y')}}</p>
        </div>
{{--           <div class="d-sm-flex">
          <div>
            <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Bounce Rate</p>
            <h4 class="tx-lato tx-inverse tx-bold mg-b-0">23.32%</h4>
            <span class="tx-12 tx-success tx-roboto">2.7% increased</span>
          </div>
          <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
            <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Page Views</p>
            <h4 class="tx-lato tx-inverse tx-bold mg-b-0">38.20%</h4>
            <span class="tx-12 tx-danger tx-roboto">4.65% decreased</span>
          </div>
          <div class="bd-sm-l pd-sm-l-20 mg-sm-l-20 mg-t-20 mg-sm-t-0">
            <p class="mg-b-5 tx-uppercase tx-10 tx-mont tx-semibold">Time On Site</p>
            <h4 class="tx-lato tx-inverse tx-bold mg-b-0">12:30</h4>
            <span class="tx-12 tx-success tx-roboto">1.22% increased</span>
          </div>
        </div><!-- d-flex --> --}}
      </div><!-- d-flex -->

      <div class="pd-l-25 pd-r-15 pd-b-25">
        <div id="ch5" class="ht-250 ht-sm-300"></div>
      </div>
    </div>


  </div><!-- col-8 -->
</div>

</div><!-- br-pagebody -->

@endsection



@push('script')
  
  {{-- find last 10 days registrations --}}
  {{-- @php
    // dd(now()->toDateTimeString());
    // dd(today());
    // dd(App\Models\User::whereDate('created_at', now()->subDays(2)->setTime(0, 0, 0)->toDateTimeString())->count());
    $ten_day_data = [];
    $max = 0;
    for($i=9;$i>=0;$i--){
      $user_count = App\Models\User::whereDate('created_at', now()->subDays($i)->setTime(0, 0, 0)->toDateTimeString())->count();
      $user_count_pair = [
        $i,
        $user_count
      ]; 

      if($user_count > $max){
        $max = $user_count;
      }

      array_push($ten_day_data, $user_count_pair); 
    }
    $ten_day_data = json_encode($ten_day_data);
    $max = $max *2;
      // dd($ten_day_data);    
  @endphp --}}

  <script>

    //console.log('ten_day_data');
    //console.log(JSON.parse(''));
  // var newCust = JSON.parse('{!! '$ten_day_data' !!}');
  var newCust = [[0, 8], [1, 7], [2,7], [3, 8], [4, 7], [5, 8], [6, 9], [7, 9], [8, 9], [9, 8], [10, 9]];
  // var retCust = [[0, 1], [1, 2], [2,3], [3, 3], [4, 2], [5, 3], [6, 4], [7, 5], [8, 4], [9, 5], [10, 4], [11, 4], [12, 3], [13,4], [14, 4], [15, 5], [16, 5], [17, 4], [18, 6], [19, 7]];

  var plot = $.plot($('#ch5'),[
    {
      data: newCust,
      label: 'User Registration',
      color: '#17A2B8'
    },
    // {
    //   data: retCust,
    //   label: 'Subscriptions',
    //   color: '#4E6577'
    // }
  ],
  {
    series: {
      lines: {
        show: false
      },
      splines: {
        show: true,
        tension: 0.4,
        lineWidth: 0,
        fill: 0.5
      },
      shadowSize: 0
    },
    points: {
      show: false,
    },
    grid: {
      hoverable: true,
      clickable: true,
      borderColor: '#ddd',
      borderWidth: 0,
      labelMargin: 5,
      backgroundColor: '#fff'
    },
    yaxis: {
      min: 0,
      max: {{$max ?? 15}},
      color: '#eee',
      font: {
        size: 10,
        color: '#999'
      }
    },
    xaxis: {
      color: '#eee',
      font: {
        size: 10,
        color: '#999'
      }
    }
  }
  );
  </script>
@endpush
