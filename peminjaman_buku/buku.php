<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css2/style.css">
  
  </head>
  <body>
    <div class="container">
        <!-- NAV & TAB -->
        <ul class="nav nav-tabs">
            <li class="nav-item mt-2">
              <a class="nav-link active mynav text-center" aria-current="page" href="buku.php">Peminjaman Buku</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link mynav text-center" aria-current="page" href="peminjam.php">Daftar Peminjam</a>
            </li>
          </ul>
        <!-- SEARCH -->
        <div class="row w-100">

            <form class="d-flex input-group mt-3" role="search">
                <input class="form-control border-primary" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>

            <div class="col-12 col-md-8 mb-3 mt-2">
        <!-- DAFTAR BUKU -->
            <ul class="list-group">
                  <li class="list-group-item">
                      <div class="row g-1">
                          <div class="col-md-2">
                            <img src="assets/images/tensura volume 20.jpg" class="img-fluid rounded-start" alt="...">
                          </div>
                          <div class="col-md-6">
                            <div class="card-body">
                              <h5 class="card-title text-center">Tensei Shitara Slime Datta Ken Vol.20</h5>
                              <a href="" class="button text-decoration-none">#Action</a>
                              <a href="" class="button text-decoration-none">#Comedy</a>
                              <a href="" class="button text-decoration-none">#Fantasy</a>
                              <div class="d-grid gap-2 px-2 pt-2">
                                  <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Modal">Detail</button>
                                  <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#pinjam1">Pinjam Buku</button>
                              </div>
                              <!-- POP UP DETAIL -->
                              <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Buku</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="row g-2">
                                              <div class="col-md-4">
                                                  <img src="assets/images/tensura volume 20.jpg" class="img-fluid rounded-start" alt="...">
                                              </div>
                                              <div class="col-md-8">
                                                  <div class="card-body">
                                                      <h5>Judul : Tensei Shitara Slime Datta Ken Vol.20</h5>
                                                      <h6>Deskripsi : <p class="fw-normal fs-6 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, suscipit!</p> </h6>
                                                      <h6>Pengarang : Fuse Sensei</h6>
                                                      <h6>Penulis : JTF </h6>
                                                      <h6>Penerbit : </h6>
                                                      <h6>Tanggal terbit :</h6>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- POP UP PEMINJAMAN -->
                                <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="pinjam1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Form Peminjaman</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                      <form>
                                        <div class="mb-3">
                                          <label for="nama" class="form-label">Nama :</label>
                                          <input type="text" class="form-control" id="nama">
                                        </div>
                                        <div class="mb-3">
                                          <label for="kelas" class="form-label">Kelas :</label>
                                          <input type="text" class="form-control" id="kelas">
                                        </div>
                                        <div class="mb-3">
                                          <label for="kontak" class="form-label">Kontak :</label>
                                          <input type="text" class="form-control" id="kontak">
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary align-center">Submit</button>
                                        <button type="" class="btn btn-outline-danger">Cancel</button>
                                      </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                  </li>
                  <li class="list-group-item">
                    <div class="row g-1">
                        <div class="col-md-2">
                          <img src="assets/images/tensura volume 19.jpg" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-6">
                          <div class="card-body">
                            <h5 class="card-title text-center">Tensei Shitara Slime Datta Ken Vol.19</h5>
                            <!-- <h6 class="card-title text-start"> #Action #Comedy #Fantasy</h6> -->
                            <a href="" class="button text-decoration-none">#Action</a>
                            <a href="" class="button text-decoration-none">#Comedy</a>
                            <a href="" class="button text-decoration-none">#Fantasy</a>
                            <div class="d-grid gap-2 px-2 pt-2">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Modal1">Detail</button>
                                <button class="btn btn-outline-primary" type="button">Pinjam Buku</button>
                            </div>
                            <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Buku</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-2">
                                            <div class="col-md-4">
                                                <img src="assets/images/tensura volume 19.jpg" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                  <h5>Judul : Tensei Shitara Slime Datta Ken Vol.20</h5>
                                                  <h6>Deskripsi : <p class="fw-normal fs-6 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, suscipit!</p> </h6>
                                                  <h6>Pengarang : Fuse Sensei</h6>
                                                  <h6>Penulis : JTF </h6>
                                                  <h6>Penerbit : </h6>
                                                  <h6>Tanggal terbit :</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                  <div class="row g-1">
                      <div class="col-md-2">
                        <img src="assets/images/tensura volume 18.jpg" class="img-fluid rounded-start" alt="...">
                      </div>
                      <div class="col-md-6">
                        <div class="card-body">
                          <h5 class="card-title text-center">Tensei Shitara Slime Datta Ken Vol.18</h5>
                          <!-- <h6 class="card-title text-start"> #Action #Comedy #Fantasy</h6> -->
                          <a href="" class="button text-decoration-none">#Action</a>
                          <a href="" class="button text-decoration-none">#Comedy</a>
                          <a href="" class="button text-decoration-none">#Fantasy</a>
                          <div class="d-grid gap-2 px-2 pt-2">
                              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Modal2">Detail</button>
                              <button class="btn btn-outline-primary" type="button">Pinjam Buku</button>
                          </div>
                          <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Buku</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="row g-2">
                                          <div class="col-md-4">
                                              <img src="assets/images/tensura volume 18.jpg" class="img-fluid rounded-start" alt="...">
                                          </div>
                                          <div class="col-md-8">
                                              <div class="card-body">
                                                  <h5>Judul : Tensei Shitara Slime Datta Ken Vol.20</h5>
                                                  <h6>Deskripsi : <p class="fw-normal fs-6 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, suscipit!</p> </h6>
                                                  <h6>Pengarang : Fuse Sensei</h6>
                                                  <h6>Penulis : JTF </h6>
                                                  <h6>Penerbit : </h6>
                                                  <h6>Tanggal terbit :</h6>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
              </li>
        </ul>
        </div>
        <!-- RANKING BUKU -->
            <div class="col-12 col-md-4 mt-2">
                <ol class="list-group list-group-numbered">
                    
                    <h2>Top Buku</h2>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Tensei Shitara Slime Datta Ken Vol.19</div>
                        Content for list item
                      </div>
                      <span class="badge bg-primary rounded-pill">30</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Tensei Shitara Slime Datta Ken Vol.20</div>
                        Content for list item
                      </div>
                      <span class="badge bg-primary rounded-pill">25</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Tensei Shitara Slime Datta Ken Vol.17</div>
                        Content for list item
                      </div>
                      <span class="badge bg-primary rounded-pill">23</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold"></div>
                          Content for list item
                        </div>
                        <span class="badge bg-primary rounded-pill">0</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold"></div>
                          Content for list item
                        </div>
                        <span class="badge bg-primary rounded-pill">0</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold"></div>
                          Content for list item
                        </div>
                        <span class="badge bg-primary rounded-pill">0</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold"></div>
                          Content for list item
                        </div>
                        <span class="badge bg-primary rounded-pill">0</span>
                      </li>
                  </ol>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>