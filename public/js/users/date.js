function date() {
    const today = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = today.toLocaleDateString('id-ID', options);
    document.getElementById("date").innerHTML = formattedDate;
}

// Jalankan saat file dimuat
document.addEventListener("DOMContentLoaded", date);
