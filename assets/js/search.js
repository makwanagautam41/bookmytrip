document.addEventListener('DOMContentLoaded', function () {
    // Set today's date
    document.getElementById('today-btn').addEventListener('click', function () {
        document.getElementById('date_of_journey').value = new Date().toISOString().split('T')[0];
    });

    // Set tomorrow's date
    document.getElementById('tomorrow-btn').addEventListener('click', function () {
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        document.getElementById('date_of_journey').value = tomorrow.toISOString().split('T')[0];
    });

    // Handle form submission with a delay and show loader
    let form = document.querySelector('form');
    form.onsubmit = function (event) {
        event.preventDefault();
        showLoader();
        showSnackbar();
        setTimeout(function () {
            form.submit();
        }, 1500);
    };

    function showLoader() {
        document.getElementById('loader').style.display = 'block';
        document.getElementById('hero-section').style.visibility = 'hidden';
    }

    function showSnackbar() {
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 1500);
        x.innerText = 'Wait & Scroll down to View Buses';
        x.style.background = "#000";
        x.style.color = "#ffff";
    }
});