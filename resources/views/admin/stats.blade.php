@extends('layouts.app')
@section('title', 'Stats')

@section('breadcrumbs')
    @breadcrumbs(['Home' => 'index', 'Profile' => 'user.home'])
@endsection

@section('content')
    <section class="section">
        <div class="columns">
            <a class="is-hidden-tablet" href="{{ route('user.home') }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
            <div class="column is-2 is-hidden-mobile">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column is-10">
                <nav class="level is-mobile">
                  <div class="level-item has-text-centered">
                    <div>
                      <p class="heading">Visuals</p>
                      <p class="title">{{ $visuals }}</p>
                    </div>
                  </div>
                  <div class="level-item has-text-centered">
                    <div>
                      <p class="heading">Users</p>
                      <p class="title">{{ $users }}</p>
                    </div>
                  </div>
                  <div class="level-item has-text-centered">
                    <div>
                      <p class="heading">Comments</p>
                      <p class="title">{{ $comments }}</p>
                    </div>
                  </div>
                  <div class="level-item has-text-centered">
                    <div>
                      <p class="heading">Total Views</p>
                      <p class="title">{{ $totalViews }}</p>
                    </div>
                  </div>
                </nav>
                <section class="section">
                    <canvas id="stats" width="100" height="400"></canvas>
                </section>
            </div>
        </div>
    </section>
@stop
@section('footer-js')
@parent
<script src="{{ mix('assets/js/admin.js') }}"></script>
<script>
    var stats = null;
    axios.get('{{ route('admin.stats.count') }}')
        .then(function (response) { renderChart(response.data) })
        .catch(function (error) {});

    function getMonthLabel(stats) {
        var months = [ "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
        var currentMonth = new Date().getMonth(); // getMonth() starts from 0

        // return months from last year
        if (currentMonth < 5) {
            // get months from the back of the array
            var monthsWithOffset = months.slice(currentMonth - 5);
            months.forEach(function (value, index) {
                // stop if we at the current month
                if (index > currentMonth) return;
                monthsWithOffset.push(value);
            });

            return monthsWithOffset;
        }

        return months.slice(0, currentMonth + 1);
    }

    function renderChart(stats) {
        var labels = getMonthLabel(stats);
        var data = {};

        for (entity in stats) {
            data[entity] = {};
            data[entity].values = [];
            labels.forEach(function (label, index) {
                data[entity].values[index] = 0;
                stats[entity].forEach(function (month) {
                    if (label === month.month) {
                        data[entity].values[index] = month.count;
                    }
                });
            });
        }

        var ctx = document.getElementById("stats");
        var stats = new Chart(ctx, {
            type: 'line',
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Comments",
                        backgroundColor: "rgba(201,214,223,0.4)",
                        borderColor: "rgba(201,214,223,1)",
                        data: data.comments.values,
                    },
                    {
                        label: "Visuals",
                        backgroundColor: "rgba(63,193,201,0.4)",
                        borderColor: "rgba(63,193,201,1)",
                        data: data.visuals.values,
                    },
                    {
                        label: "Users",
                        backgroundColor: "rgba(252,81,133,0.4)",
                        borderColor: "rgba(252,81,133,1)",
                        data: data.users.values,
                    }
                ]
            }
        });
    }
</script>
@stop
