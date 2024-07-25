<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="{{ asset('images/dagat_logo.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Activity Logs</title>
  @vite(['resources/css/sidebar.css', 'resources/js/sidebar.js'])
</head>

<body>
@include('includes.sidebar')

<section class="home-section">
  <div class="home-content"></div>
  <div class="container bg-light rounded">
    <br>
    <h3>&nbsp;Activity Logs</h3>
    <hr>
    <div class="row mb-3">
      <div class="col-md-4">
        <input type="text" id="dateFilter" class="form-control" placeholder="Filter by date range">
      </div>
    </div>
    <br>
    <div class="table-responsive">
      <table id="example" class="table table-hover table-light table-borderless">
        <thead>
          <tr>
            <th>Document</th>
            <th>Signatory</th>
            <th>Action</th>
            <th>Timestamp</th>
          </tr>
        </thead>
        <tbody>
          @foreach($activityLogs as $log)
          <tr>
            <td>{{ $log->document->Description ?? 'N/A' }}</td>
            <td>{{ $log->signatory->office->Office_Name ?? 'N/A' }}</td>
            <td>{{ $log->action }}</td>
            <td>{{ $log->Timestamp }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <br>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('script/sidebar.js') }}"></script>

<script>
    $(document).ready(function() {
        var table = $('#example').DataTable();

        // Date range filter
        $('#dateFilter').daterangepicker({
            opens: 'left',
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#dateFilter').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = picker.startDate;
                    var max = picker.endDate;
                    var date = new Date(data[3]); // Assuming the date is in the fourth column (index 3)
                    
                    if (
                        (min == null && max == null) ||
                        (min == null && date <= max) ||
                        (min <= date && max == null) ||
                        (min <= date && date <= max)
                    ) {
                        return true;
                    }
                    return false;
                }
            );
            table.draw();
            $.fn.dataTable.ext.search.pop();
        });

        $('#dateFilter').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            $.fn.dataTable.ext.search.pop();
            table.draw();
        });
    });
</script>

</body>
</html>
