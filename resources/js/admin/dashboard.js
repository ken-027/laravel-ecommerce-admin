class AppDashboard {
    static onLoad() {
        if (!$('#brandChart').length && !$('#modelChart').length) return;

        page = 'dashboard';

        $.ajax({
            url: '/admin/report/top-brand',
            data: {
                _token: token,
            },
            success: function(result) {
                AppDashboard.topBrand(result.data);
            }
        })

        $.ajax({
            url: '/admin/report/top-models',
            data: {
                _token: token,
            },
            success: function(result) {
                AppDashboard.topModel(result.data);
            }
        })
    }

    static topBrand(data) {
        brandChart.forEach(function(chart) {
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: [data[0][1], data[1][1], data[2][1], data[3][1], data[4][1]],
                    datasets: [{
                        label: "Number of Orders",
                        data: [data[0][2], data[1][2], data[2][2], data[3][2], data[4][2]],
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                        ],
                        borderColor: [
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                        ],
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        });
    }

    static topModel(data) {
        modelChart.forEach(function(chart) {
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: [data[0][1], data[1][1], data[2][1], data[3][1], data[4][1], data[5][1], data[6][1], data[7][1], data[8][1], data[9][1]],
                    datasets: [{
                        label: "Number of Orders",
                        data: [data[0][2], data[1][2], data[2][2], data[3][2], data[4][2], data[5][2], data[6][2], data[7][2], data[8][2], data[9][2]],
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                        ],
                        borderColor: [
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                        ],
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        });
    }
}