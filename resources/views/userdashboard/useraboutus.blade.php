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
  <title> About Us </title>
  @vite(['resources/css/app.css', 'resources/css/about.css', 'resources/css/sidebar.css', 'resources/css/about.css', 'resources/js/sidebar.js'])
  
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
      <li id="dashboard">
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
      <li id="aboutus"  class="active">
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
      <h3>&nbsp;About</h3>
      <hr>
      <h2>Introducing DaGAT</h2>
      <br>
      <p>DaGAT, the Document and Governance Administration Tracker, is a specialized software solution designed to streamline documentation management and governance processes for local school councils. This comprehensive platform integrates advanced document tracking, version control, and workflow automation to ensure efficient handling of critical school council documents, such as meeting minutes, policies, and budget reports. DaGAT offers robust security features, including role-based access control and audit trails, to maintain document integrity and comply with educational governance requirements. </p>

      <p>The system's user-friendly interface allows school council members, administrators, and relevant stakeholders to easily create, edit, and collaborate on documents while maintaining a clear overview of approval processes and submission deadlines. DaGAT's powerful search functionality enables quick retrieval of information across the entire document repository, facilitating rapid access to historical decisions and policy changes. With its customizable dashboard and reporting tools, DaGAT provides real-time insights into document status and council activities, empowering school leadership to make informed decisions and track progress on various initiatives. </p>

      <p>DaGAT's versatility makes it an ideal solution for managing the diverse documentation needs of school councils, from annual reports and strategic plans to committee charters and parent communication materials. The platform's scalability ensures it can adapt to the changing needs of growing school communities without compromising performance. DaGAT also features analytics capabilities, allowing councils to identify bottlenecks in their document workflows and optimize governance processes. With its cloud-based architecture, DaGAT enables secure access for council members from various locations, supporting flexible meeting arrangements and remote collaboration. The platform's regular updates introduce new features tailored to the evolving needs of school governance, ensuring DaGAT remains a valuable tool for enhancing transparency, accountability, and efficiency in local school council operations.</p>
      <br>
    </div>


  </section>
  
  <script src="{{ asset('js/sidebar.js') }}"></script>
</body>
</html>
