# Создание метрики
1. Создать класс, наследуемый от `MetricHandler` (_classes/metrics/MetricHandler.php_ *)
1. Определить метод `getResult` (наподобии *PlatformHandler.php*) - для записи метрики в БД
1. Определить метод `getValues` (наподобии *PlatformHandler.php*) - для выборки метрик из БД
1. Дополнить функцию **get_existing_metrics** (*utils.php* *) определением класса для метрики
1. Настроить подготовку и отправку метрики на стороне фронтенда 
   1. создать файл в директории `/src/assets/js`
   1. использовать созданный файл для реализаци логики сбора метрики (пример - _platform.js)

**PS**: (*) пути в пунктах 1-4 указаны относительно директории плагина 
(`/src/moodle/local/metricscollector`)