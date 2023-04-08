## About Attendances

Face Recognition Attendance Tool

Currently developed

Install `docker` and `docker-compose`

make sure you Manage Docker as a non-root user
https://docs.docker.com/engine/install/linux-postinstall/

run in terminal: 

    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        -w /var/www/html \
        laravelsail/php81-composer:latest \
        composer install --ignore-platform-reqs

run `cp .env.example .env` <br/>
run `./vendor/bin/sail up` <br/>
run `./vendor/bin/sail php artisan migrate` <br/>
run `./vendor/bin/sail npm i` <br/>
run `./vendor/bin/sail npm run dev` <br/>

visit `localhost


-- To do List

Create new table student_classrooms
create new table institutions
delete className column in students
create classroom_id column in students, so update factories

update models controller and views after theses changes

finally, continue working with 'add descriptors' option into clasroom view
- take descriptor using the photo of the student
- asign descriptor to each student
- give an option to add new descriptors to students without photo

