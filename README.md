# Single Page Application (SPA) for a Job bank

## Developed with Symfony and Angular _using_ _Docker_ and _deployed_ _in_ _Azure_

### author: anderfrago

The aim of this project is to develop a job bank that is simple to use and easy to adapt to the different needs of the users.

To achieve this, the wizard for generating job offers and CVs of alumni has been simplified. In the current version both employers and students can upload their own PDF documents with the information they consider appropriate.
The great advantage of this application is that it allows the administrator users (Artean) to search through key words in the students' CVs. To achieve this, the students' PDFs are transformed into text that is stored in a column of the database.

In addition, to avoid the massive registration of fake accounts, either from former students or employers, every time there is a new registration it must be validated by the account administrator.

## [Demo web page](https://artean-bolsa-empleo.web.app/home)

> The certificate is not valid, to use the application you must accept the risk of accessing the urls below:

- [Backend](https://artean.westeurope.cloudapp.azure.com:8000)

- [Fontend](https://artean.westeurope.cloudapp.azure.com:4200) (Just for debug)

---

## Documentation

### Artean Classic web page documentacion in this [link](https://anderfrago.github.io/artean-bolsa-empleo/)

### Documentation about SPA in this other [link](https://ander-frago-landa.gitbook.io/artean-spa-sym4-3/)

### Access to Docker tutorial [here](https://drive.google.com/file/d/1MAlN7EGC-WjULNI3UB2hycwO2PYf2blZ/view?usp=sharing)

---

## Deployment guide

The demo deployment have been done in a ubuntu server machine, in Azure cloud.
The ports 4200 and 8000 must be open in the machine.

The first thing that must be done in the ubuntu server is to clone the project with git and install Docker and Docker compose.

Once excuted `docker-compose build ` and `docker-compose up`

Is necessary to access to _www_ container to load the project dependencies

` docker exec -it CONTAINER_ID bash`

> You can get the CONTAINER_ID executing
> `docker ps`

Then run these commands:

`composer install`

`php bin\console doctrine:migrations:migrate`

`php bin/console lexik:jwt:generate-keypair`
