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


run php artisan storage:link to read images

visit `localhost


-- To do List

- hacer un componente para agregar salones a un estudiante
- Classroom view has to have the option to add students in every classroom



update models controller and views after theses changes

finally, continue working with 'add descriptors' option into clasroom view
- take descriptor using the photo of the student
- asign descriptor to each student
- give an option to add new descriptors to students without photo

bug
- salon repetido no borra el search box
- No se borra letras al cerrar modal en addStudents de la pagina classrooms

Questions
- Is it bad idea delete registers to save the save ones? (classrooms controller update student_classrooms)






