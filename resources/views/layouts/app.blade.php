<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireStyles
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('includes.navbar')

            @auth('mahasiswa')
                @include('includes.mahasiswa.sidebar')
            @endauth

            @auth('pegawai')
                @include('includes.pegawai.sidebar')
            @endauth


            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('title')</h1>
                    </div>
                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>
            @include('includes.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>

    {{-- Custom JS Page --}}
    @stack('scripts')
    @stack('modals')

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ $message }}',
                icon: 'success',
                confirmButtonText: 'Okay'
            })
        </script>
    @endif
    @if ($message = Session::get('failed'))
        <script>
            Swal.fire({
                title: 'Gagal!',
                text: '{{ $message }}',
                icon: 'error',
                confirmButtonText: 'Okay'
            })
        </script>
    @endif



    @livewireScripts
    <script>
        Livewire.on('nilai-update', () => {
            iziToast.success({
                title: 'Sukses',
                message: 'Berhasil memasukkan nilai!',
                position: 'topRight',
                timeout: 2000
            });
        })
        window.addEventListener('message-update', () => {
            var div = document.getElementById("chatbox");
            $('#chatbox').animate({
                scrollTop: div.scrollHeight - div.clientHeight
            });
        })

        document.addEventListener('livewire:load', function() {
            @auth('mahasiswa')
                Echo.channel('user-message.' + "{{ auth('mahasiswa')->user()->id }}")
                .listen('MessageEvent', (e) => {
                iziToast.info({
                title: 'Info',
                message: 'Ada pesan masuk!',
                position: 'topRight',
                timeout: 2000
                });
            
                var audio = new Audio("{{ asset('assets/sounds/notif.mp3') }}");
                audio.play();
            
                })
            @endauth
            @auth('pegawai')
                Echo.channel('user-message.' + "{{ auth('pegawai')->user()->id }}")
                .listen('MessageEvent', (e) => {
                iziToast.info({
                title: 'Info',
                message: 'Ada pesan masuk!',
                position: 'topRight',
                timeout: 2000
                });
            
                var audio2 = new Audio("{{ asset('assets/sounds/notif.mp3') }}");
                audio2.play();
            
                })
            
            @endauth
        })
    </script>

</body>

</html>
