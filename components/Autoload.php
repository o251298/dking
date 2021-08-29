<?php
// функция для автозагрузки класов
spl_autoload_register(function ($class_name) {
    // прописываем пути к файлам
    $array_path = array(
        '/components/',
        '/models/',
    );
    // проходимся по елементам файла и прописываем полный путь к файлу
    foreach ($array_path as $path){
        $path = ROOT . $path . $class_name . '.php';
        // если файл есть - то подключаем файл
        if (is_file($path)){
            include_once($path);
        }
    }
});

