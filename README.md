# First graded assignment from Web Programing
## Human Resource System with Symfony

## Running after simple unzip
Solution was tested on remote my remote computer (Docker CE 18.09, Ubuntu 18.04), it was working on both my local and remote machines after simple unzip.

## Dump
Dump is provided inside '/dump' directory.

## Start URL
Startng URL 'localhost/'
If there is a case, above URL is not redirecting properly, 'localhost/login' should be considered as starting URL.

## CSS framework used
In this porject I use Bootrstap4, its defined in Base Template, JavaSript part of Bootstrap is included as well, to work with Symfony Bootstrap4 form template. 

## Short description
This application was built with Symfony 4. With tools provided by framwork I developed and implemented database model, with mutiple tables and relations, and CRUD forms were created for them. Access for these forms is restricted, of all them are available from admin account. Most of them are accesible from HR account, since, according to project specyfication, HR department need access to them. 
Beacuse of ordinary user should have no access to data of other users, special section "My Data" was developed. It allows user to preview, and request edition of his personal data. 
Requests are stored in special table, named TemporaryPersonalData, which is similar to PersonalData table, but also includes Timestamps and does not have realtions. Other personal data, such as Addresses, Emails, and Phone Numbers, which are stored by system in separate tabels, in TemporaryPersonalData are stored as JSON's to avoid creating realtions.
Also special page for HR user was developed to approve or discard these requests, to maintain data consistency requests are delivered to HR members in ascending order by timestamp.
For superiors section "My Units" was developed. There Superiors can preview data of their team members. Ordinary users can access this section as well, but in this case no data should be displayed.

## Access system control
Access control is based on hierarchical roles. Lowest in hierarchy is USER, then HR and ADMIN, user with particular role can access content for lower-level roles. This implementation was followed, since is provided by Symfony Security package.
Superior is defined as a Superior of an unit, one User may be superior of many units. Groups of Users is defined as members of the same unit. Automaticly Superior of an unit, becomes superior over group of unit members.

## User credentials

Super user:
Username: admin
password: admin

HR user:
Username: AnnaNova
password: password

Superior user:
Username: JohnDoe
password: password

Ordinary user:
Username: JohnSmith
password: password
