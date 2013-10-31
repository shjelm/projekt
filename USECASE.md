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
3.	Admin väljer att visa medlemmar
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
3.	Admin väljer att kolla en medlem
4.	Systemet visar medlemmen med massa uppgifter

===================================

AF4. Ändra registrerade uppgifter
Admin vill ändra en registrerad medlems uppgifter. 
Admin måste ha loggat in för att kunna utföra uppgiften. 
Admin ändrar uppgifterna och sparar medlemmen.

===================================

AF5. Avregistrera medlem
Admin vill avregistrera en medlem. 
Admin måste ha loggat in för att kunna utföra uppgiften. 
Admin väljer att avregistrera medlemmen och den försvinner ur registret.

===================================

AF6. Kolla sina egna uppgifter
En medlem vill kunna se sina uppgifter. 
Medlemmen måste logga in för att kunna se dem. 
Medlemmens uppgifter visas då den loggar in

===================================
AF7. Logga in reggad medlem
En nyreggad medlem vill kunna logga in. Medlemmen skriver in användarnamn och lösenord och loggas in.

===================================
AF8. Visa alla medlemmar i en enkel lista (för andra medlemmar)


