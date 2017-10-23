REM Server - ett REST Mockup API
===========================================

Servern har ett standard-dataset under `remserver/api/users`.

Du kan skapa egna dataset och jobba med dem genom `remserver/api/[datasets]`.


Testa {#try}
-------------------------------------------

Du kan testa standard-datasetet `users`.

* [Hämta alla användare](remserver/api/users)
* [Häma användaren med `id=1`](remserver/api/users/1)



API {#api}
-------------------------------------------

###Hämta datasetet {#all}

Hämta hela datasetet, eller delar av det.

```text
GET /api/[dataset]
GET /api/users
```

Resultat.

```json
{
    "data": [],
    "offset": 0,
    "limit": 25,
    "total": 0
}

{
    "data": [
        {
            "id": "1",
            "firstName": "Phuong",
            "lastName": "Allison"
        },
        ...
    ],
    "offset": 0,
    "limit": 25,
    "total": 12
}
```

Valfria query-sträng-parametrar.

* `offset` standard = 0.
* `limit` standard = 25.

```text
GET /api/users?offset=0&limit=25
```



###Hämta en post {#one}

Hämta en post baserat på id.

```text
GET /api/users/7
```

Resultat.

```json
{
    "id": "7",
    "firstName": "Etha",
    "lastName": "Nolley"
}
```



###Skapa en ny post {#create}

Skapa en ny post i datasetet, skapar datasetet om det inte finns och lägger till ett id till posten.

```text
POST /api/[dataset]
{"some": "thing"}

POST /api/users
{"firstName": "Mikael", "lastName": "Roos"}
```

Resultat.

```json
{
    "some": "thing",
    "id": 1
}

{
    "firstName": "Mikael",
    "lastName": "Roos",
    "id": 13
}
```



###Upsert/ersätt en post {#upsert}

Upsert (skapa/uppdatera) eller ersätt en post, skapa datasetet om det inte redan finns.

```text
PUT /api/[dataset]/1
{"id": 1, "other": "thing"}

PUT /api/users/13
{"id": 13, "firstName": "MegaMic", "lastName": "Roos"}
```

Värdet i id-fältet uppdateras för att matcha det från PUT-request-värdet.

Resultat.

```json
{
    "other": "thing",
    "id": 1
}

{
    "id": 13,
    "firstName": "MegaMic",
    "lastName": "Roos"
}
```



###Ta bort en post {#delete}

Ta bort en post.

```text
DELETE /api/[dataset]/1

DELETE /api/users/13
```

Resultat kommer alltid bli `null`.



Källkod {#source}
-------------------------------------------

Källkoden finns på GitHub: [dbwebb-se/rem-server](https://github.com/dbwebb-se/rem-server).
