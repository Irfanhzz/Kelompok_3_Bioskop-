<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ url('/css/style.css') }}" rel="stylesheet">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #kursi {
            display: none;
        }
    </style>
    <title>Edit Tiket</title>
</head>

<body>
    <div class="container mt-4">
        <a href="/" title="Kembali ke Halaman Utama">
            <img src="{{ url('/images/back.png') }}" height="30" alt="Back">
        </a>
        <h2 class="text-black my-4">Form Edit Tiket</h2>

        <!-- Form Edit -->
        <form action="{{ route('update', encrypt($tiket->id)) }}" method="post">
            @csrf
            <input type="hidden" name="id_user" id="id_user" value="{{ $tiket->id_user }}">

            <div class="mb-3">
                <label for="nama" class="form-label">Nama:</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $tiket->nama }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="judul_film" class="form-label">Judul Film:</label>
                <input type="text" name="judul_film" id="judul_film" class="form-control"
                    value="{{ $tiket->judul_film }}" required>
            </div>

            <div class="mb-3">
                <label for="" class="">No kursi:</label>
                <input type="text" name="" id="" class="form-control"
                    value="{{ $tiket->kursi }}" required>
            </div>


            <label for="jam" class="form-label">Ubah Jam:</label>
            <select name="jam" id="jam" class="form-select" required>
                <option value="1" {{ $tiket->jam == 1 ? 'selected' : '' }}>06:00 - 08:00</option>
                <option value="2" {{ $tiket->jam == 2 ? 'selected' : '' }}>09:00 - 11:00</option>
                <option value="3" {{ $tiket->jam == 3 ? 'selected' : '' }}>12:00 - 14:00</option>
                <option value="4" {{ $tiket->jam == 4 ? 'selected' : '' }}>15:00 - 17:00</option>
                <option value="5" {{ $tiket->jam == 5 ? 'selected' : '' }}>18:00 - 20:00</option>
            </select><br>

            <input type="text" class="form-control" name="kursi" id="kursi" readonly
                value="{{ $tiket->kursi }}">
            <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#kursiModal">
                Ubah Kursi
            </button><br><br>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <!-- Modal untuk Pilih Kursi -->
    <div class="modal fade" id="kursiModal" tabindex="-1" aria-labelledby="kursiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kursiModalLabel">Pilih Kursi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table container">
                        <thead>
                            <tr>
                                <th scope="col">Nomor Kursi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#" class="select-kursi" data-kursi="A1">A1</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="A2">A2</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="A3">A3</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="A4">A4</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="A5">A5</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="select-kursi" data-kursi="B1">B1</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="B2">B2</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="B3">B3</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="B4">B4</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="B5">B5</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="select-kursi" data-kursi="C1">C1</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="C2">C2</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="C3">C3</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="C4">C4</a></td>
                                <td><a href="#" class="select-kursi" data-kursi="C5">C5</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white p-1 mt-auto">
        <div class="container">
            <p class="mt-3">&copy; 2024 Tiketku. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectKursiLinks = document.querySelectorAll('.select-kursi');
            const kursiModal = new bootstrap.Modal(document.getElementById('kursiModal'));

            selectKursiLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const selectedKursi = this.getAttribute('data-kursi');
                    document.getElementById('kursi').value = selectedKursi;

                    // Tutup modal setelah memilih kursi
                    kursiModal.hide();
                });
            });
        });
    </script>
</body>

</html>