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
        var months = [];
        var monthCount = 0;

        // build the months labels
        for (set in stats) {
            if (Object.keys(stats[set]).length >= monthCount) {
                stats[set].forEach(function(data, index) {
                    months[index] = data.month;
                });
                monthCount = Object.keys(stats[set]).length;
            }
        }
        return months;
    }

    function renderChart(stats) {
        var labels = getMonthLabel(stats);
        var data = {};

        for (entity in stats) {
            data[entity] = {};
            data[entity].values = [];
            // entity = comments
            labels.forEach(function (label, index) {
                //label = december
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
                        backgroundColor: "rgba(100,192,30,0.4)",
                        borderColor: "rgba(100,192,30,1)",
                        data: data.comments.values,
                    },
                    {
                        label: "Visuals",
                        backgroundColor: "rgba(75,192,192,0.4)",
                        borderColor: "rgba(75,192,192,1)",
                        data: data.visuals.values,
                    },
                    {
                        label: "Users",
                        backgroundColor: "rgba(75,192,192,0.4)",
                        borderColor: "rgba(75,192,40,1)",
                        data: data.users.values,
                    }
                ]
            }
        });
    }
</script>
@stop
