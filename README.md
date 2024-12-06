## Installation
1. Clone the project:
    ```bash 
    git clone git@gitlab.com:lucky-game-app/lucky-game-app.git
    ```
2. Go to project dir: ``cd <project_dir>``

3. Copy .env file from .env.example: ``cp .env.example .env``
4. Run docker containers: ``docker-compose up -d``
5. Go into docker container:
    ```bash 
    docker-compose exec -u sail app bash
    ```
6. Under the docker container run following commands:
    ```bash
    composer install
    php artisan install
    ```
7. Open in browser http://localhost:8000.
   
