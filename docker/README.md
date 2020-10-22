## Setup Docker Dev Environment

1. `cd` into the `docker` folder and create a symlink using:
    
    `ln -s <absolute path to project src folder> ./www`

2. **Make sure you do not commit this symlink.**

3. `cd` back out and run `docker-compose up -d`. You should be able to access XFRM on port 3000. Edit ``docker-compose.yml`` if you want to change the host port. Don't commit any changes to host port.
