@extends('pelanggan.layout.index')

@section('content')
    <div class="d-flex justify-content-lg-between mt-5">
        <!-- Card 1 -->
        <div class="card mb-3 gap-3" style="width: 28rem;">
            <img src="{{ asset('assets/images/profile/arga.jpg') }}" class="card-img-top card-img-custom" alt="Arga">
            <div class="card-body">
                <h5 class="card-title">Arga</h5>
                <p class="card-text">152023027</p>
                <a href="https://www.instagram.com/arvndy_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="btn btn-primary">Instagram</a>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="card mb-3 gap-3" style="width: 28rem;">
            <img src="{{ asset('assets/images/profile/cio.jpg') }}" class="card-img-top card-img-custom" alt="Cio">
            <div class="card-body">
                <h5 class="card-title">Cio</h5>
                <p class="card-text">152023120</p>
                <a href="https://www.instagram.com/amsatrgsilangit/?utm_source=ig_web_button_share_sheet" target="_blank" class="btn btn-primary">Instagram</a>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="card mb-3 gap-3" style="width: 28rem;">
            <img src="{{ asset('assets/images/profile/dean.jpg') }}" class="card-img-top card-img-custom" alt="Dean">
            <div class="card-body">
                <h5 class="card-title">Dean</h5>
                <p class="card-text">152023115</p>
                <a href="https://www.instagram.com/uknownz_24/" target="_blank" class="btn btn-primary">Instagram</a>
            </div>
        </div>
    </div>

    <h4 class="text-center mt-md-5 mb-md-2" style="color: white">Contact Us</h4>
    <hr class="mb-5">

    <div class="row mb-md-5">
        <div class="col-md-6 mx-auto">
            <div class="card border-0 shadow-lg" style="background-color: #f8f9fa; border-radius: 12px; font-family: 'Poppins', sans-serif;">
                <div class="card-header text-center" style="background-color: #007bff; color: white; border-radius: 12px 12px 0 0;">
                    <h4>Kritik dan Saran</h4>
                </div>
                <div class="card-body" style="padding: 20px;">
                    <p class="text-center mb-4">Kami sangat menghargai masukan Anda untuk meningkatkan layanan kami.</p>
                    <form id="feedbackForm" action="/feedback" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" required>
                            <div class="invalid-feedback">Username tidak boleh kosong.</div>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" rows="3" name="pesan" placeholder="Tulis pesan Anda" required></textarea>
                            <div class="invalid-feedback">Pesan tidak boleh kosong.</div>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-select" name="rating" id="rating" required>
                                <option value="">Pilih rating</option>
                                <option value="1">1 - Sangat Buruk</option>
                                <option value="2">2 - Buruk</option>
                                <option value="3">3 - Cukup</option>
                                <option value="4">4 - Baik</option>
                                <option value="5">5 - Sangat Baik</option>
                            </select>
                            <div class="invalid-feedback">Mohon pilih rating.</div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane"></i> Kirim Pesan
                            </button>
                            <button type="reset" class="btn btn-secondary w-100">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h4 class="text-center mt-5">Daftar Saran</h4>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const feedbackList = document.getElementById('feedbackList');

        function renderFeedbacks() {
            feedbackList.innerHTML = localStorage.getItem('feedbackData') || '<p class="text-center">Belum ada saran yang diberikan.</p>';
        }

        document.getElementById('feedbackForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const username = document.getElementById('username');
            const pesan = document.getElementById('pesan');
            const rating = document.getElementById('rating');

            let valid = true;
            if (!username.value.trim()) {
                username.classList.add('is-invalid');
                valid = false;
            } else {
                username.classList.remove('is-invalid');
            }

            if (!pesan.value.trim()) {
                pesan.classList.add('is-invalid');
                valid = false;
            } else {
                pesan.classList.remove('is-invalid');
            }

            if (!rating.value) {
                rating.classList.add('is-invalid');
                valid = false;
            } else {
                rating.classList.remove('is-invalid');
            }

            if (valid) {
                Swal.fire('Terima kasih!', `Kritik dan saran dari ${username.value} berhasil dikirim.`, 'success');
                const feedbackData = `
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">${username.value}</h5>
                            <p class="card-text">${pesan.value}</p>
                            <span class="badge bg-primary">Rating: ${rating.value}</span>
                        </div>
                    </div>
                `;
                const currentFeedbacks = localStorage.getItem('feedbackData') || '';
                localStorage.setItem('feedbackData', feedbackData + currentFeedbacks);
                renderFeedbacks();
                this.reset();
            }
        });

        renderFeedbacks();
    </script>
@endsection

<style>
    /* Gaya khusus untuk memastikan gambar tampil dengan baik */
    .card-img-custom {
        width: 100%;
        height: 350px;
        object-fit: cover; /* Menyesuaikan gambar agar tidak terdistorsi */
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    /* Gaya khusus untuk card-body */
    .card-body {
        padding: 1.5rem; /* Memberikan ruang yang cukup pada bagian dalam card */
        text-align: center; /* Menengahkan teks di dalam card */
        background-color: #ffffff; /* Warna latar belakang card */
        border: 1px solid #e0e0e0; /* Menambahkan border tipis */
        border-bottom-left-radius: 12px; /* Membulatkan sudut bawah kiri */
        border-bottom-right-radius: 12px; /* Membulatkan sudut bawah kanan */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan */
    }

    /* Judul card */
    .card-title {
        font-size: 1.25rem; /* Ukuran teks judul */
        font-weight: 600; /* Membuat teks lebih tebal */
        margin-bottom: 0.5rem;
        color: #333333;
    }

    /* Teks card */
    .card-text {
        font-size: 1rem;
        color: #666666;
        margin-bottom: 1rem; /* Memberikan jarak dengan tombol */
    }

    /* Tombol di card */
    .card-body .btn-primary {
        background-color: #007bff; /* Warna tombol */
        border: none; /* Menghapus border default tombol */
        font-weight: 500; /* Membuat teks tombol lebih menonjol */
        transition: all 0.3s ease-in-out; /* Efek transisi saat tombol dihover */
    }

    .card-body .btn-primary:hover {
        background-color: #0056b3; /* Warna tombol saat dihover */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan saat dihover */
    }

    /* CSS untuk bagian form feedback */
    .form-label {
        font-weight: 500;
        color: #333333;
    }

    .form-control, .form-select {
        border-radius: 8px;
    }

    .btn-primary, .btn-secondary {
        border-radius: 8px;
    }
</style>



