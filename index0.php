<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset = "utf-8" />
	    <link rel = "stylesheet" href = "index.css">
        <title>Task</title>
    </head>
    <body>
        <h1> КОНТРОЛЬ ВЫПОЛНЕНИЯ ЗАДАЧ </h1>
        <div class = "form_input">
            <h2> Поставить новую задачу </h2>
            <form action = "index.php" method = "POST" id = "task">
                <p>Имя работника:
                    <select class = "name" name = "select">
                        <option value="1">Саша</option>
                        <option value="2">Антон</option>
                        <option value="3">Дима</option>
                    </select>
                </p>
                <p>Текст задания: <textarea class = "text" name="text"></textarea></p>
                <p>Дата выполнения: <input class = "date" type = "date" name = "date"> </p>
                <p><input class = "button" type = "submit" value = "ПОСТАВИТЬ"></p>
            </form>
            <script>
                var form = document.getElementById("task");

                form.onsubmit = function ()
                    {
                        if (form.text.value == "")
                        {
                            alert ('Задание не введено. Пожалуйста, введите задание в поле "Текст задания"!');
                            return false;
                        }
                        else if (!form.date.value)
                        {
                            alert ('Дата выполнения задания не введена. Пожалуйста, введите дату в поле "Дата выполнения"!');
                            return false;
                        }
                        return true;
                    };
            </script>
        </div>
        <?php
        require ("link.php");
        mysqli_query($link,"SET CHARACTER SET 'utf8'");
        $query = 'SELECT Task.Task, Task.Date, names.Name, Task.Complete FROM `Task` RIGHT JOIN `names` ON Task.Name_ID = names.ID ORDER BY Task.Date'; // переменной присваиваем запрос
        $res = mysqli_query ($link, $query); //передаем запрос в базу и получаем объект
        $count = 1;
        $current_date = date("Y-m-d");
        echo "<table border = 'solid'>";
            echo "<caption> Список заданий </caption>";
            echo "<tr>";
                echo "<th width = '60'>№ п/п</th>";
                echo "<th>Задание</th>";
                echo "<th width = '130'>Дата выполнения</th>";
                echo "<th width = '150'>Исполнитель</th>";
                echo "<th width = '150'>Статус</th>";
            while ($row = mysqli_fetch_row ($res))
                {
                    echo "<tr>";
                        echo "<td>";
                            print_r ($count);
                        echo "</td>";
                        echo "<td align = 'left'>";
                            print_r ($row[0]." ");
                        echo "</td>";
                        echo "<td>";
                            if ($row[1] == $current_date)
                            {
                                echo "<font color = 'LimeGreen'>";
                                print_r ("Сегодня!");
                                echo "</color>";
                            }
                            else if ($row[1] < $current_date && $row[3] == 0)
                            {
                                echo "<font color = 'Red'>";
                                print_r ("Просрочено!");
                                echo "</color>";
                            }
                            else
                            {
                                print_r ($row[1]." ");
                            }
                        echo "</td>";
                        echo "<td>";
                            print_r ($row[2]." ");
                        echo "</td>";
                        echo "<td>";
                            if ($row[3] == 0)
                            {
                                print_r ("Не выполнено");
                            }
                            else
                            {
                                print_r("Выполнено");
                            }
                        echo "</td>";
                    echo "</tr>";
                    $count ++;
                }
        echo "</table>";

        mysqli_close ($link);
    	?>
	</body>
</html>