async function loadSchedule() {
    const faculty = document.getElementById('faculty').value;
    const course = document.getElementById('course').value;
    
    try {
        const response = await fetch(`schedule_parser.php?faculty=${faculty}&course=${course}`);
        const html = await response.text();
        document.getElementById('schedule').innerHTML = html;
    } catch (error) {
        document.getElementById('schedule').innerHTML = `
            <div class="error">Ошибка загрузки</div>
        `;
    }
}

// Первая загрузка при открытии страницы
loadSchedule();