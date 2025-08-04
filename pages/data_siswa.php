<div class="container mt-4">
  <h3 class="mb-4">Data Siswa</h3>

  <!-- Tabs Kelas -->
  <ul class="nav nav-tabs" id="kelasTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="kelasX-tab" data-bs-toggle="tab" data-bs-target="#kelasX" type="button" role="tab">Kelas X</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="kelasXI-tab" data-bs-toggle="tab" data-bs-target="#kelasXI" type="button" role="tab">Kelas XI</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="kelasXII-tab" data-bs-toggle="tab" data-bs-target="#kelasXII" type="button" role="tab">Kelas XII</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="alumni-tab" data-bs-toggle="tab" data-bs-target="#alumni" type="button" role="tab">Alumni</button>
    </li>
  </ul>

  <div class="tab-content mt-3" id="kelasTabContent">
    <!-- Kelas X -->
    <div class="tab-pane fade show active" id="kelasX" role="tabpanel">
      <!-- Accordion Jurusan Kelas X -->
      <div class="accordion" id="accordionX">
        <!-- RPL -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="x-rpl-heading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#x-rpl" aria-expanded="false" aria-controls="x-rpl">
              RPL
            </button>
          </h2>
          <div id="x-rpl" class="accordion-collapse collapse" aria-labelledby="x-rpl-heading" data-bs-parent="#accordionX">
            <div class="accordion-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Ani RPL</td>
                    <td>1001</td>
                    <td>
                      <button class="btn btn-sm btn-warning">Edit</button>
                      <button class="btn btn-sm btn-danger">Hapus</button>
                      <button class="btn btn-sm btn-success">Naik Kelas</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- TKJ -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="x-tkj-heading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#x-tkj" aria-expanded="false" aria-controls="x-tkj">
              TKJ
            </button>
          </h2>
          <div id="x-tkj" class="accordion-collapse collapse" aria-labelledby="x-tkj-heading" data-bs-parent="#accordionX">
            <div class="accordion-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Budi TKJ</td>
                    <td>1002</td>
                    <td>
                      <button class="btn btn-sm btn-warning">Edit</button>
                      <button class="btn btn-sm btn-danger">Hapus</button>
                      <button class="btn btn-sm btn-success">Naik Kelas</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Kelas XI -->
    <div class="tab-pane fade" id="kelasXI" role="tabpanel">
      <p class="text-muted">Data siswa kelas XI belum ditambahkan.</p>
    </div>

    <!-- Kelas XII -->
    <div class="tab-pane fade" id="kelasXII" role="tabpanel">
      <p class="text-muted">Data siswa kelas XII belum ditambahkan.</p>
    </div>

    <!-- Alumni -->
    <div class="tab-pane fade" id="alumni" role="tabpanel">
      <p class="text-muted">Data alumni belum ditambahkan.</p>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
