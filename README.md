## TFG - Plataforma de telemedicina para la diabetes
Sugarcare - Trabajo de Fin de Grado (TFG). Este Trabajo Final de Grado se centra en el desarrollo de una plataforma de telemedicina para el manejo de la diabetes. El proyecto propuesto tiene como objetivo principal facilitar el seguimiento y control de la diabetes mediante la integración de diversas funcionalidades, tales como el registro de glucosa en sangre, la monitorización de la alimentación y actividad física, la comunicación en tiempo real con el equipo médico, y la provisión de recursos educativos para pacientes. Para llevarlo a cabo se ha seguido una metodología de modelo iterativo incremental que facilita el desarrollo global del proyecto en fases más cortas y alcanzables.
La plataforma incluye un sistema avanzado de análisis de datos que permite identificar patrones y generar alertas, mejorando la toma de decisiones tanto para los pacientes como para los profesionales de la salud. También se han incorporado mecanismos de salud colaborativa, permitiendo que los pacientes compartan experiencias y consejos entre ellos, fomentando una comunidad activa. La metodología aplicada incluye el análisis de tecnologías actuales, la definición de requisitos funcionales y no funcionales, y el desarrollo de un prototipo de la plataforma.


## Uso

Para utilizar la aplicación se debe desplegar entorno LAMP O WAMP, también se puede desplegar más cómodamente con docker.

## Parametros de configuración de la aplicación - sugarcare
APP_URL= "URL_HOST"
APP_KEY= "APP_KEY"

# Configuración
### 1.Archivo .env
Abra el archivo .env (directorio raiz) y modifique según su conexión, en este ejemplo se detalla configuración con XAMPP y bases de datos mysql (deben crearla manualmente a través de phpMyAdmin).

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

### 2.Cargar modelo
Para terminar el proceso de creación de tablas utilizaremos:

php artisan migrate

### 3.Registre usuario administrador
### 4.Registre usuario de prueba
### 5.Registre usuario médico de prueba

![ejemplo matriz](./attribution/images/app.jpg)