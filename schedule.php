<?php
// Проверяем, передан ли номер группы
$group = isset($_GET['group']) ? (int)$_GET['group'] : 0;
$isValidGroup = ($group >= 1101 && $group <= 8540);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>
        <?= $isValidGroup ? "Расписание группы " . htmlspecialchars($group) : "Поиск расписания" ?>
    </title>
    <link rel="stylesheet" href="styles1.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .search-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .search-input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        .search-input:focus {
            border-color: #0C4FED;
            outline: none;
            box-shadow: 0 0 0 2px rgba(63, 81, 181, 0.2);
        }
        .search-button {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            background-color: #0C4FED;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .search-button:hover {
            background-color: #0C4FED;
        }
        .error-message {
            color: #e53935;
            margin-top: 10px;
            padding: 10px;
            background-color: #ffebee;
            border-radius: 4px;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #388E3C;
        }
        .day-block {
            margin-top: 30px;
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        h2 {
            color: #3f51b5;
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .schedule-table th {
            background-color: #0C4FED;
            color: white;
            padding: 12px;
            text-align: left;
        }
        .schedule-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
        }
        .schedule-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .schedule-table tr:hover {
            background-color: #f1f1f1;
        }
        .time {
            font-weight: bold;
            color: #1a237e;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!$group || !$isValidGroup): ?>
            <!-- Показываем форму, если группа не передана или неверная -->
            <form method="GET" action="schedule.php" class="search-container">
                <input type="number"
                       name="group"
                       placeholder="Введите номер группы (1101-8540)"
                       required
                       min="1101"
                       max="8540"
                       class="search-input">
                <button type="submit" class="search-button">Показать</button>
            </form>
            <?php if ($group && !$isValidGroup): ?>
                <div class="error-message">Группа <?= htmlspecialchars($group) ?> не найдена!</div>
            <?php endif; ?>
        <?php else: ?>
            <h1>Расписание группы <?= htmlspecialchars($group) ?></h1>
            
            <!-- Понедельник -->
            <div class="day-block">
                <h2>Понедельник</h2>
                <table class="schedule-table">
                    <tr>
                        <th>Время</th>
                        <th>Дата</th>
                        <th>Дисциплина</th>
                        <th>Вид</th>
                        <th>Аудитория</th>
                        <th>Здание</th>
                        <th>Преподаватель</th>
                        <th>Кафедра</th>
                    </tr>
                    <tr>
                        <td class="time">08:00</td>
                        <td></td>
                        <td>Физическая культура и спорт (элективная дисциплина)</td>
                        <td>пр</td>
                        <td>КСК КАИ ОЛИМП</td>
                        <td>КСК КАИ ОЛИМП</td>
                        <td>Преподаватель кафедры</td>
                        <td>Кафедра физической культуры и спорта</td>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td>неч</td>
                        <td>Высшая математика</td>
                        <td>пр</td>
                        <td>424</td>
                        <td>2</td>
                        <td>Бильченко Наталия Григорьевна</td>
                        <td>Кафедра теоретической и прикладной механики и математики</td>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td>чет</td>
                        <td>Философия</td>
                        <td>пр</td>
                        <td>506</td>
                        <td>8</td>
                        <td>Румянцева Марина Георгиевна</td>
                        <td>Кафедра философии</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td>неч</td>
                        <td>Химия</td>
                        <td>лек</td>
                        <td>300</td>
                        <td>2</td>
                        <td>Григорьева Ирина Геннадьевна</td>
                        <td>Кафедра общей химии и экологии</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td>чет</td>
                        <td>Теоретическая механика</td>
                        <td>пр</td>
                        <td>331</td>
                        <td>8</td>
                        <td>Тажибаева Александра Валерьевна</td>
                        <td>Кафедра машиноведения и инженерной графики</td>
                    </tr>
                    <tr>
                        <td class="time">13:30</td>
                        <td>неч</td>
                        <td>Высшая математика</td>
                        <td>пр</td>
                        <td>505</td>
                        <td>2</td>
                        <td>Бильченко Григорий Григорьевич</td>
                        <td>Кафедра теоретической и прикладной механики и математики</td>
                    </tr>
                    <tr>
                        <td class="time">13:30</td>
                        <td>чет</td>
                        <td>Высшая математика</td>
                        <td>пр</td>
                        <td>408</td>
                        <td>8</td>
                        <td>Бильченко Григорий Григорьевич</td>
                        <td>Кафедра теоретической и прикладной механики и математики</td>
                    </tr>
                </table>
            </div>

            <!-- Вторник -->
            <div class="day-block">
                <h2>Вторник</h2>
                <table class="schedule-table">
                    <tr>
                        <th>Время</th>
                        <th>Дата</th>
                        <th>Дисциплина</th>
                        <th>Вид</th>
                        <th>Аудитория</th>
                        <th>Здание</th>
                        <th>Преподаватель</th>
                        <th>Кафедра</th>
                    </tr>
                    <tr>
                        <td class="time">08:00</td>
                        <td></td>
                        <td>Компьютерная графика</td>
                        <td>л.р.</td>
                        <td>514</td>
                        <td>2</td>
                        <td>Адыева Назия Абдулхамитовна</td>
                        <td>Кафедра машиноведения и инженерной графики</td>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td></td>
                        <td>Компьютерная графика</td>
                        <td>л.р.</td>
                        <td>514</td>
                        <td>2</td>
                        <td>Адыева Назия Абдулхамитовна</td>
                        <td>Кафедра машиноведения и инженерной графики</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td></td>
                        <td>Философия</td>
                        <td>лек</td>
                        <td>334</td>
                        <td>8</td>
                        <td>Румянцева Марина Георгиевна</td>
                        <td>Кафедра философии</td>
                    </tr>
                    <tr>
                        <td class="time">13:30</td>
                        <td></td>
                        <td>Иностранный язык</td>
                        <td>пр</td>
                        <td>313</td>
                        <td>2</td>
                        <td>Преподаватель кафедры</td>
                        <td>Кафедра иностранных языков</td>
                    </tr>
                    <tr>
                        <td class="time">13:30</td>
                        <td></td>
                        <td>Иностранный язык</td>
                        <td>пр</td>
                        <td>440</td>
                        <td>2</td>
                        <td>Зарипова Эльвира Ильдаровна</td>
                        <td>Кафедра иностранных языков</td>
                    </tr>
                    <tr>
                        <td class="time">15:10</td>
                        <td>неч</td>
                        <td>Иностранный язык</td>
                        <td>пр</td>
                        <td>313</td>
                        <td>2</td>
                        <td>Преподаватель кафедры</td>
                        <td>Кафедра иностранных языков</td>
                    </tr>
                    <tr>
                        <td class="time">15:10</td>
                        <td>неч</td>
                        <td>Иностранный язык</td>
                        <td>пр</td>
                        <td>440</td>
                        <td>2</td>
                        <td>Зарипова Эльвира Ильдаровна</td>
                        <td>Кафедра иностранных языков</td>
                    </tr>
                </table>
            </div>
            <!-- Среда -->
            <div class="day-block">
                <h2>Среда</h2>
                <table class="schedule-table">
                    <tr>
                        <th>Время</th>
                        <th>Дата</th>
                        <th>Дисциплина</th>
                        <th>Вид</th>
                        <th>Аудитория</th>
                        <th>Здание</th>
                        <th>Преподаватель</th>
                        <th>Кафедра</th>
                    </tr>
                    <tr>
                        <td class="time">08:00</td>
                        <td>неч</td>
                        <td>Высшая математика</td>
                        <td>лек</td>
                        <td>300</td>
                        <td>2</td>
                        <td>Бильченко Наталия Григорьевна</td>
                        <td>Кафедра теоретической и прикладной механики и математики</td>
                    </tr>
                    <tr>
                        <td class="time">08:00</td>
                        <td>чет</td>
                        <td>Высшая математика</td>
                        <td>лек</td>
                        <td>актовый зал</td>
                        <td>2</td>
                        <td>Бильченко Наталия Григорьевна</td>
                        <td>Кафедра теоретической и прикладной механики и математики</td>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td>неч</td>
                        <td>Высшая математика</td>
                        <td>лек</td>
                        <td>300</td>
                        <td>2</td>
                        <td>Бильченко Григорий Григорьевич</td>
                        <td>Кафедра теоретической и прикладной механики и математики</td>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td>чет</td>
                        <td>Высшая математика</td>
                        <td>лек</td>
                        <td>актовый зал</td>
                        <td>2</td>
                        <td>Бильченко Григорий Григорьевич</td>
                        <td>Кафедра теоретической и прикладной механики и математики</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td>чет</td>
                        <td>Физика</td>
                        <td>л.р.</td>
                        <td>323</td>
                        <td>2</td>
                        <td>Гайсин Алмаз Фивзатович</td>
                        <td>Кафедра технической физики</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td>чет</td>
                        <td>Химия</td>
                        <td>л.р.</td>
                        <td>128</td>
                        <td>2</td>
                        <td>Шипилова Римма Рустемовна</td>
                        <td>Кафедра общей химии и экологии</td>
                    </tr>
                </table>
            </div>

            <!-- Четверг -->
            <div class="day-block">
                <h2>Четверг</h2>
                <table class="schedule-table">
                    <tr>
                        <th>Время</th>
                        <th>Дата</th>
                        <th>Дисциплина</th>
                        <th>Вид</th>
                        <th>Аудитория</th>
                        <th>Здание</th>
                        <th>Преподаватель</th>
                        <th>Кафедра</th>
                    </tr>
                    <tr>
                        <td class="time">08:00</td>
                        <td></td>
                        <td>Физическая культура и спорт (элективная дисциплина)</td>
                        <td>пр</td>
                        <td>КСК КАИ ОЛИМП</td>
                        <td>КСК КАИ ОЛИМП</td>
                        <td>Преподаватель кафедры</td>
                        <td>Кафедра физической культуры и спорта</td>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td>неч</td>
                        <td>Физика (спецкурс)</td>
                        <td>пр</td>
                        <td>актовый зал</td>
                        <td>2</td>
                        <td>Царева Альбина Маратовна</td>
                        <td>Кафедра технической физики</td>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td>чет</td>
                        <td>Высшая математика</td>
                        <td>пр</td>
                        <td>401</td>
                        <td>2</td>
                        <td>Бильченко Наталия Григорьевна</td>
                        <td>Кафедра теоретической и прикладной механики и математики</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td>неч</td>
                        <td>Химия</td>
                        <td>пр</td>
                        <td>501</td>
                        <td>2</td>
                        <td>Григорьева Ирина Геннадьевна</td>
                        <td>Кафедра общей химии и экологии</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td>чет</td>
                        <td>Физика (спецкурс)</td>
                        <td>пр</td>
                        <td>актовый зал</td>
                        <td>2</td>
                        <td>Царева Альбина Маратовна</td>
                        <td>Кафедра технической физики</td>
                    </tr>
                    <tr>
                        <td class="time">13:30</td>
                        <td>неч</td>
                        <td>Физика</td>
                        <td>л.р.</td>
                        <td>323</td>
                        <td>2</td>
                        <td>Гайсин Алмаз Фивзатович</td>
                        <td>Кафедра технической физики</td>
                    </tr>
                    <tr>
                        <td class="time">13:30</td>
                        <td>неч</td>
                        <td>Химия</td>
                        <td>л.р.</td>
                        <td>118</td>
                        <td>2</td>
                        <td>Шипилова Римма Рустемовна</td>
                        <td>Кафедра общей химии и экологии</td>
                    </tr>
                    <tr>
                        <td class="time">13:30</td>
                        <td>чет</td>
                        <td>История России</td>
                        <td>пр</td>
                        <td>208</td>
                        <td>8</td>
                        <td>Леонов Игорь Викторович</td>
                        <td>Кафедра социологии, политологии и менеджмента</td>
                    </tr>
                </table>
            </div>

            <!-- Пятница -->
            <div class="day-block">
                <h2>Пятница</h2>
                <table class="schedule-table">
                    <tr>
                        <th>Время</th>
                        <th>Дата</th>
                        <th>Дисциплина</th>
                        <th>Вид</th>
                        <th>Аудитория</th>
                        <th>Здание</th>
                        <th>Преподаватель</th>
                        <th>Кафедра</th>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td>неч</td>
                        <td>История России</td>
                        <td>лек</td>
                        <td>лекционный зал №2</td>
                        <td>2</td>
                        <td>Давыдов Денис Владимирович</td>
                        <td>Кафедра социологии, политологии и менеджмента</td>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td>чет</td>
                        <td>История России</td>
                        <td>лек</td>
                        <td>актовый зал</td>
                        <td>2</td>
                        <td>Давыдов Денис Владимирович</td>
                        <td>Кафедра социологии, политологии и менеджмента</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td>неч</td>
                        <td>Теоретическая механика</td>
                        <td>лек</td>
                        <td>331</td>
                        <td>8</td>
                        <td>Великанов Петр Геннадьевич</td>
                        <td>Кафедра машиноведения и инженерной графики</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td>чет</td>
                        <td>Теоретическая механика</td>
                        <td>лек</td>
                        <td>334</td>
                        <td>8</td>
                        <td>Великанов Петр Геннадьевич</td>
                        <td>Кафедра машиноведения и инженерной графики</td>
                    </tr>
                    <tr>
                        <td class="time">13:30</td>
                        <td></td>
                        <td>Высшая математика (спецкурс)</td>
                        <td>пр</td>
                        <td>300</td>
                        <td>2</td>
                        <td>Бильченко Наталия Григорьевна</td>
                        <td>Кафедра теоретической и прикладной механики и математики</td>
                    </tr>
                </table>
            </div>

            <!-- Суббота -->
            <div class="day-block">
                <h2>Суббота</h2>
                <table class="schedule-table">
                    <tr>
                        <th>Время</th>
                        <th>Дата</th>
                        <th>Дисциплина</th>
                        <th>Вид</th>
                        <th>Аудитория</th>
                        <th>Здание</th>
                        <th>Преподаватель</th>
                        <th>Кафедра</th>
                    </tr>
                    <tr>
                        <td class="time">08:00</td>
                        <td>чет</td>
                        <td>Теория решения изобретательских задач</td>
                        <td>лек</td>
                        <td>ДОТ</td>
                        <td>ДОТ</td>
                        <td>Лопатин Алексей Александрович</td>
                        <td>Кафедра реактивных двигателей и энергетических установок</td>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td>неч</td>
                        <td>Теоретическая механика</td>
                        <td>пр</td>
                        <td>207</td>
                        <td>8</td>
                        <td>Тажибаева Александра Валерьевна</td>
                        <td>Кафедра машиноведения и инженерной графики</td>
                    </tr>
                    <tr>
                        <td class="time">09:40</td>
                        <td>чет</td>
                        <td>Физика</td>
                        <td>пр</td>
                        <td>227</td>
                        <td>2</td>
                        <td>Царева Альбина Маратовна</td>
                        <td>Кафедра технической физики</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td>неч</td>
                        <td>Физика</td>
                        <td>лек</td>
                        <td>331</td>
                        <td>8</td>
                        <td>Царева Альбина Маратовна</td>
                        <td>Кафедра технической физики</td>
                    </tr>
                    <tr>
                        <td class="time">11:20</td>
                        <td>чет</td>
                        <td>Физика</td>
                        <td>лек</td>
                        <td>лекционный зал №2</td>
                        <td>2</td>
                        <td>Царева Альбина Маратовна</td>
                        <td>Кафедра технической физики</td>
                    </tr>
                </table>
            </div> 
            
            <!-- Остальные дни недели -->
            <!-- ... -->

            <a href="index.html" class="back-button">Назад к поиску</a>
        <?php endif; ?>
    </div>
</body>
</html>