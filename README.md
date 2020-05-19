# RP2_Projekt

### Promjene
* dodano u bazu in_offering u spiza food - flag 0 ili 1, 1 ako je u ponudi jelo 0 ako je izbrisano iz ponude
#### Za inicijaliziranje baze:
* Treba u app/database/db.class namjestit podatke za login u bazu
* Za kreiranje tablica potrebno je pokrenuti na serveru file-ove 

###### Napomena:
* U css folderu treba ostaviti file style_404.css
* Registracija korisnika radi samo ako se pokreće na rp2 serveru


#### Baza podataka
* baza users je ista kao u dz2
* restaurants baza ima restorane Pizzeria 6, Pizzeria Bros, Rocket Buger, Submarine, Batak Grill, Kokopeli, R&B Food House Of Ribs, Kineski restoran Peking, Koykan World Food - Tkalčićeva, Pizzeria Zagabria
* liste restorana po vrsti hrane: pizza, burger, grill, meksicka, kineska
    !!neki restorani mogu spadati u više vrsta hrane!!
* baza orders ima već nekoliko narudžbi pa da se pazi da već neke narudžbe postoje

### Opis:
* Na svakoj stranici se ispisuje menu: Moji omiljeni restorani, Moje narudžbe, Svi restorani, Logout
* Nakon ulogiravanja se ispisuje: 
    * mogućnost odabira restorana prema tipu hrane
    * mogućnost pregleda restorana koji dostavljaju na moju adresu (prema udaljenosti, npr. 10 km)
    * lista Vaši omiljeni restorani: trenutno ispisuje restorane koje je korisnik ocijenio sortirano silazno prema ocjeni, 
    želimo ubaciti još da se gleda broj narudžbi korisnika iz svakog tog restorana, npr.
    Vaši omiljeni restorani:
        Rocket Burger     - ocjena: 9, br_narudzbi: 6
        Pizzeria Zagabria - ocjena: 9, br_narudzbi: 4
        Submarine         - ocjena: 9, br_narudzbi: 3
        Kokopeli          - ocjena: 8, br_narudzbi: 5
* Svi restorani: popis restorana prema njihovoj ocjeni
* Moje narudžbe:

