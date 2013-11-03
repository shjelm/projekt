Projekt PHP, 1dv408
===================================
AF 1. Registrera medlem
Admin vill registrera en ny medlem. Systemet sparar medlemmen.

Primär aktör
Admin

Förkrav
Admin är inloggad.

Efterkrav
Medlemmen blir registrerad.

Huvudscenario
1.	Startar när admin har loggat in
2.	Systemet visar menyval
3.	Admin väljer att registrera medlem
4.	Systemet visar formulär
5.	Admin skriver in uppgifter
6.	Systemet sparar medlemmen

Alternativa scenarios
5a. Admin skriver in felaktiga uppgifter
     1. Systemet visar felmeddelande
     2. Admin rättar till fel
     Gå till steg 6.

===================================

AF 2. Visa fullständigt register
Admin vill se alla registrerade medlemmar.

Primär aktör
Admin

Förkrav
Admin är inloggad.

Efterkrav
Alla registrerade medlemmar visas.

Huvudscenario
1.	Startar när admin har loggat in
2.	Systemet visar menyval
3.	Admin väljer att visa alla medlemmar
4.	Systemet visar alla medlemmar

===================================

AF 3. Se betalningsstatus hos medlem
Admin vill se om en medlem har betalat. 

Primär aktör
Admin

Förkrav
Admin är inloggad.

Huvudscenario
1.	Startar när admin har loggat in
2.	Systemet visar menyval
3.	Admin väljer att visa medlem
4.  Systemet visar möjlighet att söka på en specifik medlem
5.	Admin skriver in ett personnummer och söker på en medlem
6.	Systemet visar medlemmen med dess uppgifter

Alternativa scenarios
5a. Admin skriver in ett felaktigt  personnummer
     1. Systemet visar felmeddelande
     2. Admin söker på ett korrekt personummer
     Gå till steg 6.

===================================

AF4. Ändra registrerade uppgifter
Admin vill ändra en registrerad medlems uppgifter. 
Admin måste ha loggat in för att kunna utföra uppgiften. 
Admin väljer att visa en medlem och klickar sedan på ändra medlem.
Admin ändrar uppgifterna och sparar medlemmen.

===================================

AF5. Avregistrera medlem
Admin vill avregistrera en medlem. 
Admin måste ha loggat in för att kunna utföra uppgiften.
Admin väljer att visa en medlem och klickar sedan på radera medlem. 
Admin väljer att avregistrera medlemmen och den försvinner ur registret.

===================================

AF6. Kolla sina egna uppgifter
En medlem vill kunna se sina uppgifter. 
Medlemmen måste logga in för att kunna se dem. 
Medlemmens uppgifter visas då den loggar in.

===================================
AF7. Logga in nyregistrerad medlem
En nyregistrerad medlem vill kunna logga in. 
Medlemmen skriver in användarnamn och lösenord och klickar på logga in.
Om uppgifterna är korrekta loggas medlemmen in.

===================================
AF8. Ändra lösenord
En medlem vill kunna ändra sitt lösenord.
Medlemmen loggar in och väljer att ändra lösenord.
Lösenordet uppdateras i databasen.

===================================
AF 9. Visa alla medlemmar i en enkel lista (för andra medlemmar)

===================================
AF 10. Admin ska kunna lägga till evenemang och se dem i en lista

===================================
AF 11. Admin ska kunna radera och ändra evenemang

===================================
AF 12. Medlem ska kunna visa evenemangen


