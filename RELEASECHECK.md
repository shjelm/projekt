Projekt PHP, 1dv408
===================================
Checklista för release

1. Databas
- Skapa en databas, ändra till rätt databas, användare, lösenord i  funktionen openCon() i LoginDAL
- Databasen ska ha en tabell med namnet member och
  member ska ha 9 fält:
	- Namn, varchar(60), not null
	- Personnummer, varchar(20), not null
	- Klass, varchar(5), not null
	- Namn, varchar(60), not null
	- Telefonnummer, varchar(20), not null
	- Adress, varchar(100), not null
	- Betalat_till, date
	- Anvnamn, varchar(10), not null
	- Losenord, varchar(50), not null
  men detta skapas automatiskt om tabellen member ej existerar.
  
2. Lägg upp hela mappen PHPProjekt på webbhotellet
