@extends('layouts.app')
@section('title', 'Stats')

@section('content')
    <section class="section">
        <div class="columns">
            <div class="column is-2">
                @include('layouts.partials.sidebar')
            </div>
            <div class="column is-10">
                <nav class="level">
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
                    <canvas id="myChart" width="100" height="400"></canvas>
                </section>
            </div>
        </div>
    </section>
@stop
@section('footer-js')
@parent
<script src="{{ asset('assets/js/admin.js') }}"></script>
<script>
    var stats = null;
    axios.get('{{ route('admin.stats.count') }}')
        .then(function (response) { renderChart(response.data) })
        .catch(function (error) {});

    function getMonthLabel(stats) {
        var months = [ "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
        var now = new Date().getMonth();

        // return months from last year if current month number is less than 6
        if (now < 5) {
            var monthsWithOffset = months.slice(now - 5);
            months.forEach(function (value, index) {
                if (index > now) return;
                monthsWithOffset.push(value);
            });

            return monthsWithOffset;
        }

        return months.slice(now, now + 5);
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

        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
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
