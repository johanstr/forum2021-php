# Forum met vanilla PHP
In dit project bouwen we een forum met vanilla PHP. We gaan in feite twee applicaties bouwen. We bouwen een API om toegang te krijgen tot een database vanuit een client app. We bouwen een CLIENT om gebruikers een user interface te bieden. De CLIENT gaat via API calls de data binnenhalen en presenteren aan de gebruiker in verschillende pagina's.

# Hoe haal je deze repo binnen op je eigen computer?
Je haalt de repo binnen met de volgende commandline:  
  
```bash
    git clone https://github.com/johanstr/forum2021-php.git
```

Let op! met deze opdracht wordt automatisch een map aangemaakt met de naam **forum2021-php**  
  
# Wat vind je in deze repo?
Je vindt de volgende mappen:  
  
1. ***design***  
   Hierin is staat het voorbereidend werk qua **vormgeving** van de verschillende pagina's. Je vindt hier alle .html, .js, .css bestanden voor de user interface.
2. ***client***   
   In deze map gaan we de **CLIENT APP** ontwikkelen. We maken voor deze map lokaal een domeinnaam aan zodat we ook via een url kunnen simuleren dat het een aparte app is die los staat van de API.
3. ***api***  
   In deze map gaan de **API** ontwikkelen.

# Hoe maken we een lokale domeinnaam aan?
Dit doe je in verschillende stappen, waarbij de tweede stap afhankelijk is van het feit of je WAMP, XAMPP e.d. gebruikt. We gaan echter in de uitleg hieronder uit van Windows als OS.  
  
## Stap 1 - Lokale domeinnaam maken
In de map C:\Windows\System32\drivers\etc vind je het bestand **hosts**. Daarin kun je zoiets zien als:  
```
# Copyright (c) 1993-2009 Microsoft Corp.
#
# This is a sample HOSTS file used by Microsoft TCP/IP for Windows.
#
# This file contains the mappings of IP addresses to host names. Each
# entry should be kept on an individual line. The IP address should
# be placed in the first column followed by the corresponding host name.
# The IP address and the host name should be separated by at least one
# space.
#
# Additionally, comments (such as these) may be inserted on individual
# lines or following the machine name denoted by a '#' symbol.
#
# For example:
#
#      102.54.94.97     rhino.acme.com          # source server
#       38.25.63.10     x.acme.com              # x client host

# localhost name resolution is handled within DNS itself.
#	127.0.0.1       localhost
#	::1             localhost
# 127.0.0.1	localhost

```  
1. Open dit bestand met b.v. kladblok. Maar let op, start kladblok als administrator, want anders kun je dit bestand niet opslaan.
2. Haal het comment symbool voor 127.0.0.1 localhost weg. Dit is het #-teken  
3. Zet daaronder de volgende nieuwe regel:  
   ```
   127.0.0.1 forum2021-client.test
   ```  
   Hierbij is forum2021-client.test de gekozen lokale domeinnaam.  
   LET OP!!!! Je kunt geen tld's gebruiken die gangbaar zijn op het internet. Daarom is het veiliger om als TLD ***.test*** of ***.local*** te gebruiken.
4. Punt 3 herhaal je voor alle lokale domeinnamen die je wil gebruiken.
5. Sla het bestand op.
6. Zoek in de installatie map van WAMP of XAMPP of ... naar het bestand **httpd-vhosts.conf**  
   Vaak vind je deze in de map: \<WAMP of XAMPP\>\bin\apache\conf\extra\  
7. Open deze met een editor. Je ziet dan ongeveer de volgende inhoud:
  
```  
## Virtual Hosts  
#  
# If you want to maintain multiple domains/hostnames on your  
# machine you can setup VirtualHost containers for them. Most configurations  
# use only name-based virtual hosts so the server doesn't need to worry about  
# IP addresses. This is indicated by the asterisks in the directives below.  
#  
# Please see the documentation at   
# <URL:http://httpd.apache.org/docs/2.2/vhosts/>  
# for further details before you try to setup virtual hosts.  
#  
# You may use the command line option '-S' to verify your virtual host   # configuration.  
    
#
# Use name-based virtual hosting.
#
NameVirtualHost *:80

#
# VirtualHost example:
# Almost any Apache directive may go into a VirtualHost container.
# The first VirtualHost section is used for all requests that do not
# match a ServerName or ServerAlias in any <VirtualHost> block.
#
#<VirtualHost *:80>
#    ServerAdmin webmaster@dummy-host.example.com
#    DocumentRoot "/Apache22/docs/dummy-host.example.com"
#    ServerName dummy-host.example.com
#    ServerAlias www.dummy-host.example.com
#    ErrorLog "logs/dummy-host.example.com-error.log"
#    CustomLog "logs/dummy-host.example.com-access.log" common
#</VirtualHost>
```  
8. Plaats onderaan de volgende inhoud (minimaal):  
```
<VirtualHost *:80>
#    DocumentRoot "<de rootmap je webserver>"
#    Bijvoorbeeld:
    DocumentRoot "/www"
    ServerName localhost
    ErrorLog "logs/localhost-error.log"
    CustomLog "logs/localhost-access.log" common
</VirtualHost>  

<VirtualHost *:80>
#    DocumentRoot "<de map waar de code van je app staat>"
#    Bijvoorbeeld:
    DocumentRoot "/www/eindproject/client"
    ServerName forum2021-client.test
    ErrorLog "logs/forum2021-client.test-error.log"
    CustomLog "logs/forum2021-client.test-access.log" common
</VirtualHost>
```  
9. Sla dit bestand op.
10. Herstart Apache (de webserver software)
11. Probeer het maar eens uit door nu in de adresbalk van de browser de volledige url te tikken.  
    Dus: ***http://forum2021-client.test***  
