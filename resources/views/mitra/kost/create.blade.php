<x-app-layout>
    <style>
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .spinner {
            animation: spin 1s linear infinite;
            display: inline-block; /* Tambahan untuk memastikan transform bekerja */
        }
    </style>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-bold mb-4">Tambah Kost Baru</h2>
                <form id="kostForm" action="{{ route('mitra.kost.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-1">Nama Kost</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1">Alamat</label>
                        <input type="text" name="address" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1">Kota</label>
                        <input type="text" name="city" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1">Deskripsi</label>
                        <textarea name="description" class="w-full border rounded px-3 py-2" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1">Harga</label>
                        <input type="number" name="price" class="w-full border rounded px-3 py-2" required min="0">
                    </div>
                    

                    <div class="mb-4">
                        <label class="block mb-1">Gambar Kost <span class="text-red-500">*</span></label>
                        <div class="flex flex-row items-start gap-4 w-full">
                            <!-- Upload Box -->
                            <div id="upload-box" class="flex flex-col items-center justify-center w-32 h-32 border-2 border-dashed border-blue-400 rounded-lg cursor-pointer bg-blue-50 hover:bg-blue-100 transition relative flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="text-xs text-blue-500 mt-2">Tambah Gambar</span>
                                <input type="file" name="images[]" id="images-input" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" required multiple>
                            </div>
                            <!-- Preview Images -->
                            <div id="preview-images" class="flex gap-2 flex-nowrap overflow-x-auto w-full min-h-[80px]"></div>
                        </div>
                        <small class="text-gray-500">Bisa upload lebih dari satu gambar, minimal 1 gambar.</small>
                    </div>

                    <!-- Tombol simpan di luar wrapper flex -->
                    <div class="mt-8 flex justify-end">
                        <button type="submit" id="submitBtn"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold rounded-lg shadow transition focus:outline-none focus:ring-2 focus:ring-blue-400 border border-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#1d4ed8" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span id="buttonText">Simpan</span>
                            <svg id="loadingIcon" class="hidden h-5 w-5 text-blue-700" viewBox="0 0 24 24">
                                <circle 
                                    cx="12" 
                                    cy="12" 
                                    r="10" 
                                    stroke="currentColor" 
                                    stroke-width="4" 
                                    fill="none"
                                    stroke-dasharray="60"
                                    stroke-dashoffset="0">
                                    <animateTransform
                                        attributeName="transform"
                                        attributeType="XML"
                                        type="rotate"
                                        from="0 12 12"
                                        to="360 12 12"
                                        dur="1s"
                                        repeatCount="indefinite"/>
                                </circle>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    const uploadBox = document.getElementById('upload-box');
    const imagesInput = document.getElementById('images-input');
    const preview = document.getElementById('preview-images');
    const form = document.getElementById('kostForm');
    const submitBtn = document.getElementById('submitBtn');
    const buttonText = document.getElementById('buttonText');
    const loadingIcon = document.getElementById('loadingIcon');

    // Debug: Periksa elemen loading icon
    console.log('Loading Icon Element:', loadingIcon);
    console.log('Loading Icon Classes:', loadingIcon.className);

    // Trigger file input on box click
    uploadBox.addEventListener('click', function() {
        imagesInput.click();
    });

    // Preview images
    imagesInput.addEventListener('change', function(event) {
        preview.innerHTML = '';
        const files = Array.from(event.target.files);
        console.log('Files selected:', files);

        files.forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'relative group';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-20 h-20 object-cover rounded shadow-md border';
                    wrapper.appendChild(img);
                    preview.appendChild(wrapper);
                    console.log('Image preview added');
                };
                reader.readAsDataURL(file);
            } else {
                console.log('File bukan gambar:', file.name);
            }
        });
    });

    // Form submit handler
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate if images are selected
        const imageInput = document.getElementById('images-input');
        if (imageInput.files.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Silakan pilih minimal 1 gambar kost'
            });
            return;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        buttonText.textContent = 'Menyimpan...';
        loadingIcon.classList.remove('hidden');
        
        // Create FormData object
        const formData = new FormData(form);
        
        // Submit form using fetch
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Try to parse as JSON, if fails, handle as redirect
            return response.text().then(text => {
                try {
                    return JSON.parse(text);
                } catch (e) {
                    // If not JSON, assume it's a redirect
                    window.location.href = response.url;
                    return null;
                }
            });
        })
        .then(data => {
            if (data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data kost berhasil disimpan',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = data.redirect || '/mitra/kost';
                    });
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan saat menyimpan data');
                }
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message || 'Terjadi kesalahan saat menyimpan data'
            });
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            buttonText.textContent = 'Simpan';
            loadingIcon.classList.add('hidden');
        });
    });
    </script>
</x-app-layout>
