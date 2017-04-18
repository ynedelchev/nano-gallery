The Smallest Possible PHP Nano Gallery
--------------------------------------

This is a photo galllery application developed in PHP.

Installation
------------

 - Clone this repository
   `git clone https://github.com/ynedelchev/nano-gallery`

 - Copy the `nano-gallery` into your Web server root (assuming apache httpd with document root in `/var/www/html`).
   `cp -r nano-gallery /var/www/html`
 
 - Create a subdirectory for each photo album in the `albums` directory and just populate it with photos.
   Your direcotry structure should look similar to this:

   ````
     /var/www/html/nano-gallery
             |
             .
             .
             .
             +-- albums
                  |
                  +-- My Wedding Album
                  |    |
                  |    |-- Photo 1.JPG
                  |    |-- Photo 2.JPG
                  |    `-- Photo 3.JPG
                  |
                  +-- My Aniversary Album
                       |
                       |-- Image 1.PNG
                       |-- Image 2.PNG
                       `-- Image 3.PNG
                 ...
             .
             .
             .
   ````

 - After that execute the `update.sh` script so that you copy the `album.php` int each of these folders as `index.php`. 
   `/var/www/html/nano-gallery/update.sh`
 
 - Congratulations. Now you are ready to access your new gallery on the following address:
   `http://localhost/nano-gallery`

 - Do not forget to rerun `update.sh` each time when you add a new Photo album under `albums` directory.

Sample
------

See a sample of how it looks like here: [http://bgkalendar.com/gallery/](http://bgkalendar.com/gallery/)
  

 Enjoy
