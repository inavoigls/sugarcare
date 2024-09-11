## TFG - Plataforma de telemedicina para la diabetes
Sugarcare - Trabajo de Fin de Grado (TFG). Plataforma de seguimiento para enfermedades crónicas, con especial énfasis en la diabetes, surge de una conjunción de interés personal, relevancia social y el potencial impacto tecnológico en el ámbito de la salud. La diabetes, siendo una de las enfermedades crónicas más prevalentes a nivel mundial, afecta a millones de personas, impactando significativamente su calidad de vida y generando una carga considerable sobre los sistemas de salud. Este proyecto se alinea con mi aspiración de contribuir al avance de la tecnología aplicada al bienestar de las personas que padecen la enfermedad.

## Uso

Para utilizar la aplicación se debe desplegar entorno LAMP O WAMP, también se puede desplegar más cómodamente con docker.

# Parametros de configuración de la aplicación - sugarcare
url_base = "URL_HOST"
secure_url = "SECURE_URL_HOST"

# Configuración
## 1.Crear dentro del directorio config el fichero configuration.php
interface configuration {

    /** Parametros de la base de datos **/
    const host = '';
    const user = '';
    const password = '';
    const database = '';
}

## 2.Cargar modelo
## 3.Registro usuario administrador
## 4.Registro usuario de prueba
## 5.Registro usuario médico de prueba

![ejemplo matriz](./attribution/images/app.jpg)