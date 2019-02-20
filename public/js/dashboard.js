'use strict';
$(document).ready(function() {


    $.ajax({
        type: "GET",
        url: "dashboard",
        success: function (response) {

            var data=[];

            $.each(response.eventArr, function( key, value ) {
                data.push(value);
            });

           
            new Chart(document.getElementById("event-analytics"), {
                type: 'line',
                data: {
                  labels: month,
                  datasets: [{ 
                    label: "Events Active",
                    borderWidth: 2,
                           backgroundColor: "rgba(6, 167, 125, 0.1)",
                           borderColor: "rgba(6, 167, 125, 1)",
                           pointBackgroundColor: "rgba(225, 225, 225, 1)",
                           pointBorderColor: "rgba(6, 167, 125, 1)",
                           pointHoverBackgroundColor: "rgba(6, 167, 125, 1)",
                           pointHoverBorderColor: "#fff",
                   data: data
                  }
                  ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                  title: {
                    display: false,
                  }
                }
              });
              
        }
    });

    var ctx = document.getElementById('user-chart').getContext("2d");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: valincome('#fff', [25, 30, 20, 15, 20], '#fff'),
        options: valincomebuildoption(),
    });
    var ctx = document.getElementById('events-chart').getContext("2d");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: valincome('#fff', [10, 30, 20, 15, 30], '#fff'),
        options: valincomebuildoption(),
    });
    var ctx = document.getElementById('active-chart').getContext("2d");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: valincome('#fff', [25, 10, 20, 15, 20], '#fff'),
        options: valincomebuildoption(),
    });
    var ctx = document.getElementById('exp-chart').getContext("2d");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: valincome('#fff', [25, 30, 20, 15, 10], '#fff'),
        options: valincomebuildoption(),
    });

    function valincome(a, b, f) {
        if (f == null) {
            f = "rgba(0,0,0,0)";
        }
        return {
            labels: ["1", "2", "3", "4", "5"],
            datasets: [{
                label: "",
                borderColor: a,
                borderWidth: 0,
                hitRadius: 30,
                pointRadius: 0,
                pointHoverRadius: 4,
                pointBorderWidth: 2,
                pointHoverBorderWidth: 12,
                pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                pointBorderColor: a,
                pointHoverBackgroundColor: a,
                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                fill: true,
                backgroundColor: Chart.helpers.color(f).alpha(1).rgbString(),
                data: b,
            }]
        };
    }

    function valincomebuildoption() {
        return {
            maintainAspectRatio: false,
            title: {
                display: false,
            },
            tooltips: {
                enabled: false,
            },
            legend: {
                display: false
            },
            hover: {
                mode: 'index'
            },
            scales: {
                xAxes: [{
                    display: false,
                    gridLines: false,
                    scaleLabel: {
                        display: true,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: false,
                    gridLines: false,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    },
                    ticks: {
                        min: 1,
                    }
                }]
            },
            elements: {
                point: {
                    radius: 4,
                    borderWidth: 12
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 0,
                    top: 15,
                    bottom: 0
                }
            }
        };
    }
  
});