Projekt PHP, 1dv408
===================================

TF 1.1 Navigera till sida
1. Öppna webbläsare
2. Navigera till sida (http://www.sofiahjelm.se/PHPProjekt)
3. Systemet visar en inloggningssida

TF 1.2 Logga in admin	
1. Testfall 1.1 Navigera till sida
2. Skriv in "Admin" och "Password"
3. Klicka på logga in
4. Admin loggas in och rättmeddelande visas

TF 1.3 Logga in admin med fel användarnamn	
1. Testfall 1.1 Navigera till sida
2. Skriv in "Adminas" och "Password"
3. Klicka på logga in
4. Felmeddelande "Felaktigt användarnamn och/eller lösenord" visas
5. Användarnamnet förblir ifyllt

TF 1.3 Logga in admin med fel lösenord	
1. Testfall 1.1 Navigera till sida
2. Skriv in "Admin" och "Fel"
3. Klicka på logga in
4. Felmeddelande "Felaktigt användarnamn och/eller lösenord" visas

TF 1.4 Logga in admin utan användarnamn	eller lösenord
1. Testfall 1.1 Navigera till sida
2. Skriv in "" och ""
3. Klicka på logga in
4. Felmeddelande "Användarnamn saknas" visas

TF 1.5 Logga in admin utan användarnamn	
1. Testfall 1.1 Navigera till sida
2. Skriv in "" och "Password"
3. Klicka på logga in
4. Felmeddelande "Användarnamn saknas" visas

TF 1.6 Logga in admin utan lösenord	
1. Testfall 1.1 Navigera till sida
2. Skriv in "Admin" och ""
3. Klicka på logga in
4. Felmeddelande "Lösenord saknas" visas

TF 1.7 Inloggad vid omladdning av sida
1. TF 1.2 Logga in admin	
2. Uppdatera sidan (markera url och enter)
3. Admin är fortfarande inloggad

TF 1.8 Logga in admin, med HTML-taggar och fel uppgifter	
1. Testfall 1.1 Navigera till sida
2. Skriv in "<a href="?">Admin</a>" och "Fel"
3. Klicka på logga in
4. Felmeddelande visas och taggarna tas bort från användarnamnet

TF 1.9 Logga in admin, med HTML-taggar och rätt uppgifter	
1. Testfall 1.1 Navigera till sida
2. Skriv in "<a href="?">Admin</a>" och "Password"
3. Klicka på logga in
4. Admin loggas in och rättmeddelande visas

===================================

TF 2.1 Visa medlem
1. TF 1.2 Logga in admin	
2. TF 3.1 Visa alla medlemmar
3. Ange personnummer
4. Klicka på sök
5. Medlem visas

TF 2.2 Visa medlem, ogiltigt personnummer
1. TF 1.2 Logga in admin	
2. TF 3.1 Visa alla medlemmar
3. Ange ett ej registrerat personnummer
4. Klicka på sök
5. Felmeddelande visas

TF 2.3 Ändra medlem
1. TF 3.1 Visa alla medlemmar
2. Leta upp den medlem som ska ändras
3. Klicka på ändra medlem
4. Fyll i de uppgifter som ska ändras
5. Klicka på uppdatera
6. Rättmeddelande visas

TF 2.4 Ändra medlem, fel format på datum
1. TF 3.1 Visa alla medlemmar
2. Klicka på ändra medlem
3. Fyll i ett felaktigt format på datum (23/6-2013)
4. Klicka på uppdatera
5. Felmeddelande visas

TF 2.5 Radera medlem
1. TF 3.1 Visa alla medlemmar
2. Klicka på radera medlem
3. Klicka på bekräfta
4. Medlemmen raderas och rättmeddelande visas

TF 2.6 Ändra medlem, felaktig klass
1. TF 3.1 Visa alla medlemmar
2. Klicka på ändra meelm
3. Ange en felatkig klass (WP23)
3. Klicka på uppdatera
5. Felmeddelande visas

TF 2.7 Ändra medlem, felaktig email
1. TF 3.1 Visa alla medlemmar
2. Klicka på ändra meelm
3. Ange en felatkig email (hej@du)
3. Klicka på uppdatera
5. Felmeddelande visas
===================================

TF 3.1 Visa alla medlemmar
1. TF 1.2 Logga in admin	
2. Klicka på visa alla medlemmar
3. Alla medlemmar visas

TF 3.2 Visa alla medlemmar som har betalat
1. Testfall 3.1 Visa alla medlemmar
2. Klicka på visa betalande medlemmar
3. Alla betalande medlemmar visas

TF 3.3 Visa alla medlemmar som ej har betalat
1. Testfall 3.1 Visa alla medlemmar
2. Klicka på visa icke betalande medlemmar
3. Alla ej betalande medlemmar visas

===================================

TF 4.1 Registrera medlem
1. TF 1.2 Logga in admin
2. Klicka på registrera medlem
3. Skriva in korrekta uppgifter i alla fält
4. Klicka på registrera
5. Rättmeddelande visas

TF 4.2 Registrera medlem, med tomma fält
1. TF 1.2 Logga in admin
2. Klicka på registrera medlem
3. Skriva in uppgifter men lämna namn tomt
4. Klicka på registrera
5. Felmeddelande visas

TF 4.3 Registrera medlem, med tomt betalningsfält
1. TF 1.2 Logga in admin
2. Klicka på registrera medlem
3. Skriva in uppgifter men lämna betalningsdatum tomt
4. Klicka på registrera
5. Rättmeddelande visas

TF 4.4 Registrera medlem, med ogiltigt personnummer
1. TF 1.2 Logga in admin
2. Klicka på registrera medlem
3. Skriva in uppgifter men ange ett ogiltigt personnummer (121232)
4. Klicka på registrera
5. Felmeddalnde visas

TF 4.5 Registrera medlem, med redan registrerat personnummer
1. TF 1.2 Logga in admin
2. Klicka på registrera medlem
3. Skriva in uppgifter men ange ett personnummer som redan är registrerat (9103014565)
4. Klicka på registrera
5. Felmeddalnde visas

TF 4.6 Registrera medlem, felaktig klass
1. TF 1.2 Logga in admin
2. Klicka på registrera medlem
3. Ange en felaktig klass (WP23)
4. Klicka på registrera
5. Felmeddalnde visas

TF 4.7 Registrera medlem, felaktig email
1. TF 1.2 Logga in admin
2. Klicka på registrera medlem
3. Ange en felaktig email (hej@du)
4. Klicka på registrera
5. Felmeddalnde visas

===================================

TF 5.1 Logga in medlem
1. TF 1.1 Navigera till sida
2. Skriva in korrekt användarnamn ("Ras910301") och lösenord ("Losenord")
3. Klicka på logga in
4. Medlemmen loggas in 

TF 5.2 Logga in medlem med fel användarnamn	
1. Testfall 1.1 Navigera till sida
2. Skriv in "Fel" och "Losenord"
3. Klicka på logga in
4. Felmeddelande "Felaktigt användarnamn och/eller lösenord" visas

TF 5.3 Logga in medlem med fel lösenord	
1. Testfall 1.1 Navigera till sida
2. Skriv in "Ras910301" och "Fel"
3. Klicka på logga in
4. Felmeddelande "Felaktigt användarnamn och/eller lösenord" visas

TF 5.4 Logga in medlem utan användarnamn eller lösenord
1. Testfall 1.1 Navigera till sida
2. Skriv in "" och ""
3. Klicka på logga in
4. Felmeddelande "Användarnamn saknas" visas

TF 5.5 Logga in medlem utan användarnamn	
1. Testfall 1.1 Navigera till sida
2. Skriv in "" och "Losenord"
3. Klicka på logga in
4. Felmeddelande "Användarnamn saknas" visas

TF 5.6 Logga in medlem utan lösenord	
1. Testfall 1.1 Navigera till sida
2. Skriv in "Ras910301" och ""
3. Klicka på logga in
4. Felmeddelande "Lösenord saknas" visas

===================================

TF 6.1 Ändra lösenord
1. TF 5.1 Logga in medlem
2. Klicka på ändra lösenord
3. Ange ett nytt lösenord
4. Repetera lösenordet
5. Klicka på bekräfta ändring
6. Rättmeddelande visas

TF 6.2 Ändra lösenord, misslyckat försök
1. TF 5.1 Logga in medlem
2. Klicka på ändra lösenord
3. Ange ett nytt lösenord ("Losenord")
4. Reptera lösenord ("Losen")
5. Klicka på bekräfta ändring
6. Felmeddelande visas

TF 6.3 Ändra lösenord, misslyckat försök med "Ange nytt lösenord" tomt 
1. TF 5.1 Logga in medlem
2. Klicka på ändra lösenord
3. Lämna ange ett nytt lösenord tomt
4. Reptera lösenord ("Losen")
5. Klicka på bekräfta ändring
6. Felmeddelande visas

TF 6.4 Ändra lösenord, misslyckat försök med "Repetera lösenord" tomt 
1. TF 5.1 Logga in medlem
2. Klicka på ändra lösenord
3. Ange ett nytt lösenord ("Losenord")
4. Lämna reptera lösenord tomt
5. Klicka på bekräfta ändring
6. Felmeddelande visas

TF 6.5 Ändra lösenord, misslyckat försök med tomma fält
1. TF 5.1 Logga in medlem
2. Klicka på ändra lösenord
3. Lämna ange ett nytt lösenord tomt
4. Lämna reptera lösenord tomt
5. Klicka på bekräfta ändring
6. Felmeddelande visas

TF 6.6 Ändra lösenord, misslyckat försök med för kort lösenord
1. TF 5.1 Logga in medlem
2. Klicka på ändra lösenord
3. Ange "losen"
4. Repeera "losen"
5. Klicka på bekräfta ändring
6. Felmeddelande visas

===================================

TF 7.1. Visa alla medlemmar, enkel lista
1. TF 5.1 Logga in medlem
2. Klicka på visa alla medlemmar
3. Alla medlemmar visas i en enkel lista med namn, klass och epostadress

===================================
TF 8.1 Logga ut medlem
1. TF 5.1 Logga in medlem
2. Klicka på logga ut
3. Medlemmen loggas ut och rättmeddelande visas

TF 8.2 Logga ut admin
1. TF 1.2 Logga in admin
2. Klicka på logga ut
3. Admin loggas ut och rättmeddelande visas

===================================
TF 9.1 Lägg till evenemang
1. TF 1.2 Logga in admin
2. Klicka på skapa evenemang
3. Fyll i titel, tidpunkt och beskrvning
4. Klicka på spara
5. Eventet sparas och rättmeddelande visas

TF 9.2 Lägg till evenemang, tomma fält
1. TF 1.2 Logga in admin
2. Klicka på skapa evenemang
3. Fyll i titel och tidpunkt
4. Klicka på spara
5. Felmeddelande visas

TF 9.3 Visa evenemang, admin
1. TF 1.2 Logga in admin
2. Klicka på visa alla evenemang 
3. Alla evenemang visas

TF 9.4 Visa evenemang, medlem
1. TF 5.1 Logga in medlem
2. Klicka på visa alla evenemang 
3. Alla evenemang visas

TF 9.5 Ändra evenemang
1. TF 1.2 Logga in admin
2. Klicka på visa alla evenemang 
3. Klicka på ändra evenemang
4. Fyll i uppgifter
5. Klicka på uppdatera
6. Rättmeddelande visas

TF 9.6 Ändra evenemang, misslyckat datum
1. TF 1.2 Logga in admin
2. Klicka på visa evenemang 
3. Klicka på ändra evenemang
4. Fyll i ogiltigt datum
5. Klicka på uppdatera
6. Felmeddelande visas

TF 9.7 Ändra evenemang, misslyckad tid
1. TF 1.2 Logga in admin
2. Klicka på visa evenemang 
3. Klicka på ändra evenemang
5. Fyll i ogiltig tidpunkt
5. Klicka på uppdatera
6. Felmeddelande visas

TF 9.8 Radera evenemang
1. TF 1.2 Logga in admin
2. Klicka på visa evenemang 
3. Klicka på radera evenemang
4. Evenemanget raderas och rättmeddeladne visas
