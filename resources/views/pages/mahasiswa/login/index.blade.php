<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; KRSan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="flex-wrap d-flex align-items-stretch">
                <div class="order-2 bg-white col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100">
                    <div class="p-4 m-3">
                        <img src="../assets/img/stisla-fill.svg" alt="logo" width="80"
                            class="mt-2 mb-5 shadow-light rounded-circle">
                        <h4 class="text-dark font-weight-normal">Selamat Datang di <span
                                class="font-weight-bold">KRSan</span>
                        </h4>
                        <p class="text-muted">Sebelum kamu melakukan KRSan, kamu perlu masuk dengan akunmu terlebih
                            dahulu nih</p>
                        <form method="POST" action="{{ route('mahasiswa.login') }}" class="needs-validation"
                            novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror"
                                    name="nim" tabindex="1" required autofocus>
                                @error('nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                    required>
                                <div class="invalid-feedback">
                                    Mohon masukkan Password kamu
                                </div>
                            </div>

                            <div class="text-right form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                    Login
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="order-1 col-lg-8 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                    data-background="https://source.unsplash.com/640x853/?bali">
                    <div class="absolute-bottom-left index-2">
                        <div class="p-5 pb-2 text-light">
                            <div class="pb-3 mb-5">
                                @if (date('H') > 0)
                                    <h1 class="mb-2 display-4 font-weight-bold">Mornin' Sunshine!</h1>
                                @elseif (date('H') > 6)
                                    <h1 class="mb-2 display-4 font-weight-bold">Good Morning</h1>
                                @elseif (date('H') > 12)
                                    <h1 class="mb-2 display-4 font-weight-bold">Good Afternoon</h1>
                                @elseif (date('H') > 17)
                                    <h1 class="mb-2 display-4 font-weight-bold">Good Evening</h1>
                                @elseif (date('H') > 22)
                                    <h1 class="mb-2 display-4 font-weight-bold">Go To Bed!</h1>
                                @endif
                                <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
                            </div>
                            Photo on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>
