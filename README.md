# FoodShala

FoodShala is an online Food ordering website that lets customers log in and order food from the menu set by the restaurant and lets restaurants view their orders and edit their menu.

## Installing

- #### Windows
  - Install [WAMP Server](http://www.wampserver.com/en/) or [XAMPP Server](https://www.apachefriends.org/download.html)
  - Navigate to the relevant  directory: 
    - WAMP:   `(install location)/wamp/www`
    - XAMPP:  `(install location)/htdocs`
  - Clone the repository: `git clone https://github.com/arnav-deep/FoodShala.git`
  - Start the server:
    - WAMP:   `(install location)/wamp/wampmanager.exe`
    - XAMPP:  `(install location)/xampp-control.exe`
  - Open Browser and navigate to `http://localhost/phpmyadmin`
  - Create a database 'Foodshala' and import this [backup file]() present in `(install location)/wamp` in the database.

- #### Apple
  - Install [MAMP Server](https://www.mamp.info/en/downloads/)
  - Navigate to `Applications/MAMP/htdocs/`
  - Clone the repository: `git clone https://github.com/arnav-deep/FoodShala.git`
  - Start MAMP `Applications/MAMP/MAMP`
  - Open Browser and navigate to `http://localhost/phpmyadmin`
  - Create a database 'Foodshala' and import this [backup file]() present in `(install location)/wamp` in the database.

- #### Linux
  - Install [LAMP Server](https://bitnami.com/stack/lamp/installer)
  - Open the console (Ctrl + Alt + T) and navigate to the download location of the LAMP installation file
  - Change permissions of the Bitnami LAMP file (change filname to the file you have downloaded):
    `chmod +x bitnami-lampstack-YOUR-VERSION-linux-x64-installer.run`
  - Start the installer:
    `./bitnami-lampstack-YOUR-VERSION-linux-x64-installer.run`
  - Follow the installation steps.
    - Deselect *"Launch lampstack in the cloud with Bitnami"* when presented with the  *"Deploy lampstack to the Cloud in One Click"* window.
  - Navigate to `/home/USERNAME/lampstack-YOUR-VERSION/apache2/htdocs/`
  - Clone the repository: `git clone https://github.com/arnav-deep/FoodShala.git`
  - Start LAMP `/home/USERNAME/lampstack-YOUR-VERSION/manager-linux-x64.run`
  - Open Browser and navigate to `http://localhost/phpmyadmin`
  - Create a database 'Foodshala' and import this [backup file]() present in `(install location)/wamp` in the database.

## Contributing

There are already basic issues and update suggestions mentioned in [Issues](https://github.com/arnav-deep/FoodShala/issues).

If want to contribute code, see the [contribution guide](https://github.com/arnav-deep/FoodShala/blob/master/CONTRIBUTING.md).

## HacktoberFest 2020

- The repository is always open to contributions.
- Please read the [contribution guide](https://github.com/arnav-deep/FoodShala/blob/master/CONTRIBUTING.md) thoroughly for more before sending in Pull Requests.

Created by [Arnav Deep](https://github.com/arnav-deep/).
Copyright 2020 © Arnav Deep
