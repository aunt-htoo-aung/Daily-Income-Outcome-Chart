const ctx = document.getElementById('inout');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: chartLabels,
    datasets: [
      {
        label: 'Income',
        data: chartIncome,
        backgroundColor: '#1dcd49',
        borderWidth: 1
      },
      {
        label: 'Outcome',
        data: chartOutcome,
        backgroundColor: '#d32323',
        borderWidth: 1
      }
    ]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
