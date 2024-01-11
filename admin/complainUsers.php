<?php require 'header.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Tables</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Datatables</h5>
            <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to convert to a datatable</p>

            <!-- Table with fetched data -->
            <table class="table datatable" id="complaintsTable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Complaint ID</th>
                  <th scope="col">User ID</th>
                  <th scope="col">Title</th>
                  <th scope="col">Statement</th>
                  <th scope="col">Type</th>
                  <th scope="col">Reply</th>
                  <th scope="col">Date</th>
                  <th scope="col">Email</th>
                  <th scope="col">Actions</th> 
                </tr>
              </thead>
              <tbody></tbody>
            </table>
            <!-- End Table with fetched data -->

          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<!-- Fetch and display data using JavaScript -->
<!-- Fetch and display data using JavaScript -->
<script>
  fetch('assets/php/fetch_complaints.php')
    .then(response => response.json())
    .then(data => {
      const tableBody = document.querySelector('#complaintsTable tbody');
      data.forEach((entry, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${index + 1}</td>`;
        Object.values(entry).forEach(value => {
          const cell = document.createElement('td');
          cell.textContent = value;
          row.appendChild(cell);
        });

        // Add "Reply" button
        const actionsCell = document.createElement('td');
        const replyButton = document.createElement('button');
        replyButton.textContent = 'Reply';
        replyButton.addEventListener('click', () => {
          // Redirect to the page where you can view and reply to the complaint
          window.location.href = `view_complaint.php?complaint_id=${entry.complaint_id}&user_id=${entry.user_id}`;
        });
        actionsCell.appendChild(replyButton);
        row.appendChild(actionsCell);

        tableBody.appendChild(row);
      });
    })
    .catch(error => console.error('Error fetching data:', error));
</script>
