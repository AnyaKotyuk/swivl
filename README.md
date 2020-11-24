# swivl

routing: 
GET /classrooms get classroom list
GET /classrooms/1 get the first classroom
POST /classrooms/ create classroom ({"name": "third classroom", "dateCreated":"21.11.2020","isActive":1})
PUT /classrooms/1 ({"name": "third classroom", "dateCreated":"21.11.2020","isActive":1})
PUT /classrooms/1/activate set active status for a classroom
PUT /classrooms/1/deactivate set not-active status for a classroom

Run app:
Rename .env.dist to .env and set your parameters
docker-compose up


