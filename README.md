Endpoints:



GET(Lista todos los elementos):http://localhost/web/tp_web_segundaentrega/api/games
GET(ASC,asc,DESC,desc)Lista los elementos ordenados por nombre de manera asendente o descendente :http://localhost/web/tp_web_segundaentrega/api/games?orderby=
GET(Trae una entidad dado el id):http://localhost/web/tp_web_segundaentrega/api/games/id (numero)
DELETE (Elimina un elemento dado el id):http://localhost/web/tp_web_segundaentrega/api/games/id (numero)
PUT (Edita un elemento dado su id):http://localhost/web/tp_web_segundaentrega/api/games/id (numero)
POST (Agrega un nuevo elemento):http://localhost/web/tp_web_segundaentrega/api/games

Ejemplo de objeto para poder respetar el orden de las columnas acorde a la base de datos:
{
    "id": "6",
    "Nombre": "Sniper Elite",
    "Descripcion": "Sniper Elite 2 (V2) es la segunda entrega del shooter desarrollado por Rebellion que nos pone en la piel de un francotirador durante la Segunda Guerra",
    "Anio": "2012",
    "id_genero": "1"
}
