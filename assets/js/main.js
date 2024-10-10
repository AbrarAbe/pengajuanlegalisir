// main scripts
(function ($) {
  "use strict";

  // Full height section
  const fullHeight = () => {
    $(".js-fullheight").css("height", $(window).height());
    $(window).resize(() => {
      $(".js-fullheight").css("height", $(window).height());
    });
  };
  fullHeight();

  // Sidebar toggle
  $("#sidebarCollapse").on("click", () => {
    $("#sidebar").toggleClass("active");
  });
})(jQuery);

document.addEventListener("DOMContentLoaded", () => {
  // Phone number input with intlTelInput
  const input = document.querySelector("#phone");
  window.intlTelInput(input, {
    initialCountry: "auto",
    geoIpLookup: (callback) => {
      fetch("https://ipinfo.io?token=7b70fe5064d574")
        .then((response) => response.json())
        .then((data) => callback(data.country))
        .catch(() => callback("id"));
    },
    utilsScript:
      "https://cdn.jsdelivr.net/npm/intl-tel-input@23.7.3/build/js/utils.js",
    autoPlaceholder: "polite",
  });

  // Phone number validation on blur
  input.addEventListener("blur", () => {
    const iti = window.intlTelInputGlobals.getInstance(input);
    if (iti.isValidNumber()) {
      var number = iti.getNumber(); // Dapatkan nomor dalam format internasional
      console.log("Nomor valid:", number);
    } else {
      console.log("Nomor tidak valid");
    }
  });

  // Set default country and preferred countries
  window.intlTelInput(input, {
    initialCountry: "id",
    preferredCountries: ["us", "gb", "id"],
    separateDialCode: true,
  });
});

// Form harga total
function updateTotal() {
  const legalisirIjazah =
    parseInt(document.getElementById("jumlah_legalisir_ijazah").value) || 0;
  const legalisirTranskrip =
    parseInt(document.getElementById("jumlah_legalisir_transkrip").value) || 0;
  const hargaIjazah = 5000;
  const hargaTranskrip = 5000;
  const totalHarga =
    legalisirIjazah * hargaIjazah + legalisirTranskrip * hargaTranskrip;
  document.getElementById("total_harga").innerText =
    totalHarga.toLocaleString("id-ID");
  document.getElementById("total_harga_input").value = totalHarga;
}

// Cek angka negatif di input jumlah legalisir
function checkNegative(input) {
  if (input.value < 0) {
    input.value = 1;
  }
}

// Button script
function metodePengiriman() {
  const metodeCOD = document.getElementById("kirim").checked;
  const nomorRekening = document.getElementById("nomorRekening");
  const buktiPembayaran = document.getElementById("buktiPembayaran");
  const alamatPengiriman = document.getElementById("alamatPengiriman");
  const warningPengiriman = document.getElementById("warningPengiriman");
  const hint = document.getElementById("hint");

  if (metodeCOD) {
    nomorRekening.style.display = "none";
    buktiPembayaran.style.display = "none";
    alamatPengiriman.style.display = "block";
    warningPengiriman.style.display = "block";
    hint.style.display = "block";
  } else {
    nomorRekening.style.display = "block";
    buktiPembayaran.style.display = "block";
    alamatPengiriman.style.display = "none";
    warningPengiriman.style.display = "none";
    hint.style.display = "none";
  }
}

// Button show password
function showPass() {
  const password = document.getElementById("password");
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);

  const toggleIcon = document.getElementById("toggleIcon");
  toggleIcon.classList.toggle("nf-fa-eye");
  toggleIcon.classList.toggle("nf-fa-eye_slash");
}

// Delete
function confirmDelete(id_pengajuan) {
  if (confirm("Apakah Anda yakin ingin menghapus pengajuan ini?")) {
    window.location.href =
      "../proses/delete_pengajuan.php?id_pengajuan=" + id_pengajuan;
  }
}

// Logout
function confirmLogout() {
  if (confirm("Apakah Anda yakin ingin logout?")) {
    window.location.href = "../proses/logout.php";
  }
}

document.addEventListener("DOMContentLoaded", function (event) {
  function OTPInput() {
    const inputs = document.querySelectorAll("#otp > *[id]");
    for (let i = 0; i < inputs.length; i++) {
      inputs[i].addEventListener("keydown", function (event) {
        if (event.key === "Backspace") {
          inputs[i].value = "";
          if (i !== 0) inputs[i - 1].focus();
        } else {
          if (i === inputs.length - 1 && inputs[i].value !== "") {
            return true;
          } else if (event.keyCode > 47 && event.keyCode < 58) {
            inputs[i].value = event.key;
            if (i !== inputs.length - 1) inputs[i + 1].focus();
            event.preventDefault();
          } else if (event.keyCode > 64 && event.keyCode < 91) {
            inputs[i].value = String.fromCharCode(event.keyCode);
            if (i !== inputs.length - 1) inputs[i + 1].focus();
            event.preventDefault();
          }
        }
      });
    }
  }
  OTPInput();
});