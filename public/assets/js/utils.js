document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    }, false);

function convertDate(data, type, row) {
	if (!data) return '';
	const dateObj = new Date(data);
	if (isNaN(dateObj)) return data;
	const days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
	const dayName = days[dateObj.getDay()];
	const day = String(dateObj.getDate()).padStart(2, '0');
	const month = String(dateObj.getMonth() + 1).padStart(2, '0');
	const year = dateObj.getFullYear();
	return `${dayName}, ${day}-${month}-${year}`;
}

// Agar bisa diakses global
// window.convertDate = convertDate;
