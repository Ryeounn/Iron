const ctx = document.getElementById('quantity');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Square', 'Rectangle', 'Equilateral', 'Straight', 'Circle','Unfinished iron and steel'],
      datasets: [{
        label: 'Quantity',
        data: [1, 2, 5, 12, 14, 16],
        borderWidth: 1
      }]
    }
  });
  
  
  const ctx1 = document.getElementById('revenue');
  new Chart(ctx1, {
    type: 'radar',
    data: {
      labels: ['Square', 'Rectangle', 'Equilateral', 'Straight', 'Circle','Unfinished iron and steel'],
      datasets: [{
        label: 'Revenue',
        data: [550,260,200,2080,1050,10000],
        borderWidth: 1,
        backgroundColor: "red"
      }]
    }
  });


