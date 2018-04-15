### ASSIGNMENT DETAILS ###
==========================

Git Repository for all the Assignment Tasks : https://github.com/abobby/assignment-inone.git

-----------------------------------
@Task 1 <Folder : task-1>
-----------------------------------
Please write PHP code that converts flattened JSON into a hierarchical JSON.

<SOLUTION>
1. Data Folder Contains the sample json files
2. index.php (Contains the code logic for Task 1 to convert flattened JSON 'flattened.json' into a hierarchical JSON 'hierarchical.json')
3. hierarchical.json is an empty file
4. When index.php is executed the output is written in 'hierarchical.json'

-----------------------------------
@Task 2 <Folder : task-2>
-----------------------------------
Build a MySQL database schema for an e-commerce site products master.

<SOLUTION>
1. Table structure file "table_structure.sql"
2. Queries in "sql_queries.sql"


-----------------------------------
@Task 3 <Folder : task-3>
-----------------------------------
Save user information captured from a form into a database, then retrieve and show all records in a list.

<SOLUTION>
1. cd task-3
2. composer install
3. cp .env.local .env
4. php artisan key:generate
5. Create mysql database
6. Add Database and database access credentials in .env file
7. php artisan migrate
8. php artisan seed
9. php artisan serve
