function updateTime() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const formattedTime = `${hours}:${minutes < 10 ? '0' : ''}${minutes}`;

    const year = now.getFullYear();
    const month = now.getMonth() + 1;
    const day = now.getDate();
    const formattedDate = `${year}-${month < 10 ? '0' : ''}${month}-${day < 10 ? '0' : ''}${day}`;

    const lastUpdateElements = document.querySelectorAll('.lastUpdate');
    lastUpdateElements.forEach(element => {
        element.textContent = `Last Update: ${formattedTime}, ${formattedDate}`;
    });

    setTimeout(updateTime, 1000); // Update every second
}

window.onload = updateTime;
