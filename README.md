  ----------- -------------
  Frago, A.   Versión 0.1
  ----------- -------------

**DESARROLLO WEB**

  -- -------------------
     ITC Cuatrovientos
  -- -------------------

![](media/image1.png){width="1.578034776902887in"
height="1.5878772965879264in"}

#Contenido {#contenido .ListParagraph .TtuloTDC}


[[1]{.underline} [El proyecto]{.underline} 4](#el-proyecto)

[[1.1]{.underline} [Gestionar ofertas de empleo]{.underline}
5](#gestionar-ofertas-de-empleo)

[[1.1.1]{.underline} [Página principal]{.underline}
5](#página-principal)

[[1.1.2]{.underline} [Detalles de empleo]{.underline}
5](#detalles-de-empleo)

[[1.1.3]{.underline} [Nuevo empleo]{.underline} 6](#nuevo-empleo)

[[1.2]{.underline} [Gestión de Curriculum vitae (CV)]{.underline}
7](#gestión-de-curriculum-vitae-cv)

[[1.2.1]{.underline} [Añadir un nuevo CV]{.underline}
7](#añadir-un-nuevo-cv)

[[1.3]{.underline} [Gestión de usuarios]{.underline}
7](#gestión-de-usuarios)

[[2]{.underline} [Persistencia]{.underline} 8](#persistencia)

[[2.1]{.underline} [El modelo de datos Entidad-Relación]{.underline}
8](#el-modelo-de-datos-entidad-relación)

[[3]{.underline} [Creación del proyecto]{.underline}
10](#creación-del-proyecto)

[[3.1]{.underline} [Preparación del entorno]{.underline}
10](#preparación-del-entorno)

[[3.1.1]{.underline} [Instalación de Symfony]{.underline}
10](#instalación-de-symfony)

[[3.1.2]{.underline} [Estructurando la aplicación]{.underline}
10](#estructurando-la-aplicación)

[[3.1.3]{.underline} [La filosofía de Symfony]{.underline}
12](#la-filosofía-de-symfony)

[[4]{.underline} [La base de datos]{.underline} 13](#la-base-de-datos)

[[4.1]{.underline} [Integración de la base de datos]{.underline}
13](#integración-de-la-base-de-datos)

[[4.2]{.underline} [Generación de las entidades]{.underline}
13](#generación-de-las-entidades)

[[4.3]{.underline} [Valores iniciales]{.underline}
14](#valores-iniciales)

[[4.3.1]{.underline} [Doctrine Fixture Bundle]{.underline}
14](#doctrine-fixture-bundle)

[[4.3.2]{.underline} [DataFixture]{.underline} 15](#datafixture)

[[5]{.underline} [El layout]{.underline} 17](#el-layout)

[[5.1]{.underline} [Webpack Encore]{.underline} 18](#webpack-encore)

[[5.1.1]{.underline} [Configurando Encore/Webpack¶]{.underline}
20](#configurando-encorewebpack)

[[5.1.2]{.underline} [Plantilla base]{.underline} 23](#plantilla-base)

[[6]{.underline} [Visitante]{.underline} 25](#visitante)

[[6.1]{.underline} [Página principal]{.underline}
25](#página-principal-1)

[[6.1.1]{.underline} [Controlador]{.underline} 25](#controlador)

[[6.1.2]{.underline} [Vista]{.underline} 27](#vista)

[[7]{.underline} [Gestor de ofertas de empleo]{.underline}
29](#gestor-de-ofertas-de-empleo)

[[7.1]{.underline} [Publicar una oferta]{.underline}
30](#publicar-una-oferta)

[[7.2]{.underline} [Visualizar Mis Ofertas]{.underline}
30](#visualizar-mis-ofertas)

[[8]{.underline} [Gestor de CVs]{.underline} 31](#gestor-de-cvs)

[[8.1]{.underline} [Controladores de CV]{.underline}
31](#controladores-de-cv)

[[8.1.1]{.underline} [Creación de un CV]{.underline}
31](#creación-de-un-cv)

[[8.1.2]{.underline} [Edición de un CV]{.underline}
35](#edición-de-un-cv)

[[8.1.3]{.underline} [Busqueda de un CV]{.underline}
37](#busqueda-de-un-cv)

[[9]{.underline} [Gestión de usuarios]{.underline}
38](#gestión-de-usuarios-1)

[[9.1]{.underline} [Jerarquía de las entidades]{.underline}
38](#jerarquía-de-las-entidades)

[[9.1.1]{.underline} [Entidad base: Usuario]{.underline}
39](#entidad-base-usuario)

[[10]{.underline} [Gestión de acceso]{.underline}
44](#gestión-de-acceso)

[[10.1]{.underline} [Formularios de acceso]{.underline}
45](#formularios-de-acceso)

[[10.1.1]{.underline} [Registro de usuario]{.underline}
45](#registro-de-usuario)

[[10.1.2]{.underline} [Acceso de usuario]{.underline}
46](#acceso-de-usuario)

[[11]{.underline} [Acceso a la web]{.underline} 49](#acceso-a-la-web)

[[12]{.underline} [Exalumno]{.underline} 51](#exalumno-1)

[[12.1]{.underline} [Registro de CV]{.underline} 51](#registro-de-cv)

[[12.2]{.underline} [Barra de herramientas]{.underline}
52](#barra-de-herramientas)

[[12.3]{.underline} [Mi CV]{.underline} 52](#mi-cv)

[[12.4]{.underline} [Ventana de edición]{.underline}
52](#ventana-de-edición)

[[12.5]{.underline} [Aplicar a una oferta]{.underline}
53](#aplicar-a-una-oferta)

[[12.6]{.underline} [Mis Candidaturas]{.underline}
53](#mis-candidaturas)

[[13]{.underline} [Empresa]{.underline} 55](#empresa)

[[13.1]{.underline} [Registro]{.underline} 55](#registro)

[[13.2]{.underline} [Barra de herramientas]{.underline}
55](#barra-de-herramientas-1)

[[13.3]{.underline} [Publicar ofertas]{.underline}
55](#publicar-ofertas)

[[13.4]{.underline} [Detalles de oferta]{.underline}
56](#detalles-de-oferta)

[[13.4.1]{.underline} [Candidatos]{.underline} 57](#candidatos)

[[13.5]{.underline} [Buscador de ofertas]{.underline}
57](#buscador-de-ofertas)

Desarrollo según el rolManual de aplicación

ARTEAN: Bolsa de empleo

#El proyecto


Todo el mundo está hablando de la crisis hoy en día. El desempleo está
aumentando de nuevo.

![](media/image2.png){width="1.5748031496062993in"
height="1.3081692913385827in"}

1.  Gráfica de empleo de la última década.

Lo sé, los desarrolladores formados en *ITC Cuatrovientos* no están
realmente preocupados y es por eso por lo que te estas esforzando al
máximo en la asignatura de *Desarrollo Web.*

Dentro de poco te enfrentarás al mercado laboral, con la difícil tarea
de encontrar un empleo que desarrolle tu potencial. Para ello, necesitas
encontrar una plataforma que ofrezca un buen trabajo*. ¿InformaTrabajos*
dices*?* Piensa otra vez.

> *¿Dónde puedes encontrar un empleo de desarrollador de Symfony? *
>
> *¿Dónde puedes anunciar tus habilidades de Symfony?*

Necesitas una plataforma que ofrezca trabajos orientada a
desarrolladores.

-   Una donde puedas encontrar a la mejor gente, los expertos.

-   Una donde sea fácil, rápido y divertido buscar un trabajo, o
    proponer uno.

No busque más. *Artean* es el lugar. Debes de saber que no estás solo,
desde *ITC Cuatrovientos* vamos a ayudarte. Pero, antes tienes la
oportunidad de demostrar tus conocimientos. Vamos a desarrollar un
software *Open-Source* que sólo hace una cosa, pero lo hace bien. Es
fácil de usar, personalizar, ampliar e integrar.

Antes de sumergirnos en el código de cabeza, describamos el proyecto un
poco más. Las siguientes secciones describen las características que
queremos implementar.

El sitio web de *Artean* tiene cuatro tipos de usuarios:

-   Visitantes: **anónimos.**

-   Usuarios de rol **exalumno.**

-   Usuarios de rol **empleador** (Empresa que oferta el empleo).

-   Usuario **administrador** de la aplicación.

Gestionar ofertas de empleo
---------------------------

### Página principal

Todos los usuarios

En la página de inicio, el usuario puede ver los últimos trabajos.

Cuando un usuario entra a la página web *Artean*, ve una lista de los
puestos de trabajo activos. Los puestos de trabajo se clasifican por
categoría y a continuación, por fecha de publicación (los nuevos puestos
de trabajo primero). Para cada puesto de trabajo, sólo se muestran la
ubicación, la posición, y la empresa.

![](media/image3.png){width="2.6388593613298337in"
height="1.968503937007874in"}

1.  2.  Página principal.

### Detalles de empleo

Todos los usuarios

Un usuario hace clic en un puesto de trabajo para ver información más
detallada.

El usuario puede seleccionar un trabajo de la lista para ver información
más detallada.

![](media/image4.png){width="3.1914621609798774in"
height="1.968503937007874in"}

3.  Detalles de empleo.

### Nuevo empleo

Usuario empleador

Un usuario registrado envía un puesto de trabajo.

Un usuario empleador puede enviar un puesto de trabajo. Un puesto de
trabajo está formado por varias partes de información:

-   Compañía

-   Tipo (full-time, part-time, o freelance)

-   Logo (opcional)

-   URL (opcional)

-   Posición

-   Ubicación

-   Categoría (el usuario elige una de una lista de posibles categorías)

<!-- -->

-   Descripción del trabajo (URL y correos electrónicos son enlazados de
    forma automática)

-   Cómo aplicar (URL y correos electrónicos son enlazados de forma
    automática)

-   Público (si el trabajo también puede ser publicados en sitios web
    afiliados)

-   Email (email del ofertante)

![](media/image5.png){width="2.3052832458442696in"
height="1.968503937007874in"}

4.  Nuevo empleo.

Gestión de Curriculum vitae (CV)
--------------------------------

### Añadir un nuevo CV

Usuario con rol de exalumno

Se considera que un CV pude estas compuesto por varias experiencias
laborales previas, diferentes titulaciones de estudios y otros
conocimientos, por ejemplo, idiomas. El CV es pues un conjunto de todos
estos conceptos, por eso el *asistente CRUD* no nos ha facilitado un
simple formulario.

Debemos indicar un flujo de pantallas que nos permita completar esta
tabla mediante una introducción recursiva de registros en las tablas de
*studies*, work\_*experiences*, *another*\_*aknowledges*.

Gestión de usuarios
-------------------

Usuario con rol de administrador

Los visitantes son libres de registrarse como exalumno o empresa, la
verificación la realizarán los administradores del sitio. Dependiendo
del rol seleccionado deberán completar las propiedades correspondientes
a su categoría.

#### El usuario puede solicitar convertirse en empleador

El usuario puede convertirse en Empleador para lo que debe completar el
asistente de registro como empleador y ser validado por el administrador
de *Artean*.

#### El usuario puede registrarse como exalumo

El usuario puede registrarse como exalumno para lo que debe completar el
asistente de registro y ser validado por el administrador de *Artean*.

#### Administrador: configura el sitio web

El administrador puede:

-   editar las categorías en el sitio web

-   edita y elimina cualquier trabajo publicado

-   Validar roles de usuario: activar y desactivar usuarios.

#Persistencia


A continuación, se opresenta el esquema de tablas de base de datos con
el que se va a estructurar la información la aplicación *Artean.*

El modelo de datos Entidad-Relación
-----------------------------------

Aquí está el diagrama de entidad-relación completo en el que se muestran
los campos de las tablas de base de datos y sus relaciones.

![](media/image6.png){width="4.865999562554681in"
height="6.15200021872266in"}

5.  Entidad-Relación completo.

**NOTA:** Existe una tabla extra que sirve para almacenar valores de
configuración en base de datos. Se menciona más adelante.

Las tablas principales cuentan con campos de auditoría (la idea es que
se implementen mediante *triggers* o desde la aplicación) para
establecer el usuario creador y modificador de los registros de base de
datos. En un primer vistazo se pueden apreciar 3 subsistemas.

1.  Exalumnos -- CV

    -   Los Exalumnos tienen CVs.

    -   Los CVs están compuestos de estudios, experiencias laborales,
        idiomas y otros conocimientos.

2.  Empresas - Ofertas

    -   Las empresas publican ofertas.

    -   Las ofertas tienen Curriculum Vitaes (CVs).

Cuando los exalumnos se inscriben las ofertas lo hacen presentando un
CV, este CV puede pasar por varios estados dentro de la oferta.

3.  Gestión de usuarios:

    -   Establece los accesos de usuario y asigna roles de usuario. A
        nivel de aplicación se establecerán los permisos de cada usuaria
        a partir de su rol.

    -   Los usuarios *pueden* ser exalumnos.

#Creación del proyecto


A continuación, se explica mediante una guía paso a paso como llevar a
cabo este proyecto.

Preparación del entorno
-----------------------

El Entorno de Desarrollo Intergrado (IDE) utilizado ha sido PhpStorm al
que se le ha añadido el *plugin de Symfony* y su dependencia del *plugin
de* *Annotations*.

### Instalación de Symfony

La primera tarea que realizar es descargar el instalador de Symfony, lo
hacemos mediante el siguiente comando.

C:\\\> php -r \"file\_put\_contents(\'symfony\',
file\_get\_contents(\'https://symfony.com/installer\'));\"

Creamos nuestro proyecto.

C:\\\> php symfony new sym\_ev2\_artean

Para ejecutar nuestra aplicación lanzaremos el comando

C:\\\> php bin/console server:run

### Estructurando la aplicación

Después de crear la aplicación, vemos un número de archivos y
directorios generados automáticamente:

![](media/image7.png){width="1.1090277777777777in"
height="2.4659722222222222in"}

2.  6.  Estructura del proyecto

Esta jerarquía de archivos y directorios es la convención propuesta por
Symfony para estructurar sus aplicaciones.

El propósito recomendado de cada directorio es el siguiente:

-   app/config/, almacena toda la configuración definida para cualquier
    entorno;

-   app/Resources/, almacena todas las plantillas y los archivos de
    traducción de la aplicación;

-   src/AppBundle/, almacena el código específico de Symfony
    (controladores y rutas), su código de dominio (por ejemplo, clases
    de doctrina) y toda su lógica de negocio;

-   var/cache/, almacena todos los archivos caché generados por la
    aplicación;

-   var/logs/, almacena todos los archivos de registro generados por la
    aplicación;

-   var/sessions/, almacena todos los archivos de sesión generados por
    la aplicación;

-   tests/AppBundle/, almacena las pruebas automáticas (por ejemplo,
    pruebas unitarias) de la aplicación.

-   vendor/, este es el directorio donde Composer instala las
    dependencias de la aplicación y nunca debe modificar ninguno de sus
    contenidos;

-   web/, almacena todos los archivos del controlador frontal y todos
    los activos web, como hojas de estilo, archivos JavaScript e
    imágenes.

#### AppBundle

Cuando Symfony 2.0 fue lanzado, la mayoría de los desarrolladores
adoptaron naturalmente la forma Symfony 1.x de dividir las aplicaciones
en módulos lógicos. Es por eso por lo que muchas aplicaciones Symfony
usan paquetes para dividir su código en características lógicas:
UserBundle, ProductBundle, InvoiceBundle, etc.

Pero un paquete está destinado a ser algo que puede ser reutilizado como
una pieza de software independiente. Si UserBundle no puede ser usado
\"como está\" en otras aplicaciones de Symfony, entonces no debería ser
su propio paquete. Además, si InvoiceBundle depende de ProductBundle,
entonces no hay ventaja en tener dos paquetes separados.

La implementación de un único paquete AppBundle en tus proyectos hará
que su código sea más conciso y fácil de entender.

### **La filosofía de Symfony**

![](media/image8.png){width="2.7559055118110236in"
height="1.5260531496062992in"}

7.  La filosofía de symfony. (Eguiluz, J. 2017. *deSymfony*)

Del mismo modo que la v2.x trajo componentes desacoplados y la v3
introdujo el **microkernel**, symfony 4 vendrá con **cambios
importantes:**

-   Adiós al monolito: Hasta ahora se buscaba que, de base, symfony
    fuese capaz de aportar todo lo necesario independientemente del tipo
    de aplicación a desarrollar: web, api, consola, etc. No en vano, la
    edición estándar de **symfony** consta de más de 40 componentes, 15
    librerías y 11 bundles. Este enfoque ha muerto. A partir de ahora
    tendremos micro aplicaciones base a las que añadir aquello que
    requiramos. Tanto es así que la base de symfony 4 tiene un 70% menos
    de líneas de código que 3.3.

-   **Nueva estructura de directorios:** Sin cambios revolucionarios,
    pero encontrarás varios directorios reubicados o renombrados.
    También se centralizan los contenidos de front: Assets, templates,
    etc. 

![https://blog.irontec.com/wp-content/uploads/2017/07/s4\_directorios-e1499851521624.png](media/image9.png){width="3.499562554680665in"
height="1.968503937007874in"}

8.  Estructura de directorios por defecto. (Madariaga, M. 2017)

> • No más bundles privados: La separación modular del código de
> aplicación se hará exclusivamente vía namespaces de PHP. El concepto
> bundle se conserva exclusivamente para software de terceros instalado
> vía composer.
>
> • parameters.yml desaparece para apostar por variables de entorno.

#La base de datos


Integración de la base de datos
-------------------------------

#### C**onfiguración**

Las opciones de configuración relacionadas con la infraestructura van
definidas en el archivo app/config/parameters.yml. A continuación,
modificamos el nombre de la base de datos en la configuración de
parámetros.

**parameters:**

**database\_host:** 127.0.0.1\
**database\_port:** null\
**database\_name:** bolsaartean\
**database\_user:** root\
**database\_password:** null\
**mailer\_transport:** smtp\
**mailer\_host:** 127.0.0.1\
**mailer\_user:** null\
**mailer\_password:** null

Generación de las entidades
---------------------------

Las entidades deben cumplir con los requisitos establecidos en el
análisis y en la definición de la tabla de base de datos.

Pasamos a crear las entidades, vamos a tener que ejecutar el siguiente
comando por cada una de las tablas de nuestra tabla de base de datos.

C:\\\> php bin/console doctrine:generate:entity

Este comando lanza el asistente que tendremos que completar con los
campos definidos a la hora de establecer la base de datos.

#### Ingeniería inversa

Podemos actualizar nuestro modelo de datos de múltiples formas;
generando las clases *php* de forma manual y añadiendo las
correspondientes anotaciones, generando las entidades con el asistente o
actualizando nuestra aplicación desde una base de datos ya generada.

En esta ocasión vamos a generar el resto de nuestro modelo de datos
desde la base de datos creada con *MySQL Workbench* para lo que
ejecutaremos el siguiente comando.

php bin\\console doctrine:mapping:import AppBundle annotation

Valores iniciales
-----------------

### Doctrine Fixture Bundle

Para poner algunos datos iniciales en nuestra base de datos, crearemos
el comando de la consola que nos permite llenar una base de datos. Pero
antes de hacerlo, necesitaremos un componente adicional llamado
*Fixtures*.

Vamos a instalar el *bundle* DoctrineFixturesBundle y a generar nuestro
contenido de mentira.

composer require \--dev doctrine/doctrine-fixtures-bundle

Una vez que se actualizan las dependencias podemos verificar que se han
añadido las siguientes líneas en composer.json.

\"require-dev\": {

\"doctrine/doctrine-fixtures-bundle\": \"\^3.0\",

**\...**

},

Activamos la dependencia en el kernel, en la sección de desarrollo:

**\<?php\
\...**\
**class** AppKernel **extends** Kernel\
{\
**public function** registerBundles()\
{\
**\...**\
**if** (*in\_array*(\$this-\>getEnvironment(), \[**\'dev\'**,
**\'test\'**\], **true**)) {\
**\...**

\$bundles\[\] = **new**
Doctrine\\Bundle\\FixturesBundle\\DoctrineFixturesBundle();\
\
**\...**

Y con todo instalado, podemos empezar a crear fixtures.

Para generar valores aleatorios de las ofertas de empleo vamos a hacer
uso de otro Bundle. *Faker* es una biblioteca PHP que genera datos
falsos para nosotros. Una manera sencilla de poner en marcha una base de
datos para hacer pruebas de desarrollo.

composer require \--dev fzaninotto/faker

\"require-dev\": {

\...

\"fzaninotto/faker\": \"\^1.7\",

\...

},

### DataFixture

Los *DataFixture* son clases de PHP donde se crean objetos y los
almacenamos de manera persistente en la base de datos. Imagina que
deseamos inicializar nuestra base de datos. *¡No hay problema! *

Creamos una clase de InitialFixture dentro de una carpeta DataFixtures
dentro de AppBundle.

**\<?php\
namespace** AppBundle\\DataFixtures;\
\
**use** Faker;\
**use** AppBundle\\Entity\\OfferMgr\\Offers;\
**use** AppBundle\\Entity\\UserMgr\\Employeers;\
\
**use** Doctrine\\Bundle\\FixturesBundle\\ORMFixtureInterface;\
**use** Doctrine\\Common\\Persistence\\ObjectManager;\
\
**class** InitialFixture **implements** ORMFixtureInterface\
{\
**public function** load(ObjectManager \$manager)\
{\
*// Creating 20 job offers\
***for** (\$i = 0; \$i \< 20; \$i++)\
{\
\$jobFaker = Faker\\Factory::*create*();\
\
*// Employeer\
*\$employeer = **new** Employeers();\
\$employeer-\>setUsername(**\"Cuatrovientos\_**\$i**\"**);\
\$employeer-\>setEmail(**\"artean\_**\$i**\@cuatrovientos.org\"**);\
\$employeer-\>setPassword(**\"4Vientos\"**);\
\
\$employeer-\>setVCIF(**\"82102288A\"**);\
\$employeer-\>setVName(\$jobFaker-\>**company**);\
\$employeer-\>setVLogo(\$jobFaker-\>**imageUrl**(\$width=640,
\$height=480));\
\$employeer-\>setVDescription(\$jobFaker-\>**sentence**);\
\$employeer-\>setVContactName(\$jobFaker-\>**name**);\
\$employeer-\>setVContactPhone(\$jobFaker-\>**phoneNumber**);\
\$employeer-\>setVContactMail(\$jobFaker-\>**companyEmail**);\
\$employeer-\>setVLocation(\$jobFaker-\>**address**);\
\$employeer-\>setNNumberOfWorkers(\$jobFaker-\>**numberBetween**(0,255));\
\$employeer-\>setCreationUser(**\"InitialFixture\"**);\
\$employeer-\>setCreationDate(**new** \\DateTime(**\"2018-6-1\"**));\
\$employeer-\>setModificationUser(**\"InitialFixture\"**);\
\$employeer-\>setModificationDate(**new**
\\DateTime(**\"2018-6-1\"**));\
\
\$manager-\>persist(\$employeer);\
\
*// Offer\
*\$offer = **new** Offers();\
\$offer-\>setVOfferCode(**\"ACTIVE\"**);\
\$offer-\>setVOfferType(**\'full-time\'**);\
\$offer-\>setDActivationDate(**new** \\DateTime(**\"2018-6-1\"**));\
\$offer-\>setDDueDate(**new** \\DateTime(**\"2018-6-**\$i**\"**));\
\$offer-\>setVPosition(*implode*(**\' \'**,
\$jobFaker-\>**words**(2)));\
\$offer-\>setLtextDuties(\$jobFaker-\>**sentence**);\
\$offer-\>setLtextDescription(\$jobFaker-\>**paragraph**);\
\$offer-\>setVSalaray(**\"1200\"**);\
\$offer-\>setLtextExperienceRequirements(\$jobFaker-\>**paragraph**);\
\$offer-\>setVLocation(\$jobFaker-\>**city**.**\',
\'**.\$jobFaker-\>**country**);\
\
\$offer-\>setEmployeer(\$employeer);\
\
\$offer-\>setCreationUser(**\"InitialFixture\"**);\
\$offer-\>setCreationDate(**new** \\DateTime(**\"2018-6-1\"**));\
\$offer-\>setModificationUser(**\"InitialFixture\"**);\
\$offer-\>setModificationDate(**new** \\DateTime(**\"2018-6-1\"**));\
\
\$manager-\>persist(\$offer);\
}\
\
\$manager-\>flush();\
}\
\
}

Añadimos la siguiente configuración en el archivo
app/config/services.yml

*\# Fixtures services\
\# makes classes in src/AppBundle/DataFixtures available to be used as
services\
\# and have a tag that allows actions to type-hint services\
***AppBundle\\DataFixtures\\**:\
**resource**: **\'../../src/AppBundle/DataFixtures\'\
tags**: \[**\'doctrine.fixture.orm\'**\]

Ya solo nos falta ejecutarlo, es muy fácil, pero mucho cuidado que hará
un *truncate* de todas nuestras tablas:

php bin/console doctrine:fixtures:load

#El layout


En primer lugar, si realizas una mirada más cercana a los prototipos,
*mockups*, te darás cuenta de que gran parte de cada página se ve igual.
Ya sabes que la duplicación de código es mala, ya sea que hablemos de
código HTML o PHP, por lo que necesitamos encontrar una forma de evitar
que estos elementos de vista común resulten en duplicación de código.

Una forma de resolver el problema es definir un encabezado y un pie de
página e incluirlos en cada plantilla:

![](media/image10.png){width="4.09375in" height="1.0416666666666667in"}

9.  Layout.

Pero aquí el encabezado y los archivos de pie de página no contienen
HTML válido. Debe haber una mejor manera. En lugar de reinventar la
rueda, usaremos otro patrón de diseño para resolver este problema: **el
patrón de diseño del decorador**. El patrón de diseño del decorador
resuelve el problema al revés: **la plantilla está decorada después.**

**Puedes analizar el siguiente ejemplo:**

[[https://es.wikipedia.org/wiki/Decorator\_(patron\_de\_diseño)\#Ejemplo\_de\_PHP]{.underline}](https://es.wikipedia.org/wiki/Decorator_(patron_de_diseño)#Ejemplo_de_PHP)

A continuación, vamos a darle un aspecto más usable a nuestra web. Para
ello comenzamos integrando los archivos CSS y JS de *Boostrap* de una
manera sencilla.

Symfony viene con una biblioteca de JavaScript, llamada Webpack Encore,
que hace que trabajar con CSS y JavaScript sea una delicia.

Webpack Encore
--------------

*Webpack Encore* es una forma más simple de integrar *Webpack* en una
aplicación. Webpack proporciona una API limpia y potente para agrupar
módulos de JavaScript, preprocesar CSS y JS y compilar y minificar
archivos.

Realizamos la instalación ejecutando el siguiente comando:

npm install \@symfony/webpack-encore \--save-dev

Instalamos las dependencias de *Webpack* con estos tres comandos.

npm install node-sass

npm install sass-loader@\^7.0.1 \--save-dev

npm install webpack-notifier

También instalamos las dependencias e Bootstrap.

npm install \--save jquery popper.js

Además, añadimos unos iconos para usar en nuestro proyecto.

npm install \--save webpack-icons-installer

Tenemos un simple proyecto, con una carpeta assets donde agrupamos las
hojas de estilos SCSS siguiendo la siguiente arquitectura, para que el
código CSS sea fácil de mantener y evolucionar y ayudando a evitar
problemas relacionados con la herencia de estilos.

![](media/image11.png){width="1.2229166666666667in"
height="1.5933562992125985in"}

10. Carpeta de assets.

Una buena práctica de estructura de carpetas para los estilos es:

-   **01\_settings**: Contiene las variables globales, configuración,
    colores, etc. común para todo el proyecto.

-   **02\_tools**: Mixins y funciones comunes para todo el proyecto.

-   **03\_generic**: Estilos para unificar la visualización en
    navegadores (por ejemplo normilize.css) e impresoras, declaración de
    fuentes, reglas globales para box-sizing, etc.

-   **04\_elements**: Estilos a etiquetas de HTML.

-   **05\_objects**: Patrones de layout estructurales repetitivos, sin
    ningún aspecto visual, por ejemplo, el [[media
    object]{.underline}](http://www.stubbornella.org/content/2010/06/25/the-media-object-saves-hundreds-of-lines-of-code/).

-   **06\_components**: Piezas de la interfaz de usuario reconocibles,
    con estilos visuales propios. También llamados componentes.

-   **07\_themes**: Estilos para cambiar el aspecto de componentes y
    elementos en base a la clase del theme.

-   **08\_specifics**: Estilos específicos de partes de una página que
    aún no se ha encontrado el patrón para convertirlo en componente.

-   **09\_utilities**: Clases totalmente especializadas que aportan
    estilos que sobreescriben cualquiera de los anteriores si fuera
    necesario. Cada clase contiene un único estilo, a diferencia de los
    componentes.

Dentro de la carpeta css debemos tener un archivo app.scss donde
importamos los elementos css.

\@import \'settings\';

\@import \'elements\';

\@import \'objects\';

\@import \'themes\';

...

Con *Encore*, debemos pensar en CSS como una dependencia del JavaScript.
Esto significa que hay que requerir cualquier CSS que se necesite desde
dentro de JavaScript:

require(\'../scss/global.scss\');

// CSS\
require(\'../css/bootstrap.min.css\');\
require(\'../css/bootstrap-grid.min.css\');\
require(\'../css/bootstrap-reboot.min.css\');\
// JS\
require(\'./bootstrap.min.js\');\
require(\'./bootstrap.bundle.min.js\');

// Icons\
require(\'./webpack-icons-installer\');\
console.info(\'Your script is loaded.\');

Con Encore, podemos minimizar fácilmente estos archivos, preprocesar
app.scss a través de Sass y mucho más.

### Configurando Encore/Webpack¶

Creamos un nuevo archivo llamado webpack.config.js en la ruta raíz de
nuestro proyecto.

En el interior, establecemos el siguiente código de configuración.

var Encore = require(\'\@symfony/webpack-encore\');

Encore

// directory where all compiled assets will be stored

.setOutputPath(\'web/build/\')

// Windows??? \<\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

.setManifestKeyPrefix(\'build\')

// what\'s the public path to this directory (relative to your
project\'s document root dir)

.setPublicPath(\'/build\')

// empty the outputPath dir before each build

.cleanupOutputBeforeBuild()

// will output as web/build/app.js

.addEntry(\'app\', \'./web/assets/js/main.js\')

// will output as web/build/global.css

.addStyleEntry(\'global\', \'./web/assets/scss/global.scss\')

// allow sass/scss files to be processed

.enableSassLoader()

// allow legacy applications to use \$/jQuery as a global variable

.autoProvidejQuery()

.enableSourceMaps(!Encore.isProduction())

// create hashed filenames (e.g. app.abc123.css)

// .enableVersioning()

;

// export the final configuration

module.exports = Encore.getWebpackConfig();

Debemos crear las carpetas *build* dentro la carpeta web. Para realizar
la compilación de los assets utilizamos el siguiente comando, ejecutado
desde la ruta donde se encuentra *Encore*.

call ./node\_modules/.bin/encore dev \--context ./

![](media/image12.png){width="1.0475251531058618in"
height="1.5748031496062993in"}

11. Webpack build.

Después de ejecutar uno de estos comandos, ahora se puede agregar las
secuencias de comandos y etiquetas de enlace a los nuevos recursos
compilados (por ejemplo, /build/app.css y /build/app.js).

Actualmente el documento base.html.twig se encuentra dentro de la
carpeta app en Resources\>views. Todas las páginas van a partir de este
mismo punto raíz. Desde este archivo se enlazan las hojas de estilos.

#### Iconos

Para hacer uso de los iconos instalados actualizamos dentro del
directorio build el archivo manifest.json estableciendo las rutas para
descarga de las fuentes y los iconos que vamos a utilizar.

{\
**\"build/app.css\"**: **\"/build/app.css\"**,\
**\"build/app.js\"**: **\"/build/app.js\"**,\
**\"build/global.css\"**: **\"/build/global.css\"**,\
**\"build/fonts/MaterialIcons-Regular.woff\"**:
**\"/build/fonts/MaterialIcons-Regular.012cf6a1.woff\"**,\
**\"build/fonts/MaterialIcons-Regular.woff2\"**:
**\"/build/fonts/MaterialIcons-Regular.570eb838.woff2\"**,\
**\"build/fonts/MaterialIcons-Regular.ttf\"**:
**\"/build/fonts/MaterialIcons-Regular.a37b0c01.ttf\"**,\
**\"build/fonts/MaterialIcons-Regular.eot\"**:
**\"/build/fonts/MaterialIcons-Regular.e79bfd88.eot\"**,\
**\"build/fonts/fontawesome-webfont.eot?v=4.7.0\"**:
**\"/build/fonts/fontawesome-webfont.674f50d2.eot\"**,\
**\"build/fonts/fontawesome-webfont.woff2?v=4.7.0\"**:
**\"/build/fonts/fontawesome-webfont.af7ae505.woff2\"**,\
**\"build/fonts/fontawesome-webfont.ttf?v=4.7.0\"**:
**\"/build/fonts/fontawesome-webfont.b06871f2.ttf\"**,\
**\"build/fonts/fontawesome-webfont.woff?v=4.7.0\"**:
**\"/build/fonts/fontawesome-webfont.fee66e71.woff\"**,\
**\"build/fonts/glyphicons-halflings-regular.woff2\"**:
**\"/build/fonts/glyphicons-halflings-regular.448c34a5.woff2\"**,\
**\"build/fonts/glyphicons-halflings-regular.ttf\"**:
**\"/build/fonts/glyphicons-halflings-regular.e18bbf61.ttf\"**,\
**\"build/fonts/glyphicons-halflings-regular.eot\"**:
**\"/build/fonts/glyphicons-halflings-regular.f4769f9b.eot\"**,\
**\"build/fonts/glyphicons-halflings-regular.woff\"**:
**\"/build/fonts/glyphicons-halflings-regular.fa277232.woff\"**,\
**\"build/images/fontawesome-webfont.svg?v=4.7.0\"**:
**\"/build/images/fontawesome-webfont.912ec66d.svg\"**,\
**\"build/images/glyphicons-halflings-regular.svg\"**:
**\"/build/images/glyphicons-halflings-regular.89889688.svg\"\
**}

### Plantilla base

A continuación el código actualizado de este archivo desde donde se
enlazan a los archivos css y js en el archivo base.html.twig:

\<!DOCTYPE **html**\>\
\<**html**\>\
\<**head**\>\
\<**meta charset=\"UTF-8\"** /\>\
\<**title**\>{% **block** title %}Artean{% **endblock** %}\</**title**\>\
{% **block** stylesheets %}\
\<**link rel=\"stylesheet\"\
href=\"**{{asset(**\'build/app.css\'**)}}**\"**\>\
{% **endblock** %}\
\</**head**\>\
\<**body**\>\
\
{% **block** navbar %}\
{% **if** is\_granted(**\'IS\_AUTHENTICATED\_FULLY\'**) %}\
{% **include \'navbar/private.html.twig\'** %}\
{% **else** %}\
{% **include \'navbar/public.html.twig\'** %}\
{% **endif** %}\
{% **endblock** %}\
\
{% **block** body %} {% **endblock** %}\
\
{% **block** javascripts %}\
\<**script src=\"**{{asset(**\'build/app.js\'**)}}**\"**\>
\</**script**\>\
{% **endblock** %}\
\
\</**body**\>\
\<**footer class=\"footer\"**\>\
{% **block** footer %}{% **endblock** %}\
\</**footer**\>\
\
\</**html**\>

Desarrollo según el rol.

Aplicación desglosada según los roles de usuario

#Visitante


Usuario anónimo

A continuación, se desarrollan las pantallas dentro del ámbito de un
usuario visitante.

Página principal
----------------

### Controlador

En la página principal se muestra un listado de las ofertas de empleo
más recientes.

#### Repositorio de clases personalizadas

Con el objetivo de aislar, reutilizar y probar consultas, es una buena
práctica crear una clase de repositorio personalizada para una entidad.
Los métodos que contienen la lógica de la consulta pueden almacenarse en
esta clase.

Para hacer esto, agregamos el nombre de clase del repositorio a la
definición de mapeo de su entidad:

**\<?php\
***/\*\* **\@title** Offers \...\*/\
***namespace** AppBundle\\Entity\\OfferMgr;\
\
**use** Doctrine\\ORM\\Mapping **as** ORM;\
\
*/\*\*\
\* **\@ORM\\Table**(name=\"offers\")\
\*
**\@ORM\\Entity**(repositoryClass=\"AppBundle\\Repository\\OfferMgr\\OffersRepository\")\
\*/\
***class** Offers {

...

Luego, creamos una clase Repository\\OfferMgr\\OffersRepository vacía
que se extienda desde DoctrineORMEntityRepository.

Luego, agregamos un nuevo método - findAllActive() - a la clase
OffersRepository recién generada. Este método consultará todas las
entidades de ofertas activas, ordenadas alfabéticamente por fecha.

**\<?php\
***/\*\* **\@title** OffersRepository \...\*/\
***namespace** AppBundle\\Repository\\OfferMgr;\
\
**use** Doctrine\\ORM\\EntityRepository;\
\
**class** OffersRepository **extends** EntityRepository {\
\
**public function** findAllActive()\
{\
**return** \$this-\>getEntityManager()\
-\>createQuery(\
**\"SELECT o FROM AppBundle:OfferMgr\\Offers o WHERE
o.vOfferCode=\'ACTIVE\' ORDER BY o.modificationDate ASC\"\
**)\
-\>getResult();\
}\
\
}

Dentro de la carpeta de controladores establecemos la lógica de
comunicación entre la petición desde URL de visualización de la pantalla
principal, la obtención de los datos a través de los Repositorios de
entidades y de la plantilla html.

Por cada una de las ofertas obtendremos la entidad del empleador
formando un elemento compuesto que será el que renderizemos en la vista.

**\<?php\
\
namespace** AppBundle\\Controller;\
\
**use** AppBundle\\Entity\\OfferMgr\\Offers;\
**use** AppBundle\\Entity\\UserMgr\\Employeers;\
**use** Symfony\\Bundle\\FrameworkBundle\\Controller\\Controller;\
**use** Symfony\\Component\\HttpFoundation\\Request;\
**use** Symfony\\Component\\Routing\\Annotation\\Route;\
\
**class** DefaultController **extends** Controller\
{\
*/\*\*\
\* **\@Route**(\"/\", name=\"homepage\")\
\*/\
***public function** indexAction(Request \$request)\
{\
\$offers = \$this-\>getDoctrine()\
-\>getRepository(Offers::**class**)\
-\>findAllActive();\
\
**return** \$this-\>render(**\'default/index.html.twig\'**, **array**(\
**\'offers\'** =\> \$offers,\
));\
}\
}

### Vista

La página principal es la página por defecto index.html.twig alojada
dentro del directorio default.

{% **extends \'base.html.twig\'** %}\
{% **block** navbar %}\
{% **include \'navbar/public.html.twig\'** %}\
{% **extends \'base.html.twig\'** %}\
\
{% **block** body %}\
\
\<**div class=\"container-fluid alert alert-dark alert-dismissible fade
show pt-0 pb-2\" role=\"alert\"** \>\
\<**div class=\"row\"**\>\
\<**div class=\"col-10 mx-auto\"**\>\
\<**h2 class=\"alert-heading display-2\"**\>Bolsa de empleo\</**h2**\>\
\<**hr**\>\
\<**p class=\"mb-0 lead\"**\>Servicio gratuito cuya finalidad es
facilitar el acceso al mercado laboral de las personas que conforman la
Comunidad Cuatrovientos (alumnado, exalumnado\...) dando respuesta a los
procesos de selección solicitados por las empresas y otras
organizaciones.\</**p**\>\
\</**div**\>\
\</**div**\>\
\<**button type=\"button\" class=\"close\" data-dismiss=\"alert\"
aria-label=\"Close\"**\>\
\<**span aria-hidden=\"true\"**\>**&times;**\</**span**\>\
\</**button**\>\
\</**div**\>\
\
\<**div class=\"container-fluid\"**\>\
\<**div class=\"row\"**\>\
\<**div class=\"col-10 mx-auto\"**\>\
\<**h6 class=\"lead\"**\>A continuación ofrecemos las ofertas de
empleo.\</**h6**\>\
\</**div**\>\
\</**div**\>\
\<**div class=\"row bg-white\"**\>\
\<**div class=\"col-8 mx-auto \"**\>\
{% **for** offer **in** offers %}\
\<**div class=\"media py-2\"**\>\
\<**img class=\"my-auto card-img\" style=\"width**:60**px\" src=\"**{{
offer.Employeer.getVLogo() }}**\" alt=\"logo empresa\"**\>\
\<**div class=\"media-body\"**\>\
\<**div class=\"mx-4 d-flex justify-content-between \"**\>\
\<**h4 class=\"p-0\"**\> {{ offer.getVPosition() }}\
\<**small** \>\<**i** \> {{ offer.getDActivationDate() \|
date(**\'d-m-Y\'**) }}\</**i**\>\</**small**\>\
\</**h4**\>\
\<**a href=\"**{{ path(**\'offers\_show\'**, {**\'id\'**:
offer.getId()}) }}**\" class=\"btn btn-outline-primary\"**\>More
details\...\</**a**\>\
\</**div**\>\
\<**div class=\"px-2\"**\>\
\<**p class=\"card-body text-muted mb-0\"**\> {{
offer.getLtextDescription() }} \</**p**\>\
\</**div**\>\
\</**div**\>\
\</**div**\>\
\<**hr**/\>\
{% **endfor** %}\
\</**div**\>\
\</**div**\>\
\</**div**\>\
{% **endblock** %}

#Gestor de ofertas de empleo


Para el desarrollo de la funcionalidad Gestor de ofertas de empleo vamos
a establecer un espacio de nombres, OfferMgr. En este espacio de nombres
la entidad principal es Ofertas y su relación con la entidad de
Empleadores.

Las ofertas son publicadas por los empleadores de las empresas. Un
empleador puede publicar múltiples ofertas. Por lo que la relación es
*Many to one* en Ofertas y *One to many* en Empleadores.

Dentro de la entidad Ofertas establecemos el siguiente código
responsable de realizar la relación.

*/\*\*\
\*
**\@ORM\\ManyToOne**(targetEntity=\"AppBundle\\Entity\\OfferMgr\\Employeers\",
inversedBy=\"offers\",cascade={\"persist\"})\
\* **\@ORM\\JoinColumn**(name=\"employeer\_id\",
referencedColumnName=\"id\")\
\*/\
***private \$employeer**;

Dentro de la entidad de empleadores establecemos la relación inversa.

*/\*\*\
\*
**\@ORM\\OneToMany**(targetEntity=\"AppBundle\\Entity\\OfferMgr\\Offers\",
mappedBy=\"employeer\")\
\*/\
***private \$offers**;\
\
**public function** \_\_construct()\
{\
\$this-\>**offers** = **new** ArrayCollection();\
}

Haciendo uso del asistente vamos a crear un primer prototipo de lo que
serían las acciones CRUD sobre la tabla de ofertas.

C:\\\> php bin/console doctrine:generate:crud

Publicar una oferta
-------------------

Usuario empleador

A partir del asistente CRUD disponemos de la mayor parte de la lógica de
esta funcionalidad.

La actualización para implementar en el código autogenerado es que estas
funcionalidades deben de ser personalizadas para el usuario empleador
que ha iniciado sesión. A la hora de realizar la inserción en base de
datos del usuario creador (campo de auditoría de la tabla de base de
datos), debemos establecer este valor con el usuario que ha iniciado
sesión.

Visualizar Mis Ofertas
----------------------

Usuario empleador

Lo mismo pasa al realizar la obtención de todas las ofertas, en el
repositorio de ofertas debemos limitarlo a *todas las ofertas de un
usuario determinado.*

*/\*\*\
\* **\@Route**(\"offers\")\
\*/\
***class** OffersController **extends** Controller\
{\
*/\*\*\
\* Lists all offer entities from logged in Employeer\
\* **\@Route**(\"/\", name=\"offers\_index\")\
\* **\@Method**(\"GET\")\
\*/\
***public function** indexAction(Request \$request)\
{\
\$em = \$this-\>getDoctrine()-\>getManager();\
*// Get all the offers published by the logged employer\
*\$loggedin\_username =
\$request-\>getSession()-\>get(Security::***LAST\_USERNAME***);\
\$offers =
\$em-\>getRepository(**\'AppBundle:OfferMgr\\Offers\'**)-\>findOffersFromEmployeer(\$loggedin\_username);\
\
**return** \$this-\>render(**\'offermgr/offers/index.html.twig\'**,
**array**(\
**\'offers\'** =\> \$offers,\
));\
}

#Gestor de CVs


Se considera que un CV pude estas compuesto por varias experiencias
laborales previas, diferentes titulaciones de estudios y otros
conocimientos o idiomas. El CV es un conjunto de todos estos conceptos.
Para aprovechar las funcionalidades de Symfony realizamos el CRUD de las
tablas que conforman el CV; *studies*, work\_*experiences*, *languages*
y *other*\_*knowledges*.

Para completar un CV debemos indicar un flujo de pantallas que nos
permita completar esta tabla mediante la introducción recursiva de
registros en las tablas de *studies*, work\_*experiences*, *languages* y
*other*\_*knowledges*. Esta lógica debemos implementarla en el
controlador.

Controladores de CV
-------------------

### Creación de un CV

Usuario exalumno

CVCreatorController

En la lógica de creación de un controlador debemos de tener en cuenta
que el CV no es más que un contenedor, donde se agrupan diferentes
registros, ya sean de experiencias laborales, estudios, idiomas u otros
conocimientos.Además, el número de cada uno de estos elementos es
indefinido y diferente en cada uno de los CVs.

Es por eso que debemos hacer uso de la recursividad a la hora de
establecer un asistente de creación de CVs que contemple la creación de
múltiples componentes asociados dando opción al usuario de registrar
múltiples experiencias laborales, estudios, etc.

#### Recursividad

A continuación, la lógica implementada para realizar una llamada
recursiva al formulario de creación de múltiples experiencias laborales.

*/\*\*\
\* **\@Route**(\"/new\_workexperience\",
name=\"workexperience\_task\_add\"))\
\*/\
***public function** addWorkExperienceAction(Request \$request, Session
\$session){\
*//Check if there is any existing CV in session\
*\$this-\>checkIfCVinSessionExists(\$session);\
\
\$workExperience = **new** WorkExperiences();\
\$form =
\$this-\>createForm(**\'AppBundle\\Form\\CvMgr\\WorkExperiencesType\'**,
\$workExperience);\
\$form-\>handleRequest(\$request);\
\
**if** (\$form-\>isSubmitted() ) {\
*// 1. DateTime parse\
*\$startDate = \$workExperience-\>getDStartDate();\
\$workExperience-\>setDStartDate(**new** \\DateTime(\$startDate));\
\$endDate = \$workExperience-\>getDEndDate();\
\$workExperience-\>setDEndDate(**new** \\DateTime(\$endDate));\
*// 2. Set the relation to the CV\
*\$workExperience-\>setCv(\$this-\>**actual\_user\_cv**);\
*// 3. Update CV in session\
*\$this-\>**actual\_user\_cv** =
\$session-\>get(**\'actual\_user\_cv\'**);\
\$this-\>**actual\_user\_cv**-\>addWorkexperience(\$workExperience);\
\$session-\>set(**\'actual\_user\_cv\'**,
\$this-\>**actual\_user\_cv**);\
\
*// Depending on the request the user might want to enter another
work-experience (true)\
// or continue to insert studies (false)\
*\$nextAction = \$form-\>get(**\'saveAndAdd\'**)-\>isClicked()\
? **\'task\_new\'\
**: **\'task\_success\'**;\
\
**if**( \$nextAction == **\'task\_success\'** ){\
*// Next, the user adds his studies\
***return** \$this-\>redirectToRoute(**\'studies\_task\_add\'**);\
}\
**else**{\
*// Clears previous form\
***unset**(\$workExperience);\
**unset**(\$form);\
*// recursive call to addWorkExperienceAction\
***return**
\$this-\>redirectToRoute(**\'workexperience\_task\_add\'**);\
}\
}\
**return** \$this-\>render(**\'cvmgr/workexperiences/new.html.twig\'**,
**array**(\
**\'workExperience\'** =\> \$workExperience,\
**\'form\'** =\> \$form-\>createView(),\
));\
}

#### Almacenamiento en base de datos

Una vez el usuario a finalizado de crear su CV, introduciremos los
valores gestionados en la sesión a la base de datos.

*/\*\*\
\* **\@Route**(\"/new\_otherknowledge\", name=\"other\_task\_add\"))\
\*/\
***public function** addOtherKnowledgeAction(Request \$request , Session
\$session){ *//Check existing CV\
//Check if there is any existing CV in session\
*\$this-\>checkIfCVinSessionExists(\$session);\
\
\$other\_knowledge = **new** Otherknowledge();\
\$form =
\$this-\>createForm(**\'AppBundle\\Form\\CvMgr\\OtherknowledgeType\'**,
\$other\_knowledge);\
\$form-\>handleRequest(\$request);\
\
**if** (\$form-\>isSubmitted() ) {\
*// Establish relation to CV and user\
*\$other\_knowledge-\>setCv(\$this-\>**actual\_user\_cv**);\
*// 2. Set the relation to the CV\
*\$other\_knowledge-\>setCv(\$this-\>**actual\_user\_cv**);\
*// 3. Update CV in session\
*\$this-\>**actual\_user\_cv** =
\$session-\>get(**\'actual\_user\_cv\'**);\
\$this-\>**actual\_user\_cv**-\>addOtherknowledges(\$other\_knowledge);\
\$session-\>set(**\'actual\_user\_cv\'**,
\$this-\>**actual\_user\_cv**);\
\
*// Depending on the request the user might want enter another studies
(true)\
// or continue to insert studies (false)\
*\$nextAction = \$form-\>get(**\'saveAndAdd\'**)-\>isClicked()\
? **\'task\_new\'\
**: **\'task\_success\'**;\
\
**if**( \$nextAction == **\'task\_success\'** ){\
*// Persist values\
*\$this-\>getDoctrine()\
-\>getRepository(CV::**class**)\
-\>store\_cv\_values(\$session, \$this-\>**actual\_user\_cv**);\
*// CV creation finished.\
\
// Add user values stored in session to the actual user cv\
*\$id = \$session-\>get(**\'formerStudentID\'**);\
*// Get formed student values from database\
*\$formerStudent =
\$this-\>getDoctrine()-\>getManager()-\>getRepository(FormerStudents::**class**)-\>find(\$id);\
\
*// Redirectio to main page after login validation\
***return**
\$this-\>get(**\'security.authentication.guard\_handler\'**)\
-\>authenticateUserAndHandleSuccess(\
\$formerStudent,\
\$request,\
\$this-\>get(**\'app.security.login\_form\_authenticator\'**),\
**\'main\'\
**);\
}\
**else**{\
*// Clears previous form\
***unset**(\$other\_knowledge);\
**unset**(\$form);\
\
*// recursive call to addstudiesAction\
***return** \$this-\>redirectToRoute(**\'other\_task\_add\'**);\
}\
}\
\
**return** \$this-\>render(**\'cvmgr/otherknowledge/new.html.twig\'**,
**array**(\
**\'otherknowledge\'** =\> \$other\_knowledge,\
**\'form\'** =\> \$form-\>createView(),\
));\
}

La función encargada de realizar la persistencia se encuentra en la
clase de repositorio asociada a la entidad CV.

*// Method used to persist values in database\
***public function** store\_cv\_values( Session \$session, CV
\$actual\_user\_cv)\
{\
*// Manage fields according to what the database expects:\
*\$em = \$this-\>getEntityManager();\
*// Add formed student (from session) to actual user cv\
*\$formerStudent = \$session-\>get(**\'formerStudent\'**);\
\$actual\_user\_cv-\>setFormerstudent(\$formerStudent);\
**foreach** (\$actual\_user\_cv-\>getWorkexperiences() **as**
\$aux\_workexperience) {\
\$em-\>persist(\$aux\_workexperience);\
}\
**foreach** (\$actual\_user\_cv-\>getStudies() **as** \$aux\_studies) {\
\$em-\>persist(\$aux\_studies);\
}\
**foreach** (\$actual\_user\_cv-\>getLanguages() **as** \$aux\_language)
{\
\$em-\>persist(\$aux\_language);\
}\
**foreach** (\$actual\_user\_cv-\>getOtherknowledges() **as**
\$aux\_otherknowledge) {\
\$em-\>persist(\$aux\_otherknowledge);\
}\
\$em-\>flush();\
*// Delete CV in session\
*\$session-\>set(**\'actual\_user\_cv\'**, **null**);\
}

### Edición de un CV

Usuario exalumno

CVEditorController

A la hora de actualizar un CV se muestran los valores obtenidos desde la
base de datos para el CV de exalumno en cuestión.

*/\*\*\
\* Update values of an edited work experience from a selected
FormedStudent\'s CV\
\* **\@Route**(\"/{id\_std}/edit/workexperience\",
name=\"stdnts\_wrkexp\_edit\")\
\*/\
***public function** stdntsWorkExpEditAction(\$id\_std, Request
\$request, Session \$session)\
{\
*// Get the Working experience id from session\
*\$id\_wrkexp = \$request-\>**query**-\>get(**\'id\_wrkexp\'**);\
*// Get WorkExperience by Id\
*\$em = \$this-\>getDoctrine()-\>getManager();\
\$wrkexp\_db =
\$em-\>getRepository(**\'AppBundle:CvMgr\\WorkExperiences\'**)-\>find(\$id\_wrkexp);\
**if**(!\$wrkexp\_db){\
**throw** \$this-\>createNotFoundException(\
**\'No product found for id \'**.***id\_wrkexp\
***);\
}\
*// Update values taken from the form\
*\$wrkexp\_db-\>setVPosition(\$request-\>**request**-\>get(**\'position\'**));\
\$wrkexp\_db-\>setVEmployer(\$request-\>**request**-\>get(**\'employer\'**));\
\$wrkexp\_db-\>setVLocation(\$request-\>**request**-\>get(**\'location\'**));\
\$wrkexp\_db-\>setLtextDuties(\$request-\>**request**-\>get(**\'duties\'**));\
\$wrkexp\_db-\>setDStartDate(**new**
\\DateTime(\$request-\>**request**-\>get(**\'startdate\'**) ));\
\$wrkexp\_db-\>setDEndDate(**new**
\\DateTime(\$request-\>**request**-\>get(**\'enddate\'**) ));\
*// Update database\
*\$em-\>merge(\$wrkexp\_db);\
\$em-\>flush();\
*// Back to former students editing page\
***return**
\$this-\>redirect(\$this-\>generateUrl(**\'formerstudents\_edit\'**,
**array**(**\'id\'** =\> \$id\_std)));\
}

Dentro de la funcionalidad de edición hay que tener en cuenta la
posibilidad de que el usuario quiera añadir un nuevo elemento de los que
conforman su CV, ya sea una nueva experiencia laboral, estudios, etc.

Cuando el usuario pulsa la opción de añadir un nuevo elemento dentro de
la ventana de edición de CV se crea un nuevo registro en base de datos
con los valores de **to complete**.

Con esto simplificamos la lógica ya que al volver a realizar la llamada
a edición a través de *stdnts\_wrkexp\_edit* el usuario visualiza estos
valores para su edición.

*/\*\*\
\* New work experience to add to an editing FormedStudent\'s CV\
\* **\@Route**(\"/{id\_std}/{id\_cv}/new/workexperience\",
name=\"stdnts\_wrkexp\_new\")\
\*/\
***public function** stdntsWorkExpNewAction(\$id\_std, \$id\_cv, Request
\$request) {\
\$em = \$this-\>getDoctrine()-\>getManager();\
\
*// Look for the editing CV\
*\$actual\_user\_cv =
\$em-\>getRepository(CV::**class**)-\>find(\$id\_cv);\
\
*// Get id from last workexperience\
*\$highest\_id = \$this-\>getDoctrine()\
-\>getRepository(WorkExperiences::**class**)\
-\>getMaxId();\
\
*// Add another workexperience at the CV\
*\$newWrkExperience = **new** WorkExperiences();\
\$newWrkExperience-\>setId(\$highest\_id + 1);\
\$newWrkExperience-\>setVPosition(**\"to complete\"**);\
\$newWrkExperience-\>setVEmployer(**\"to complete\"**);\
\$newWrkExperience-\>setVLocation(**\"to complete\"**);\
\$newWrkExperience-\>setLtextDuties(**\"to complete\"**);\
\$newWrkExperience-\>setDStartDate(**new** \\DateTime());\
\$newWrkExperience-\>setDEndDate(**new** \\DateTime());\
\
*// Saving the referencing entity\
*\$em-\>persist(\$newWrkExperience);\
\$em-\>flush();\
*// Add entity to actual user CV\
*\$actual\_user\_cv-\>addWorkexperience(\$newWrkExperience);\
\
\$cv = \$em-\>getRepository(CV::**class**)-\>find(\$id\_cv);\
\$newWrkExperience-\>setCv(\$cv);\
\$em-\>merge(\$newWrkExperience);\
\$em-\>flush();\
\
*// Back to former students editing page\
*\$formerStudent =
\$em-\>getRepository(FormerStudents::**class**)-\>find(\$id\_std);\
**return**
\$this-\>redirect(\$this-\>generateUrl(**\'formerstudents\_edit\'**,
\[**\'username\'** =\> \$formerStudent-\>getUsername()\]));\
}

**NOTA:** La aplicación está diseñada para permitir que un usuario pueda
tener múltiples CVs, pero está funcionalidad no ha sido implementada. Es
por eso por lo que de una lista de CVs en la edición se obtiene el CV de
índice 0.

### Busqueda de un CV

Usuario empleador

CVSearchController

Para realizar la búsqueda de usuarios se establecen una serie de
filtros. Los valores disponibles para estos filtros se almacenan en una
tabla de base de datos, *categorías de CV*. Esta tabla se ha
implementado con la idea de poder aglutinar todo tipo de variables de
configuración, es por eso que su diseño sigue la pauta de Clave =\>
Valor, típica de un array asociativo. Además, incluye un campo de
descripción de manera que para obtener los valores de *categorías de
estudio*, relacionadas con la entidad *Study* con la siguiente consulta.

![](media/image13.png){width="3.937007874015748in"
height="1.2930457130358706in"}

3.  4.  5.  6.  7.  12. Consulta en table de categorías de CV.

A la hora de hacer uso de esta tabla se genera la respectiva entidad y
su repositorio para obtener los valores.

**use** Doctrine\\ORM\\EntityRepository;\
\
**class** CVCategoriesRepository **extends** EntityRepository {\
\
**function** getWorExperiencesPositions(){\
**return** \$this-\>getEntityManager()-\>createQuery(\
**\"SELECT e.value FROM AppBundle:CvMgr\\CVCategories e WHERE
e.key=\'Work Experience\' AND
e.description=\'position\'\"**)-\>getResult();\
}\
**function** getStudiesCategories(){\
**return** \$this-\>getEntityManager()-\>createQuery(\
**\"SELECT e.value FROM AppBundle:CvMgr\\CVCategories e WHERE
e.key=\'Studies\' AND e.description=\'study
category\'\"**)-\>getResult();\
}

#Gestión de usuarios


Para el desarrollo de las funcionalidades relacionadas con el control de
usuarios vamos a establecer un espacio de nombres, UserMgr. Dentro de
este espacio de nombres situamos las tablas de Usuario, Empleador y
Exalumno siguiendo las especificaciones del apartado de diseño.

Jerarquía de las entidades
--------------------------

El diagrama de clases queda de la siguiente manera:

![](media/image14.png){width="2.1840485564304464in"
height="1.8042136920384952in"}

El mapeo relacional de objetos (ORM) de Doctrine se referencia mediante
anotaciones.

Para utilizar la clase User como gestora de la seguridad se establece la
implementación de UserInterface y Serializable.

La estructuración de la herencia mediante doctrine se realiza con las
siguientes anotaciones:

*/\*\*\
\* \@ORM\\Entity\
\* \@ORM\\Table(name=\"user\_mgr\_users\")\
\* \@ORM\\InheritanceType(\"JOINED\")\
\* \@ORM\\DiscriminatorColumn(name=\"roles\", type=\"string\")\
\* \@ORM\\DiscriminatorMap({\
\* \"formerstudent\" = \"AppBundle\\Entity\\UserMgr\\FormerStudents\",\
\* \"employeer\" = \"AppBundle\\Entity\\UserMgr\\Employeers\",\
\* \"user\" = \"AppBundle\\Entity\\UserMgr\\User\"\
\* })\
\*/*

### Entidad base: Usuario

La clase basa User dispone de las siguientes propiedades.

#### Usuario

*/\*\*\
\* **\@ORM\\Column**(type=\"integer\")\
\* **\@ORM\\Id\
**\* **\@ORM\\GeneratedValue**(strategy=\"AUTO\")\
\*/\
***private \$id**;\
*/\*\*\
\* **\@ORM\\Column**(type=\"string\", length=25, unique=true)\
\*/\
***private \$username**;\
*/\*\*\
\* **\@ORM\\Column**(type=\"string\", length=64)\
\*/\
***private \$password**;\
\
*/\*\*\
\* **\@ORM\\Column**(type=\"string\", length=254, unique=true)\
\*/\
***private \$email**;\
**private \$roles**=\[\];

Como se puede apreciar existe un array de roles de usuario el cuál no es
trasladado a base de datos. En base de datos este campo se creará a
partir del DiscriminatorMap establecido en la herencia de ORM.

Se crean los getter/setter de las propiedades y se implementan las
funciones de Serialización utilizadas por el formulario de registro.

**public function** serialize() {\
**return** *serialize*(\[\
\$this-\>**id**,\
\$this-\>**username**,\
\$this-\>**email**,\
\$this-\>**password**,\
\$this-\>**roles\
**\]);\
}\
\
**public function** unserialize(\$serialized) {\
**list** (\
\$this-\>**id**,\
\$this-\>**username**,\
\$this-\>**email**,\
\$this-\>**password**,\
\$this-\>**roles\
**) = *unserialize*(\$serialized, \[**\'allowed\_classes\'** =\>
**FALSE**\]);\
}

#### Entidades de segundo nivel

Los actores que participan en este apartado de la aplicación son dos,
empleadores y exalumnos.

Estas clases contiene un constructor encargado de llamar al constructor
de la clase base.

**public function** \_\_construct() {\
**parent**::*\_\_construct*();\
}

#### Exalumno

*/\*\*\
\* **\@var** int\
\*\
\* **\@ORM\\Column**(name=\"id\", type=\"integer\")\
\* **\@ORM\\Id\
**\* **\@ORM\\GeneratedValue**(strategy=\"AUTO\")\
\*/\
***private \$id**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_NIF\", type=\"string\", length=45)\
\*/\
***private \$vNIF**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_Name\", type=\"string\", length=45)\
\*/\
***private \$vName**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_Surnames\", type=\"string\", length=45)\
\*/\
***private \$vSurnames**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_Address\", type=\"string\", length=45)\
\*/\
***private \$vAddress**;\
\
*/\*\*\
\* **\@var** \\DateTime\
\*\
\* **\@ORM\\Column**(name=\"d\_Birth\_Date\", type=\"date\")\
\*/\
***private \$dBirthDate**;\
\
*/\*\*\
\* **\@var** bool\
\*\
\* **\@ORM\\Column**(name=\"b\_Vehicle\", type=\"boolean\")\
\*/\
***private \$bVehicle**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"creation\_user\", type=\"string\",
length=45)\
\*/\
***private \$creationUser**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"modification\_user\", type=\"string\",
length=45)\
\*/\
***private \$modificationUser**;\
\
*/\*\*\
\* **\@var** \\DateTime\
\*\
\* **\@ORM\\Column**(name=\"creation\_date\", type=\"date\")\
\*/\
***private \$creationDate**;\
\
*/\*\*\
\* **\@var** \\DateTime\
\*\
\* **\@ORM\\Column**(name=\"modification\_date\", type=\"datetime\")\
\*/\
***private \$modificationDate**;

#### Empleador

*/\*\*\
\* **\@var** int\
\*\
\* **\@ORM\\Column**(name=\"id\", type=\"integer\")\
\* **\@ORM\\Id\
**\* **\@ORM\\GeneratedValue**(strategy=\"AUTO\")\
\*/\
***private \$id**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_CIF\", type=\"string\", length=45)\
\*/\
***private \$vCIF**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_Name\", type=\"string\", length=255)\
\*/\
***private \$vName**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_Logo\", type=\"string\", length=255)\
\*/\
***private \$vLogo**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_Description\", type=\"string\",
length=255)\
\*/\
***private \$vDescription**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_Contact\_Name\", type=\"string\",
length=255)\
\*/\
***private \$vContactName**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_Contact\_Phone\", type=\"string\",
length=255)\
\*/\
***private \$vContactPhone**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_Contact\_Mail\", type=\"string\",
length=255)\
\*/\
***private \$vContactMail**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"v\_Location\", type=\"string\", length=255)\
\*/\
***private \$vLocation**;\
\
*/\*\*\
\* **\@var** int\
\*\
\* **\@ORM\\Column**(name=\"n\_Number\_Of\_Workers\", type=\"integer\",
nullable=true)\
\*/\
***private \$nNumberOfWorkers**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"creation\_user\", type=\"string\",
length=45)\
\*/\
***private \$creationUser**;\
\
*/\*\*\
\* **\@var** string\
\*\
\* **\@ORM\\Column**(name=\"modification\_user\", type=\"string\",
length=45)\
\*/\
***private \$modificationUser**;\
\
*/\*\*\
\* **\@var** \\DateTime\
\*\
\* **\@ORM\\Column**(name=\"creation\_date\", type=\"date\")\
\*/\
***private \$creationDate**;\
\
*/\*\*\
\* **\@var** \\DateTime\
\*\
\* **\@ORM\\Column**(name=\"modification\_date\", type=\"datetime\")\
\*/\
***private \$modificationDate**;

#Gestión de acceso


*Symfony* gestiona la seguridad mediante dos aspectos diferenciados:
Autentificación y Autorización.

**Autentificación** verifica las credenciales de usuario. Su trabajo no
es restringir el acceso, solo necesita saber quién eres tú. Podíamos
pensar que se trata de un punto de seguridad en el acceso a un edificio
en el que tienes que identificarte. Una vez verificado obtienes una
tarjeta de acceso, o *token.* Este token puede ser utilizado para
desbloquear puertas. Todo el mundo en el interior del edificio debe de
disponer de un token, pero algunos tienen más acceso que otros.

**Autorización** es como el cerrojo que hay en cada puerta, impide que
los usuarios puedan acceder a un determinado sitio. No necesita saber
quién eres, solo si tienes permiso de acceso o no.

Formularios de acceso
---------------------

### Registro de usuario

Dentro del controlador de usuario se gestiona el registro de exalumnos y
empleadores. Una vez introducidos los valores de acceso común a la web
cada rol de usuarios sigue un asistente diferente.

*/\*\*\
\* **\@Route**(\"/register\", name=\"user\_register\")\
\*/\
***public function** registerAction(Request \$request,
UserPasswordEncoderInterface \$encoder) {\
\$user\_form = **new** UserRegistrationForm();\
\$form = \$this-\>createForm(UserRegistrationForm::**class**);\
\$form-\>handleRequest(\$request);\
**if** (\$form-\>isValid()) {\
*// Values of the User object shared by FormerStudents and Employeers\
*\$user\_form = \$form-\>getData();\
*// Save access values in session\
*\$session = \$request-\>getSession();\
\$session-\>set(**\'username\'**, \$user\_form-\>getUsername());\
\$session-\>set(**\'email\'**, \$user\_form-\>getEmail());\
\$plainPassword = \$user\_form-\>getPassword();\
\$encoded = \$encoder-\>encodePassword(\$user\_form, \$plainPassword);\
\$session-\>set(**\'password\'**, \$encoded);\
*// Check user type\
***if** (*in\_array*(**\"ROLE\_USER\_FORMER\_STUDENT\"**,
\$user\_form-\>getRoles())) {\
*// Show cv creation form\
***return** \$this-\>redirectToRoute(**\'formerstudents\_new\'**,
\[**\'request\'** =\> \$request\]);\
}\
**else** {\
**if** (*in\_array*(**\"ROLE\_USER\_EMPLOYEER\"**,
\$user\_form-\>getRoles())) {\
*// Show employee creation form\
***return** \$this-\>redirectToRoute(**\'employeers\_new\'**,
\[**\'request\'** =\> \$request\]);\
}\
}\
**return** \$this-\>get(**\'security.authentication.guard\_handler\'**)\
-\>authenticateUserAndHandleSuccess(\
\$user\_form,\
\$request,\
\$this-\>get(**\'app.security.login\_form\_authenticator\'**),\
**\'main\'\
**);\
}\
**return** \$this-\>render(**\'usermgr/register.html.twig\'**, \[\
**\'form\'** =\> \$form-\>createView(),\
\]);\
}

### Acceso de usuario

La lógica del controlador de usuario se encuentra sen
SecurityController.

*/\*\*\
\* **\@Route**(\"/register\", name=\"user\_register\")\
\*/\
***public function** registerAction(Request \$request,
UserPasswordEncoderInterface \$encoder) {\
\$user\_form = **new** UserRegistrationForm();\
\$form = \$this-\>createForm(UserRegistrationForm::**class**);\
\
\$form-\>handleRequest(\$request);\
**if** (\$form-\>isValid()) {\
*// Values of the User object shared by FormerStudents and Employeers\
*\$user\_form = \$form-\>getData();\
\
*// Save access values in session\
*\$session = \$request-\>getSession();\
\$session-\>set(**\'username\'**, \$user\_form-\>getUsername());\
\$session-\>set(**\'email\'**, \$user\_form-\>getEmail());\
\
\$plainPassword = \$user\_form-\>getPassword();\
\$encoded = \$encoder-\>encodePassword(\$user\_form, \$plainPassword);\
\$session-\>set(**\'password\'**, \$encoded);\
\
*// Check user type\
***if** (*in\_array*(**\"ROLE\_USER\_FORMER\_STUDENT\"**,
\$user\_form-\>getRoles())) {\
*// Show cv creation form\
***return** \$this-\>redirectToRoute(**\'formerstudents\_new\'**,
\[**\'request\'** =\> \$request\]);\
}\
**else** {\
**if** (*in\_array*(**\"ROLE\_USER\_EMPLOYEER\"**,
\$user\_form-\>getRoles())) {\
*// Show employee creation form\
***return** \$this-\>redirectToRoute(**\'employeers\_new\'**,
\[**\'request\'** =\> \$request\]);\
}\
}\
\
**return** \$this-\>get(**\'security.authentication.guard\_handler\'**)\
-\>authenticateUserAndHandleSuccess(\
\$user\_form,\
\$request,\
\$this-\>get(**\'app.security.login\_form\_authenticator\'**),\
**\'main\'\
**);\
}\
**return** \$this-\>render(**\'usermgr/register.html.twig\'**, \[\
**\'form\'** =\> \$form-\>createView(),\
\]);\
}

Desde el formulario de registro se delega la responsabilidad de
comprobar la validación de usuario a Security\\LoginFormAuthenticator.
Además, hay que configurar los parámetros de Autentificación y
Autorización en la configuración de security.yml.

**security**:\
\# En el caso que los usuarios tengan la contraseña cifrada configuramos
los encoders para la entidad en la que estén los usuarios\
**encoders**:\
**AppBundle\\Entity\\UserMgr\\User**:\
**algorithm**: bcrypt\
**cost**: 4\
**role\_hierarchy**:\
**ROLE\_USER**: \[ROLE\_USER\_FORMER\_STUDENTS,
ROLE\_USER\_EMPLOYEERS\]\
**ROLE\_ADMIN**: \[ROLE\_ARTEAN\]\
\
\# En providers le indicamos que los usuarios van a salir de la base de
datos y el username será email\
\#
https://symfony.com/doc/current/security.html\#b-configuring-how-users-are-loaded\
**providers**:\
**our\_db\_provider**:\
**entity**:\
**class**: AppBundle:UserMgr\\User\
**property**: email\
\
**firewalls**:\
\# disables authentication for assets and the profiler, adapt it
according to your needs\
**dev**:\
**pattern**: \^/(\_(profiler\|wdt)\|css\|images\|js)/\
**security**: false\
**main**:\
**anonymous**: \~\
**logout**: \~\
\
**guard**:\
**authenticators**:\
- AppBundle\\Security\\LoginFormAuthenticator\
\
**access\_control**:\
- { **path**: \^/login, **role**: IS\_AUTHENTICATED\_ANONYMOUSLY }\
- { **path**: \^/register, **role**: IS\_AUTHENTICATED\_ANONYMOUSLY }\
- { **path**: \^/admin, **role**: \[ROLE\_ARTEAN\] }\
- { **path**: \^/offers/(.+), **role**: \[IS\_AUTHENTICATED\_FULLY\] }\
- { **path**: \^/cv/new, **role**: \[IS\_AUTHENTICATED\_ANONYMOUSLY\] }\
- { **path**: \^/cv/search, **role**: \[ROLE\_USER\_EMPLOYEERS\] }

Manual de la aplicación.

Resultado del primer prototipo.

#Acceso a la web


En la primera pantalla lo que aparecen son las ofertas publicadas en la
web, ordenadas por fecha.

![](media/image15.png){width="5.905555555555556in"
height="3.209722222222222in"}

Para poder acceder a una vista más detallada de las ofertas debemos
registrarnos en la plataforma.

![](media/image16.png){width="5.905555555555556in"
height="3.2083333333333335in"}

Desde la opción de registro vamos a tener que seleccionar entre los dos
roles gestionados, exalumno y empresa.

![](media/image17.png){width="5.905555555555556in"
height="3.0854166666666667in"}

El primer formulario de información de acceso es común para ambos roles.

Generación de un Exalumno:

![](media/image18.png){width="5.905555555555556in"
height="3.1819444444444445in"}

#Exalumno


Registro de CV
--------------

Se registra en la aplicación introduciendo los datos de registro y los
datos personales globales para todos los tipos de usuarios.

![](media/image19.png){width="3.0924857830271217in"
height="1.9197123797025373in"}

A continuación, se lanza el asistente de creación de CV. En este
asistente se obliga a meter por lo menos un registro de cada uno de los
componentes del CV, experiencia laboral, estudios, idiomas y otros
intereses. El asistente permite introducir más de un campo de manera
recursiva para cada uno de los componentes del CV.

Agregar una experiencia de trabajo:

![](media/image20.png){width="3.937007874015748in"
height="3.3703455818022747in"}

Barra de herramientas
---------------------

La barra de herramientas de Exalumno muestra las diferentes
posibilidades que puede realizar un exalumno; Gestionar su CV y
Controlar sus candidaturas.

![](media/image21.png){width="5.905555555555556in"
height="0.3798611111111111in"}

Mi CV
-----

Desde la pantalla de visualización de CV se puede visualizar el aspecto
y pasar a la ventana de edición.

![](media/image22.png){width="3.937007874015748in"
height="3.6069181977252844in"}

Ventana de edición
------------------

Desde la ventana de edición no solo somos capaces de modificar los
registros de cada uno de los componentes del CV, también se puede crear
nuevos registros.

Para que los cambios surjan efecto debe de pulsarse el botón de
continuar.

![](media/image23.png){width="3.937007874015748in"
height="4.08700678040245in"}

Aplicar a una oferta
--------------------

Desde la pantalla principal un exalumno puede aplicar a una oferta al
acceder a sus detalles.

![](media/image24.png){width="3.937007874015748in"
height="2.1685028433945757in"}

Una vez que se ha aplicado a una oferta la visualización de su estado se
ve desde *Mis Candidaturas*.

Mis Candidaturas
----------------

Esta pantalla refleja las ofertas en las que está inscrito un exalumno.
Desde aquí puede hacer el seguimiento de su estado.

![](media/image25.png){width="3.937007874015748in"
height="2.196279527559055in"}

#Empresa


Registro
--------

La empresa pasa por un asistente parecido al de el exalumno al
registrarse en el sistema.

![](media/image26.png){width="3.937007874015748in"
height="3.2022911198600177in"}

Barra de herramientas
---------------------

La barra de herramientas de la empresa muestra la opción de publicar
oferta, gestionar los inscritos en las ofertas y el buscador de CVs.

![](media/image27.png){width="5.905555555555556in"
height="0.40069444444444446in"}

Publicar ofertas
----------------

En lugar de publicar su CV la empresa lanza la pantalla de publicación
de ofertas desde la barra de herramientas.

![](media/image28.png){width="3.446527777777778in"
height="5.572253937007874in"}

Detalles de oferta
------------------

Desde la pantalla de visualización de la oferta se pueden ver los
candidatos, editar la oferta o borrar la oferta.

![](media/image29.png){width="3.937007874015748in"
height="2.1323917322834647in"}

### Candidatos

Desde la ventana de candidatos se visualizan los usuarios que se han
registrado en la oferta. Desde aquí se puede cambiar el estado de cada
uno de ellos.

![](media/image30.png){width="3.937007874015748in"
height="1.9666524496937883in"}

Buscador de ofertas
-------------------

El gran potencial de esta aplicación es el buscador de CVs, capaz de
buscar una palabra en cualquiera de los campos registrados en el CV.
Esto es debido a que todos los componentes del CV son registrados como
tablas separadas y relacionadas. Cada uno de los campos de los
diferentes componentes son columnas de las tablas de base de datos.

![](media/image31.png){width="5.905555555555556in"
height="2.4944444444444445in"}
