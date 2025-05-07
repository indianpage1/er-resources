@extends('layoutss.admin.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <main class="dashboard">
    <section class="cards">
      <div class="card">
        <h3>Total Users</h3>
        <p>{{ number_format($dashboardData->total_users) }}</p>
      </div>
      <div class="card">
        <h3>Total Withdrawals</h3>
        <p>{{ number_format($dashboardData->total_withdrawals, 2) }}</p>
      </div>
      <div class="card">
        <h3>Referral Users</h3>
        <p>{{ number_format($dashboardData->referral_users) }}</p>
      </div>
      <div class="card">
        <h3>Total Investment</h3>
        <p>{{ number_format($dashboardData->total_investment, 2) }}</p>
      </div>
    </section>

    <section class="charts">
      <div class="chart-container">
        <h3>User Growth</h3>
        <div class="bar-chart">
          <div class="bar" style="height: 60%;">Jan</div>
          <div class="bar" style="height: 70%;">Feb</div>
          <div class="bar" style="height: 80%;">Mar</div>
          <div class="bar" style="height: 90%;">Apr</div>
        </div>
      </div>

      <div class="chart-container">
        <h3>Investment Over Time</h3>
        <div class="bar-chart">
          <div class="bar" style="height: 50%;">Q1</div>
          <div class="bar" style="height: 65%;">Q2</div>
          <div class="bar" style="height: 75%;">Q3</div>
          <div class="bar" style="height: 85%;">Q4</div>
        </div>
      </div>
    </section>
  </main>

</body>
</html>

<style>
    /* Reset and base styles */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background-color: #f4f6f8;
  color: #333;
}

.dashboard {
  padding: 2rem;
  padding: 30px;
  padding-top: 150px;
  padding-bottom: 100px

  
}

.cards {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  margin-bottom: 2rem;
}

.card {
  background-color: #ffffff;
  flex: 1 1 200px;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  text-align: center;
}

.card h3 {
  margin-bottom: 0.5rem;
  color: #34495e;
}

.card p {
  font-size: 1.5rem;
  font-weight: bold;
  color: #353131;
}

.charts {
  display: flex;
  flex-wrap: wrap;
  gap: 2rem;
}

.chart-container {
  background-color: #ffffff;
  flex: 1 1 300px;
  padding: 1.5rem;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.chart-container h3 {
  margin-bottom: 1rem;
  color: #34495e;
  text-align: center;
}

.bar-chart {
  display: flex;
  align-items: flex-end;
  justify-content: space-around;
  height: 200px;
  padding: 1rem 0;
}

.bar {
  width: 20%;
  background-color: #2a3336;
  text-align: center;
  color: #ecf0f1;
  border-radius: 4px 4px 0 0;
  position: relative;
}


</style>
@endsection
