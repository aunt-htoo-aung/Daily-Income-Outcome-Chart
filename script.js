const ctx = document.getElementById('inout');

      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [
            {
              label: 'Income',
              data: [12, 19, 3, 5, 2, 3],
              borderWidth: 1,
              backgroundColor:'#1dcd49'
            },
            {
              label: 'Outcome',
              data: [4, 8, 7, 4, 22, 13],
              borderWidth: 1,
              backgroundColor:'#d32323'
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });