<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
  <title>Document</title>
</head>

<body>
  @if(auth()->user()->role_id == 1)
    <x-navbar :title="'Admin Panel'" :links="[
      ['label' => 'Home', 'url' => route('admin.home')],
      ['label' => 'To Do List', 'url' => route('admin.todo')],
      ['label' => 'Message', 'url' => route('admin.message')],
      ['label' => 'Calendar', 'url' => route('admin.calendar')],
      ['label' => 'Logout', 'url' => '#', 'onclick' => 'event.preventDefault(); document.getElementById(\'logout-form\').submit();']
    ]" />
  @elseif(auth()->user()->role_id == 2)
    <x-navbar :title="'User Panel'" :links="[
      ['label' => 'Home', 'url' => route('user.home')],
      ['label' => 'Tasks', 'url' => route('user.todo')],
      ['label' => 'Messages', 'url' => route('user.message')],
      ['label' => 'Calendar', 'url' => route('user.calendar')],
      ['label' => 'Logout', 'url' => '#', 'onclick' => 'event.preventDefault(); document.getElementById(\'logout-form\').submit();']
    ]" />
  @endif
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
  </form>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-3">
        <div id='calendar'>

        </div>
      </div>
    </div>
  </div>

  <div id="click-modal" class="modal" tabindex="-1">

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.15/index.global.min.js'></script>

  <script>
    document.querySelector('[href="#"]').addEventListener('click', function (event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
    const modal = $('#click-modal')
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        events: `{{ route('event.list') }}`,
        dateClick: function (info) {
          console.log(info);

          $.ajax({
            url: '{{ route('event.create') }}',
            data: {
              start_date: info.dateStr,
              end_date: info.dateStr
            },
            success: function (res) {
              modal.html(res).modal('show')
            }
          })

          $('#click-modal').modal('show')
        }
      });
      calendar.render();
    });

  </script>
</body>

</html>