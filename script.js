// --- FUNGSI TAB NAVIGATION --- //
function openTab(evt, tabName) {
  // Sembunyikan semua tab
  document.querySelectorAll(".tabcontent").forEach(tab => tab.style.display = "none");

  // Hapus semua tombol aktif
  document.querySelectorAll(".tablinks").forEach(btn => btn.classList.remove("active"));

  // Tampilkan tab yang dipilih
  const targetTab = document.getElementById(tabName);
  if (targetTab) targetTab.style.display = "block";

  // Tambahkan class active
  if (evt) {
    evt.currentTarget.classList.add("active");
  } else {
    document.querySelector(`.tablinks[onclick*="${tabName}"]`)?.classList.add("active");
  }

  // Simpan tab terakhir
  localStorage.setItem("lastTab", tabName);

  // Bersihkan URL hash agar tetap rapi
  history.replaceState(null, "", window.location.pathname);
}

// --- SAAT HALAMAN DILOAD --- //
document.addEventListener("DOMContentLoaded", function () {
  const lastTab = localStorage.getItem("lastTab") || "dashboard";
  openTab(null, lastTab);

  // Kalau pertama kali buka → buka dashboard & aktifkan tombolnya
  if (!localStorage.getItem("lastTab")) {
    document.getElementById("dashboard").style.display = "block";
    document.getElementById("defaultOpen")?.classList.add("active");
  }

  // Hapus hash dari URL
  if (window.location.hash) {
    history.replaceState(null, "", window.location.pathname);
  }

  // --- SEMBUNYIKAN PAGINATION SAAT TAMBAH / EDIT --- //
  const pagination = document.querySelector(".pagination");
  const formTambah = document.getElementById("formTambah");
  const btnTambah = document.querySelector(".btn.btn-add");

  // Saat tombol tambah ditekan → sembunyikan pagination
  if (btnTambah && pagination) {
    btnTambah.addEventListener("click", () => {
      pagination.style.display = "none";
    });
  }

  // Kalau form tambah muncul otomatis (misalnya edit data)
  if (formTambah && formTambah.style.display === "block" && pagination) {
    pagination.style.display = "none";
  }

  // Saat tombol cancel ditekan → tampilkan lagi pagination
  document.querySelectorAll("button").forEach(btn => {
    if (btn.textContent.trim().toLowerCase() === "cancel") {
      btn.addEventListener("click", () => {
        if (pagination) pagination.style.display = "flex";
      });
    }
  });
});

// --- CRUD --- //
function toggleForm() {
  const form = document.getElementById("formTambah");
  const pagination = document.querySelector(".pagination");
  if (form.style.display === "none" || form.style.display === "") {
    form.style.display = "block";
    if (pagination) pagination.style.display = "none";
  } else {
    form.style.display = "none";
    if (pagination) pagination.style.display = "flex";
  }
}

function cancelData() {
  document.getElementById("formTambah").reset();
  document.getElementById("formTambah").style.display = "none";
  const pagination = document.querySelector(".pagination");
  if (pagination) pagination.style.display = "flex";
}

function cancelEdit() {
  cancelData();
  window.history.back();
}

// --- CHART --- //
const ctxx = document.getElementById("donutChart");
if (ctxx) {
  new Chart(ctxx, {
    type: "doughnut",
    data: {
      labels: ["Male", "Female"],
      datasets: [
        { data: [totalMale, totalFemale], backgroundColor: ["#E0DCF2", "#F2A2C4"] }
      ]
    },
    options: { responsive: true, plugins: { legend: { position: "bottom" } } }
  });
}

const ctx = document.getElementById("barChart");
if (ctx) {
  new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Male", "Female"],
      datasets: [
        { label: "Jumlah", data: [totalMale, totalFemale], backgroundColor: ["#E0DCF2", "#F2A2C4"] }
      ]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
  });
}
