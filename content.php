<main>
  <!-- PM Schedule Form Starts Here -->
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Preventive Maintenance Scheduler</h1>
        <form id="pmScheduleForm" action="" method="POST">
          <div class="mb-3">
            <label for="numberOfRooms" class="form-label">Number of Guest Rooms</label>
            <input min="1" max="10000" type="number" name="numberOfRooms" class="form-control" id="numberOfRooms"
              aria-describedby="roomsCleaningHelp">
            <div id="roomsCleaningHelp" class="form-text">Enter the total number of guest rooms you want to schedule for
              Preventive Maintenance.</div>
          </div>
          <div class="mb-3">
            <label for="roomCleaningFrequency" class="form-label">Cleaning Frequency To Clean All Rooms </label>
            <select class="form-select" id="roomCleaningFrequency" name="roomCleaningFrequency"
              aria-describedby="roomCleaningFreqHelp">
              <option value="3" selected>Quarterly</option>
              <option value="4">Triannually</option>
              <option value="6">Semi Annually</option>
              <option value="12">Annually</option>
            </select>
            <div id="roomCleaningFreqHelp" class="form-text">Hear you select schedule either anually or the other
              options for
              Preventive Maintenance of rooms.</div>
          </div>
        </form>
        <button id="pmScheduleFormBtn" class="btn btn-primary mt-3">Do the Thing!</button>
      </div>
    </div>
  </section>
  <!-- PM Schedule Form Ends Here -->

  <!-- Rooms Per Month Starts Here -->
  <div class="album py-5 bg-light outputDiv d-none text-center">
    <div class="container">
      <h3 class="fw-light"> Generated Preventive Maintenance Schedule </h3>
      <h4 class="fw-light"> Days to clean all rooms for
        <span class="currentMonthSpan fst-italic fw-bold"></span>
      </h4>
      <div id="perMonthSchedule" class="mt-4 row g-3">
      </div>
      <button id="clearButton" class="btn btn-primary mt-5">Clear Schedule</button>
    </div>
  </div>
  <!-- Rooms Per Month Ends Here -->

</main>