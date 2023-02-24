<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('asset\bootstrap\css\bootstrap.min.css') }}">
    <style type="text/css">
        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        @media (min-width: 768px) {
        .gradient-form {
        height: 100vh !important;
        }
        }
        @media (min-width: 769px) {
        .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
        }
        }
    </style>
</head>
<body class="bg-primary">

    <section class="h-100 gradient-form" style="background-color: #eee;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card rounded-3 text-black">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="card-body p-md-5 mx-md-4">

                    <div class="text-center">
                      <img src="https://roiputra.com/wp-content/uploads/2022/09/2022-06-11-62a44b515a215.png"
                        style="width: 185px;" alt="logo">
                      <h4 class="mt-1 mb-5 pb-1">We are The RPM Team</h4>
                    </div>

                    <form class="form" method="post" action="{{route('login')}}">
                        @csrf
                          <p>Please login to your account</p>

                          <div class="form-outline mb-4">
                                <input type="text" id="form2Example11" class="form-control" name="username" placeholder="Username" />
                          </div>

                          <div class="form-outline mb-4">
                                <input type="password" id="form2Example22" class="form-control" name="password" placeholder="password" />
                          </div>

                          <div class="text-center pt-1 mb-5 pb-1">
                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 w-100" type="submit">Log
                              in</button>
                          </div>

                          <div class="d-flex align-items-center justify-content-center pb-4">
                                <p class="mb-0 me-2">Don't have an account?</p>
                                <a href="{{route('viewregister')}}" type="button" class="btn btn-outline-danger">Create new</a>
                          </div>

                    </form>

                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                  <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                    <h4 class="mb-4">Kami adalah PT ROIPUTRA JAYA PROPERTINDO</h4>
                    <p class="small mb-0">yang saat ini memfokuskan usaha jasa di bidang perencanaan - pembangunan rumah tinggal / perumahan. Selain itu juga, kami menyelenggarakan jasa agen ( broker) transaksi properti. Kami bercita-cita membangun sistem yang reliabel dan nyaman bagi pelanggan, rekanan, investor, atau pemegang kepentingan lainnya sehingga kita dapat tumbuh dan berkembang bersama. Berbagi informasi - kesempatan - melakukan kolaborasi - mencapai harapan untuk bisa lebih maju dari hari ini..</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</body>
</html>
