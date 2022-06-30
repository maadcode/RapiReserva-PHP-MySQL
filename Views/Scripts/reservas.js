import { ajaxGet } from "./ajax.js";

document.addEventListener('DOMContentLoaded', () => {
    getReservations();
})

async function getReservations() {
    let userId = localStorage.getItem('userId') || 0;
    const url = `http://localhost/Projects/RapiReserva/Controllers/reservationsController.php?getReservations=true&userId=${userId}`;
    const response = await ajaxGet(url);
    writeTable(response);
}

function writeTable(reservations) {
    const tableBody = document.querySelector('.data tbody');
    
    reservations.forEach(reservation => {
        const row = document.createElement('tr');
        row.innerHTML = `<td>${reservation.startDate}</td>
                        <td>${reservation.status}</td>
                        <td><a href="http://localhost/Projects/RapiReserva/Controllers/reservationsController.php?getReservation=true&reservationId=${reservation.id}">Ver más</a></td>`;
        row.innerHTML += '</tr>';              
        tableBody.appendChild(row);
    });
}