# Security Opdracht 3 Joan Maljers

## Auteurs
* **Joan Maljers** - *De site laten werken, inclusief IDOR toevoegen* - [Joan Maljers](https://github.com/DonDuck1)

## Uitleg van features
Snooping en session hijacking worden voorkomen door gebruik te maken van HTTPS en TLS (oftewel er wordt gebruikgemaakt van een 'SSL Certificate')

IDOR is via policies en @can in de blade files toegepast. Ook ben ik niet vergeten in de back-end bij de controllers ook van de policies gebruik te maken. Voor extra bescherming heb ik in plaats van 'id's als primary keys te gebruiken in sommige tables die met CRUD zijn betrokken heb ik 'uuid's gebruikt. Dit zijn willekeurige 'string's van een bepaalde lengte. Hierdoor wordt het raden naar een andere afdeling wanneer je op de 'show' pagina van de afdeling zit lastig. Bijvoorbeeld in plaats van:
<br>
.../departments/1
<br>
.../departments/2
<br>
Gebruik ik:
<br>
.../departments/02a11954-5a03-4c26-9bd1-21e06cf27d1b
<br>
.../departments/349a5e02-10fc-4bbc-b583-c9b59095b2ce
<br>

## Gebruikers
Ik heb al 5 verschillende gebruikers aangemaakt. Dit zijn:
<br>
email = beheerder@beheerder.com
<br>
password = DonaldDuck1234!
<br>
role: Administrator

email = john@john.com
<br>
password = DagobertDuck1234!
<br>
role: Manager

email = jane@jane.com
<br>
password = KnappeKitty1234!
<br>
role: Manager

email = johnjr@john.com
<br>
password = Kwik,KwekEnKwak1234!
<br>
role: User

email = janejr@jane.com
<br>
password = Floortje1234!
<br>
role: User

## Rollen
Er zijn 3 rollen: 'Administrator', 'Manager' en 'User'. De rechten van elke gebruiker (zoals het zou moeten zijn):
Iemand met de rol 'Administrator' heeft het recht om:
- Nieuwe gebruikers te registreren. Ze kunnen echter niet nieuwe gebruikers de rol 'Administrator' geven, dat zou moeten via de database. Ook kunnen ze accounts niet aanpassen na aanmaak (behalve via de database) en kunnen ze ze niet verwijderen (behalve via de database).
- Alle organisaties bekijken, nieuwe organisaties aan te maken, bestaande organisaties bewerken en verwijderen
- Alle afdelingen bekijken, nieuwe afdelingen maken, bestaande afdelingen bewerken en verwijderen

Iemand met de rol 'Manager' heeft het recht om:
- De bestaande organisatie waar hij bij hoort bekijken en bewerken.
- De bestaande afdelingen die horen bij zijn organisatie bekijken, nieuwe afdelingen die bij zijn organisatie horen maken, bestaande afdelingen die bij zijn organisatie horen wijzigen en verwijderen.

Iemand met de rol 'User' heeft het recht om:
- De bestaande organisatie waar hij bij hoort bekijken.
- De bestaande afdelingen die horen bij zijn organisatie bekijken.

## Links
Ik zal nu alle links geven die beschikbaar zijn voor de website wanneer hij net vers is gemigrate en geseed, en wat de links inhouden en voor wie ze beschikbaar zijn. '...' is de link naar de hoofdpagina/ welkomspagina van mijn site. Om IDOR aan te tonen kun je deze links in de zoekbalk van de browser plakken wanneer je bent ingelogd als verschillende gebruikers.
<br>
<br>
.../login -> Dient om gebruikers in te laten loggen. Beschikbaar voor iedereen.
<br>
<br>
.../ -> hoofdpagina/ welkomspagina. Beschikbaar voor iedereen.
<br>
<br>
.../register -> registreren van nieuwe gebruikers. Beschikbaar voor administrator.
<br>
<br>
.../profile -> wijzig informatie over eigen account. Beschikbaar voor iedereen voor hun eigen account. Dit is niet aangepast en is volledig zoals laravel breeze het voor me had gemaakt, dus zal ik hier geen manier voor geven om proberen om proberen andere mensen hun accounts te wijzigen of verwijderen (omdat hier ook sprake is van een indirecte verwijzing, er staat geen id/ uuid van het profiel in de URL, zou dit erg moeilijk zijn).
<br>
<br>
.../dashboard -> dashboard. Beschikbaar voor iedereen.
<br>
<br>
.../organisations -> tabel met alle organisaties. Beschikbaar voor administrator.
<br>
<br>
.../organisations/280ac77a-9bca-4d9c-aa0c-cbc6f39b6717 -> informatie over organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van deze organisatie en user van deze organisatie.
<br>
<br>
.../organisations/280ac77a-9bca-4d9c-aa0c-cbc6f39b6717/edit -> wijzig informatie over organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van deze organisatie.
<br>
<br>
.../organisations/8a9aebaf-f596-475b-94aa-7bc43af5e4e9 -> informatie over organisatie 'Jane's Commercial Space Flights'. Beschikbaar voor administrator, manager van deze organisatie en user van deze organisatie.
<br>
<br>
.../organisations/8a9aebaf-f596-475b-94aa-7bc43af5e4e9/edit -> wijzig informatie over organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van deze organisatie.
<br>
<br>
.../departments -> tabel met alle afdelingen. Beschikbaar voor administrator.
<br>
<br>
.../departments/02a11954-5a03-4c26-9bd1-21e06cf27d1b -> informatie over afdeling 'John's Alien Observers' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort en user van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/02a11954-5a03-4c26-9bd1-21e06cf27d1b/edit -> wijzig informatie over afdeling 'John's Alien Observers' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/349a5e02-10fc-4bbc-b583-c9b59095b2ce -> informatie over afdeling 'Jane's Safety Videos' van organisatie 'Jane's Commercial Space Flights'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort en user van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/349a5e02-10fc-4bbc-b583-c9b59095b2ce/edit -> wijzig informatie over afdeling 'Jane's Safety Videos' van organisatie 'Jane's Commercial Space Flights'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/5ad872f5-1a85-42e6-a4fc-6788227c6a55 -> informatie over afdeling 'Jane's Spicy Engines' van organisatie 'Jane's Commercial Space Flights'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort en user van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/5ad872f5-1a85-42e6-a4fc-6788227c6a55/edit -> wijzig informatie over afdeling 'Jane's Spicy Engines' van organisatie 'Jane's Commercial Space Flights'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/67392d6a-d4ad-4bdd-bb67-c4880e57652d -> informatie over afdeling 'John's Astronaut Training' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort en user van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/67392d6a-d4ad-4bdd-bb67-c4880e57652d/edit -> wijzig informatie over afdeling 'John's Astronaut Training' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/8a6ce960-4860-428c-8d78-38fa4013ef24 -> informatie over afdeling 'John's Rocket R&D' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort en user van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/8a6ce960-4860-428c-8d78-38fa4013ef24/edit -> wijzig informatie over afdeling 'John's Rocket R&D' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort.

## Om de 'store', 'update' en 'delete' routes proberen te bereiken kun je respectievelijk de volgende code toevoegen aan de site via de webeditor. Vergeet daarbij niet de '...' en wat tussen {{}} staat te vervangen met de relevante data.
### 'Store' user (alleen administrator mag nieuwe gebruikers maken via .../register):
```
<form method="POST" action=".../register">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <!-- Name -->
    <div>
        <label class="block font-medium text-sm text-gray-700" for="name">Name</label>
        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="name" type="text" name="name" required="required" autofocus="autofocus" autocomplete="name">
    </div>

    <!-- Organisation -->
    <div class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="organisation">Organisation</label>
        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="organisation" name="organisation">
            <option value="" selected="" disabled="" hidden="">-- Choose an organisation --</option>
            <option value="John's Space Agency">John's Space Agency</option>
            <option value="Jane's Commercial Space Flights">Jane's Commercial Space Flights</option>
        </select>
    </div>

    <!-- Role -->
    <div class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="role">Role</label>
        <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="role" name="role">
            <option value="" selected="" disabled="" hidden="">-- Choose a role --</option>
            <option value="User">User</option>
            <option value="Manager">Manager</option>
            <option value="Administrator">Administrator</option> <!-- Dit staat in de normale register route niet en is via de backend onmogelijk te verwerken -->
        </select>
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="email">Email</label>
        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="email" type="email" name="email" required="required" autocomplete="username">
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="password">Password</label>
        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="password" type="password" name="password" required="required" autocomplete="new-password">
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label class="block font-medium text-sm text-gray-700" for="password_confirmation">Confirm Password</label>
        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="password_confirmation" type="password" name="password_confirmation" required="required" autocomplete="new-password">
    </div>

    <div class="flex items-center justify-end mt-4">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4">Register</button>
    </div>
</form>
```
### 'Store' organisation (alleen administrator):
```
<form method="POST" action=".../organisations">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <div class="field">
        <label class="label" for="name">Organisation name</label>
        <div class="control">
            <input class="input" type="text" name="name" id="name" size="80" value="">
        </div>
    </div>

    <div class="field">
        <label class="label" for="active">Active</label>
        <div class="control">
            <select id="active" name="active">
                <option value="1">True</option>
                <option value="0">False</option>
            </select>
        </div>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button class="submit_button_blogs" type="submit">Submit</button>
        </div>
    </div>
</form>
```

### 'Update' organisation (adminstrator, manager kan alleen van zijn eigen organisatie info wijzigen):
```
<form method="POST" action=".../organisations/{{ organisation uuid }}">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <input type="hidden" name="_method" value="PUT">            
    <div class="field">
        <label class="label" for="name">Organisation Name</label>
        <div class="control">
            <input class="input" type="text" name="name" id="name" value="Jane's Commercial Space Flights" size="80">
        </div>
    </div>

    <div class="field">
        <label class="label" for="active">Active</label>
        <div class="control">
            <select id="active" name="active">
                <option value="1" selected="">True</option>
                <option value="0">False</option>
            </select>
        </div>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button class="submit_button_blogs" type="submit">Submit</button>
        </div>
    </div>
</form>
```

### 'Delete' organisation (alleen administrator):
```
<form method="POST" action=".../organisations/{{ organisation uuid }}">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit">Delete</button>
</form>
```

### 'Store' department (adminstrator, manager kan alleen afdelingen bij eigen organisatie toevoegen):
```
<form method="POST" action=".../public/departments">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <div class="field">
        <label class="label" for="name">Department name</label>
        <div class="control">
            <input class="input" type="text" name="name" id="name" size="80" value="">
        </div>
    </div>

    <div class="field">
        <label class="label" for="active">Active</label>
        <div class="control">
            <select id="active" name="active">
                <option value="1">True</option>
                <option value="0">False</option>
            </select>
        </div>
    </div>

    <div class="field">
        <label class="label" for="organisation">Organisation</label>
        <div class="control">
            <select id="organisation" name="organisation">
                <option value="" selected="" disabled="" hidden="">-- Choose an organisation --</option>
                <option value="John's Space Agency">John's Space Agency</option>
                <option value="Jane's Commercial Space Flights">Jane's Commercial Space Flights</option>
            </select>
        </div>
    </div>
            

    <div class="field is-grouped">
        <div class="control">
            <button class="submit_button_blogs" type="submit">Submit</button>
        </div>
    </div>
</form>
```

### 'Update' department (adminstrator, manager kan alleen afdelingen van eigen organisatie wijzigen):
```
<form method="POST" action=".../departments/{{ department uuid }}">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <input type="hidden" name="_method" value="PUT">            
        <div class="field">
        <label class="label" for="name">Department Name</label>
        <div class="control">
            <input class="input" type="text" name="name" id="name" value="John's Alien Observers" size="80">
        </div>
    </div>

    <div class="field">
        <label class="label" for="active">Active</label>
        <div class="control">
            <select id="active" name="active">
                <option value="1" selected="">True</option>
                <option value="0">False</option>
            </select>
        </div>
    </div>

    <div class="field">
        <label class="label" for="organisation">Organisation</label>
        <div class="control">
            <select id="organisation" name="organisation">
                <option value="1">Create new</option>
                <option value="John's Space Agency" selected="">John's Space Agency</option>
                <option value="Jane's Commercial Space Flights">Jane's Commercial Space Flights</option>
            </select>
        </div>
    </div>
            
    <div class="field is-grouped">
        <div class="control">
            <button class="submit_button_blogs" type="submit">Submit</button>
        </div>
    </div>
</form>
```

### 'Delete' department (adminstrator, manager kan alleen afdelingen van eigen organisatie verwijderen):
```
<form method="POST" action=".../departments/{{ department uuid }}">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <input type="hidden" name="_method" value="DELETE">            
    <button type="submit">Delete</button>
</form>
```
