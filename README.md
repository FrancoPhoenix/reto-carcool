# Reto Carcool

## Indicaciones

### Vue

1. Deberás crear una instancia de vue
2. Crear componente team el cual desplegará una tabla o listado con los nombres de algunos jugadores de la selección
3. Los jugadores deberán estar almacenados en un archivo js dentro de una carpeta constants. Los datos a desplegar son nombre, posición, cantidad de goles (en cero por default)
4. Dentro del listado deberá habilitarse 2 botones para incrementar y disminuir la cantidad de goles del jugador. Este botón deberá ser implementado con un componente goals (deberás ser claro en los props y la forma en que este componte aumente/disminuya los goles del jugador)
5. El listado deberá contar con un filtro por nombre de jugador y posición
6. Se deberá desplegar la cantidad de jugadores (utilizando computed)
7. Deberás habilitar la opción de agregar/eliminar/editar jugador, cada una de estas acciones ejecutadas deberán desplegar un mensaje de alerta (esta alerta deberá ser otro componente: alert)

### Laravel

1. Se te entrega un token de una api pagada, ¿donde almacenarías el registro según la estructura de un proyecto tipo de Laravel?
2. Crear modelo Player el cual represente el jugador, debe considerar:

- Validaciones: nombre (texto), posición (texto no mayor a 20 caracteres) y cantidad de goles (numérico), todos obligatorios
- Genera relaciones con otros modelos (crea algunos ficticios)
- Método que retorne todos los clubes en los cuales ha jugado anteriormente. 

3. Crear controlador de Player, el cual posea los métodos show (retorna detalle de jugador) y save (registra nuevo jugador) ambos métodos deben contemplar manejos de errores.
4. Definir archivo de rutas para ambos métodos.

## Respuestas

Laravel Api Token: Siguiendo la estructura que plantea Laravel, es preferible guardar el registro de token de una api en el archivo de variables de entorno .env
