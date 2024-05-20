function sortActivities(order) {
    var activities = document.querySelectorAll('.col-4');

    activities.forEach(function(activity) {
        activity.style.display = ''; // Reset display property for all activities
    });

    if (order === 'desc') {
        // Sort activities based on price high to low
        activities = Array.from(activities).sort(function(a, b) {
            var priceA = parseFloat(a.querySelector('.price').innerText.replace('$', ''));
            var priceB = parseFloat(b.querySelector('.price').innerText.replace('$', ''));
            return priceB - priceA;
        });
    } else if (order === 'asc') {
        // Sort activities based on price low to high
        activities = Array.from(activities).sort(function(a, b) {
            var priceA = parseFloat(a.querySelector('.price').innerText.replace('$', ''));
            var priceB = parseFloat(b.querySelector('.price').innerText.replace('$', ''));
            return priceA - priceB;
        });
    }

    // Hide activities not in sorted order
    activities.forEach(function(activity) {
        activity.parentNode.appendChild(activity); // Re-append sorted activities to parent container
    });
}