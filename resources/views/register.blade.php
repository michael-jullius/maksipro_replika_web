<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('asset\bootstrap\css\bootstrap.min.css') }}">
    <style type="text/css">
        @media (min-width: 1025px) {
            .h-custom {
                height: 100vh !important;
            }
        }
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }
        .card-registration .select-arrow {
            top: 13px;
        }

        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #a1c4fd;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
        }

        .bg-indigo {
            background-color: #4835d4;
        }
        @media (min-width: 992px) {
            .card-registration-2 .bg-indigo {
                border-top-right-radius: 15px;
                border-bottom-right-radius: 15px;
            }
        }
        @media (max-width: 991px) {
            .card-registration-2 .bg-indigo {
                border-bottom-left-radius: 15px;
                border-bottom-right-radius: 15px;
            }
        }
    </style>
</head>
<body class="bg-primary">
    <form class="form " method="post" action="{{route('register')}}">
        @csrf
        <section class="h-100 h-custom gradient-custom-2">
          <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                  <div class="card-body p-0">
                    <div class="row g-0">
                      <div class="col-lg-6">
                        <div class="p-5">
                          <h3 class="fw-normal mb-5" style="color: #4835d4;">User Registration</h3>

                          <div class="row">
                            <div class="col-md-6 mb-4 pb-2">

                              <div class="form-outline">
                                <input type="text" id="form3Examplev2" class="form-control form-control-lg" name="namadepan" />
                                <label class="form-label" for="form3Examplev2">First name</label>
                              </div>

                            </div>
                            <div class="col-md-6 mb-4 pb-2">

                              <div class="form-outline">
                                <input type="text" id="form3Examplev3" class="form-control form-control-lg" name="namabelakang"/>
                                <label class="form-label" for="form3Examplev3">Last name</label>
                              </div>

                            </div>
                          </div>


                          <div class="mb-4 pb-2">
                            <div class="form-outline">
                              <input type="text" id="form3Examplev4" class="form-control form-control-lg" name="username"/>
                              <label class="form-label" for="form3Examplev4">Username</label>
                            </div>
                          </div>

                          <div class="mb-4 pb-2">
                            <div class="form-outline">
                              <input type="text" id="form3Examplev4" class="form-control form-control-lg" name="password"/>
                              <label class="form-label" for="form3Examplev4">password</label>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="col-lg-6 bg-indigo text-white">
                        <div class="p-5">
                          <h3 class="fw-normal mb-5">Company Details</h3>

                          <div class="mb-4 pb-2">
                            <div class="form-outline form-white">
                              <input type="text" id="form3Examplea2" class="form-control form-control-lg" name="nama_perusahaan"/>
                              <label class="form-label" for="form3Examplea2">Nama Perusahaan</label>
                            </div>
                          </div>

                          <div class="mb-4 pb-2">
                            <div class="form-outline form-white">
                              <input type="text" id="form3Examplea3" class="form-control form-control-lg" name="nama_direktur"/>
                              <label class="form-label" for="form3Examplea3">Nama Direktur</label>
                            </div>
                          </div>

                          <div class="mb-4 pb-2">
                            <div class="form-outline form-white">
                              <input type="text" id="form3Examplea3" class="form-control form-control-lg" name="nama_estimator"/>
                              <label class="form-label" for="form3Examplea3">Nama Estimator</label>
                            </div>
                          </div>

                          <div class="mb-4 pb-2">
                            <div class="form-outline form-white">
                              <input type="text" id="form3Examplea6" class="form-control form-control-lg" name="npwp" />
                              <label class="form-label" for="form3Examplea6">NPWP</label>
                            </div>
                          </div>

                          <div class="mb-4 pb-2">
                            <div class="form-outline form-white">
                              <input type="text" id="form3Examplea6" class="form-control form-control-lg" name="no_siup_tdp"/>
                              <label class="form-label" for="form3Examplea6">Nomor SIUP, TDP</label>
                            </div>
                          </div>

                        <div class="mb-4 pb-2">
                            <div class="form-outline form-white">
                              <input type="text" id="form3Examplea3" class="form-control form-control-lg" name="no_tlp"/>
                              <label class="form-label" for="form3Examplea3">No Telephone Perusahaan</label>
                            </div>
                        </div>

                        <div class="mb-4 pb-2">
                            <div class="form-outline form-white">
                              <input type="text" id="form3Examplea6" class="form-control form-control-lg" name="kota"/>
                              <label class="form-label" for="form3Examplea6">Kota / Kabupaten</label>
                            </div>
                        </div>
                          
                          <div class="mb-4">
                            <div class="form-outline form-white">
                                <textarea class="form-control form-control-lg"  style="height:100px;" name="alamat" required></textarea>
                                <label class="form-label" for="form3Examplea9">Alamat Perusahaan</label>
                            </div>
                          </div>

                          <button type="submit" class="btn btn-light btn-lg"
                            data-mdb-ripple-color="dark">Register</button>

                        <p style="font-size: 20px;" class="mt-3">have accounts ? <a href="{{route('viewlogin')}}" style="font-size: 20px; color: orange;">login</a></p>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </form>
</body>
</html>
