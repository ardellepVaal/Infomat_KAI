// Все здания КНИТУ-КАИ с точными координатами
const buildings = [
    {
        id: 1,
        name: "Главное здание",
        address: "ул. Карла Маркса, 10",
        stop: "КАИ",
        coords: [55.79453, 49.12224],
        type: "main"
    },
    {
        id: 2,
        name: "Второе здание", 
        address: "ул. Четаева, 18",
        stop: "ул. Четаева",
        coords: [55.79194, 49.12141],
        type: "educational"
    },
    {
        id: 3,
        name: "Третье здание",
        address: "ул. Льва Толстого, 15",
        stop: "ул. Л.Толстого",
        coords: [55.78891, 49.12363],
        type: "educational"
    },
    {
        id: 4,
        name: "Четвертое здание",
        address: "ул. Горького, 28/17",
        stop: "ул. Л.Толстого",
        coords: [55.78925, 49.12412],
        type: "educational"
    },
    {
        id: 5,
        name: "Пятое здание",
        address: "ул. Карла Маркса, 31/7",
        stop: "Площадь Свободы",
        coords: [55.79621, 49.11535],
        type: "administrative"
    },
    {
        id: 6,
        name: "Шестое здание (Авиационный институт)",
        address: "ул. Дементьева, 2а",
        stop: "Институт",
        coords: [55.85551, 49.07027],
        type: "research"
    },
    {
        id: 7,
        name: "Седьмое здание",
        address: "ул. Большая Красная, 55",
        stop: "Гоголя",
        coords: [55.79462, 49.12284],
        type: "educational"
    },
    {
        id: 8,
        name: "Восьмое здание (Новое)",
        address: "ул. Четаева, 18а",
        stop: "Чистопольская",
        coords: [55.79228, 49.12189],
        type: "educational"
    }
];

document.addEventListener('DOMContentLoaded', function() {
    // Инициализация карты (центр - главное здание)
    const map = L.map('kai-map').setView([55.7919, 49.1214], 15);
    
    // Добавление слоя OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Создание маркеров
    buildings.forEach(building => {
        // Создаем кастомный HTML для маркера
        const markerHtml = `
            <div class="building-marker" style="background-color: ${getColorByType(building.type)}">
                ${building.id}
            </div>
        `;
        
        // Создаем иконку
        const customIcon = L.divIcon({
            html: markerHtml,
            className: '',
            iconSize: [30, 30]
        });
        
        // Добавляем маркер на карту
        const marker = L.marker(building.coords, {
            icon: customIcon
        }).addTo(map);
        
        // Всплывающее окно с информацией
        marker.bindPopup(`
            <b>${building.name}</b>
            <small>${building.address}</small>
            <div><span class="transport-icon">🚌</span> ${building.stop}</div>
        `);
        
        // Добавляем ID здания в данные маркера
        marker.buildingId = building.id;
    });

    // Заполняем выпадающий список
    const buildingSelect = document.getElementById('building-select');
    buildings.forEach(building => {
        const option = document.createElement('option');
        option.value = building.id;
        option.textContent = `${building.id}. ${building.name} (${building.address})`;
        buildingSelect.appendChild(option);
    });
    
    // Обработка выбора здания
    buildingSelect.addEventListener('change', function() {
        const selectedId = parseInt(this.value);
        if (selectedId) {
            const selectedBuilding = buildings.find(b => b.id === selectedId);
            map.setView(selectedBuilding.coords, 18);
        } else {
            // Показать все здания
            const bounds = L.latLngBounds(buildings.map(b => b.coords));
            map.fitBounds(bounds.pad(0.2));
        }
    });
    
    // Заполняем таблицу зданий
    const buildingsTbody = document.getElementById('buildings-tbody');
    buildings.forEach(building => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${building.id}</td>
            <td>${building.name}</td>
            <td>${building.address}</td>
            <td><span class="transport-icon">🚌</span> ${building.stop}</td>
        `;
        row.addEventListener('click', () => {
            map.setView(building.coords, 18);
        });
        row.style.cursor = 'pointer';
        buildingsTbody.appendChild(row);
    });
    
    // Поиск по названию/адресу
    const searchInput = document.getElementById('search-input');
    searchInput.addEventListener('input', function() {
        const searchText = this.value.toLowerCase();
        if (searchText.length > 2) {
            const found = buildings.filter(b => 
                b.name.toLowerCase().includes(searchText) || 
                b.address.toLowerCase().includes(searchText)
            .map(b => b.coords));
            
            if (found.length > 0) {
                const bounds = L.latLngBounds(found);
                map.fitBounds(bounds.pad(0.2));
            }
        }
    });
});

// Возвращает цвет маркера в зависимости от типа здания
function getColorByType(type) {
    const colors = {
        'main': '#e74c3c',
        'educational': '#3498db',
        'administrative': '#2ecc71',
        'research': '#9b59b6'
    };
    return colors[type] || '#3498db';
}