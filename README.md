# swivl

<b>Routing:</b><br> 
<ul>
  <li>GET /classrooms get classroom list</li>
  <li>GET /classrooms/1 get the first classroom</li>
  <li>POST /classrooms/ create classroom ({"name": "third classroom", "dateCreated":"21.11.2020","isActive":1})</li>
  <li>PUT /classrooms/1 ({"name": "third classroom", "dateCreated":"21.11.2020","isActive":1})</li>
  <li>PUT /classrooms/1/activate set active status for a classroom</li>
  <li>PUT /classrooms/1/deactivate set not-active status for a classroom</li>
</ul>

<b>Run app:</b><br>
Rename .env.dist to .env and set your parameters<br>
RUN docker-compose up<br>
RUN docker exec -it swivl_php bash<br>
In container from prev step run bin:console:migrations:migrate<br>

Your app on http://127.0.0.1:8888/classrooms/

Some styling fixes are avoided for time saving (usually such problem doesn't exist because it's automated) <br>
Core and rest layers are devided for future app modifications


