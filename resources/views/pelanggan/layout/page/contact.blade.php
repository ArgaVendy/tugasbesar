@extends('pelanggan.layout.index')

@section('content')
    <div class="d-flex justify-content-lg-between mt-5">
        <div class="card mb-3 gap-3" style="width: 28rem;">
            <img src="{{ asset('images/person1.jpg') }}" class="card-img-top object-fit-cover" style="height: 350px;">
            <div class="card-body">
                <h5 class="card-title">ArgaVendy</h5>
                <p class="card-text">152023027</p>
                <a href="https://www.instagram.com/arvndy_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="btn btn-primary">Instagram</a>
            </div>
        </div>
        <div class="card mb-3 gap-3" style="width: 28rem;">
            <img src="{{ asset('images/person2.jpg') }}" class="card-img-top object-fit-cover" style="height: 350px;">
            <div class="card-body">
                <h5 class="card-title">CIO</h5>
                <p class="card-text">152023120</p>
                <a href="https://www.instagram.com/amsatrgsilangit/?utm_source=ig_web_button_share_sheet" target="_blank" class="btn btn-primary">Instagram</a>
            </div>
        </div>
        <div class="card mb-3 gap-3" style="width: 28rem;">
            <img src="{{ asset('images/person3.jpg') }}" class="card-img-top object-fit-cover" style="height: 350px;">
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
                    <form id="feedbackForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Masukkan username Anda" required>
                            <div class="invalid-feedback">Username tidak boleh kosong.</div>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" rows="3" placeholder="Tulis pesan Anda" required></textarea>
                            <div class="invalid-feedback">Pesan tidak boleh kosong.</div>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-select" id="rating" required>
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
    <div id="feedbackList" class="mt-3"></div>

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
                Swal.fire('Terima kasih!', Kritik dan saran dari ${username.value} berhasil dikirim., 'success');
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