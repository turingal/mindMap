# Реализация метрик
В metricscollector/classes/metrics содержится список метрик

## Метрики
- [Тип используемой платформы](###Platform-type)  
- [Тип используемого браузера](###Browser-type)  
- [Язык используемого браузера](###Browser-language)  
- [Количество скачанных текстовых файлов к общему количеству текстовых файлов](###DownloadTextFileHandler)

### Platform-type
- **Класс**: PlatformHandler
- **metricCode**: platform
- **metricValue** может принимать следующие значения:
    - Linux
    - Android
    - Apple
    - BlackBerry
    - FreeBSD
    - Microsoft
    - OpenBSD
    - Palm
    - Symbian
    - Solaris
    - Sony
    
### Browser type
- **Класс**: BrowserTypeHandler
- **metricCode**: browser
- **metricValue** может принимать следующие значения:
    - Safari
    - Firefox
    - IE
    - Chrome
    - YaBrowser
    - Opera
    - Konqueror
    - Iceweasel
    - SeaMonkey
    - Edge
    
### Browser language
- **Класс**: LanguageBrowserHandler
- **metricCode**: language_browser
- **metricValue** все возможные html коды языков,
доступны по ссылке: http://proglang.su/html-reference/language-iso-codes

### Download text files
Используемые форматы файлов: `doc`, `docx`, `txt`, `pdf`, `odt`, `excel`
- **Класс**: DownloadTextFileHandler
- **metricCode**: download_text_file
- **metricValue**:
  - 1 - текстовый файл был загружен
  - 0 - текстовый файл не был загружен
  