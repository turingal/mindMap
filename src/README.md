## Зависимости и миграции PHP

### Установка composer и phinx


1. Установка composer в корне проекта

```
curl -sS https://getcomposer.org/installer | php
```
2. Установка зависимостей

```
php composer.phar require robmorgan/phinx
```

3. Установка Phinx

```
php composer.phar install
```

4. Инициализация конфига

```
php vendor/bin/phinx init
```

### Настройка phinx

1. Создание каталогов

- В корне проекта необходимо создать каталог для хранения миграций

```
database\migrations
```
- Также нужно добавить каталог для механизма seeding

```
database\seed
```

2. Подключение к базе данных

- В файле phinx.yml, который находится в папке проекта, нужно прописатьт пути, где будут расположены миграции и механизмы seed, для наполнения данными

```
paths:
migrations: %%PHINX_CONFIG_DIR%%/database/migrations
seeds: %%PHINX_CONFIG_DIR%%/database/seeds
```
- Также в этом же файле необходимо заполнит данные для подключения базы данных

```
environments:
default_migration_table: phinxlog
default_database: production
production:
adapter: mysql
host: localhost
name: moodle
user: username
pass: password
```

3. Работа с миграциями

- Создание миграции

```
src/vendor/bin/phinx create name_migration
```

- Методы миграций

В методе change описываются запросы, которые будут создаваться при выполнении миграции

```php
public function change()
{
	$table = $this->table('name'); //создание таблицы
        $table->addColumn('name', 'string', ['limit' => 255]) //добавление столбца
              ->create();
}
```
- Выполнение миграции

```
vendor/bin/phinx migrate
```

- Откат миграции

```
vendor/bin/phinx rollback
```

## Gulpfile

Установка зависимостей:

```
npm i
```

Запуск build:

```
gulp build

```
Просмотр наблюдений за изменениями файлов:

```
gulp watch
```
