<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic To-Do List Calendar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <center>
            <h1>To-do List</h1>
        </center>
        <button id="logoutButton" style="position: absolute; top: 10px; right: 10px;">Logout</button>
        <hr>
        <button id="prevButton">Previous</button>
        <button id="nextButton">Next</button>
        <button id="formkegiatanButton">Tambah Kegiatan</button>
    </header>
    <main>
        <h1 id="namabulan"></h1>
        <center>
            <table border="0" cellpadding="5" cellspacing="0" id="calendarTable">
                <thead>
                    <tr class="hari">
                        <th><center>Senin</center></th>
                        <th><center>Selasa</center></th>
                        <th><center>Rabu</center></th>
                        <th><center>Kamis</center></th>
                        <th><center>Jumat</center></th>
                        <th><center>Sabtu</center></th>
                        <th><center>Minggu</center></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </center>
        <img id="anya" src="https://pnganime.com/web/images/a/anya-forger-pointing.png" alt="stickyimage">
        <img id="yor" src="https://animegirlpng.com/wp-content/uploads/2023/03/1680175444797-671x1024.png" alt="stickyimage2">
    </main>
    <footer>
        <hr>
        <center>FTI UKDW 2023 &copy; All rights reserved</center>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarTable = document.getElementById('calendarTable');
            const namaBulan = document.getElementById('namabulan');
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');
            const logoutButton = document.getElementById('logoutButton');
            const monthNames = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
            const currentDate = new Date();
            let currentYear = currentDate.getFullYear();
            let currentMonth = currentDate.getMonth();
            updateCalendar();

            logoutButton.addEventListener('click', function () {
                window.location.href = 'logout.php';
            });

            function updateCalendar() {
                calendarTable.querySelector('tbody').innerHTML = '';
                namaBulan.textContent = monthNames[currentMonth] + ' ' + currentYear;
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
                const firstDay = new Date(currentYear, currentMonth, 1).getDay() - 1;
                let dayCounter = 1;
                for (let i = 0; i < 6; i++) {
                    const row = document.createElement('tr');
                    for (let j = 0; j < 7; j++) {
                        const cell = document.createElement('td');
                        if (i === 0 && j < firstDay) {
                            cell.textContent = '';
                        } else if (dayCounter > daysInMonth) {
                            cell.textContent = '';
                        } else {
                            const dateElement = document.createElement('div');
                            dateElement.textContent = dayCounter;
                            const activityList = document.createElement('ul');
                            activityList.classList.add('kegiatan');
                            cell.appendChild(dateElement);
                            cell.appendChild(activityList);
                            dayCounter++;
                            cell.addEventListener('click', function () {
                                const clickedDate = new Date(currentYear, currentMonth, dayCounter);
                                const formattedDate = currentDate.toISOString().split('T')[0];
                                window.location.href = 'index2.html?tanggal=' + formattedDate;
                            });
                            const currentDate = new Date(currentYear, currentMonth, dayCounter);
                            const formattedDate = currentDate.toISOString().split('T')[0];
                            fetchActivities(formattedDate, activityList);
                        }
                        row.appendChild(cell);
                    }
                    calendarTable.querySelector('tbody').appendChild(row);
                }
            }

            function fetchActivities(date, activityList) {
                fetch('ambilkegiatan.php?tanggal=' + date)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function (activity) {
                            if (activity.date === date) {
                                const listItem = document.createElement('li');
                                listItem.textContent = activity.name;
                                activityList.appendChild(listItem);
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching activities:', error);
                    });
            }

            function changeMonth(value) {
                currentMonth = parseInt(value);
                updateCalendar();
            }

            function changeYear(value) {
                currentYear = parseInt(value);
                updateCalendar();
            }

            function prevMonth() {
                if (currentMonth === 0) {
                    currentMonth = 11;
                    currentYear--;
                } else {
                    currentMonth--;
                }
                updateCalendar();
            }

            function nextMonth() {
                if (currentMonth === 11) {
                    currentMonth = 0;
                    currentYear++;
                } else {
                    currentMonth++;
                }
                updateCalendar();
            }

            function addKegiatan() {
                window.location.href = 'formkegiatan.html';
            }

            prevButton.addEventListener('click', prevMonth);
            nextButton.addEventListener('click', nextMonth);
            formkegiatanButton.addEventListener('click', addKegiatan);
        });
    </script>
</body>
</html>
