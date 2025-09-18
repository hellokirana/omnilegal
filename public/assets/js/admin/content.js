function confirmSave(form) {
    Swal.fire({
        title: "Simpan Perubahan?",
        text: "Perubahan pada form ini akan disimpan.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, simpan",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();

            Swal.fire({
                title: "Berhasil!",
                text: "Perubahan telah disimpan.",
                icon: "success",
                timer: 2000,
                showConfirmButton: false,
            });
        }
    });
}

// Reset form to original values
function resetForm(form) {
    Swal.fire({
        title: "Reset Form?",
        text: "Semua input pada form ini akan dikosongkan.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, reset",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            form.reset();

            Swal.fire({
                title: "Berhasil!",
                text: "Form sudah direset.",
                icon: "success",
                timer: 1500,
                showConfirmButton: false,
            });
        }
    });
}

// Save all changes with SweetAlert
function saveAllChanges() {
    const forms = document.querySelectorAll(".content-form");
    let savedCount = 0;

    Swal.fire({
        title: `Simpan semua ${forms.length} konten?`,
        text: "Perubahan akan langsung tersimpan.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya, simpan!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            forms.forEach((form, index) => {
                setTimeout(() => {
                    form.submit();
                    savedCount++;

                    if (savedCount === forms.length) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Semua perubahan berhasil disimpan!",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                }, index * 200); // jeda antar submit biar ga bentrok
            });
        }
    });
}

// Show notification
function showNotification(message, type = "info") {
    // Create toast notification
    const toast = document.createElement("div");
    toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    toast.style.cssText =
        "top: 20px; right: 20px; z-index: 9999; min-width: 300px;";
    toast.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

    document.body.appendChild(toast);

    // Auto remove after 3 seconds
    setTimeout(() => {
        if (toast && toast.parentNode) {
            toast.remove();
        }
    }, 3000);
}

// Auto-save functionality (optional)
document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll("input, textarea");

    inputs.forEach((input) => {
        let timeout;

        input.addEventListener("input", function () {
            clearTimeout(timeout);

            // Add visual indicator that content has changed
            this.classList.add("border-warning");

            timeout = setTimeout(() => {
                this.classList.remove("border-warning");
                this.classList.add("border-success");

                setTimeout(() => {
                    this.classList.remove("border-success");
                }, 1000);
            }, 2000);
        });
    });
});

// Form validation
document.querySelectorAll(".content-form").forEach((form) => {
    form.addEventListener("submit", function (e) {
        const titleId = form.querySelector('[name="title_id"]').value.trim();
        const titleEn = form.querySelector('[name="title_en"]').value.trim();

        if (!titleId && !titleEn) {
            e.preventDefault();
            showNotification("Minimal satu judul harus diisi!", "warning");
            return false;
        }
    });
});
