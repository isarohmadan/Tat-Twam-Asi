document.addEventListener("DOMContentLoaded", function () {
  const ctx = document.getElementById("myAreaChart").getContext("2d");
  const chartData = window.chartData;

  new Chart(ctx, {
      type: 'line',
      data: {
          labels: chartData.labels,
          datasets: [{
              label: "Jumlah Anak",
              lineTension: 0.3,
              backgroundColor: "rgba(2,117,216,0.2)",
              borderColor: "rgba(2,117,216,1)",
              pointRadius: 5,
              pointBackgroundColor: "rgba(2,117,216,1)",
              pointBorderColor: "rgba(255,255,255,0.8)",
              pointHoverRadius: 5,
              pointHoverBackgroundColor: "rgba(2,117,216,1)",
              pointHitRadius: 50,
              pointBorderWidth: 2,
              data: chartData.values,
          }],
      },
      options: {
          scales: {
              xAxes: [{
                  type: 'category',
                  gridLines: { display: false },
                  ticks: { maxTicksLimit: 12 }
              }],
              yAxes: [{
                  ticks: {
                      beginAtZero: true,
                      precision: 0
                  },
                  gridLines: {
                      color: "rgba(0, 0, 0, .125)",
                  }
              }]
          },
          legend: { display: false }
      }
  });
});
