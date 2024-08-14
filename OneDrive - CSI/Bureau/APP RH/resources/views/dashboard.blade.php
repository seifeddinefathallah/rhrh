@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <!-- Welcome Card -->
          <div class="col-lg-8 mb-4 order-0">
            <div class="card">
              <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                  <h5 class="card-title text-primary">Hello {{ Auth::user()->name }}!</h5>
                </div>
              </div>
            </div>
          </div>
    
          <!-- Leave Balances and Calendar in the Same Row -->
          <div class="row">
            <!-- Leave Balances -->
            <div class="col-lg-4 col-md-8 order-1">
              @foreach ($leaveBalances as $index => $balance)
              <div class="col-lg-12 col-md-6 col-12 mb-4">
                <div class="card {{ 'card-style-' . $index }}">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img src="{{ asset('backend/assets/img/icons/unicons/' . ($index === 0 ? 'wallet-info.png' : ($index === 1 ? 'chart-success.png' : ($index === 2 ? 'cc-warning.png' : 'wallet.png')))) }}" alt="Leave Type" class="rounded" />
                      </div>
                      <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt{{ $index }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt{{ $index }}">
                          <a class="dropdown-item" href="javascript:void(0);">View More</a>
                          <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                      </div>
                    </div>
                    <h5 class="card-title mt-3">Congé {{ $balance->name }}</h5>
                    <p class="mb-1">Jours restants: <span class="fw-bold">{{ $balance->remaining_days }} J</span></p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
    
            <!-- Calendar Section -->
            <div class="col-lg-8 col-md-6">
              <div class="card mb-4">
                <div class="card-body">
                  <div id='full_calendar_events'></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      $(document).ready(function () {
          var SITEURL = "{{ url('/') }}";
          var daysOff = []; // Tableau pour stocker les jours de congé
      
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
      
          function loadDaysOff() {
              $.ajax({
                  url: SITEURL + "/leave-requests/approved",
                  dataType: 'json',
                  success: function(data) {
                      daysOff = data.map(function(item) {
                          return item.start; // Assumer que data contient des objets avec une propriété 'start'
                      });
                  },
                  error: function(xhr, status, error) {
                      console.error('Erreur lors du chargement des jours de congé:', xhr.responseText);
                  }
              });
          }
      
          loadDaysOff(); // Appeler la fonction pour charger les jours de congé
      
          function isDatePassed(date) {
              var today = new Date();
              var selectedDate = new Date(date);
              return selectedDate < today && selectedDate.toDateString() !== today.toDateString();
          }
      
          function showAlert(title, text) {
              Swal.fire({
                  icon: 'error',
                  title: title,
                  text: text,
                  confirmButtonColor: '#03428e',
                  timer: 5000
              }).then(() => {
                  $('#full_calendar_events').fullCalendar('unselect');
              });
          }
      
          function showSuccessAlert(title, text) {
              Swal.fire({
                  icon: 'success',
                  title: title,
                  text: text,
                  confirmButtonColor: '#03428e',
                  timer: 5000,
                  backdrop: `
                      rgba(0,0,123,0.4)
                      url("/images/success-bg.jpg")
                      center left
                      no-repeat
                  `,
                  customClass: {
                      title: 'swal-title',
                      text: 'swal-text'
                  }
              });
          }
      
          $('#full_calendar_events').fullCalendar({
              editable: true,
              events: function(start, end, timezone, callback) {
                  $.ajax({
                      url: SITEURL + "/leave-requests/approved",
                      dataType: 'json',
                      success: function(data) {
                          var events = [];
                          $(data).each(function() {
                              events.push({
                                  id: this.id,
                                  title: this.title,
                                  start: this.start,
                                  end: this.end,
                                  allDay: this.allDay,
                                  backgroundColor: this.backgroundColor
                              });
                          });
                          callback(events);
                      },
                      error: function(xhr, status, error) {
                          console.error('Erreur lors du chargement des événements:', xhr.responseText);
                      }
                  });
              },
              displayEventTime: true,
              selectable: true,
              selectHelper: true,
              select: function (start, end, allDay) {
                  var formattedDate = $.fullCalendar.formatDate(start, "Y-MM-DD");
      
                  if (isDatePassed(formattedDate)) {
                      showAlert('Date invalide', 'Vous ne pouvez pas sélectionner cette date car elle est passée.');
                      return;
                  }
      
                  var isDayOff = daysOff.includes(formattedDate);
      
                  if (isDayOff) {
                      showAlert('Jour de congé', 'Vous ne pouvez pas sélectionner cette date car c\'est un jour de congé.');
                      return;
                  }
      
                  var day = start.day(); // 0 est dimanche, 6 est samedi
                  if (day === 0 || day === 6) {
                      Swal.fire({
                          icon: 'error',
                          title: 'Sélection de week-end interdite',
                          text: 'Les week-ends ne sont pas disponibles. Veuillez sélectionner un jour de semaine.',
                          confirmButtonColor: '#03428e',
                          timer: 5000
                      }).then(() => {
                          $('#full_calendar_events').fullCalendar('unselect');
                      });
                      return;
                  }
      
                  // Fetch the creation URL with the selected start date
                  $.ajax({
                      url: SITEURL + "/leave-requests/generate-create-url",
                      data: { start: formattedDate },
                      success: function(response) {
                          window.location.href = response.url;
                      },
                      error: function(xhr, status, error) {
                          console.error('Erreur lors de la génération de l\'URL de création de demande:', xhr.responseText);
                      }
                  });
              },
              eventDrop: function (event, delta) {
                  var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                  var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
      
                  if (isDatePassed(event_start)) {
                      showAlert('Date invalide', 'Vous ne pouvez pas déplacer l\'événement à une date passée.');
                      return;
                  }
      
                  $.ajax({
                      url: SITEURL + '/calendar-crud-ajax',
                      data: {
                          title: event.title,
                          start: event_start,
                          end: event_end,
                          id: event.id,
                          type: 'edit'
                      },
                      type: "POST",
                      success: function (response) {
                          Swal.fire({
                              icon: 'success',
                              title: 'Événement mis à jour',
                              text: 'L\'événement a été mis à jour avec succès.',
                              confirmButtonColor: '#03428e',
                              timer: 5000
                          });
                      },
                      error: function (xhr, status, error) {
                          console.error('Erreur lors de la mise à jour de l\'événement:', xhr.responseText);
                      }
                  });
              },
              eventClick: function (event) {
                  var eventDelete = confirm("Êtes-vous sûr?");
                  if (eventDelete) {
                      $.ajax({
                          type: "POST",
                          url: SITEURL + '/calendar-crud-ajax',
                          data: {
                              id: event.id,
                              type: 'delete'
                          },
                          success: function (response) {
                              Swal.fire({
                                  icon: 'success',
                                  title: 'Événement supprimé',
                                  text: 'L\'événement a été supprimé avec succès.',
                                  confirmButtonColor: '#03428e',
                                  timer: 5000
                              });
                              $('#full_calendar_events').fullCalendar('removeEvents', event.id);
                          },
                          error: function (xhr, status, error) {
                              console.error('Erreur lors de la suppression de l\'événement:', xhr.responseText);
                          }
                      });
                  }
              },
              dayRender: function (date, cell) {
                  var day = date.day(); // 0 est dimanche, 6 est samedi
      
                  if (day === 0 || day === 6) {
                      cell.css("background-color", "#d3d3d3");
                      cell.css("pointer-events", "none"); // Désactiver les interactions
                  }
      
                  if (isDatePassed(date.format())) {
                      cell.css("background-color", "#f0f0f0");
                      cell.css("pointer-events", "none"); // Désactiver les interactions pour les jours passés
                  }
              },
              selectAllow: function(selectInfo) {
                  var formattedDate = $.fullCalendar.formatDate(selectInfo.start, "Y-MM-DD");
      
                  var isDayOff = daysOff.includes(formattedDate);
      
                  return !isDayOff && !isDatePassed(formattedDate);
              }
          });
      });
      </script>
      
  

@endsection