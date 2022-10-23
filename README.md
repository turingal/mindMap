# Mind Map

## Inital Setup (Linux)

### Moodle

1. Install **LAMP**
2. Clone our repository

```
cd /var/www
git clone https://github.com/turingal/mindMap
```

3. Configure server
- copy default conf file

```
sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/bonobo.conf
```
- change the contents of the configuration file

```
<VirtualHost bonobo:80>

    ServerName bonobo # hostname
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/bonobo/src/moodle # path/to/source/directory

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
```

- enable site

```
sudo a2ensite bonobo.conf
```

- add line to file `/etc/hosts`

```
sudo nano /etc/hosts

# -------- this is file!

...
127.0.0.1   bonobo

```

4. Customize mysql

```sql
CREATE DATABASE moodle;
CREATE USER 'moodle'@'localhost' IDENTIFIED BY '123';
GRANT ALL PRIVILEGES ON moodle.* TO 'moodle'@'localhost';
FLUSH PRIVILEGES;
```

5. Download moodle 3.8 and copy to `src/`

```
cd /var/www/
git clone -b MOODLE_38_STABLE git://git.moodle.org/moodle.git
```

Copy all files except `.git` and `local` to `/var/www/bonobo/src/moodle`

6. Go to `http://bonobo/` and complete installing
- set pathes
- set database auth data
- configure server
- ...

### Python Server

1. Running the enviroment

- install virtual enviroment

```python3 -m venv venv```

- install flask

```pip3 install -r requirements.txt```

- launch server

Address ```http://127.0.0.1:5000/```

```python server.py```

## Documentation

All documentation in `/docs`
