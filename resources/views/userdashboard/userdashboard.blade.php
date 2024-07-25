<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <!--<title> Drop Down Sidebar Menu | CodingLab </title>-->
  <link rel="stylesheet" href="css/sidebar.css">
  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="image/x-icon" href="{{ asset('images/dagat_logo.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Dashboard </title>
  @vite(['resources/css/app.css', 'resources/css/sidebar.css', 'resources/css/dashboard.css', 'resources/js/sidebar.js'])
  </head>
  
  
</head>


<body>
   <!-- Images-->
  <div class="sidebar close">
    <div class="logo-details">
      <img src="{{ asset('images/dagat_logo.png') }}" alt="logo" class="logo-img">
      <span class="logo_name">&nbsp;&nbsp;&nbsp;DaGAT</span>
    </div>

    <!-- Links-->
    <ul class="nav-links">

    <!-- Admin-->
      <li id="dashboard" class="active">
        <a href="{{ url('/dashboard') }}">
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{ url('/userdashboard') }}">Dashboard</a></li>
        </ul>
      </li>

      <!-- Archives-->
      <li id="archives">
        <a href="archives.html">
        <i class='bx bx-briefcase-alt-2'></i>
          <span class="link_name">Archives</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="archives.html">Archives</a></li>
        </ul>
      </li>

      <!-- Activity Log-->
      <li id="activitylog">
        <a href="{{ url('/activitylog') }}">
        <i class='bx bx-list-ul'></i>
          <span class="link_name">Activity Log</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{ url('/activityLog') }}">Activity Log</a></li>
        </ul>
      </li>

      <!--Office Metrics-->

      <li id="metrics">
        <a href="{{ url('/metrics') }}">
        <i class='bx bx-bar-chart-alt'></i>
          <span class="link_name">Office Metrics</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{ url('/offices') }}">Offices Metrics</a></li>
        </ul>
      </li>


        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

      <!-- About Us-->
      <li id="aboutus">
        <a href="{{ url('/useraboutus') }}">
          <i class='bx bx-info-circle'></i>
          <span class="link_name">About Us</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{ url('/useraboutus') }}">About Us</a></li>
        </ul>
      </li>

        <!-- Log Out-->
      <li>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class='bx bx-log-out'></i>
            <span class="link_name">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <ul class="sub-menu blank">
            <li><a class="link_name" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
      </li>
    </ul>

    <!-- End Link-->
  </div>

  


  
  <section class="home-section">
    <div class="home-content">

    </div>
    <div class="container bg-light rounded">
      <br>
      <h3 class="h3dashboard">&nbsp;Dashboard</h3>
      <br>


      <!--Card box-->
      <div class="row text-center">
        <div class="col-md-4 col-12 mb-4">
          <div class="card border-left-success shadow"style="border-left: .25rem solid #3c476a !important;">
            <div class="card-body">
              <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: blue;">
                Archive Document
              </div>
              <div class=" mb-0">30</div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-12 mb-4">
          <div class="card border-left-success shadow" style="border-left: .25rem solid #3c476a !important;">
            <div class="card-body">
              <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: orange;">
                Pending
              </div>
              <div class="mb-0">2</div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-12 mb-4">
          <div class="card border-left-success shadow" style="border-left: .25rem solid #3c476a !important;">
            <div class="card-body">
              <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: green;">
                Approved
              </div>
              <div class="mb-0">10</div>
            </div>
          </div>
        </div>
      </div>

<!--Recent Logs-->
<div class="log-container">
        <div class="log-header">
            <h2>Recent Logs</h2>
            <a href="activitylog.php" class="view-more-button">View more ></a>
        </div>
        <table>
            <thead>
                <tr>
                    <th class="tb-header">File Name</th>
                    <th class="tb-header">Status</th>
                    <th class="tb-header">Office</th>
                    <th class="tb-header">Date and Time</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>File 1</td>
                    <td>Completed</td>
                    <td>Office A</td>
                    <td>2024-07-16 08:00</td>
                </tr>
                <tr>
                    <td>File 2</td>
                    <td>In Progress</td>
                    <td>Office B</td>
                    <td>2024-07-16 09:00</td>
                </tr>
                <tr>
                    <td>File 3</td>
                    <td>Pending</td>
                    <td>Office C</td>
                    <td>2024-07-16 10:00</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>

      <!-- Progress bar -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h2 class="text-header">Current Progress</h2>
          <a href="documenttracker.php" class="view-more-button">View more ></a>
        </div>
        <div class="card-body">
          <h4 class="small font-weight-bold">CIC Fest <span style="position: relative; top: 1px; float: right;">20%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">CIC Resolution <span style="position: relative; top: 1px; float: right;">40%</span></h4>
          <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">CIC AD <span style="position: relative; top: 1px; float: right;">60%</span> </h4>
          <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>

     <br>

    </div>

    <br>
    <br>
  </section>
  <script src="{{ asset('js/sidebar.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGz1FdKUbw5K6Uis61z1CrcaN5V0m0Pv8JENhIlHXEJ4U" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-QA0CXOQmFK4POnUpaW6pF1QmxVN/cI6E9Drh4u5qIc8flrPUjcbINJZLMhQ8NKWU" crossorigin="anonymous"></script>
</body>
</html>
